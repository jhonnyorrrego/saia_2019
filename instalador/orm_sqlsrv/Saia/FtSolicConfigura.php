<?php

namespace Saia;

/**
 * FtSolicConfigura
 */
class FtSolicConfigura
{
    /**
     * @var integer
     */
    private $idftSolicConfigura;

    /**
     * @var integer
     */
    private $ftClasifSolicitud;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaConfig;

    /**
     * @var string
     */
    private $solicitud;

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
     * Get idftSolicConfigura
     *
     * @return integer
     */
    public function getIdftSolicConfigura()
    {
        return $this->idftSolicConfigura;
    }

    /**
     * Set ftClasifSolicitud
     *
     * @param integer $ftClasifSolicitud
     *
     * @return FtSolicConfigura
     */
    public function setFtClasifSolicitud($ftClasifSolicitud)
    {
        $this->ftClasifSolicitud = $ftClasifSolicitud;

        return $this;
    }

    /**
     * Get ftClasifSolicitud
     *
     * @return integer
     */
    public function getFtClasifSolicitud()
    {
        return $this->ftClasifSolicitud;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicConfigura
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
     * Set fechaConfig
     *
     * @param \DateTime $fechaConfig
     *
     * @return FtSolicConfigura
     */
    public function setFechaConfig($fechaConfig)
    {
        $this->fechaConfig = $fechaConfig;

        return $this;
    }

    /**
     * Get fechaConfig
     *
     * @return \DateTime
     */
    public function getFechaConfig()
    {
        return $this->fechaConfig;
    }

    /**
     * Set solicitud
     *
     * @param string $solicitud
     *
     * @return FtSolicConfigura
     */
    public function setSolicitud($solicitud)
    {
        $this->solicitud = $solicitud;

        return $this;
    }

    /**
     * Get solicitud
     *
     * @return string
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicConfigura
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
     * @return FtSolicConfigura
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
     * @return FtSolicConfigura
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
     * @return FtSolicConfigura
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
     * @return FtSolicConfigura
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

