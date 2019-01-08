<?php

namespace Saia;

/**
 * FtReporteAvance
 */
class FtReporteAvance
{
    /**
     * @var integer
     */
    private $idftReporteAvance;

    /**
     * @var integer
     */
    private $ftSolicitudSoporte;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $categoria;

    /**
     * @var string
     */
    private $estadoProceso;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $insumos;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $anexos;

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
     * Get idftReporteAvance
     *
     * @return integer
     */
    public function getIdftReporteAvance()
    {
        return $this->idftReporteAvance;
    }

    /**
     * Set ftSolicitudSoporte
     *
     * @param integer $ftSolicitudSoporte
     *
     * @return FtReporteAvance
     */
    public function setFtSolicitudSoporte($ftSolicitudSoporte)
    {
        $this->ftSolicitudSoporte = $ftSolicitudSoporte;

        return $this;
    }

    /**
     * Get ftSolicitudSoporte
     *
     * @return integer
     */
    public function getFtSolicitudSoporte()
    {
        return $this->ftSolicitudSoporte;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReporteAvance
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
     * Set categoria
     *
     * @param string $categoria
     *
     * @return FtReporteAvance
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set estadoProceso
     *
     * @param string $estadoProceso
     *
     * @return FtReporteAvance
     */
    public function setEstadoProceso($estadoProceso)
    {
        $this->estadoProceso = $estadoProceso;

        return $this;
    }

    /**
     * Get estadoProceso
     *
     * @return string
     */
    public function getEstadoProceso()
    {
        return $this->estadoProceso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtReporteAvance
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set insumos
     *
     * @param string $insumos
     *
     * @return FtReporteAvance
     */
    public function setInsumos($insumos)
    {
        $this->insumos = $insumos;

        return $this;
    }

    /**
     * Get insumos
     *
     * @return string
     */
    public function getInsumos()
    {
        return $this->insumos;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtReporteAvance
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtReporteAvance
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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

