<?php

namespace Saia;

/**
 * FtPruebaConfirmacion
 */
class FtPruebaConfirmacion
{
    /**
     * @var integer
     */
    private $idftPruebaConfirmacion;

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
     * @var string
     */
    private $campoTextoNice;

    /**
     * @var string
     */
    private $ocultoMostrar;


    /**
     * Get idftPruebaConfirmacion
     *
     * @return integer
     */
    public function getIdftPruebaConfirmacion()
    {
        return $this->idftPruebaConfirmacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaConfirmacion
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
     * @return FtPruebaConfirmacion
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
     * @return FtPruebaConfirmacion
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
     * @return FtPruebaConfirmacion
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
     * Set campoTextoNice
     *
     * @param string $campoTextoNice
     *
     * @return FtPruebaConfirmacion
     */
    public function setCampoTextoNice($campoTextoNice)
    {
        $this->campoTextoNice = $campoTextoNice;

        return $this;
    }

    /**
     * Get campoTextoNice
     *
     * @return string
     */
    public function getCampoTextoNice()
    {
        return $this->campoTextoNice;
    }

    /**
     * Set ocultoMostrar
     *
     * @param string $ocultoMostrar
     *
     * @return FtPruebaConfirmacion
     */
    public function setOcultoMostrar($ocultoMostrar)
    {
        $this->ocultoMostrar = $ocultoMostrar;

        return $this;
    }

    /**
     * Get ocultoMostrar
     *
     * @return string
     */
    public function getOcultoMostrar()
    {
        return $this->ocultoMostrar;
    }
}

