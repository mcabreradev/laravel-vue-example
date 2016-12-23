<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use Flash;
use App\Http\Requests;
use App\Models\Solicitudes\Tipo;
use App\Models\Solicitudes\Origen;
use App\Models\Solicitudes\Estado;
use App\Models\Solicitudes\Solicitud;
use App\Models\Solicitudes\Prioridad;
use App\Models\Solicitudes\Solicitante;
use App\Http\Controllers\ApiController;
use App\Http\Transformers\Solicitudes\SolicitudesTransformer;

class SolicitudesController extends ApiController
{
	public function index() {
		$data = Solicitud::all();

		return $this->respondWith($data, new SolicitudesTransformer);
	}

	public function main(){

		return view('solicitudes.solicitudes.main');
	}

	public function create(){

		return view('solicitudes.solicitudes.create', [
            'solicitud' => new Solicitud(),
            'origenes' => Origen::orderBy('nombre', 'asc')->get(),
            'tipos' => Tipo::orderBy('nombre', 'asc')->get(),
            'estados' => Estado::orderBy('nombre', 'asc')->get(),
            'prioridades' => Prioridad::orderBy('nombre', 'asc')->get(),
            'solicitantes' => Solicitante::orderBy('nombre', 'asc')->get(),
        ]);
	}

	public function store(Request $request) {
		Solicitud::create($request->all());

		Flash::success('El registro se creó correctamente');
		return redirect(route("solicitudes::solicitudes"));
	}

	public function show($id) {
		$data = Solicitud::findOrFail($id);

		return $this->item($data, new SolicitudesTransformer);
	}

	public function edit($id) {

		return view('solicitudes.solicitudes.edit', [
            'solicitud' => Solicitud::findOrFail($id),
            'origenes' => Origen::orderBy('nombre', 'asc')->get(),
            'tipos' => Tipo::orderBy('nombre', 'asc')->get(),
            'estados' => Estado::orderBy('nombre', 'asc')->get(),
            'prioridades' => Prioridad::orderBy('nombre', 'asc')->get(),
            'solicitantes' => Solicitante::orderBy('nombre', 'asc')->get(),
        ]);
	}

	public function update(Request $request, $id) {
		$data = Solicitud::findOrFail($id);
		$data->update($request->all());

		Flash::success('El registro se edito correctamente');
		return redirect(route("solicitudes::solicitudes"));
	}

	public function destroy($id) {
		Solicitud::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
	}
}
