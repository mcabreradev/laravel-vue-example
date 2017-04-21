<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\DpossApiContract;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\OficinaVirtual\Conexion;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Jrean\UserVerification\Facades\UserVerification;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Validator;
use Flash;
use Exception;
use Auth;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins, VerifiesUsers;

    /**
     * Servicio para consultar la API de DPOSS. Inyectado en constructor
     * @var App\Contracts\DpossApiContract
     */
    protected $dpossApi = null;

    /**
     * Guarda la info obtenida desde la API cuando un registro paso las validaciones
     */
    protected $boletaInfoCache = null;

    /**
     * Redirect URL when is not authenticated
     * @var string
     */
    protected $loginPath = 'login';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'users/dashboard';

    /**
     * Default redirect after successful authentication
     * @var string
     */
    protected $redirectAfterLogout = 'login';

    /**
     * Subject del email de verificacion
     * @var string
     */
    protected $verificationEmailSubject = '';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(DpossApiContract $dpossApi)
    {
        $this->verificationEmailSubject = env('EMAIL_VERIFY_SUBJECT', 'D.P.O.S.S.');
        $this->dpossApi = $dpossApi;
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'getVerification', 'getVerificationError']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',

            'terminos_y_condiciones' => 'accepted',

            'nro_factura'     => 'required',
            'periodo_factura' => ['required', 'regex:/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/'],
            'monto_factura'   => ['required', 'regex:/[0-9]+,[0-9][0-9]/'],
            'expediente'      => 'required',
        ];

        $messages = [
            'terminos_y_condiciones.accepted' => 'Debe aceptar los términos y condiciones'
        ];

        $validator =  Validator::make($data, $rules, $messages);

        // luego de las comprobaciones basicas se llamara al metodo validarInfoFactura
        $validator->after([$this, 'validarInfoFactura']);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'telefono' => $data['telefono']
        ]);

        // Asocio al usuario con la conexion
        if ($this->boletaInfoCache !== null) {
            $conexion = Conexion::firstOrNew([
                'expediente' => $this->boletaInfoCache->expediente,
                'unidad'     => $this->boletaInfoCache->numero_unidad,
                'domicilio'  => $this->boletaInfoCache->domicilio,
            ]);
            $conexion->save();
            $conexion->users()->attach($user);
            $conexion->save();
        }

        return $user;
    }

    /**
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator Validador del registro
     * @return [type]            [description]
     */
    public function validarInfoFactura($validator)
    {
        try {
            // datos enviados por el formulario de registro
            $data = $validator->getData();

            // adapto monto_factura y periodo_factura para la API
            $montoFactura = str_replace(',', '.', $data['monto_factura']);
            $periodoFactura = substr($data['periodo_factura'], 3) . substr($data['periodo_factura'], 0, 2);

            // Intento obtener las boletas desde la api, con los datos ingresados.
            // De obtenerse datos, se filtraran con lo ingresado.
            // Si luego de los filtros $boletas tiene items es porque la informacion
            // ingresada es correcta
            $boletas = $this->dpossApi
                ->getFacturasDePeriodo($data['expediente'], null, $periodoFactura)
                ->filter(function ($value) use ($data, $montoFactura) {
                    // filtro nro_liq_sp y monto_total_origen
                    // el expediente y el periodo ya estan filtrados por la
                    // llamada a getFacturasDePeriodo
                    return $value->nro_liq_sp == $data['nro_factura'] &&
                        $value->monto_total_origen == $montoFactura;
                });

            // Si la coleccion esta vacia es porque los datos no son correctos
            if ($boletas->isEmpty()) {
                $validator->errors()->add('nro_factura', 'Los datos ingresados no coinciden con ninguna factura');
            } else {
                $this->boletaInfoCache = $boletas->first();
            }
        }
        catch(Exception $e) {
            $validator->errors()->add('nro_factura', 'Los datos ingresados no coinciden con ninguna factura');
        }
    }

    /**
     * Override
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        // custom start
        $user = $this->create($request->all());

        UserVerification::generate($user);

        UserVerification::send($user, $this->verificationEmailSubject);

        Flash::success('Te enviamos un correo para verificar tu e-mail y terminar con el registro.');

        return redirect()->route('auth::login.form');
        // custom end
    }

    /**
     * Redirige al login si falla la verificacion de email
     * @return [type] [description]
     */
    protected function redirectIfVerificationFails()
    {
        Flash::error('No pudimos verificar tu e-mail. Por favor contactate con nosotros para solucionar el inconveniente');
        return redirect()->route('auth::login.form');
    }

    /**
     * Redirige al dashboard si el usuario vuelve a usar el link de verificacion
     * ya estando verificado
     * @return [type] [description]
     */
    protected function redirectIfVerified()
    {

        try {
            $user = User::where('email', request('email'))->firstOrFail();
            Auth::guard($this->getGuard())->login($user);

            return route('users.dashboard');
        } catch (Exception $e) {
            return route('auth::login.form');
        }
    }

    /**
     * Redirige al dashboard luego de una verificacion de email exitosa
     * @return [type] [description]
     */
    protected function redirectAfterVerification()
    {
        try {
            $user = User::where('email', request('email'))->firstOrFail();
            Auth::guard($this->getGuard())->login($user);

            Flash::success('Tu email se verificó correctamente. Podés empezar a utilizar nuestros servicios')
                ->important();

            return route('users.dashboard');
        } catch (Exception $e) {
            Flash::error('No pudimos verificar tu e-mail. Por favor contactate con nosotros para solucionar el inconveniente');
            return route('auth::login.form');
        }
    }

    /**
     * Metodo que se ejecuta luego de que el usuario pudo ingresar correctamente
     * Aqui aprovecharemos para impedir su ingreso si aun no verifico su email
     *
     * @param  Request $request [description]
     * @param  User    $user    [description]
     * @return [type]           [description]
     */
    protected function authenticated(Request $request, User $user)
    {
        if (!$user->verified) {
            Auth::logout();
            Flash::error('Aún no has verificado tu e-mail. Debes hacerlo para ingresar');
            return redirect()->route('auth::login.form')
                ->withInput();
        } else {
            return redirect()->intended($this->redirectPath());
        }
    }
}
