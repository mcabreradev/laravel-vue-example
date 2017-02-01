<?php

namespace App\Models\OficinaVirtual;

use DateTime;
use App\Models\AppModel;

class BoletaPago
{
    /**
     * Codigo de DPOSS en pago facil
     * @var string
     */
    public static $CODIGO_EMPRESA_PAGO_FACIL = '0144';

    /**
     * Variables de la boleta
     */
    public $factura_tipo;
    public $factura_numero;
    public $nro_liq_sp;
    public $numero_cuenta;
    public $nombre_razon_social;
    public $nombre_ocupante;
    public $dni_ocupante;
    public $unidad_calle;
    public $unidad_numero_puerta;
    public $unidad_piso;
    public $unidad_departamento;
    public $envio_calle;
    public $envio_numero_puerta;
    public $envio_piso;
    public $envio_departamento;
    public $nomenclatura_seccion;
    public $nomenclatura_manzana;
    public $nomenclatura_parcela;
    public $nomenclatura_subparcela;
    public $nomenclatura_unidad_funcional;
    public $expediente;
    public $numero_unidad;
    public $periodo_factura;
    public $monto_total_origen;
    public $fecha_vencimiento_1;
    public $monto_vencimiento_2;
    public $fecha_vencimiento_2;
    public $monto_vencimiento_3;
    public $fecha_vencimiento_3;
    public $fecha_factura;
    public $saldo;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'fecha_vencimiento_1', 'fecha_vencimiento_2',
        'fecha_vencimiento_3'
    ];

    public function __construct($data)
    {
        $this->factura_tipo                  = $data->factura_tipo;
        $this->factura_numero                = $data->factura_numero;
        $this->nro_liq_sp                    = $data->nro_liq_sp;
        $this->numero_cuenta                 = $data->numero_cuenta;
        $this->nombre_razon_social           = $data->nombre_razon_social;
        $this->nombre_ocupante               = $data->nombre_ocupante;
        $this->dni_ocupante                  = $data->dni_ocupante;
        $this->unidad_calle                  = $data->unidad_calle;
        $this->unidad_numero_puerta          = $data->unidad_numero_puerta;
        $this->unidad_piso                   = $data->unidad_piso;
        $this->unidad_departamento           = $data->unidad_departamento;
        $this->envio_calle                   = $data->envio_calle;
        $this->envio_numero_puerta           = $data->envio_numero_puerta;
        $this->envio_piso                    = $data->envio_piso;
        $this->envio_departamento            = $data->envio_departamento;
        $this->nomenclatura_seccion          = $data->nomenclatura_seccion;
        $this->nomenclatura_manzana          = $data->nomenclatura_manzana;
        $this->nomenclatura_parcela          = $data->nomenclatura_parcela;
        $this->nomenclatura_subparcela       = $data->nomenclatura_subparcela;
        $this->nomenclatura_unidad_funcional = $data->nomenclatura_unidad_funcional;
        $this->expediente                    = $data->expediente;
        $this->numero_unidad                 = $data->numero_unidad;
        $this->periodo_factura               = $data->periodo_factura;
        $this->monto_total_origen            = $data->monto_total_origen;
        $this->fecha_vencimiento_1           = $data->fecha_vencimiento_1;
        $this->monto_vencimiento_2           = $data->monto_vencimiento_2;
        $this->fecha_vencimiento_2           = $data->fecha_vencimiento_2;
        $this->monto_vencimiento_3           = $data->monto_vencimiento_3;
        $this->fecha_vencimiento_3           = $data->fecha_vencimiento_3;
        $this->fecha_factura                 = $data->fecha_factura;
        $this->saldo                         = $data->saldo;
    }

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

    /**
     * Recompila y concatena la informacion asociada al domicilio
     * @return string domicilio
     */
    public function getDomicilio()
    {
        $domicilio = $this->unidad_calle;

        if (($this->unidad_numero_puerta !== null) && ($this->unidad_numero_puerta > 0)) {
            $domicilio .= " {$this->unidad_numero_puerta}";
        }

        if (trim($this->unidad_piso)) {
            $domicilio .= " piso {$this->unidad_piso}";
        }

        if (trim($this->unidad_departamento)) {
            $domicilio .= " dpto {$this->unidad_departamento}";
        }

        return $domicilio;
    }
} // Class BoletaPago
