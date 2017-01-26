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
use PDF;
use Illuminate\Support\Facades\Response;

class SolicitudesController extends ApiController
{
  /**
   * [index description]
   * @return [type] [description]
   */
	public function index(Request $request) {
        if (is_null($request->input('cerrado')) || $request->input('cerrado') == 'false'){
            $data = Solicitud::where('estado_id', '<>', 3)
            ->orWhere('estado_id', null)
            ->get();
        }
        else {
            $data = Solicitud::where('estado_id', '=', 3)->get();
        }

		return $this->respondWith($data, new SolicitudTransformer);
	}

  /**
   * [main description]
   * @return [type] [description]
   */
	public function main($estado = null) {
		return view('solicitudes.solicitudes.main', ['estado' => $estado == 'cerrado' ? 'cerrado' : '' ]);
	}

  /**
   * [create description]
   * @return [type] [description]
   */
	public function create() {

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
		return redirect(route('solicitudes::solicitudes.edit', $solicitud->id));
	}

  /**
   * [show description]
   * @param  {Integer} $id [description]
   * @return [type]     [description]
   */
	public function show($id) {
		$data = Solicitud::findOrFail($id);
		return $this->respondWith($data, new SolicitudTransformer);
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
		return redirect(route('solicitudes::solicitudes.edit', $solicitud->id));
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
	public function timeline($id) {
		return view('solicitudes.solicitudes.timeline', ['solicitud' => $id]);
	}


    /**
     * [generar description]
     * @param  Resquest $request [description]
     * @return [type]            [description]
     */
    public function imprimir(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Aquí sigue configuración básica del PDF
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        PDF::SetFont('helvetica', '', 10);

        // define barcode style
        $bar_code_style = array(
            'position'     => '',
            'align'        => 'L',
            'stretch'      => false,
            'fitwidth'     => false,
            'cellfitalign' => 'L',
            'border'       => false,
            'hpadding'     => 'auto',
            'vpadding'     => 'auto',
            'fgcolor'      => [0,0,0],
            'bgcolor'      => false, //array(255,255,255),
            'text'         => true,
            'font'         => 'helvetica',
            'fontsize'     => 8,
            'stretchtext'  => 4
        );

        // Agregamos una página en blanco
        PDF::AddPage();

        $html = view('solicitudes.solicitudes.impresion')
            ->with('solicitud', $solicitud)
            ->render();

        // output the HTML content
        PDF::writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        PDF::lastPage();

        // Close and output PDF document
        return Response::make(
            PDF::Output("reclamo-{$solicitud->id}.pdf", 'S'),
            200, [
                'content-type' => 'application/pdf',
                'Content-Disposition' => "inline; reclamo-{$solicitud->id}.pdf"
            ]
        );
    }
}
