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
            $message = '<ul>';
            foreach ($validator->errors()->all() as $error) {
                $message .= "<li>{$error}</li>";
            }
            Flash::error("$message</ul>");
            return redirect()->route('oficina-virtual::conexiones.vinculadas');
        }

        $factura = $this->validarInfoFactura($request->input());

        if ($factura === null) {
            Flash::error('Los datos ingresados no coinciden con ninguna factura');
            return redirect()->route('oficina-virtual::conexiones.vinculadas');
        }

        $conexion = Conexion::firstOrNew([
            'expediente' => $factura->expediente,
            'unidad'     => $factura->numero_unidad,
            'domicilio'  => $factura->domicilio,
        ]);
        $conexion->save();

        $conexion->users()->attach(Auth::user());
        $conexion->save();

        Flash::success('La cuenta se vinculó con tu usuario');
        return redirect()->route('oficina-virtual::conexiones.vinculadas');
    }

    /**
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator Validador del registro
     * @return [type]            [description]
     */
    public function validarInfoFactura($data)
    {
        try {
            // adapto monto_factura y periodo_factura para la API
            $montoFactura = str_replace(',', '.', $data['monto_factura']);
            $periodoFactura = substr($data['periodo_factura'], 3) . substr($data['periodo_factura'], 0, 2);

            // Intento obtener la factura desde la api, con los datos ingresados.
            // De obtenerse datos, se filtraran con lo ingresado.
            // Si luego de los filtros $factura tiene items es porque la informacion
            // ingresada es correcta
            $factura = $this->dpossApi
                ->getFacturasDePeriodo($data['expediente'], null, $periodoFactura)
                ->filter(function ($value) use ($data, $montoFactura) {
                    // filtro nro_liq_sp y monto_total_origen
                    // el expediente y el periodo ya estan filtrados por la
                    // llamada a getFacturasDePeriodo
                    return $value->nro_liq_sp == $data['nro_factura'] &&
                        $value->monto_total_origen == $montoFactura;
                });

            // Si la coleccion esta vacia es porque los datos no son correctos
            if ($factura->isEmpty()) {
                return null;
            }
            else {
                return $factura->first();
            }
        }
        catch(Exception $e) {
            return null;
        }
    }

    public function desvincular(Conexion $conexion)
    {
        try {
            $conexion->users()->detach(Auth::user());
            $conexion->save();

            Flash::success('La cuenta se desvinculó correctamente');
            return redirect()->route('oficina-virtual::conexiones.vinculadas');
        }
        catch (Exception $e) {
            Flash::error('Ocurrió un error al desvincular, por favor intentalo más tarde');
            return redirect()->route('oficina-virtual::conexiones.vinculadas');
        }
    }
}
