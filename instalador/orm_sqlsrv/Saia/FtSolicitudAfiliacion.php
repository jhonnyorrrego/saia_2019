<?php

namespace Saia;

/**
 * FtSolicitudAfiliacion
 */
class FtSolicitudAfiliacion
{
    /**
     * @var integer
     */
    private $idftSolicitudAfiliacion;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaSolicitud;

    /**
     * @var string
     */
    private $datosSolicitante;

    /**
     * @var integer
     */
    private $numeroFoliosAfilia;

    /**
     * @var string
     */
    private $adjuntarDocumento;

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
     * Get idftSolicitudAfiliacion
     *
     * @return integer
     */
    public function getIdftSolicitudAfiliacion()
    {
        return $this->idftSolicitudAfiliacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudAfiliacion
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
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     *
     * @return FtSolicitudAfiliacion
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set datosSolicitante
     *
     * @param string $datosSolicitante
     *
     * @return FtSolicitudAfiliacion
     */
    public function setDatosSolicitante($datosSolicitante)
    {
        $this->datosSolicitante = $datosSolicitante;

        return $this;
    }

    /**
     * Get datosSolicitante
     *
     * @return string
     */
    public function getDatosSolicitante()
    {
        return $this->datosSolicitante;
    }

    /**
     * Set numeroFoliosAfilia
     *
     * @param integer $numeroFoliosAfilia
     *
     * @return FtSolicitudAfiliacion
     */
    public function setNumeroFoliosAfilia($numeroFoliosAfilia)
    {
        $this->numeroFoliosAfilia = $numeroFoliosAfilia;

        return $this;
    }

    /**
     * Get numeroFoliosAfilia
     *
     * @return integer
     */
    public function getNumeroFoliosAfilia()
    {
        return $this->numeroFoliosAfilia;
    }

    /**
     * Set adjuntarDocumento
     *
     * @param string $adjuntarDocumento
     *
     * @return FtSolicitudAfiliacion
     */
    public function setAdjuntarDocumento($adjuntarDocumento)
    {
        $this->adjuntarDocumento = $adjuntarDocumento;

        return $this;
    }

    /**
     * Get adjuntarDocumento
     *
     * @return string
     */
    public function getAdjuntarDocumento()
    {
        return $this->adjuntarDocumento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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

