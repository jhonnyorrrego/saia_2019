<?php

namespace Saia;

/**
 * FtFormatoPruebaLiga
 */
class FtFormatoPruebaLiga
{
    /**
     * @var integer
     */
    private $idftFormatoPruebaLiga;

    /**
     * @var string
     */
    private $estadoDocumento;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $radioBoton;

    /**
     * @var string
     */
    private $campoText;

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
     * Get idftFormatoPruebaLiga
     *
     * @return integer
     */
    public function getIdftFormatoPruebaLiga()
    {
        return $this->idftFormatoPruebaLiga;
    }

    /**
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtFormatoPruebaLiga
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFormatoPruebaLiga
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
     * Set radioBoton
     *
     * @param integer $radioBoton
     *
     * @return FtFormatoPruebaLiga
     */
    public function setRadioBoton($radioBoton)
    {
        $this->radioBoton = $radioBoton;

        return $this;
    }

    /**
     * Get radioBoton
     *
     * @return integer
     */
    public function getRadioBoton()
    {
        return $this->radioBoton;
    }

    /**
     * Set campoText
     *
     * @param string $campoText
     *
     * @return FtFormatoPruebaLiga
     */
    public function setCampoText($campoText)
    {
        $this->campoText = $campoText;

        return $this;
    }

    /**
     * Get campoText
     *
     * @return string
     */
    public function getCampoText()
    {
        return $this->campoText;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtFormatoPruebaLiga
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
     * @return FtFormatoPruebaLiga
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
     * @return FtFormatoPruebaLiga
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
     * @return FtFormatoPruebaLiga
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

