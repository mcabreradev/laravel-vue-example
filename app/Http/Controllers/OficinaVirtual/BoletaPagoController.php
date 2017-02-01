<?php

namespace app\Http\Controllers\OficinaVirtual;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\OficinaVirtual\BoletaPago;
use Carbon\Carbon;
use DNS1D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PDF;
use Tecnickcom\Tcpdf\Tcpdf_barcodes_1d as TCPDFBarcode;

class BoletaPagoController extends Controller
{
    /**
     * Obtiene los datos de las boletas de pago mediante API
     * @param  [type] $fields [description]
     * @return [type]         [description]
     */
    private function getDatosBoleta($fields)
    {
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, 'http://remotos.dposs.gob.ar:150/usuarios');
        // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["numero_unidad" => "12345"]));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["numero_expediente" => "2187"]));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // $head = json_decode(curl_exec($ch));
        // $info = curl_getinfo($ch);
        // curl_close($ch);
        // dd([$head,$info]);

        // Uno
        $response = json_decode('[{"factura_tipo":"B","factura_numero":4453771,"nro_liq_sp":675682,"numero_cuenta":18742556,"nombre_razon_social":"COLSANI MU�OZ MIRNA LETICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"DEL BOSQUE","unidad_numero_puerta":684,"unidad_piso":null,"unidad_departamento":null,"envio_calle":"DEL BOSQUE","envio_numero_puerta":684,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"E","nomenclatura_manzana":"0008","nomenclatura_parcela":"0005","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":10550,"numero_unidad":12345,"periodo_factura":"201612","monto_total_origen":672.8,"fecha_vencimiento_1":"2017-01-10","monto_vencimiento_2":674.44,"fecha_vencimiento_2":"2017-01-17","monto_vencimiento_3":676.09,"fecha_vencimiento_3":"2017-01-24","fecha_factura":"2016-12-17","saldo":0},{"factura_tipo":"B","factura_numero":4434543,"nro_liq_sp":652123,"numero_cuenta":18742556,"nombre_razon_social":"COLSANI MU�OZ MIRNA LETICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"DEL BOSQUE","unidad_numero_puerta":684,"unidad_piso":null,"unidad_departamento":null,"envio_calle":"DEL BOSQUE","envio_numero_puerta":684,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"E","nomenclatura_manzana":"0008","nomenclatura_parcela":"0005","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":10550,"numero_unidad":12345,"periodo_factura":"201611","monto_total_origen":518.61,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":519.88,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":521.14,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0},{"factura_tipo":"B","factura_numero":4415339,"nro_liq_sp":628926,"numero_cuenta":18742556,"nombre_razon_social":"COLSANI MU�OZ MIRNA LETICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"DEL BOSQUE","unidad_numero_puerta":684,"unidad_piso":null,"unidad_departamento":null,"envio_calle":"DEL BOSQUE","envio_numero_puerta":684,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"E","nomenclatura_manzana":"0008","nomenclatura_parcela":"0005","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":10550,"numero_unidad":12345,"periodo_factura":"201610","monto_total_origen":518.61,"fecha_vencimiento_1":"2016-11-10","monto_vencimiento_2":519.88,"fecha_vencimiento_2":"2016-11-17","monto_vencimiento_3":521.14,"fecha_vencimiento_3":"2016-11-24","fecha_factura":"2016-10-15","saldo":0},{"factura_tipo":"B","factura_numero":4396217,"nro_liq_sp":607724,"numero_cuenta":18742556,"nombre_razon_social":"COLSANI MU�OZ MIRNA LETICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"DEL BOSQUE","unidad_numero_puerta":684,"unidad_piso":null,"unidad_departamento":null,"envio_calle":"DEL BOSQUE","envio_numero_puerta":684,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"E","nomenclatura_manzana":"0008","nomenclatura_parcela":"0005","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":10550,"numero_unidad":12345,"periodo_factura":"201609","monto_total_origen":518.61,"fecha_vencimiento_1":"2016-10-14","monto_vencimiento_2":519.88,"fecha_vencimiento_2":"2016-10-21","monto_vencimiento_3":521.14,"fecha_vencimiento_3":"2016-10-28","fecha_factura":"2016-09-16","saldo":0},{"factura_tipo":"B","factura_numero":4377263,"nro_liq_sp":585548,"numero_cuenta":18742556,"nombre_razon_social":"COLSANI MU�OZ MIRNA LETICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"DEL BOSQUE","unidad_numero_puerta":684,"unidad_piso":null,"unidad_departamento":null,"envio_calle":"DEL BOSQUE","envio_numero_puerta":684,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"E","nomenclatura_manzana":"0008","nomenclatura_parcela":"0005","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":10550,"numero_unidad":12345,"periodo_factura":"201608","monto_total_origen":518.61,"fecha_vencimiento_1":"2016-09-12","monto_vencimiento_2":519.88,"fecha_vencimiento_2":"2016-09-19","monto_vencimiento_3":521.14,"fecha_vencimiento_3":"2016-09-26","fecha_factura":"2016-08-15","saldo":0}]');
        // Varios
        // $response = json_decode('[{"factura_tipo":"B","factura_numero":4457972,"nro_liq_sp":679883,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PB","unidad_departamento":"A","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17433,"periodo_factura":"201612","monto_total_origen":329.71,"fecha_vencimiento_1":"2017-01-10","monto_vencimiento_2":330.52,"fecha_vencimiento_2":"2017-01-17","monto_vencimiento_3":331.32,"fecha_vencimiento_3":"2017-01-24","fecha_factura":"2016-12-17","saldo":0},{"factura_tipo":"B","factura_numero":4457971,"nro_liq_sp":679882,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":" ","unidad_departamento":null,"envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":" ","envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":2324,"periodo_factura":"201612","monto_total_origen":383.58,"fecha_vencimiento_1":"2017-01-10","monto_vencimiento_2":384.52,"fecha_vencimiento_2":"2017-01-17","monto_vencimiento_3":385.45,"fecha_vencimiento_3":"2017-01-24","fecha_factura":"2016-12-17","saldo":0},{"factura_tipo":"B","factura_numero":4457973,"nro_liq_sp":679884,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PA","unidad_departamento":"B","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17434,"periodo_factura":"201612","monto_total_origen":329.71,"fecha_vencimiento_1":"2017-01-10","monto_vencimiento_2":330.52,"fecha_vencimiento_2":"2017-01-17","monto_vencimiento_3":331.32,"fecha_vencimiento_3":"2017-01-24","fecha_factura":"2016-12-17","saldo":0},{"factura_tipo":"B","factura_numero":4438745,"nro_liq_sp":656325,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PB","unidad_departamento":"A","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17433,"periodo_factura":"201611","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0},{"factura_tipo":"B","factura_numero":4438744,"nro_liq_sp":656324,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":" ","unidad_departamento":null,"envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":" ","envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":2324,"periodo_factura":"201611","monto_total_origen":301.15,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":301.89,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":302.62,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0},{"factura_tipo":"B","factura_numero":4438746,"nro_liq_sp":656326,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PA","unidad_departamento":"B","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17434,"periodo_factura":"201611","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0},{"factura_tipo":"B","factura_numero":4419514,"nro_liq_sp":633101,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":" ","unidad_departamento":null,"envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":" ","envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":2324,"periodo_factura":"201610","monto_total_origen":301.15,"fecha_vencimiento_1":"2016-11-10","monto_vencimiento_2":301.89,"fecha_vencimiento_2":"2016-11-17","monto_vencimiento_3":302.62,"fecha_vencimiento_3":"2016-11-24","fecha_factura":"2016-10-15","saldo":0},{"factura_tipo":"B","factura_numero":4419515,"nro_liq_sp":633102,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PB","unidad_departamento":"A","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17433,"periodo_factura":"201610","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-11-10","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-11-17","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-11-24","fecha_factura":"2016-10-15","saldo":0},{"factura_tipo":"B","factura_numero":4419516,"nro_liq_sp":633103,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PA","unidad_departamento":"B","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17434,"periodo_factura":"201610","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-11-10","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-11-17","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-11-24","fecha_factura":"2016-10-15","saldo":0},{"factura_tipo":"B","factura_numero":4400468,"nro_liq_sp":611975,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PB","unidad_departamento":"A","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17433,"periodo_factura":"201609","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-10-14","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-10-21","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-10-28","fecha_factura":"2016-09-16","saldo":0},{"factura_tipo":"B","factura_numero":4400467,"nro_liq_sp":611974,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":" ","unidad_departamento":null,"envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":" ","envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":2324,"periodo_factura":"201609","monto_total_origen":301.15,"fecha_vencimiento_1":"2016-10-14","monto_vencimiento_2":301.89,"fecha_vencimiento_2":"2016-10-21","monto_vencimiento_3":302.62,"fecha_vencimiento_3":"2016-10-28","fecha_factura":"2016-09-16","saldo":0},{"factura_tipo":"B","factura_numero":4400469,"nro_liq_sp":611976,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PA","unidad_departamento":"B","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17434,"periodo_factura":"201609","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-10-14","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-10-21","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-10-28","fecha_factura":"2016-09-16","saldo":0},{"factura_tipo":"B","factura_numero":4381366,"nro_liq_sp":589651,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PB","unidad_departamento":"A","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17433,"periodo_factura":"201608","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-09-12","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-09-19","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-09-26","fecha_factura":"2016-08-15","saldo":0},{"factura_tipo":"B","factura_numero":4381365,"nro_liq_sp":589650,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":" ","unidad_departamento":null,"envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":" ","envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":2324,"periodo_factura":"201608","monto_total_origen":301.15,"fecha_vencimiento_1":"2016-09-12","monto_vencimiento_2":301.89,"fecha_vencimiento_2":"2016-09-19","monto_vencimiento_3":302.62,"fecha_vencimiento_3":"2016-09-26","fecha_factura":"2016-08-15","saldo":0},{"factura_tipo":"B","factura_numero":4381367,"nro_liq_sp":589652,"numero_cuenta":5906883,"nombre_razon_social":"BEBAN AMANDA ALICIA","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":"WALANIKA","unidad_numero_puerta":341,"unidad_piso":"PA","unidad_departamento":"B","envio_calle":"WALANIKA","envio_numero_puerta":341,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":"B","nomenclatura_manzana":"0050","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":2187,"numero_unidad":17434,"periodo_factura":"201608","monto_total_origen":260.64,"fecha_vencimiento_1":"2016-09-12","monto_vencimiento_2":261.28,"fecha_vencimiento_2":"2016-09-19","monto_vencimiento_3":261.91,"fecha_vencimiento_3":"2016-09-26","fecha_factura":"2016-08-15","saldo":0}]');

        $info = ['http_code' => 200];

        if ($info['http_code'] == 200 && count($response)) {

            // obtengo el period actual
            $periodoActual = Carbon::now()->format('Ym');
            $periodoActual = '201612';

            $boletas = collect($response)->filter(function ($value, $key) use ($periodoActual) {
                return $value->periodo_factura === $periodoActual;
            })->map(function ($item, $key) {
                return new BoletaPago($item);
            });

            return $boletas;
        }
        else {
            return [];
        }
    }

    /**
     * [generar description]
     * @param  Resquest $request [description]
     * @return [type]            [description]
     */
    public function generar(Request $request)
    {
        $boletasPago = [];
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
        if (count($boletasPago) === 0) {
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
}
