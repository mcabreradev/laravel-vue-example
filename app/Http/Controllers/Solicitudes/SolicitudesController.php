<?php

namespace App\Http\Controllers\Solicitudes;

use Illuminate\Http\Request;

use DB;
use Flash;
use Auth;
use App\Http\Requests;
use App\Models\Solicitudes\Tipo;
use App\Models\Solicitudes\Origen;
use App\Models\Solicitudes\Estado;
use App\Models\Solicitudes\Localidad;
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
    public function index(Request $request)
    {
        if (is_null($request->input('cerrado')) || $request->input('cerrado') == 'false'){
            $data = Solicitud::where('estado_id', '<>', 3)
                ->orWhere('estado_id', null)
                ->orderBy('creado_el', 'desc')
                ->get();
        }
        else {
            $data = Solicitud::where('estado_id', '=', 3)
                ->orderBy('creado_el', 'desc')
                ->get();
        }

        return $this->respondWith($data, new SolicitudTransformer);
    }

    /**
     * [main description]
     * @return [type] [description]
     */
    public function main($estado = null)
    {
        return view('solicitudes.solicitudes.main', ['estado' => $estado == 'cerrado' ? 'cerrado' : '' ]);
    }

    /**
     * [create description]
     * @return [type] [description]
     */
    public function create()
    {

        // @TODO Mejorar configuracion inicial menos hardcodeada
        $solicitud = new Solicitud();
        $solicitud->estado_id = 1; // En proceso
        $solicitud->localidad_id = 1; // Ushuaia
        $solicitud->prioridad_id = 1; // Baja


        return view('solicitudes.solicitudes.create', [
            'solicitud'    => $solicitud,
            'origenes'     => Origen::orderBy('nombre', 'asc')->get(),
            'tipos'        => Tipo::orderBy('nombre', 'asc')->get(),
            'estados'     => Estado::all(),
            'prioridades' => Prioridad::all(),
            'solicitantes' => Solicitante::orderBy('nombre', 'asc')->get(),
            'localidades'  => Localidad::all(),
            'user'         => Auth::user()
        ]);
    }

  /**
   * Agrega el reclamo/solicitud y a su vez guarda el solicitante asociado
   *
   * @param  Request $request [description]
   * @return [type]           [description]
   */
    public function store(Request $request)
    {
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
    public function show($id)
    {
        try {

            $data = Solicitud::find($id);

            return $this->respondWith($data, new SolicitudTransformer);

        } catch (ModelNotFoundException $e) {

            return $this->response->errorNotFound();

        }
    }

  /**
   * [edit description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
    public function edit($id) {
        $solicitud = Solicitud::findOrFail($id);

        return view('solicitudes.solicitudes.edit', [
            'solicitud'    => $solicitud,
            'origenes'     => Origen::orderBy('nombre', 'asc')->get(),
            'tipos'        => Tipo::orderBy('nombre', 'asc')->get(),
            'estados'      => Estado::all(),
            'prioridades'  => Prioridad::all(),
            'solicitante'  => Solicitante::orderBy('nombre', 'asc')->get(),
            'localidades'  => Localidad::all(),
            'user'         => Auth::user(),
            'relacionados' => $solicitud->relacionados()->get(),
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

        Flash::success('El registro se borró correctamente');
        return redirect(route('solicitudes::solicitudes'));
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

        // Agregamos una página en blanco
        PDF::AddPage();

        $html = view('solicitudes.solicitudes.impresion-reclamante')
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

    /**
     * [generar description]
     * @param  Resquest $request [description]
     * @return [type]            [description]
     */
    public function imprimirOrdenTrabajo(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Aquí sigue configuración básica del PDF
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Agregamos una página en blanco
        PDF::AddPage();

        $html = view('solicitudes.solicitudes.impresion-orden-trabajo')
            ->with('solicitud', $solicitud)
            ->render();

        // output the HTML content
        PDF::writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        PDF::lastPage();

        // Close and output PDF document
        return Response::make(
            PDF::Output("orden-trabajo-{$solicitud->id}.pdf", 'S'),
            200, [
                'content-type' => 'application/pdf',
                'Content-Disposition' => "inline; orden-trabajo-{$solicitud->id}.pdf"
            ]
        );
    }

    /**
     * Consulta la API de DPOSS para obtener las calles
     */
    public function buscarCalles($nombre)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env($DPOSS_API_BASE) . '/calles/'. rawurlencode($nombre));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = json_decode(curl_exec($ch));
        $info     = curl_getinfo($ch);

        curl_close($ch);

        if ($info['http_code'] == 200 && count($response)) {
            return response()->json($response);
        }
        else {
            return response()->json([]);
        }
    }
}
