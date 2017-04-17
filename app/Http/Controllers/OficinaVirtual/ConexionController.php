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
     * [adeudadas description]
     * @param  DpossApiContract $api [description]
     * @return [type]                [description]
     */
    public function adeudadas(UserRepository $userRepository)
    {
        return view('oficina-virtual.boletas-de-pago.adeudadas', [
            'boletas' => $userRepository->getAllBoletasImpagas(Auth::user())
        ]);
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
}
