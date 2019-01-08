<?php

namespace Saia;

/**
 * FtClasifSolicitud
 */
class FtClasifSolicitud
{
    /**
     * @var integer
     */
    private $idftClasifSolicitud;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $ftSolicitAsistenc;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaClas;

    /**
     * @var string
     */
    private $tipoClas;

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
     * Get idftClasifSolicitud
     *
     * @return integer
     */
    public function getIdftClasifSolicitud()
    {
        return $this->idftClasifSolicitud;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtClasifSolicitud
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set ftSolicitAsistenc
     *
     * @param integer $ftSolicitAsistenc
     *
     * @return FtClasifSolicitud
     */
    public function setFtSolicitAsistenc($ftSolicitAsistenc)
    {
        $this->ftSolicitAsistenc = $ftSolicitAsistenc;

        return $this;
    }

    /**
     * Get ftSolicitAsistenc
     *
     * @return integer
     */
    public function getFtSolicitAsistenc()
    {
        return $this->ftSolicitAsistenc;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtClasifSolicitud
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
     * Set fechaClas
     *
     * @param \DateTime $fechaClas
     *
     * @return FtClasifSolicitud
     */
    public function setFechaClas($fechaClas)
    {
        $this->fechaClas = $fechaClas;

        return $this;
    }

    /**
     * Get fechaClas
     *
     * @return \DateTime
     */
    public function getFechaClas()
    {
        return $this->fechaClas;
    }

    /**
     * Set tipoClas
     *
     * @param string $tipoClas
     *
     * @return FtClasifSolicitud
     */
    public function setTipoClas($tipoClas)
    {
        $this->tipoClas = $tipoClas;

        return $this;
    }

    /**
     * Get tipoClas
     *
     * @return string
     */
    public function getTipoClas()
    {
        return $this->tipoClas;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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

