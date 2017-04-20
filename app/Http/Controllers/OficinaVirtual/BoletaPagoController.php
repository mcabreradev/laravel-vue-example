<?php

namespace app\Http\Controllers\OficinaVirtual;

use App\Contracts\DpossApiContract;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Admin\User;
use App\Models\OficinaVirtual\BoletaPago;
use App\Models\OficinaVirtual\Conexion;
use App\Repositories\Admin\UserRepository;
use Auth;
use Carbon\Carbon;
use DNS1D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PDF;
use Tecnickcom\Tcpdf\Tcpdf_barcodes_1d as TCPDFBarcode;

class BoletaPagoController extends Controller
{
    public static $TIPO_CONTENIDO = 'oficina-virtual.boletas-de-pago';

    /**
     * [__construct description]
     * @param DpossApiContract $api [description]
     */
    public function __construct(DpossApiContract $api)
    {
        $this->dpossApi = $api;
    }

    /**
     * [boletasToCollection description]
     * @param  [type] $boletas [description]
     * @param  [type] $periodo         [description]
     * @return [type]                  [description]
     */
    private function boletasToCollection($boletas, $periodo)
    {
        return $boletas->filter(function ($value, $key) use ($periodo) {
            return $value->periodo_factura === $periodo;
        })->map(function ($item, $key) {
            return new BoletaPago($item);
        });
    }

    /**
     * Obtiene los datos de las boletas de pago mediante API
     * @param  [type] $fields [description]
     * @return [type]         [description]
     */
    private function getDatosBoleta($fields)
    {
        $boletasParsed = collect([]);
        $boletas = $this->dpossApi->getUltimasBoletas($fields['expediente'], $fields['unidad']);

        if ($fields['periodo'] === null) {

            // obtengo el period actual y el anterior
            $periodoActual   = Carbon::now()->format('Ym');
            $periodoAnterior = Carbon::now()->subMonth()->format('Ym');

            // boletas filtradas por periodo actual
            $boletasParsed = $this->boletasToCollection($boletas, $periodoActual);

            // si no tengo boletas del periodo actual busco las del anterior
            if ($boletasParsed->isEmpty()) {
                $boletasParsed = $this->boletasToCollection($boletas, $periodoAnterior);
            }
        } else {

            $boletasParsed = $this->boletasToCollection($boletas, $fields['periodo']);
        }

        if ($boletasParsed->isEmpty()) {
            return $boletasParsed;
        }

        return $boletasParsed;
    }

    /**
     * [generar description]
     * @param  Resquest $request [description]
     * @return [type]            [description]
     */
    public function generar(Request $request)
    {
        $boletasPago = collect([]);

        if (!$request->has('tipo-busqueda') || !$request->has('busqueda')) {
            return view('oficina-virtual.boletas-de-pago.boleta-pago-not-found');
        }

        $fields = [
            'expediente' => $request->input('tipo-busqueda') === 'expediente' ? $request->input('busqueda') : null,
            'unidad'     => $request->input('tipo-busqueda') === 'unidad' ? $request->input('busqueda') : null,
            'periodo'    => $request->has('periodo') ? $request->input('periodo') : null,
        ];

        $boletasPago = $this->getDatosBoleta($fields);

        // si no obtuve resultados por expediente o unidad respondo con un error
        if ($boletasPago->isEmpty()) {
            return view('oficina-virtual.boletas-de-pago.boleta-pago-not-found');
        }

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

        foreach ($boletasPago as $boletaPago) {

            // Agregamos una página en blanco
            PDF::AddPage();

            // "Parseamos" el template (esto se podría formalizar más)
            $codigoDposs = PDF::serializeTCPDFtagParameters(
                [$boletaPago->getCodigoDposs(), 'C39', '', '', '', '16', 0.4, $bar_code_style, 'N']
            );

            $html = view('oficina-virtual.boletas-de-pago.boleta-pago-print')
                ->with('boletaPago', $boletaPago)
                ->with('codigoDposs', $codigoDposs)
                ->render();

            // output the HTML content
            PDF::writeHTML($html, true, false, true, false, '');

            // reset pointer to the last page
            PDF::lastPage();
        }

        // Close and output PDF document
        return Response::make(
            PDF::Output('boleta-pago.pdf', 'S'),
            200, [
                'content-type' => 'application/pdf',
                'Content-Disposition' => 'inline; boleta-pago.pdf'
            ]
        );
    }

    /**
     *
     * @return void
     */
    public function main(){
        return view($this::$TIPO_CONTENIDO.'.main', [
            'conexiones' => Auth::user()->conexiones()->get()
        ]);
    }

    /**
     * Consulta a la api dposs
     *
     * @return void
     */
    public function query(Request $request, DpossApiContract $api){
        $tipo_busqueda = json_decode($request->input('tipo_busqueda'));
        $data = $api->getUltimasBoletas($tipo_busqueda->expediente, $tipo_busqueda->unidad);

        return response()->json(['data' => $data, 'responseText' => 'ok'], 200);
    }
}
