<?php

namespace Saia;

/**
 * FtDevoluFacturaRadica
 */
class FtDevoluFacturaRadica
{
    /**
     * @var integer
     */
    private $idftDevoluFacturaRadica;

    /**
     * @var integer
     */
    private $ftRadicacionFacturas;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $adjuntar;

    /**
     * @var integer
     */
    private $formaEnvio;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $proveedorDevolucion;

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
     * Get idftDevoluFacturaRadica
     *
     * @return integer
     */
    public function getIdftDevoluFacturaRadica()
    {
        return $this->idftDevoluFacturaRadica;
    }

    /**
     * Set ftRadicacionFacturas
     *
     * @param integer $ftRadicacionFacturas
     *
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * Set adjuntar
     *
     * @param string $adjuntar
     *
     * @return FtDevoluFacturaRadica
     */
    public function setAdjuntar($adjuntar)
    {
        $this->adjuntar = $adjuntar;

        return $this;
    }

    /**
     * Get adjuntar
     *
     * @return string
     */
    public function getAdjuntar()
    {
        return $this->adjuntar;
    }

    /**
     * Set formaEnvio
     *
     * @param integer $formaEnvio
     *
     * @return FtDevoluFacturaRadica
     */
    public function setFormaEnvio($formaEnvio)
    {
        $this->formaEnvio = $formaEnvio;

        return $this;
    }

    /**
     * Get formaEnvio
     *
     * @return integer
     */
    public function getFormaEnvio()
    {
        return $this->formaEnvio;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtDevoluFacturaRadica
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
     * Set proveedorDevolucion
     *
     * @param string $proveedorDevolucion
     *
     * @return FtDevoluFacturaRadica
     */
    public function setProveedorDevolucion($proveedorDevolucion)
    {
        $this->proveedorDevolucion = $proveedorDevolucion;

        return $this;
    }

    /**
     * Get proveedorDevolucion
     *
     * @return string
     */
    public function getProveedorDevolucion()
    {
        return $this->proveedorDevolucion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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

