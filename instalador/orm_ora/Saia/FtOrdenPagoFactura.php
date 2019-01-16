<?php

namespace Saia;

/**
 * FtOrdenPagoFactura
 */
class FtOrdenPagoFactura
{
    /**
     * @var integer
     */
    private $idftOrdenPagoFactura;

    /**
     * @var integer
     */
    private $ftRadicacionFacturas;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $calificacion;

    /**
     * @var string
     */
    private $causacion;

    /**
     * @var \DateTime
     */
    private $fechaCausacion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $tipoGasto;

    /**
     * @var integer
     */
    private $urgenciaPago;

    /**
     * @var integer
     */
    private $usuarioCauso;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $estadoDocumento;


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

