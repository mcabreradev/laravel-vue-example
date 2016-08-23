<?php

namespace App\Models\OficinaVirtual;

use DateTime;
use App\Models\AppModel;

class BoletaPago extends AppModel
{
    public static $CODIGO_EMPRESA_PAGO_FACIL = '0144';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boletas_pago';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'fecha_vencimiento_1',
        'fecha_vencimiento_2', 'fecha_vencimiento_3'];

    /**
     * [getCodigoDposs description]
     * @return [type] [description]
     */
    public function getCodigoDposs()
    {
        return $this->factura_tipo . '0' .$this->factura_numero;
    }

    /**
     * [getCodigoLink description]
     * @return [type] [description]
     */
    public function getCodigoLink()
    {
        return sprintf('%06d', $this->expediente) . sprintf('%06d', $this->unidad_numero) . '0';
    }

    /**
     * [getCodigoPagoFacil description]
     * @param  boolean $checksum [description]
     * @return [type]            [description]
     */
    public function getCodigoPagoFacil($checksum=true)
    {
        // Código de Empresa para Pago Fácil
        $pagoFacil = $this::$CODIGO_EMPRESA_PAGO_FACIL;

        // 4 Enteros , 2 Decimales, sin punto
        $montoVto1 = sprintf('%06d', number_format($this->monto_vencimiento_1, 2, "", ""));

        // AA ultimos 2 dígitos del año, y DDD días transcurridos desde el 1 de Enero del año.
        $fechaVto1 = $this->fecha_vencimiento_1->format('yz') + 1;

        // Id. Comprobante
        // Tipo de Factura (1 == A ; 2 == B)
        // Nro. de Factura (6 digitos)
        // Numero de Cliente DPOSS == Expediente de Rentas (6 digitos)
        $tipoFactura = $this->factura_tipo === 'A' ? 1 : 2;
        $idComprobante = $tipoFactura . substr($this->factura_numero, -6) . sprintf('%06d', $this->expediente);

        // Diferencia en $ entre el Monto Original y segundo vencimiento. 3 enteros, 2 decimales
        $difVto2 = sprintf('%05d', number_format(($this->monto_vencimiento_2 - $this->monto_vencimiento_1), 2, "", ""));

        // Cantidad de días entre la Fecha del Vencimiento Original y el Segundo Vencimiento. (2 digitos)
        $fechaVto2 = sprintf('%02d', date_diff($this->fecha_vencimiento_1, $this->fecha_vencimiento_2)->format('%a'));

        // Diferencia en $ entre el Monto Original y el tercer vencimiento. 2 enteros, 2 decimales
        $difVto3 = sprintf('%04d', number_format(($this->monto_vencimiento_3 - $this->monto_vencimiento_1), 2, "", ""));

        // Cantidad de días entre la Fecha del Vencimiento Original y el Tercer Vencimiento. (2 digitos)
        $fechaVto3 = sprintf('%02d', date_diff($this->fecha_vencimiento_1, $this->fecha_vencimiento_3)->format('%a'));

        $codigoSinChecksum = $pagoFacil . $montoVto1 . $fechaVto1 .
        $idComprobante . $difVto2 . $fechaVto2 . $difVto3 . $fechaVto3;

        if ($checksum) {
            return $codigoSinChecksum . $this->getChecksum();
        }
        else {
            return $codigoSinChecksum;
        }
    }

    /**
     * Inspirado en http://www.clubdelphi.com/foros/showthread.php?t=80919
     * @return [type] [description]
     */
    public function getChecksum() {
        $serie = 1;
        $mult  = 0;

        $codigoPagoFacilSinChecksum = $this->getCodigoPagoFacil(false);

        for ($i=0; $i < strlen($codigoPagoFacilSinChecksum); $i++) {
            if ($serie > 9) {
                $serie = 3;
            }

            $mult = $mult + ($codigoPagoFacilSinChecksum[$i] * $serie);
            $serie = $serie + 2;
        }

        $mult = $mult / 2;
        return floor($mult) % 10;
    }
} // Class BoletaPago
