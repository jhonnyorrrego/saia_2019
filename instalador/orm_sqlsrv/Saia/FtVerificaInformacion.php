<?php

namespace Saia;

/**
 * FtVerificaInformacion
 */
class FtVerificaInformacion
{
    /**
     * @var integer
     */
    private $idftVerificaInformacion;

    /**
     * @var integer
     */
    private $ftRadicaDocMercantil;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $datosRemitente;

    /**
     * @var integer
     */
    private $numeroFoliosVerifi;

    /**
     * @var string
     */
    private $fechaInicialVerifi;

    /**
     * @var string
     */
    private $observacionVerifica;

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
     * @var string
     */
    private $identificaAfiliado;

    /**
     * @var integer
     */
    private $numeroFoliosRecibi;

    /**
     * @var integer
     */
    private $presentaInconsisten;

    /**
     * @var string
     */
    private $nombreAfiliado;

    /**
     * @var string
     */
    private $fkIdexpediente;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftVerificaInformacion
     *
     * @return integer
     */
    public function getIdftVerificaInformacion()
    {
        return $this->idftVerificaInformacion;
    }

    /**
     * Set ftRadicaDocMercantil
     *
     * @param integer $ftRadicaDocMercantil
     *
     * @return FtVerificaInformacion
     */
    public function setFtRadicaDocMercantil($ftRadicaDocMercantil)
    {
        $this->ftRadicaDocMercantil = $ftRadicaDocMercantil;

        return $this;
    }

    /**
     * Get ftRadicaDocMercantil
     *
     * @return integer
     */
    public function getFtRadicaDocMercantil()
    {
        return $this->ftRadicaDocMercantil;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtVerificaInformacion
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
     * Set datosRemitente
     *
     * @param string $datosRemitente
     *
     * @return FtVerificaInformacion
     */
    public function setDatosRemitente($datosRemitente)
    {
        $this->datosRemitente = $datosRemitente;

        return $this;
    }

    /**
     * Get datosRemitente
     *
     * @return string
     */
    public function getDatosRemitente()
    {
        return $this->datosRemitente;
    }

    /**
     * Set numeroFoliosVerifi
     *
     * @param integer $numeroFoliosVerifi
     *
     * @return FtVerificaInformacion
     */
    public function setNumeroFoliosVerifi($numeroFoliosVerifi)
    {
        $this->numeroFoliosVerifi = $numeroFoliosVerifi;

        return $this;
    }

    /**
     * Get numeroFoliosVerifi
     *
     * @return integer
     */
    public function getNumeroFoliosVerifi()
    {
        return $this->numeroFoliosVerifi;
    }

    /**
     * Set fechaInicialVerifi
     *
     * @param string $fechaInicialVerifi
     *
     * @return FtVerificaInformacion
     */
    public function setFechaInicialVerifi($fechaInicialVerifi)
    {
        $this->fechaInicialVerifi = $fechaInicialVerifi;

        return $this;
    }

    /**
     * Get fechaInicialVerifi
     *
     * @return string
     */
    public function getFechaInicialVerifi()
    {
        return $this->fechaInicialVerifi;
    }

    /**
     * Set observacionVerifica
     *
     * @param string $observacionVerifica
     *
     * @return FtVerificaInformacion
     */
    public function setObservacionVerifica($observacionVerifica)
    {
        $this->observacionVerifica = $observacionVerifica;

        return $this;
    }

    /**
     * Get observacionVerifica
     *
     * @return string
     */
    public function getObservacionVerifica()
    {
        return $this->observacionVerifica;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtVerificaInformacion
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
     * @return FtVerificaInformacion
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
     * @return FtVerificaInformacion
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
     * @return FtVerificaInformacion
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
     * Set identificaAfiliado
     *
     * @param string $identificaAfiliado
     *
     * @return FtVerificaInformacion
     */
    public function setIdentificaAfiliado($identificaAfiliado)
    {
        $this->identificaAfiliado = $identificaAfiliado;

        return $this;
    }

    /**
     * Get identificaAfiliado
     *
     * @return string
     */
    public function getIdentificaAfiliado()
    {
        return $this->identificaAfiliado;
    }

    /**
     * Set numeroFoliosRecibi
     *
     * @param integer $numeroFoliosRecibi
     *
     * @return FtVerificaInformacion
     */
    public function setNumeroFoliosRecibi($numeroFoliosRecibi)
    {
        $this->numeroFoliosRecibi = $numeroFoliosRecibi;

        return $this;
    }

    /**
     * Get numeroFoliosRecibi
     *
     * @return integer
     */
    public function getNumeroFoliosRecibi()
    {
        return $this->numeroFoliosRecibi;
    }

    /**
     * Set presentaInconsisten
     *
     * @param integer $presentaInconsisten
     *
     * @return FtVerificaInformacion
     */
    public function setPresentaInconsisten($presentaInconsisten)
    {
        $this->presentaInconsisten = $presentaInconsisten;

        return $this;
    }

    /**
     * Get presentaInconsisten
     *
     * @return integer
     */
    public function getPresentaInconsisten()
    {
        return $this->presentaInconsisten;
    }

    /**
     * Set nombreAfiliado
     *
     * @param string $nombreAfiliado
     *
     * @return FtVerificaInformacion
     */
    public function setNombreAfiliado($nombreAfiliado)
    {
        $this->nombreAfiliado = $nombreAfiliado;

        return $this;
    }

    /**
     * Get nombreAfiliado
     *
     * @return string
     */
    public function getNombreAfiliado()
    {
        return $this->nombreAfiliado;
    }

    /**
     * Set fkIdexpediente
     *
     * @param string $fkIdexpediente
     *
     * @return FtVerificaInformacion
     */
    public function setFkIdexpediente($fkIdexpediente)
    {
        $this->fkIdexpediente = $fkIdexpediente;

        return $this;
    }

    /**
     * Get fkIdexpediente
     *
     * @return string
     */
    public function getFkIdexpediente()
    {
        return $this->fkIdexpediente;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtVerificaInformacion
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

