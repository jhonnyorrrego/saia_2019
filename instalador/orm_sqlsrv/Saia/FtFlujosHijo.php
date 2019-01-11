<?php

namespace Saia;

/**
 * FtFlujosHijo
 */
class FtFlujosHijo
{
    /**
     * @var integer
     */
    private $idftFlujosHijo;

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
     * @var string
     */
    private $campoTezxt;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $estadoDocumento;

    /**
     * @var integer
     */
    private $ftFlujosPadre;


    /**
     * Get idftFlujosHijo
     *
     * @return integer
     */
    public function getIdftFlujosHijo()
    {
        return $this->idftFlujosHijo;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtFlujosHijo
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
     * @return FtFlujosHijo
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
     * @return FtFlujosHijo
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
     * @return FtFlujosHijo
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
     * Set campoTezxt
     *
     * @param string $campoTezxt
     *
     * @return FtFlujosHijo
     */
    public function setCampoTezxt($campoTezxt)
    {
        $this->campoTezxt = $campoTezxt;

        return $this;
    }

    /**
     * Get campoTezxt
     *
     * @return string
     */
    public function getCampoTezxt()
    {
        return $this->campoTezxt;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFlujosHijo
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
     * @return FtFlujosHijo
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
     * Set ftFlujosPadre
     *
     * @param integer $ftFlujosPadre
     *
     * @return FtFlujosHijo
     */
    public function setFtFlujosPadre($ftFlujosPadre)
    {
        $this->ftFlujosPadre = $ftFlujosPadre;

        return $this;
    }

    /**
     * Get ftFlujosPadre
     *
     * @return integer
     */
    public function getFtFlujosPadre()
    {
        return $this->ftFlujosPadre;
    }
}

