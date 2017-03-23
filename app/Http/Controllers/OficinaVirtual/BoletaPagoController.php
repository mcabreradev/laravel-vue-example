<?php

namespace app\Http\Controllers\OficinaVirtual;

use PDF;
use Auth;
use DNS1D;
use Carbon\Carbon;
use App\Http\Requests;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use App\Contracts\DpossApiContract;
use App\Http\Controllers\Controller;
use App\Models\OficinaVirtual\Conexion;
use Illuminate\Support\Facades\Response;
use App\Models\OficinaVirtual\BoletaPago;
use Tecnickcom\Tcpdf\Tcpdf_barcodes_1d as TCPDFBarcode;

class BoletaPagoController extends Controller
{
    public static $TIPO_CONTENIDO = 'oficina-virtual.boletas-de-pago';

    /**
     * [boletasToCollection description]
     * @param  [type] $boletasResponse [description]
     * @param  [type] $periodo         [description]
     * @return [type]                  [description]
     */
    private function boletasToCollection($boletasResponse, $periodo)
    {
        return collect($boletasResponse)->filter(function ($value, $key) use ($periodo) {
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('DPOSS_API_BASE') . 'usuarios');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($ch);
        $info     = curl_getinfo($ch);

        curl_close($ch);

        if ($info['http_code'] == 200 && $response) {

            $parsedResponse = json_decode($response);

            // obtengo el period actual y el anterior
            $periodoActual   = Carbon::now()->format('Ym');
            $periodoAnterior = Carbon::now()->subMonth()->format('Ym');

            // boletas filtradas por periodo actual
            $boletas = $this->boletasToCollection($parsedResponse, $periodoActual);

            // si no tengo boletas del periodo actual busco las del anterior
            if ($boletas->isEmpty()) {
                $boletas = $this->boletasToCollection($parsedResponse, $periodoAnterior);
            }

          return $boletas;
        }
        else {
          return collect([]);
        }
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
            return response()->json(['error' => 'No se encontró boleta de pago con los datos ingresados'], 404);
        }

        if ($request->input('tipo-busqueda') === 'expediente') {
            $boletasPago = $this->getDatosBoleta(['numero_expediente' => $request->input('busqueda')]);
        }
        else {
            $boletasPago = $this->getDatosBoleta(['numero_unidad' => $request->input('busqueda')]);
        }

        // si no obtuve resultados por expediente o unidad respondo con un error
        if ($boletasPago->isEmpty()) {
            return response()->json(['error' => 'No se encontró boleta de pago con los datos ingresados'], 404);
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

            $html = view('oficina-virtual.boleta-pago')
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
        $user = User::find(Auth::user()->id);

        return view($this::$TIPO_CONTENIDO.'.main', [
            'conexiones' => $user->conexiones()->get()
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
