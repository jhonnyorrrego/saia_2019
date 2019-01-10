<?php

namespace Saia;

/**
 * FtAvanceNovedad
 */
class FtAvanceNovedad
{
    /**
     * @var integer
     */
    private $idftAvanceNovedad;

    /**
     * @var integer
     */
    private $ftNovedades;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaAvance;

    /**
     * @var string
     */
    private $descripcionAvance;

    /**
     * @var integer
     */
    private $estadoAvance;

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
     * Get idftAvanceNovedad
     *
     * @return integer
     */
    public function getIdftAvanceNovedad()
    {
        return $this->idftAvanceNovedad;
    }

    /**
     * Set ftNovedades
     *
     * @param integer $ftNovedades
     *
     * @return FtAvanceNovedad
     */
    public function setFtNovedades($ftNovedades)
    {
        $this->ftNovedades = $ftNovedades;

        return $this;
    }

    /**
     * Get ftNovedades
     *
     * @return integer
     */
    public function getFtNovedades()
    {
        return $this->ftNovedades;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAvanceNovedad
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
     * Set fechaAvance
     *
     * @param \DateTime $fechaAvance
     *
     * @return FtAvanceNovedad
     */
    public function setFechaAvance($fechaAvance)
    {
        $this->fechaAvance = $fechaAvance;

        return $this;
    }

    /**
     * Get fechaAvance
     *
     * @return \DateTime
     */
    public function getFechaAvance()
    {
        return $this->fechaAvance;
    }

    /**
     * Set descripcionAvance
     *
     * @param string $descripcionAvance
     *
     * @return FtAvanceNovedad
     */
    public function setDescripcionAvance($descripcionAvance)
    {
        $this->descripcionAvance = $descripcionAvance;

        return $this;
    }

    /**
     * Get descripcionAvance
     *
     * @return string
     */
    public function getDescripcionAvance()
    {
        return $this->descripcionAvance;
    }

    /**
     * Set estadoAvance
     *
     * @param integer $estadoAvance
     *
     * @return FtAvanceNovedad
     */
    public function setEstadoAvance($estadoAvance)
    {
        $this->estadoAvance = $estadoAvance;

        return $this;
    }

    /**
     * Get estadoAvance
     *
     * @return integer
     */
    public function getEstadoAvance()
    {
        return $this->estadoAvance;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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
     * @return FtAvanceNovedad
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

