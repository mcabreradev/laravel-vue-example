<?php

namespace app\Http\Controllers\OficinaVirtual;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\OficinaVirtual\BoletaPago;
use App\Http\Requests;
use Illuminate\Http\Request;

class BoletaPagoController extends Controller
{
    public function generar()
    {

        $boletaPago = BoletaPago::find(5467);

        // Aquí sigue configuración básica del PDF
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        PDF::SetFont('helvetica', '', 10);

        // define barcode style
        $bar_code_style = array(
            'position'     => '',
            'align'        => 'C',
            'stretch'      => false,
            'fitwidth'     => true,
            'cellfitalign' => '',
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

        // "Parseamos" el template (esto se podría formalizar más)
        $codigoPagoFacil = PDF::serializeTCPDFtagParameters(
            [$boletaPago->getCodigoPagoFacil(), 'C39', '', '', '', '20', 1, $bar_code_style, 'N']
        );

        $codigoDposs = PDF::serializeTCPDFtagParameters(
            [$boletaPago->getCodigoDposs(), 'C39', '', '', '', '20', 1, $bar_code_style, 'N']
        );

        $html = view('oficina-virtual.boleta-pago')
            ->with('boletaPago', $boletaPago)
            ->with('codigoPagoFacil', $codigoPagoFacil)
            ->with('codigoDposs', $codigoDposs)
            ->render();

        // output the HTML content
        PDF::writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        PDF::lastPage();

        //Close and output PDF document
        return Response::make(
            PDF::Output('boleta-pago.pdf', 'S'),
            200, [
                'content-type' => 'application/pdf',
                'Content-Disposition' => 'inline; boleta-pago.pdf'
            ]
        );
    }
}
