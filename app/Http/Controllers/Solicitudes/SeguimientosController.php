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
   * [create description]
   * @return [type] [description]
   */
	public function create(){
		return view('solicitudes.seguimientos.create', [
            'seguimiento' => new Seguimiento(),
            'areas' => Area::orderBy('nombre', 'asc')->get(),
        ]);
	}

  /**
   * [store description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
	public function store(Request $request) {
		Seguimiento::create($request->all());
        return $this->respondWithOk(201, 'ok');
	}

  /**
   * Trae todos los seguimientos de una solicitud en especifico
   *
   * @param  {Integer}      $solicitud_id ID de la solicitud
   * @return {Collection}   La lista de seguimientos
   */
	public function show($solicitud_id) {
        $data = Seguimiento::where('solicitud_id', $solicitud_id)
        ->orderBy('generado_el')
        ->get();

		return $this->respondWith($data, new SeguimientoTransformer);
	}

  /**
   * [edit description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
	public function edit($id) {
		return view('solicitudes.seguimientos.edit', [
            'seguimiento' => Seguimiento::findOrFail($id),
            'areas' => Area::orderBy('nombre', 'asc')->get(),
        ]);
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
