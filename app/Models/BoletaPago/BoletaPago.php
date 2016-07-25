<?php

namespace App\Models\BoletaPago;

class BoletaPago {
    protected $ocupante;
    protected $tipoFactura;
    protected $nroFactura;
    protected $rentas;
    protected $periodo;
    protected $montoVto1;
    protected $montoVto2;
    protected $montoVto3;
    protected $fechaVto1;
    protected $fechaVto2;
    protected $fechaVto3;

    function __construct($data)
    {
    //date_default_timezone_set('America/Argentina/Ushuaia');

        $this->setOcupante($data->nombre_razon_socia);
        $this->setTipoFactura($data->tipo_factura);
        $this->setNroFactura($data->nro_factura);
        $this->setRentas($data->exp_rentas);

    // lo hago así porque la fecha tiene un formato inválido (yyyymm) y agregando el día funciona correctamente
        $this->setPeriodo($data->periodo_factura);

        $this->setMontoVto1($data->monto_total_origen);
        $this->setFechaVto1($data->fecha_vencim_1);

        $this->setMontoVto2($data->monto_ven2);
        $this->setFechaVto2($data->fecha_vencim_2);

        $this->setMontoVto3($data->monto_ven3);
        $this->setFechaVto3($data->fecha_vencim_3);

    }


    public function getCodigoBancos()
    {
        return "*604313675*";
    // return $this->codigoBancos;
    }

    public function getCodigoDposs()
    {
        return "*604313675*";
    // return $this->codigoDposs;
    }

    public function getCodigoLink()
    {
        return "0194010267920";
    // return $this->codigoLink;
    }

    public function getCodigoPagoFacil($checksum=true)
    {
    // Código de Empresa para Pago Fácil
        $pagoFacil = "0144";

    // 4 Enteros , 2 Decimales, sin punto
        $montoVto1 = sprintf('%06d', number_format($this->getMontoVto1(), 2, "", ""));

    // AA últimos 2 dígitos del año, y DDD días transcurridos desde el 1 de Enero del año.
        $fechaVto1 = $this->getFechaVto1()->format('yz') + 1;

    // Id. Comprobante
    // Tipo de Factura (1 == A ; 2 == B)
    // Nro. de Factura (6 digitos)
    // Numero de Cliente DPOSS == Expediente de Rentas (6 digitos)
        $tipoFactura = $this->getTipoFactura() === 'A' ? 1 : 2;
        $idComprobante = $tipoFactura . substr($this->getNroFactura(), -6) . sprintf('%06d', $this->getRentas());

    // Diferencia en $ entre el Monto Original y segundo vencimiento. 3 enteros, 2 decimales
        $difVto2 = sprintf('%05d', number_format(($this->getMontoVto2() - $this->getMontoVto1()), 2, "", ""));

    // Cantidad de días entre la Fecha del Vencimiento Original y el Segundo Vencimiento.
        $fechaVto2 = sprintf('%02d', date_diff($this->getFechaVto1(), $this->getFechaVto2())->format('%a'));

    // Diferencia en $ entre el Monto Original y el tercer vencimiento. 3 enteros, 2 decimales
        $difVto3 = sprintf('%04d', number_format(($this->getMontoVto3() - $this->getMontoVto1()), 2, "", ""));

    // Cantidad de días entre la Fecha del Vencimiento Original y el Tercer Vencimiento.
        $fechaVto3 = sprintf('%02d', date_diff($this->getFechaVto1(), $this->getFechaVto3())->format('%a'));

        $codigoSinChecksum = $pagoFacil . $montoVto1 . $fechaVto1 .
        $idComprobante . $difVto2 . $fechaVto2 . $difVto3 . $fechaVto3;

        if ($checksum) {
            return $codigoSinChecksum . $this->getChecksum();
        }
        else {
            return $codigoSinChecksum;
        }
    }


    // Inspirado en http://www.clubdelphi.com/foros/showthread.php?t=80919
    public function getChecksum() {
        $serie = 1;
        $mult = 0;

        $codigoPagoFacilSinChecksum = $this->getCodigoPagoFacil(false);

        for ($i=1; $i < strlen($codigoPagoFacilSinChecksum); $i++) {
            if ($serie > 9) $serie = 3;
            $mult = $mult + ($codigoPagoFacilSinChecksum[$i] * $serie);
            $serie = $serie + 2;
        }

        $mult = $mult / 2;

        return floor($mult) % 10;
    }



    /**
     * Gets the value of ocupante.
     *
     * @return mixed
     */
    public function getOcupante()
    {
      return $this->ocupante;
    }

    /**
     * Sets the value of ocupante.
     *
     * @param mixed $ocupante the ocupante
     *
     * @return self
     */
    protected function setOcupante($ocupante)
    {
      $this->ocupante = $ocupante;

      return $this;
    }

