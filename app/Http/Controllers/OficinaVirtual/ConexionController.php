<?php

namespace app\Http\Controllers\OficinaVirtual;

use App\Contracts\DpossApiContract;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\OficinaVirtual\Conexion;
use App\Repositories\Admin\UserRepository;
use Auth;
use Flash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ConexionController extends Controller
{
    /**
     * [__construct description]
     * @param DpossApiContract $api [description]
     */
    public function __construct(DpossApiContract $api)
    {
        $this->dpossApi = $api;
    }

    /**
     * [facturas description]
     * @param  Conexion $conexion [description]
     * @return [type]             [description]
     */
    public function facturas(Conexion $conexion)
    {
        $facturas = $this->dpossApi->historicoFacturas($conexion->expediente, $conexion->unidad);

        return response()->json($facturas, 200);
    }

    /**
     * [resumenHistorico description]
     */
    public function resumenFacturas()
    {
        return view('oficina-virtual.conexiones.resumen-historico', [
            'conexiones' => Auth::user()->conexiones()->get()
        ]);
    }

    public function deudas(Conexion $conexion)
    {
        $deudas = $this->dpossApi->estadoDeuda($conexion->expediente, $conexion->unidad);

        return response()->json($deudas, 200);
    }

    public function estadoDeuda()
    {
        return view('oficina-virtual.conexiones.estado-deuda', [
            'conexiones' => Auth::user()->conexiones()->get()
        ]);
    }

    public function vinculadas()
    {
        return view('oficina-virtual.conexiones.vinculadas', [
            'conexiones' => Auth::user()->conexiones()->get()
        ]);
    }

    public function vincularCuentaConUsuario(Request $request)
    {
        $rules = [
            'nro_factura'     => 'required',
            'periodo_factura' => ['required', 'regex:/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/'],
            'monto_factura'   => ['required', 'regex:/[0-9]+,[0-9][0-9]/'],
            'expediente'      => 'required',
        ];

        $validator =  Validator::make($request->input(), $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                Flash::error($error);
            }
            return redirect()->route('oficina-virtual::conexiones.vinculadas');
        }

        Flash::success('El registro se creó correctamente');
        return redirect()->route('oficina-virtual::conexiones.vinculadas');
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
            }
        }
        catch(Exception $e) {
            $validator->errors()->add('nro_factura', 'Los datos ingresados no coinciden con ninguna factura');
        }
    }
}
