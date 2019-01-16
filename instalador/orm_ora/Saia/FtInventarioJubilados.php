<?php

namespace Saia;

/**
 * FtInventarioJubilados
 */
class FtInventarioJubilados
{
    /**
     * @var integer
     */
    private $idftInventarioJubilados;

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
     * @var \DateTime
     */
    private $fechaReconocimiento;

    /**
     * @var string
     */
    private $cedulaSustitucion;

    /**
     * @var string
     */
    private $sustitucionPensiona;

    /**
     * @var string
     */
    private $demandado;

    /**
     * @var string
     */
    private $estamento;

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
     * @var integer
     */
    private $segundoApellido;

    /**
     * @var string
     */
    private $primerApellido;

    /**
     * @var string
     */
    private $emanadaDe;

    /**
     * @var string
     */
    private $numeroResolucion;

    /**
     * @var \DateTime
     */
    private $fechaJubilacion;

    /**
     * @var string
     */
    private $numeroCaja;

    /**
     * @var string
     */
    private $ubicacion;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $estadoDocumento;


    /**
     * Get idftInventarioJubilados
     *
     * @return integer
     */
    public function getIdftInventarioJubilados()
    {
        return $this->idftInventarioJubilados;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * Set fechaReconocimiento
     *
     * @param \DateTime $fechaReconocimiento
     *
     * @return FtInventarioJubilados
     */
    public function setFechaReconocimiento($fechaReconocimiento)
    {
        $this->fechaReconocimiento = $fechaReconocimiento;

        return $this;
    }

    /**
     * Get fechaReconocimiento
     *
     * @return \DateTime
     */
    public function getFechaReconocimiento()
    {
        return $this->fechaReconocimiento;
    }

    /**
     * Set cedulaSustitucion
     *
     * @param string $cedulaSustitucion
     *
     * @return FtInventarioJubilados
     */
    public function setCedulaSustitucion($cedulaSustitucion)
    {
        $this->cedulaSustitucion = $cedulaSustitucion;

        return $this;
    }

    /**
     * Get cedulaSustitucion
     *
     * @return string
     */
    public function getCedulaSustitucion()
    {
        return $this->cedulaSustitucion;
    }

    /**
     * Set sustitucionPensiona
     *
     * @param string $sustitucionPensiona
     *
     * @return FtInventarioJubilados
     */
    public function setSustitucionPensiona($sustitucionPensiona)
    {
        $this->sustitucionPensiona = $sustitucionPensiona;

        return $this;
    }

    /**
     * Get sustitucionPensiona
     *
     * @return string
     */
    public function getSustitucionPensiona()
    {
        return $this->sustitucionPensiona;
    }

    /**
     * Set demandado
     *
     * @param string $demandado
     *
     * @return FtInventarioJubilados
     */
    public function setDemandado($demandado)
    {
        $this->demandado = $demandado;

        return $this;
    }

    /**
     * Get demandado
     *
     * @return string
     */
    public function getDemandado()
    {
        return $this->demandado;
    }

    /**
     * Set estamento
     *
     * @param string $estamento
     *
     * @return FtInventarioJubilados
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
     * Set ultimoCargo
     *
     * @param string $ultimoCargo
     *
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
     * @param integer $segundoApellido
     *
     * @return FtInventarioJubilados
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return integer
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
     * @return FtInventarioJubilados
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
     * Set emanadaDe
     *
     * @param string $emanadaDe
     *
     * @return FtInventarioJubilados
     */
    public function setEmanadaDe($emanadaDe)
    {
        $this->emanadaDe = $emanadaDe;

        return $this;
    }

    /**
     * Get emanadaDe
     *
     * @return string
     */
    public function getEmanadaDe()
    {
        return $this->emanadaDe;
    }

    /**
     * Set numeroResolucion
     *
     * @param string $numeroResolucion
     *
     * @return FtInventarioJubilados
     */
    public function setNumeroResolucion($numeroResolucion)
    {
        $this->numeroResolucion = $numeroResolucion;

        return $this;
    }

    /**
     * Get numeroResolucion
     *
     * @return string
     */
    public function getNumeroResolucion()
    {
        return $this->numeroResolucion;
    }

    /**
     * Set fechaJubilacion
     *
     * @param \DateTime $fechaJubilacion
     *
     * @return FtInventarioJubilados
     */
    public function setFechaJubilacion($fechaJubilacion)
    {
        $this->fechaJubilacion = $fechaJubilacion;

        return $this;
    }

    /**
     * Get fechaJubilacion
     *
     * @return \DateTime
     */
    public function getFechaJubilacion()
    {
        return $this->fechaJubilacion;
    }

    /**
     * Set numeroCaja
     *
     * @param string $numeroCaja
     *
     * @return FtInventarioJubilados
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
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return FtInventarioJubilados
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInventarioJubilados
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
     * @return FtInventarioJubilados
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
}

