<?php

namespace Saia;

/**
 * FtFormaPagoVehiculo
 */
class FtFormaPagoVehiculo
{
    /**
     * @var integer
     */
    private $idftFormaPagoVehiculo;

    /**
     * @var integer
     */
    private $ftConfirNegociVehiculo;

    /**
     * @var \DateTime
     */
    private $fechaPago;

    /**
     * @var integer
     */
    private $conceptoPago;

    /**
     * @var integer
     */
    private $valorFormaPago;

    /**
     * @var string
     */
    private $observacionesPago;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftFormaPagoVehiculo
     *
     * @return integer
     */
    public function getIdftFormaPagoVehiculo()
    {
        return $this->idftFormaPagoVehiculo;
    }

    /**
     * Set ftConfirNegociVehiculo
     *
     * @param integer $ftConfirNegociVehiculo
     *
     * @return FtFormaPagoVehiculo
     */
    public function setFtConfirNegociVehiculo($ftConfirNegociVehiculo)
    {
        $this->ftConfirNegociVehiculo = $ftConfirNegociVehiculo;

        return $this;
    }

    /**
     * Get ftConfirNegociVehiculo
     *
     * @return integer
     */
    public function getFtConfirNegociVehiculo()
    {
        return $this->ftConfirNegociVehiculo;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     *
     * @return FtFormaPagoVehiculo
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    /**
     * Get fechaPago
     *
     * @return \DateTime
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set conceptoPago
     *
     * @param integer $conceptoPago
     *
     * @return FtFormaPagoVehiculo
     */
    public function setConceptoPago($conceptoPago)
    {
        $this->conceptoPago = $conceptoPago;

        return $this;
    }

    /**
     * Get conceptoPago
     *
     * @return integer
     */
    public function getConceptoPago()
    {
        return $this->conceptoPago;
    }

    /**
     * Set valorFormaPago
     *
     * @param integer $valorFormaPago
     *
     * @return FtFormaPagoVehiculo
     */
    public function setValorFormaPago($valorFormaPago)
    {
        $this->valorFormaPago = $valorFormaPago;

        return $this;
    }

    /**
     * Get valorFormaPago
     *
     * @return integer
     */
    public function getValorFormaPago()
    {
        return $this->valorFormaPago;
    }

    /**
     * Set observacionesPago
     *
     * @param string $observacionesPago
     *
     * @return FtFormaPagoVehiculo
     */
    public function setObservacionesPago($observacionesPago)
    {
        $this->observacionesPago = $observacionesPago;

        return $this;
    }

    /**
     * Get observacionesPago
     *
     * @return string
     */
    public function getObservacionesPago()
    {
        return $this->observacionesPago;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFormaPagoVehiculo
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }
}

