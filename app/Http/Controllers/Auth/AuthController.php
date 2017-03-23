<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\DpossApiContract;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\OficinaVirtual\Conexion;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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
    protected $loginPath = '/login';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Default redirect after successful authentication
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(DpossApiContract $dpossApi)
    {
        $this->dpossApi = $dpossApi;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',

            'nro_factura'     => 'required',
            'periodo_factura' => 'required',
            'monto_factura'   => 'required',
            'expediente'      => 'required',
        ]);

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
        dd($data);
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Asocio al usuario con la conexion
        $conexion = Conexion::create([
            'expediente' => $this->boletaInfoCache->expediente,
            'unidad'     => $this->boletaInfoCache->numero_unidad,
            'domicilio'  => $this->boletaInfoCache->unidad_calle,
        ]);
        $conexion->users()->attach($user);
        $conexion->save();

        return $user;
    }

    /**
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator Validador del registro
     * @return [type]            [description]
     */
    public function validarInfoFactura($validator)
    {
        // datos enviados por el formulario de registro
        $data = $validator->getData();

        // Intento obtener las boletas desde la api, con los datos ingresados.
        // De obtenerse datos, se filtraran con lo ingresado.
        // Si luego de los filtros $boletas tiene items es porque la informacion
        // ingresada es correcta
        $boletas = $this->dpossApi
            ->getBoletasPorPeriodo($data['expediente'], null, $data['periodo_factura'])
            ->filter(function ($value, $key) use ($data) {
                // filtro nro_liq_sp y monto_total_origen
                // el expediente y el periodo ya estan filtrados por la
                // llamada a getBoletasPorPeriodo
                return $value->nro_liq_sp == $data['nro_factura'] &&
                    $value->monto_total_origen == $data['monto_factura'];
            });

        // Si la coleccion esta vacia es porque los datos no son correctos
        if ($boletas->isEmpty()) {
            $validator->errors()->add('nro_factura', 'Los datos ingresados no coinciden con ninguna factura');
        } else {
            $this->boletaInfoCache = $boletas->first();
        }
    }
}