    /**
     * Gets the value of periodo.
     *
     * @return mixed
     */
    public function getPeriodo($formatear = false)
    {
      if ($formatear) return $this->periodo->format('m/Y');
      else return $this->periodo;
    }

    /**
     * Sets the value of periodo.
     *
     * @param mixed $periodo the periodo
     *
     * @return self
     */
    protected function setPeriodo($periodo)
    {
      $this->periodo = DateTime::createFromFormat('Ym', $periodo);

      return $this;
    }

    /**
     * Gets the value of montoVto1.
     *
     * @return mixed
     */
    public function getMontoVto1($formatear = false)
    {
      if ($formatear) return number_format($this->montoVto1, 2, ",", ".");
      else return $this->montoVto1;
    }

    /**
     * Sets the value of montoVto1.
     *
     * @param mixed $montoVto1 the monto vto1
     *
     * @return self
     */
    protected function setMontoVto1($montoVto1)
    {
      $this->montoVto1 = $montoVto1;

      return $this;
    }

    /**
     * Gets the value of montoVto2.
     *
     * @return mixed
     */
    public function getMontoVto2($formatear = false)
    {
      if ($formatear) return number_format($this->montoVto2, 2, ",", ".");
      else return $this->montoVto2;
    }

    /**
     * Sets the value of montoVto2.
     *
     * @param mixed $montoVto2 the monto vto2
     *
     * @return self
     */
    protected function setMontoVto2($montoVto2)
    {
      $this->montoVto2 = $montoVto2;

      return $this;
    }

    /**
     * Gets the value of montoVto3.
     *
     * @return mixed
     */
    public function getMontoVto3($formatear = false)
    {
      if ($formatear) return number_format($this->montoVto3, 2, ",", ".");
      else return $this->montoVto3;
    }

    /**
     * Sets the value of montoVto3.
     *
     * @param mixed $montoVto3 the monto vto3
     *
     * @return self
     */
    protected function setMontoVto3($montoVto3)
    {
      $this->montoVto3 = $montoVto3;

      return $this;
    }

    /**
     * Gets the value of fechaVto1.
     *
     * @return mixed
     */
    public function getFechaVto1($formatear = false)
    {
      if ($formatear) return $this->fechaVto1->format('d/m/Y');
      else return $this->fechaVto1;
    }

    /**
     * Sets the value of fechaVto1.
     *
     * @param mixed $fechaVto1 the fecha vto1
     *
     * @return self
     */
    protected function setFechaVto1($fechaVto1)
    {
      $this->fechaVto1 = new DateTime($fechaVto1);

      return $this;
    }

    /**
     * Gets the value of fechaVto2.
     *
     * @return mixed
     */
    public function getFechaVto2($formatear = false)
    {
      if ($formatear) return $this->fechaVto2->format('d/m/Y');
      else return $this->fechaVto2;
    }

    /**
     * Sets the value of fechaVto2.
     *
     * @param mixed $fechaVto2 the fecha vto2
     *
     * @return self
     */
    protected function setFechaVto2($fechaVto2)
    {
      $this->fechaVto2 = new DateTime($fechaVto2);

      return $this;
    }

    /**
     * Gets the value of fechaVto3.
     *
     * @return mixed
     */
    public function getFechaVto3($formatear = false)
    {
      if ($formatear) return $this->fechaVto3->format('d/m/Y');
      else return $this->fechaVto3;
    }

    /**
     * Sets the value of fechaVto3.
     *
     * @param mixed $fechaVto3 the fecha vto3
     *
     * @return self
     */
    protected function setFechaVto3($fechaVto3)
    {
      $this->fechaVto3 = new DateTime($fechaVto3);

      return $this;
    }


    /**
     * Gets the value of rentas.
     *
     * @return mixed
     */
    public function getRentas()
    {
      return $this->rentas;
    }

    /**
     * Sets the value of rentas.
     *
     * @param mixed $rentas the rentas
     *
     * @return self
     */
    protected function setRentas($rentas)
    {
      $this->rentas = $rentas;

      return $this;
    }

    /**
     * Gets the value of tipoFactura.
     *
     * @return mixed
     */
    public function getTipoFactura()
    {
        return $this->tipoFactura;
    }

    /**
     * Sets the value of tipoFactura.
     *
     * @param mixed $tipoFactura the tipo factura
     *
     * @return self
     */
    protected function setTipoFactura($tipoFactura)
    {
        $this->tipoFactura = $tipoFactura;

        return $this;
    }

    /**
     * Gets the value of nroFactura.
     *
     * @return mixed
     */
    public function getNroFactura()
    {
        return $this->nroFactura;
    }

    /**
     * Sets the value of nroFactura.
     *
     * @param mixed $nroFactura the nro factura
     *
     * @return self
     */
    protected function setNroFactura($nroFactura)
    {
        $this->nroFactura = $nroFactura;

        return $this;
    }
} // Class BoletaPago
