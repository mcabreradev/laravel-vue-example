<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use DB;
use Flash;
use App\Http\Requests;
use App\Models\Solicitudes\Tipo;
use App\Models\Solicitudes\Origen;
use App\Models\Solicitudes\Estado;
use App\Models\Solicitudes\Solicitud;
use App\Models\Solicitudes\Prioridad;
use App\Models\Solicitudes\Solicitante;
use App\Models\Solicitudes\Seguimiento;
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
            'solicitud'    => new Solicitud(),
            'origenes'     => Origen::orderBy('nombre', 'asc')->get(),
            'tipos'        => Tipo::orderBy('nombre', 'asc')->get(),
            'estados'      => Estado::orderBy('nombre', 'asc')->get(),
            'prioridades'  => Prioridad::orderBy('nombre', 'asc')->get(),
            'solicitantes' => Solicitante::orderBy('nombre', 'asc')->get(),
        ]);
	}

  /**
   * Agrega el reclamo/solicitud y a su vez guarda el solicitante asociado
   *
   * @param  Request $request [description]
   * @return [type]           [description]
   */
	public function store(Request $request) {
        $solicitud = Solicitud::create($request->all());

        if ($this->requestHasData($request->input('solicitante'))) {
            $solicitante = Solicitante::create($request->input('solicitante'));
            $solicitud->solicitante()->associate($solicitante);
            $solicitud->save();
        }

		Flash::success('El registro se creó correctamente');
		return redirect(route("solicitudes::solicitudes"));
	}

  /**
   * [show description]
   * @param  {Integer} $id [description]
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
        $solicitud = Solicitud::findOrFail($id);

		return view('solicitudes.solicitudes.edit', [
            'solicitud'   => $solicitud,
            'origenes'    => Origen::orderBy('nombre', 'asc')->get(),
            'tipos'       => Tipo::orderBy('nombre', 'asc')->get(),
            'estados'     => Estado::orderBy('nombre', 'asc')->get(),
            'prioridades' => Prioridad::orderBy('nombre', 'asc')->get(),
            'solicitante' => Solicitante::orderBy('nombre', 'asc')->get(),
        ]);
	}

  /**
   * [update description]
   * @param  Request $request [description]
   * @param  [type]  $id      [description]
   * @return [type]           [description]
   */
	public function update(Request $request, $id) {
		$solicitud = Solicitud::findOrFail($id);
		$solicitud->update($request->all());

        // Si existe el Solicitante, editar
        if ( $request->input('solicitante.id') !== null &&  $request->input('solicitante.id') !== "") {
            $solicitud->solicitante()->update($request->input('solicitante'));
        }
        // Sino existe, crearlo y asociarlo a la solicitud
        elseif($this->requestHasData($request->input('solicitante'))){
            $solicitante = Solicitante::create($request->input('solicitante'));
            $solicitud->solicitante()->associate($solicitante);
            $solicitud->save();
        }

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
    public function requestHasData($request) {
        $has_data = false;

        if ($request == "") {
            return false;
        }
        foreach ($request as $field){
            if ( $field != "") {
                $has_data = true;
                continue;
            }
        }

        return $has_data;
    }

    /**
   * [show description]
   * @param  {Integer} $id [description]
   * @return [type]     [description]
   */
	public function seguimientos($id) {
        $solicitud = Solicitud::findOrFail($id);
        $seguimientos = Seguimiento::where('solicitud_id', $id)->get();

		return view('solicitudes.solicitudes.seguimientos', [
            'solicitud'    => $solicitud,
            'seguimientos' => $seguimientos,
             ]);
	}
}
