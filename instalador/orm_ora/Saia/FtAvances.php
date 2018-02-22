<?php

namespace Saia;

/**
 * FtAvances
 */
class FtAvances
{
    /**
     * @var integer
     */
    private $idftAvances;

    /**
     * @var integer
     */
    private $ftRecordarTarea;

    /**
     * @var integer
     */
    private $serieIdserie;

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
    private $estado;

    /**
     * @var \DateTime
     */
    private $fechaFormato;

    /**
     * @var string
     */
    private $descripcionFormato;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftAvances
     *
     * @return integer
     */
    public function getIdftAvances()
    {
        return $this->idftAvances;
    }

    /**
     * Set ftRecordarTarea
     *
     * @param integer $ftRecordarTarea
     *
     * @return FtAvances
     */
    public function setFtRecordarTarea($ftRecordarTarea)
    {
        $this->ftRecordarTarea = $ftRecordarTarea;

        return $this;
    }

    /**
     * Get ftRecordarTarea
     *
     * @return integer
     */
    public function getFtRecordarTarea()
    {
        return $this->ftRecordarTarea;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAvances
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAvances
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
     * @return FtAvances
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
     * @return FtAvances
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
     * @return FtAvances
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
     * Set estado
     *
     * @param string $estado
     *
     * @return FtAvances
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaFormato
     *
     * @param \DateTime $fechaFormato
     *
     * @return FtAvances
     */
    public function setFechaFormato($fechaFormato)
    {
        $this->fechaFormato = $fechaFormato;

        return $this;
    }

    /**
     * Get fechaFormato
     *
     * @return \DateTime
     */
    public function getFechaFormato()
    {
        return $this->fechaFormato;
    }

    /**
     * Set descripcionFormato
     *
     * @param string $descripcionFormato
     *
     * @return FtAvances
     */
    public function setDescripcionFormato($descripcionFormato)
    {
        $this->descripcionFormato = $descripcionFormato;

        return $this;
    }

    /**
     * Get descripcionFormato
     *
     * @return string
     */
    public function getDescripcionFormato()
    {
        return $this->descripcionFormato;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAvances
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

