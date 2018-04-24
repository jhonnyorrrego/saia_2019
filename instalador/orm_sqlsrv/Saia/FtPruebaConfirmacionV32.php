<?php

namespace Saia;

/**
 * FtPruebaConfirmacionV32
 */
class FtPruebaConfirmacionV32
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
     * @var \DateTime
     */
    private $date1027490111;


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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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
     * @return FtPruebaConfirmacionV32
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

    /**
     * Set date1027490111
     *
     * @param \DateTime $date1027490111
     *
     * @return FtPruebaConfirmacionV32
     */
    public function setDate1027490111($date1027490111)
    {
        $this->date1027490111 = $date1027490111;

        return $this;
    }

    /**
     * Get date1027490111
     *
     * @return \DateTime
     */
    public function getDate1027490111()
    {
        return $this->date1027490111;
    }
}

