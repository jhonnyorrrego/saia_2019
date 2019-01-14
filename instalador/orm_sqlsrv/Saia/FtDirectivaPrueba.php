<?php

namespace Saia;

/**
 * FtDirectivaPrueba
 */
class FtDirectivaPrueba
{
    /**
     * @var integer
     */
    private $idftDirectivaPrueba;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $estadoFormato;

    /**
     * @var \DateTime
     */
    private $fechaDirectiva;

    /**
     * @var string
     */
    private $temaDirectiva;


    /**
     * Get idftDirectivaPrueba
     *
     * @return integer
     */
    public function getIdftDirectivaPrueba()
    {
        return $this->idftDirectivaPrueba;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDirectivaPrueba
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
     * @return FtDirectivaPrueba
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
     * @param string $dependencia
     *
     * @return FtDirectivaPrueba
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set estadoFormato
     *
     * @param integer $estadoFormato
     *
     * @return FtDirectivaPrueba
     */
    public function setEstadoFormato($estadoFormato)
    {
        $this->estadoFormato = $estadoFormato;

        return $this;
    }

    /**
     * Get estadoFormato
     *
     * @return integer
     */
    public function getEstadoFormato()
    {
        return $this->estadoFormato;
    }

    /**
     * Set fechaDirectiva
     *
     * @param \DateTime $fechaDirectiva
     *
     * @return FtDirectivaPrueba
     */
    public function setFechaDirectiva($fechaDirectiva)
    {
        $this->fechaDirectiva = $fechaDirectiva;

        return $this;
    }

    /**
     * Get fechaDirectiva
     *
     * @return \DateTime
     */
    public function getFechaDirectiva()
    {
        return $this->fechaDirectiva;
    }

    /**
     * Set temaDirectiva
     *
     * @param string $temaDirectiva
     *
     * @return FtDirectivaPrueba
     */
    public function setTemaDirectiva($temaDirectiva)
    {
        $this->temaDirectiva = $temaDirectiva;

        return $this;
    }

    /**
     * Get temaDirectiva
     *
     * @return string
     */
    public function getTemaDirectiva()
    {
        return $this->temaDirectiva;
    }
}

