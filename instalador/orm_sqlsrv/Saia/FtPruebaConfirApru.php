<?php

namespace Saia;

/**
 * FtPruebaConfirApru
 */
class FtPruebaConfirApru
{
    /**
     * @var integer
     */
    private $idftPruebaConfirApru;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $estadoDocumento;

    /**
     * @var string
     */
    private $holaMundo;

    /**
     * @var string
     */
    private $anexos;

    /**
     * @var string
     */
    private $item;


    /**
     * Get idftPruebaConfirApru
     *
     * @return integer
     */
    public function getIdftPruebaConfirApru()
    {
        return $this->idftPruebaConfirApru;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtPruebaConfirApru
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtPruebaConfirApru
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtPruebaConfirApru
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPruebaConfirApru
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaConfirApru
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtPruebaConfirApru
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set holaMundo
     *
     * @param string $holaMundo
     *
     * @return FtPruebaConfirApru
     */
    public function setHolaMundo($holaMundo)
    {
        $this->holaMundo = $holaMundo;

        return $this;
    }

    /**
     * Get holaMundo
     *
     * @return string
     */
    public function getHolaMundo()
    {
        return $this->holaMundo;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtPruebaConfirApru
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return FtPruebaConfirApru
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }
}

