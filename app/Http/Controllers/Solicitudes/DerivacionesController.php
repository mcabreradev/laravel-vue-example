<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use Flash;
use App\Http\Requests;
use App\Models\Solicitudes\Area;
use App\Models\Solicitudes\Solicitud;
use App\Models\Solicitudes\Derivacion;
use App\Http\Controllers\ApiController;
use App\Transformers\Solicitudes\DerivacionTransformer;

class DerivacionesController extends ApiController
{
    /**
   * [index description]
   * @return [type] [description]
   */
	public function index() {
		$data = Derivacion::all();
		return $this->respondWith($data, new DerivacionTransformer);
	}

  /**
   * [main description]
   * @return [type] [description]
   */
	public function main(){
		return view('solicitudes.derivaciones.main');
	}

  /**
   * [create description]
   * @return [type] [description]
   */
	public function create(){
		return view('solicitudes.derivaciones.create', [
            'derivacion' => new Derivacion(),
            'solicitudes' => Solicitud::all(),
            'areas' => Area::orderBy('nombre', 'asc')->get(),
        ]);
	}

  /**
   * [store description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
	public function store(Request $request) {
        // dd($request->all());
		Derivacion::create($request->all());
        return $this->respondWithOk(201, 'ok');
	}

  /**
   * [show description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
	public function show($id) {
		$data = Derivacion::findOrFail($id);
		return $this->item($data, new DerivacionTransformer);
	}

  /**
   * [edit description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
	public function edit($id) {
		return view('solicitudes.derivaciones.edit', [
            'derivacion' => Derivacion::findOrFail($id),
            'solicitudes' => Solicitud::all(),
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
		$data = Derivacion::findOrFail($id);
		$data->update($request->all());
		Flash::success('El registro se edito correctamente');
		return redirect(route("solicitudes::solicitudes"));
	}

  /**
   * [destroy description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
	public function destroy($id) {
		Derivacion::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
	}
}
