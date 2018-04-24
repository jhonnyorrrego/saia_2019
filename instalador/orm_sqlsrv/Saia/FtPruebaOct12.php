<?php

namespace Saia;

/**
 * FtPruebaOct12
 */
class FtPruebaOct12
{
    /**
     * @var integer
     */
    private $idftPruebaOct12;

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
    private $cuadroText;


    /**
     * Get idftPruebaOct12
     *
     * @return integer
     */
    public function getIdftPruebaOct12()
    {
        return $this->idftPruebaOct12;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaOct12
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
     * @return FtPruebaOct12
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
     * @return FtPruebaOct12
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
     * @return FtPruebaOct12
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
     * Set cuadroText
     *
     * @param string $cuadroText
     *
     * @return FtPruebaOct12
     */
    public function setCuadroText($cuadroText)
    {
        $this->cuadroText = $cuadroText;

        return $this;
    }

    /**
     * Get cuadroText
     *
     * @return string
     */
    public function getCuadroText()
    {
        return $this->cuadroText;
    }
}

