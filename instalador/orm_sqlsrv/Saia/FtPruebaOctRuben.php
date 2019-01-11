<?php

namespace Saia;

/**
 * FtPruebaOctRuben
 */
class FtPruebaOctRuben
{
    /**
     * @var integer
     */
    private $idftPruebaOctRuben;

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
    private $campoTextRuben;


    /**
     * Get idftPruebaOctRuben
     *
     * @return integer
     */
    public function getIdftPruebaOctRuben()
    {
        return $this->idftPruebaOctRuben;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaOctRuben
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
     * @return FtPruebaOctRuben
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
     * @return FtPruebaOctRuben
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
     * @return FtPruebaOctRuben
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
     * Set campoTextRuben
     *
     * @param string $campoTextRuben
     *
     * @return FtPruebaOctRuben
     */
    public function setCampoTextRuben($campoTextRuben)
    {
        $this->campoTextRuben = $campoTextRuben;

        return $this;
    }

    /**
     * Get campoTextRuben
     *
     * @return string
     */
    public function getCampoTextRuben()
    {
        return $this->campoTextRuben;
    }
}

