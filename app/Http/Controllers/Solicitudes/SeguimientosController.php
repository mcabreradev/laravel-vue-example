<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use Flash;
use App\Http\Requests;
use App\Models\Solicitudes\Area;
use App\Models\Solicitudes\Solicitud;
use App\Models\Solicitudes\Seguimiento;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\SeguimientoTransformer;

class SeguimientosController extends ApiController
{
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index() {
        $data = Seguimiento::all();
        return $this->respondWith($data, new SeguimientoTransformer);
    }

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main(){
        return view('solicitudes.seguimientos.main');
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request) {
        $seguimiento = Seguimiento::create($request->all());

        if ($request->has('relacionados') && count($request->input('relacionados'))) {
            foreach ($request->input('relacionados') as $reclamoId) {
                $rel = $seguimiento->replicate();
                $rel->solicitud()->associate($reclamoId);
                $rel->save();
            }
        }

        return $this->respondWithOk(201, 'ok');
    }

    /**
     * Trae todos los seguimientos de una solicitud en especifico
     *
     * @param  {Integer}      $solicitud_id ID de la solicitud
     * @return {Collection}   La lista de seguimientos
     */
    public function porSolicitud($solicitud_id) {
        $data = Seguimiento::where('solicitud_id', $solicitud_id)
        ->orderBy('generado_el')
        ->get();

        return $this->respondWith($data, new SeguimientoTransformer);
    }

    /**
     * [update description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id) {
        $tipo = Seguimiento::findOrFail($id);
        $tipo->update($request->all());
        return $this->respondWithOk(200, 'Updated');
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id) {
        Seguimiento::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
    }
}
