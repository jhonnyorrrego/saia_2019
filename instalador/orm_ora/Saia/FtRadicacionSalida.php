<?php

namespace Saia;

/**
 * FtRadicacionSalida
 */
class FtRadicacionSalida
{
    /**
     * @var integer
     */
    private $idftRadicacionSalida;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $anexosFisicos;

    /**
     * @var string
     */
    private $personaNatural;

    /**
     * @var string
     */
    private $descripcionSalida;

    /**
     * @var string
     */
    private $descripcionAnexos;

    /**
     * @var string
     */
    private $estadoRadicado;

    /**
     * @var \DateTime
     */
    private $fechaRadicacionEntrada;

    /**
     * @var integer
     */
    private $numeroRadicado;

    /**
     * @var string
     */
    private $areaResponsable;

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
    private $tipoMensajeria;

    /**
     * @var integer
     */
    private $mensajeros;

    /**
     * @var integer
     */
    private $numFolios;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftRadicacionSalida
     *
     * @return integer
     */
    public function getIdftRadicacionSalida()
    {
        return $this->idftRadicacionSalida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRadicacionSalida
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
     * Set anexosFisicos
     *
     * @param integer $anexosFisicos
     *
     * @return FtRadicacionSalida
     */
    public function setAnexosFisicos($anexosFisicos)
    {
        $this->anexosFisicos = $anexosFisicos;

        return $this;
    }

    /**
     * Get anexosFisicos
     *
     * @return integer
     */
    public function getAnexosFisicos()
    {
        return $this->anexosFisicos;
    }

    /**
     * Set personaNatural
     *
     * @param string $personaNatural
     *
     * @return FtRadicacionSalida
     */
    public function setPersonaNatural($personaNatural)
    {
        $this->personaNatural = $personaNatural;

        return $this;
    }

    /**
     * Get personaNatural
     *
     * @return string
     */
    public function getPersonaNatural()
    {
        return $this->personaNatural;
    }

    /**
     * Set descripcionSalida
     *
     * @param string $descripcionSalida
     *
     * @return FtRadicacionSalida
     */
    public function setDescripcionSalida($descripcionSalida)
    {
        $this->descripcionSalida = $descripcionSalida;

        return $this;
    }

    /**
     * Get descripcionSalida
     *
     * @return string
     */
    public function getDescripcionSalida()
    {
        return $this->descripcionSalida;
    }

    /**
     * Set descripcionAnexos
     *
     * @param string $descripcionAnexos
     *
     * @return FtRadicacionSalida
     */
    public function setDescripcionAnexos($descripcionAnexos)
    {
        $this->descripcionAnexos = $descripcionAnexos;

        return $this;
    }

    /**
     * Get descripcionAnexos
     *
     * @return string
     */
    public function getDescripcionAnexos()
    {
        return $this->descripcionAnexos;
    }

    /**
     * Set estadoRadicado
     *
     * @param string $estadoRadicado
     *
     * @return FtRadicacionSalida
     */
    public function setEstadoRadicado($estadoRadicado)
    {
        $this->estadoRadicado = $estadoRadicado;

        return $this;
    }

    /**
     * Get estadoRadicado
     *
     * @return string
     */
    public function getEstadoRadicado()
    {
        return $this->estadoRadicado;
    }

    /**
     * Set fechaRadicacionEntrada
     *
     * @param \DateTime $fechaRadicacionEntrada
     *
     * @return FtRadicacionSalida
     */
    public function setFechaRadicacionEntrada($fechaRadicacionEntrada)
    {
        $this->fechaRadicacionEntrada = $fechaRadicacionEntrada;

        return $this;
    }

    /**
     * Get fechaRadicacionEntrada
     *
     * @return \DateTime
     */
    public function getFechaRadicacionEntrada()
    {
        return $this->fechaRadicacionEntrada;
    }

    /**
     * Set numeroRadicado
     *
     * @param integer $numeroRadicado
     *
     * @return FtRadicacionSalida
     */
    public function setNumeroRadicado($numeroRadicado)
    {
        $this->numeroRadicado = $numeroRadicado;

        return $this;
    }

    /**
     * Get numeroRadicado
     *
     * @return integer
     */
    public function getNumeroRadicado()
    {
        return $this->numeroRadicado;
    }

    /**
     * Set areaResponsable
     *
     * @param string $areaResponsable
     *
     * @return FtRadicacionSalida
     */
    public function setAreaResponsable($areaResponsable)
    {
        $this->areaResponsable = $areaResponsable;

        return $this;
    }

    /**
     * Get areaResponsable
     *
     * @return string
     */
    public function getAreaResponsable()
    {
        return $this->areaResponsable;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRadicacionSalida
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
     * @return FtRadicacionSalida
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
     * @return FtRadicacionSalida
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
     * @return FtRadicacionSalida
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
     * Set tipoMensajeria
     *
     * @param integer $tipoMensajeria
     *
     * @return FtRadicacionSalida
     */
    public function setTipoMensajeria($tipoMensajeria)
    {
        $this->tipoMensajeria = $tipoMensajeria;

        return $this;
    }

    /**
     * Get tipoMensajeria
     *
     * @return integer
     */
    public function getTipoMensajeria()
    {
        return $this->tipoMensajeria;
    }

    /**
     * Set mensajeros
     *
     * @param integer $mensajeros
     *
     * @return FtRadicacionSalida
     */
    public function setMensajeros($mensajeros)
    {
        $this->mensajeros = $mensajeros;

        return $this;
    }

    /**
     * Get mensajeros
     *
     * @return integer
     */
    public function getMensajeros()
    {
        return $this->mensajeros;
    }

    /**
     * Set numFolios
     *
     * @param integer $numFolios
     *
     * @return FtRadicacionSalida
     */
    public function setNumFolios($numFolios)
    {
        $this->numFolios = $numFolios;

        return $this;
    }

    /**
     * Get numFolios
     *
     * @return integer
     */
    public function getNumFolios()
    {
        return $this->numFolios;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRadicacionSalida
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

