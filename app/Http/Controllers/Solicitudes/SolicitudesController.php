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
use App\Transformers\Solicitudes\SolicitudTransformer;

class SolicitudesController extends ApiController
{
  /**
   * [index description]
   * @return [type] [description]
   */
	public function index() {
		$data = Solicitud::all();
		return $this->respondWith($data, new SolicitudTransformer);
	}

  /**
   * [main description]
   * @return [type] [description]
   */
	public function main(){
		return view('solicitudes.solicitudes.main');
	}

  /**
   * [create description]
   * @return [type] [description]
   */
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

  /**
   * [store description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
	public function store(Request $request) {
		$solicitud = Solicitud::create($request->all());

        // if($this->hasSolicitante($request->input('solicitante'))){
        //     $solicitud->solicitante()->sync($request->input('solicitante') ?: null);
        // }

		Flash::success('El registro se creó correctamente');
		return redirect(route("solicitudes::solicitudes"));
	}

  /**
   * [show description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
	public function show($id) {
		$data = Solicitud::findOrFail($id);
		return $this->item($data, new SolicitudTransformer);
	}

  /**
   * [edit description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
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

  /**
   * [update description]
   * @param  Request $request [description]
   * @param  [type]  $id      [description]
   * @return [type]           [description]
   */
	public function update(Request $request, $id) {
		$data = Solicitud::findOrFail($id);
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
		Solicitud::destroy($id);
        return $this->respondWithOk(200, 'Deleted');
	}

  /**
   * [hasSolicitante description]
   * @param  [type] $request [description]
   * @return [type]          [description]
   */
    public function hasSolicitante($request) {
        $hasSolicitante = false;

        foreach ($request as $input){
            if ( $input != "") {
                $hasSolicitante = true;
                continue;
            }
        }

        return $hasSolicitante;
    }
}
