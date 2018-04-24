<?php

namespace Saia;

/**
 * FtFlujosPadre
 */
class FtFlujosPadre
{
    /**
     * @var integer
     */
    private $idftFlujosPadre;

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
    private $arbolFun;

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
    private $campoAnexo;


    /**
     * Get idftFlujosPadre
     *
     * @return integer
     */
    public function getIdftFlujosPadre()
    {
        return $this->idftFlujosPadre;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * Set arbolFun
     *
     * @param integer $arbolFun
     *
     * @return FtFlujosPadre
     */
    public function setArbolFun($arbolFun)
    {
        $this->arbolFun = $arbolFun;

        return $this;
    }

    /**
     * Get arbolFun
     *
     * @return integer
     */
    public function getArbolFun()
    {
        return $this->arbolFun;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFlujosPadre
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
     * @return FtFlujosPadre
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
     * Set campoAnexo
     *
     * @param string $campoAnexo
     *
     * @return FtFlujosPadre
     */
    public function setCampoAnexo($campoAnexo)
    {
        $this->campoAnexo = $campoAnexo;

        return $this;
    }

    /**
     * Get campoAnexo
     *
     * @return string
     */
    public function getCampoAnexo()
    {
        return $this->campoAnexo;
    }
}

