<?php

namespace Saia;

/**
 * FtRadicaDocMercantil
 */
class FtRadicaDocMercantil
{
    /**
     * @var integer
     */
    private $idftRadicaDocMercantil;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaRadicacionDoc;

    /**
     * @var integer
     */
    private $numeroSolicitud;

    /**
     * @var string
     */
    private $anexosDigitalesDoc;

    /**
     * @var integer
     */
    private $anexosFisicosRadi;

    /**
     * @var string
     */
    private $destinoDocMercantil;

    /**
     * @var string
     */
    private $copiaAMercantil;

    /**
     * @var string
     */
    private $numeroSoliciSelec;

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
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftRadicaDocMercantil
     *
     * @return integer
     */
    public function getIdftRadicaDocMercantil()
    {
        return $this->idftRadicaDocMercantil;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRadicaDocMercantil
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
     * Set fechaRadicacionDoc
     *
     * @param \DateTime $fechaRadicacionDoc
     *
     * @return FtRadicaDocMercantil
     */
    public function setFechaRadicacionDoc($fechaRadicacionDoc)
    {
        $this->fechaRadicacionDoc = $fechaRadicacionDoc;

        return $this;
    }

    /**
     * Get fechaRadicacionDoc
     *
     * @return \DateTime
     */
    public function getFechaRadicacionDoc()
    {
        return $this->fechaRadicacionDoc;
    }

    /**
     * Set numeroSolicitud
     *
     * @param integer $numeroSolicitud
     *
     * @return FtRadicaDocMercantil
     */
    public function setNumeroSolicitud($numeroSolicitud)
    {
        $this->numeroSolicitud = $numeroSolicitud;

        return $this;
    }

    /**
     * Get numeroSolicitud
     *
     * @return integer
     */
    public function getNumeroSolicitud()
    {
        return $this->numeroSolicitud;
    }

    /**
     * Set anexosDigitalesDoc
     *
     * @param string $anexosDigitalesDoc
     *
     * @return FtRadicaDocMercantil
     */
    public function setAnexosDigitalesDoc($anexosDigitalesDoc)
    {
        $this->anexosDigitalesDoc = $anexosDigitalesDoc;

        return $this;
    }

    /**
     * Get anexosDigitalesDoc
     *
     * @return string
     */
    public function getAnexosDigitalesDoc()
    {
        return $this->anexosDigitalesDoc;
    }

    /**
     * Set anexosFisicosRadi
     *
     * @param integer $anexosFisicosRadi
     *
     * @return FtRadicaDocMercantil
     */
    public function setAnexosFisicosRadi($anexosFisicosRadi)
    {
        $this->anexosFisicosRadi = $anexosFisicosRadi;

        return $this;
    }

    /**
     * Get anexosFisicosRadi
     *
     * @return integer
     */
    public function getAnexosFisicosRadi()
    {
        return $this->anexosFisicosRadi;
    }

    /**
     * Set destinoDocMercantil
     *
     * @param string $destinoDocMercantil
     *
     * @return FtRadicaDocMercantil
     */
    public function setDestinoDocMercantil($destinoDocMercantil)
    {
        $this->destinoDocMercantil = $destinoDocMercantil;

        return $this;
    }

    /**
     * Get destinoDocMercantil
     *
     * @return string
     */
    public function getDestinoDocMercantil()
    {
        return $this->destinoDocMercantil;
    }

    /**
     * Set copiaAMercantil
     *
     * @param string $copiaAMercantil
     *
     * @return FtRadicaDocMercantil
     */
    public function setCopiaAMercantil($copiaAMercantil)
    {
        $this->copiaAMercantil = $copiaAMercantil;

        return $this;
    }

    /**
     * Get copiaAMercantil
     *
     * @return string
     */
    public function getCopiaAMercantil()
    {
        return $this->copiaAMercantil;
    }

    /**
     * Set numeroSoliciSelec
     *
     * @param string $numeroSoliciSelec
     *
     * @return FtRadicaDocMercantil
     */
    public function setNumeroSoliciSelec($numeroSoliciSelec)
    {
        $this->numeroSoliciSelec = $numeroSoliciSelec;

        return $this;
    }

    /**
     * Get numeroSoliciSelec
     *
     * @return string
     */
    public function getNumeroSoliciSelec()
    {
        return $this->numeroSoliciSelec;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRadicaDocMercantil
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
     * @return FtRadicaDocMercantil
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
     * @return FtRadicaDocMercantil
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
     * @return FtRadicaDocMercantil
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRadicaDocMercantil
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}

