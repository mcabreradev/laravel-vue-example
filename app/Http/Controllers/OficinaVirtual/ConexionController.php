<?php

namespace app\Http\Controllers\OficinaVirtual;

use App\Contracts\DpossApiContract;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\OficinaVirtual\Conexion;
use App\Repositories\Admin\UserRepository;
use Auth;
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
}
