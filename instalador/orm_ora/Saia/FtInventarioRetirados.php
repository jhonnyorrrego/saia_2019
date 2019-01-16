<?php

namespace Saia;

/**
 * FtInventarioRetirados
 */
class FtInventarioRetirados
{
    /**
     * @var integer
     */
    private $idftInventarioRetirados;

    /**
     * @var string
     */
    private $estadoDocumento;

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
    private $observaciones;

    /**
     * @var string
     */
    private $estamento;

    /**
     * @var string
     */
    private $jubiladoOtraInstit;

    /**
     * @var string
     */
    private $ultimoCargo;

    /**
     * @var integer
     */
    private $folios;

    /**
     * @var \DateTime
     */
    private $fechaExtremaFinal;

    /**
     * @var \DateTime
     */
    private $fechaExtremaInicia;

    /**
     * @var string
     */
    private $numIdentificacion;

    /**
     * @var string
     */
    private $nombreCompleto;

    /**
     * @var string
     */
    private $segundoApellido;

    /**
     * @var string
     */
    private $primerApellido;

    /**
     * @var \DateTime
     */
    private $fechaRetiro;

    /**
     * @var string
     */
    private $ubicacion;

    /**
     * @var string
     */
    private $numeroCaja;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftInventarioRetirados
     *
     * @return integer
     */
    public function getIdftInventarioRetirados()
    {
        return $this->idftInventarioRetirados;
    }

    /**
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtInventarioRetirados
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtInventarioRetirados
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set estamento
     *
     * @param string $estamento
     *
     * @return FtInventarioRetirados
     */
    public function setEstamento($estamento)
    {
        $this->estamento = $estamento;

        return $this;
    }

    /**
     * Get estamento
     *
     * @return string
     */
    public function getEstamento()
    {
        return $this->estamento;
    }

    /**
     * Set jubiladoOtraInstit
     *
     * @param string $jubiladoOtraInstit
     *
     * @return FtInventarioRetirados
     */
    public function setJubiladoOtraInstit($jubiladoOtraInstit)
    {
        $this->jubiladoOtraInstit = $jubiladoOtraInstit;

        return $this;
    }

    /**
     * Get jubiladoOtraInstit
     *
     * @return string
     */
    public function getJubiladoOtraInstit()
    {
        return $this->jubiladoOtraInstit;
    }

    /**
     * Set ultimoCargo
     *
     * @param string $ultimoCargo
     *
     * @return FtInventarioRetirados
     */
    public function setUltimoCargo($ultimoCargo)
    {
        $this->ultimoCargo = $ultimoCargo;

        return $this;
    }

    /**
     * Get ultimoCargo
     *
     * @return string
     */
    public function getUltimoCargo()
    {
        return $this->ultimoCargo;
    }

    /**
     * Set folios
     *
     * @param integer $folios
     *
     * @return FtInventarioRetirados
     */
    public function setFolios($folios)
    {
        $this->folios = $folios;

        return $this;
    }

    /**
     * Get folios
     *
     * @return integer
     */
    public function getFolios()
    {
        return $this->folios;
    }

    /**
     * Set fechaExtremaFinal
     *
     * @param \DateTime $fechaExtremaFinal
     *
     * @return FtInventarioRetirados
     */
    public function setFechaExtremaFinal($fechaExtremaFinal)
    {
        $this->fechaExtremaFinal = $fechaExtremaFinal;

        return $this;
    }

    /**
     * Get fechaExtremaFinal
     *
     * @return \DateTime
     */
    public function getFechaExtremaFinal()
    {
        return $this->fechaExtremaFinal;
    }

    /**
     * Set fechaExtremaInicia
     *
     * @param \DateTime $fechaExtremaInicia
     *
     * @return FtInventarioRetirados
     */
    public function setFechaExtremaInicia($fechaExtremaInicia)
    {
        $this->fechaExtremaInicia = $fechaExtremaInicia;

        return $this;
    }

    /**
     * Get fechaExtremaInicia
     *
     * @return \DateTime
     */
    public function getFechaExtremaInicia()
    {
        return $this->fechaExtremaInicia;
    }

    /**
     * Set numIdentificacion
     *
     * @param string $numIdentificacion
     *
     * @return FtInventarioRetirados
     */
    public function setNumIdentificacion($numIdentificacion)
    {
        $this->numIdentificacion = $numIdentificacion;

        return $this;
    }

    /**
     * Get numIdentificacion
     *
     * @return string
     */
    public function getNumIdentificacion()
    {
        return $this->numIdentificacion;
    }

    /**
     * Set nombreCompleto
     *
     * @param string $nombreCompleto
     *
     * @return FtInventarioRetirados
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }

    /**
     * Get nombreCompleto
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return FtInventarioRetirados
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return FtInventarioRetirados
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set fechaRetiro
     *
     * @param \DateTime $fechaRetiro
     *
     * @return FtInventarioRetirados
     */
    public function setFechaRetiro($fechaRetiro)
    {
        $this->fechaRetiro = $fechaRetiro;

        return $this;
    }

    /**
     * Get fechaRetiro
     *
     * @return \DateTime
     */
    public function getFechaRetiro()
    {
        return $this->fechaRetiro;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return FtInventarioRetirados
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set numeroCaja
     *
     * @param string $numeroCaja
     *
     * @return FtInventarioRetirados
     */
    public function setNumeroCaja($numeroCaja)
    {
        $this->numeroCaja = $numeroCaja;

        return $this;
    }

    /**
     * Get numeroCaja
     *
     * @return string
     */
    public function getNumeroCaja()
    {
        return $this->numeroCaja;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInventarioRetirados
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
}

