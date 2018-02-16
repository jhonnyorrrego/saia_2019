<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFormaPagoVehiculo
 *
 * @ORM\Table(name="ft_forma_pago_vehiculo")
 * @ORM\Entity
 */
class FtFormaPagoVehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_forma_pago_vehiculo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftFormaPagoVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_confir_negoci_vehiculo", type="integer", nullable=false)
     */
    private $ftConfirNegociVehiculo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago", type="date", nullable=true)
     */
    private $fechaPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="concepto_pago", type="integer", nullable=false)
     */
    private $conceptoPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_forma_pago", type="integer", nullable=false)
     */
    private $valorFormaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_pago", type="string", length=255, nullable=true)
     */
    private $observacionesPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
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
