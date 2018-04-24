<?php

namespace Saia;

/**
 * FtPruebaMauro1
 */
class FtPruebaMauro1
{
    /**
     * @var integer
     */
    private $idftPruebaMauro1;

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
    private $tipo;

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
    private $estadoDocSaia;


    /**
     * Get idftPruebaMauro1
     *
     * @return integer
     */
    public function getIdftPruebaMauro1()
    {
        return $this->idftPruebaMauro1;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtPruebaMauro1
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
     * @return FtPruebaMauro1
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
     * @return FtPruebaMauro1
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
     * @return FtPruebaMauro1
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
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return FtPruebaMauro1
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaMauro1
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
     * @return FtPruebaMauro1
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
     * Set estadoDocSaia
     *
     * @param integer $estadoDocSaia
     *
     * @return FtPruebaMauro1
     */
    public function setEstadoDocSaia($estadoDocSaia)
    {
        $this->estadoDocSaia = $estadoDocSaia;

        return $this;
    }

    /**
     * Get estadoDocSaia
     *
     * @return integer
     */
    public function getEstadoDocSaia()
    {
        return $this->estadoDocSaia;
    }
}

