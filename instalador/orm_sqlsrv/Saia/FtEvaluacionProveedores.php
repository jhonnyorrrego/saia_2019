<?php

namespace Saia;

/**
 * FtEvaluacionProveedores
 */
class FtEvaluacionProveedores
{
    /**
     * @var integer
     */
    private $idftEvaluacionProveedores;

    /**
     * @var integer
     */
    private $ftJustificacionCompra;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $atencion;

    /**
     * @var string
     */
    private $cumplimiento;

    /**
     * @var string
     */
    private $descripcionAlmacenada;

    /**
     * @var string
     */
    private $matriculadoCamara;

    /**
     * @var string
     */
    private $precioCotizaciones;

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
     * @var string
     */
    private $ftRecepcionCotizacion;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftEvaluacionProveedores
     *
     * @return integer
     */
    public function getIdftEvaluacionProveedores()
    {
        return $this->idftEvaluacionProveedores;
    }

    /**
     * Set ftJustificacionCompra
     *
     * @param integer $ftJustificacionCompra
     *
     * @return FtEvaluacionProveedores
     */
    public function setFtJustificacionCompra($ftJustificacionCompra)
    {
        $this->ftJustificacionCompra = $ftJustificacionCompra;

        return $this;
    }

    /**
     * Get ftJustificacionCompra
     *
     * @return integer
     */
    public function getFtJustificacionCompra()
    {
        return $this->ftJustificacionCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtEvaluacionProveedores
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
     * Set atencion
     *
     * @param string $atencion
     *
     * @return FtEvaluacionProveedores
     */
    public function setAtencion($atencion)
    {
        $this->atencion = $atencion;

        return $this;
    }

    /**
     * Get atencion
     *
     * @return string
     */
    public function getAtencion()
    {
        return $this->atencion;
    }

    /**
     * Set cumplimiento
     *
     * @param string $cumplimiento
     *
     * @return FtEvaluacionProveedores
     */
    public function setCumplimiento($cumplimiento)
    {
        $this->cumplimiento = $cumplimiento;

        return $this;
    }

    /**
     * Get cumplimiento
     *
     * @return string
     */
    public function getCumplimiento()
    {
        return $this->cumplimiento;
    }

    /**
     * Set descripcionAlmacenada
     *
     * @param string $descripcionAlmacenada
     *
     * @return FtEvaluacionProveedores
     */
    public function setDescripcionAlmacenada($descripcionAlmacenada)
    {
        $this->descripcionAlmacenada = $descripcionAlmacenada;

        return $this;
    }

    /**
     * Get descripcionAlmacenada
     *
     * @return string
     */
    public function getDescripcionAlmacenada()
    {
        return $this->descripcionAlmacenada;
    }

    /**
     * Set matriculadoCamara
     *
     * @param string $matriculadoCamara
     *
     * @return FtEvaluacionProveedores
     */
    public function setMatriculadoCamara($matriculadoCamara)
    {
        $this->matriculadoCamara = $matriculadoCamara;

        return $this;
    }

    /**
     * Get matriculadoCamara
     *
     * @return string
     */
    public function getMatriculadoCamara()
    {
        return $this->matriculadoCamara;
    }

    /**
     * Set precioCotizaciones
     *
     * @param string $precioCotizaciones
     *
     * @return FtEvaluacionProveedores
     */
    public function setPrecioCotizaciones($precioCotizaciones)
    {
        $this->precioCotizaciones = $precioCotizaciones;

        return $this;
    }

    /**
     * Get precioCotizaciones
     *
     * @return string
     */
    public function getPrecioCotizaciones()
    {
        return $this->precioCotizaciones;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtEvaluacionProveedores
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
     * @return FtEvaluacionProveedores
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
     * @return FtEvaluacionProveedores
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
     * @return FtEvaluacionProveedores
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
     * Set ftRecepcionCotizacion
     *
     * @param string $ftRecepcionCotizacion
     *
     * @return FtEvaluacionProveedores
     */
    public function setFtRecepcionCotizacion($ftRecepcionCotizacion)
    {
        $this->ftRecepcionCotizacion = $ftRecepcionCotizacion;

        return $this;
    }

    /**
     * Get ftRecepcionCotizacion
     *
     * @return string
     */
    public function getFtRecepcionCotizacion()
    {
        return $this->ftRecepcionCotizacion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtEvaluacionProveedores
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

