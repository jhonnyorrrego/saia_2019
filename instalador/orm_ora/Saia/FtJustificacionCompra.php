<?php

namespace Saia;

/**
 * FtJustificacionCompra
 */
class FtJustificacionCompra
{
    /**
     * @var integer
     */
    private $idftJustificacionCompra;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $descripcionJustificacion;

    /**
     * @var string
     */
    private $nombreSolicitante;

    /**
     * @var string
     */
    private $primeraAprobacion;

    /**
     * @var string
     */
    private $justificacionCompra;

    /**
     * @var \DateTime
     */
    private $fechaJustificacionCompra;

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
     * Get idftJustificacionCompra
     *
     * @return integer
     */
    public function getIdftJustificacionCompra()
    {
        return $this->idftJustificacionCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtJustificacionCompra
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
     * Set descripcionJustificacion
     *
     * @param string $descripcionJustificacion
     *
     * @return FtJustificacionCompra
     */
    public function setDescripcionJustificacion($descripcionJustificacion)
    {
        $this->descripcionJustificacion = $descripcionJustificacion;

        return $this;
    }

    /**
     * Get descripcionJustificacion
     *
     * @return string
     */
    public function getDescripcionJustificacion()
    {
        return $this->descripcionJustificacion;
    }

    /**
     * Set nombreSolicitante
     *
     * @param string $nombreSolicitante
     *
     * @return FtJustificacionCompra
     */
    public function setNombreSolicitante($nombreSolicitante)
    {
        $this->nombreSolicitante = $nombreSolicitante;

        return $this;
    }

    /**
     * Get nombreSolicitante
     *
     * @return string
     */
    public function getNombreSolicitante()
    {
        return $this->nombreSolicitante;
    }

    /**
     * Set primeraAprobacion
     *
     * @param string $primeraAprobacion
     *
     * @return FtJustificacionCompra
     */
    public function setPrimeraAprobacion($primeraAprobacion)
    {
        $this->primeraAprobacion = $primeraAprobacion;

        return $this;
    }

    /**
     * Get primeraAprobacion
     *
     * @return string
     */
    public function getPrimeraAprobacion()
    {
        return $this->primeraAprobacion;
    }

    /**
     * Set justificacionCompra
     *
     * @param string $justificacionCompra
     *
     * @return FtJustificacionCompra
     */
    public function setJustificacionCompra($justificacionCompra)
    {
        $this->justificacionCompra = $justificacionCompra;

        return $this;
    }

    /**
     * Get justificacionCompra
     *
     * @return string
     */
    public function getJustificacionCompra()
    {
        return $this->justificacionCompra;
    }

    /**
     * Set fechaJustificacionCompra
     *
     * @param \DateTime $fechaJustificacionCompra
     *
     * @return FtJustificacionCompra
     */
    public function setFechaJustificacionCompra($fechaJustificacionCompra)
    {
        $this->fechaJustificacionCompra = $fechaJustificacionCompra;

        return $this;
    }

    /**
     * Get fechaJustificacionCompra
     *
     * @return \DateTime
     */
    public function getFechaJustificacionCompra()
    {
        return $this->fechaJustificacionCompra;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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

