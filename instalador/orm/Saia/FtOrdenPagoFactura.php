<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOrdenPagoFactura
 *
 * @ORM\Table(name="ft_orden_pago_factura", indexes={@ORM\Index(name="i_orden_pago_factura_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_orden_pago_factura_radicacion", columns={"ft_radicacion_facturas"}), @ORM\Index(name="i_orden_pago_factura_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtOrdenPagoFactura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_orden_pago_factura", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftOrdenPagoFactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_facturas", type="integer", nullable=false)
     */
    private $ftRadicacionFacturas;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1028';

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion", type="integer", nullable=false)
     */
    private $calificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="causacion", type="string", length=255, nullable=true)
     */
    private $causacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_causacion", type="datetime", nullable=true)
     */
    private $fechaCausacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_gasto", type="string", length=255, nullable=false)
     */
    private $tipoGasto;

    /**
     * @var integer
     *
     * @ORM\Column(name="urgencia_pago", type="integer", nullable=false)
     */
    private $urgenciaPago = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_causo", type="integer", nullable=false)
     */
    private $usuarioCauso;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftOrdenPagoFactura
     *
     * @return integer
     */
    public function getIdftOrdenPagoFactura()
    {
        return $this->idftOrdenPagoFactura;
    }

    /**
     * Set ftRadicacionFacturas
     *
     * @param integer $ftRadicacionFacturas
     *
     * @return FtOrdenPagoFactura
     */
    public function setFtRadicacionFacturas($ftRadicacionFacturas)
    {
        $this->ftRadicacionFacturas = $ftRadicacionFacturas;

        return $this;
    }

    /**
     * Get ftRadicacionFacturas
     *
     * @return integer
     */
    public function getFtRadicacionFacturas()
    {
        return $this->ftRadicacionFacturas;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenPagoFactura
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

    /**
     * Set calificacion
     *
     * @param integer $calificacion
     *
     * @return FtOrdenPagoFactura
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return integer
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set causacion
     *
     * @param string $causacion
     *
     * @return FtOrdenPagoFactura
     */
    public function setCausacion($causacion)
    {
        $this->causacion = $causacion;

        return $this;
    }

    /**
     * Get causacion
     *
     * @return string
     */
    public function getCausacion()
    {
        return $this->causacion;
    }

    /**
     * Set fechaCausacion
     *
     * @param \DateTime $fechaCausacion
     *
     * @return FtOrdenPagoFactura
     */
    public function setFechaCausacion($fechaCausacion)
    {
        $this->fechaCausacion = $fechaCausacion;

        return $this;
    }

    /**
     * Get fechaCausacion
     *
     * @return \DateTime
     */
    public function getFechaCausacion()
    {
        return $this->fechaCausacion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtOrdenPagoFactura
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set tipoGasto
     *
     * @param string $tipoGasto
     *
     * @return FtOrdenPagoFactura
     */
    public function setTipoGasto($tipoGasto)
    {
        $this->tipoGasto = $tipoGasto;

        return $this;
    }

    /**
     * Get tipoGasto
     *
     * @return string
     */
    public function getTipoGasto()
    {
        return $this->tipoGasto;
    }

    /**
     * Set urgenciaPago
     *
     * @param integer $urgenciaPago
     *
     * @return FtOrdenPagoFactura
     */
    public function setUrgenciaPago($urgenciaPago)
    {
        $this->urgenciaPago = $urgenciaPago;

        return $this;
    }

    /**
     * Get urgenciaPago
     *
     * @return integer
     */
    public function getUrgenciaPago()
    {
        return $this->urgenciaPago;
    }

    /**
     * Set usuarioCauso
     *
     * @param integer $usuarioCauso
     *
     * @return FtOrdenPagoFactura
     */
    public function setUsuarioCauso($usuarioCauso)
    {
        $this->usuarioCauso = $usuarioCauso;

        return $this;
    }

    /**
     * Get usuarioCauso
     *
     * @return integer
     */
    public function getUsuarioCauso()
    {
        return $this->usuarioCauso;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenPagoFactura
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtOrdenPagoFactura
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtOrdenPagoFactura
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtOrdenPagoFactura
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtOrdenPagoFactura
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}
