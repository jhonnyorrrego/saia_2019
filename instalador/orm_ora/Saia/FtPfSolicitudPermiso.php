<?php

namespace Saia;

/**
 * FtPfSolicitudPermiso
 */
class FtPfSolicitudPermiso
{
    /**
     * @var integer
     */
    private $idftPfSolicitudPermiso;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $cantidadDias;

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
     * Get idftPfSolicitudPermiso
     *
     * @return integer
     */
    public function getIdftPfSolicitudPermiso()
    {
        return $this->idftPfSolicitudPermiso;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPfSolicitudPermiso
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
     * Set cantidadDias
     *
     * @param integer $cantidadDias
     *
     * @return FtPfSolicitudPermiso
     */
    public function setCantidadDias($cantidadDias)
    {
        $this->cantidadDias = $cantidadDias;

        return $this;
    }

    /**
     * Get cantidadDias
     *
     * @return integer
     */
    public function getCantidadDias()
    {
        return $this->cantidadDias;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPfSolicitudPermiso
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
     * @return FtPfSolicitudPermiso
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
     * @return FtPfSolicitudPermiso
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
     * @return FtPfSolicitudPermiso
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
}

