<?php

namespace Saia;

/**
 * FtSolicitudServicio
 */
class FtSolicitudServicio
{
    /**
     * @var integer
     */
    private $idftSolicitudServicio;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaHoraSolicitud;

    /**
     * @var integer
     */
    private $ciudadOrigen;

    /**
     * @var integer
     */
    private $tipoSolicitudServi;

    /**
     * @var string
     */
    private $tipoMercancia;

    /**
     * @var integer
     */
    private $tipoPrivilegios;

    /**
     * @var integer
     */
    private $tipoEnvioSolicitud;

    /**
     * @var integer
     */
    private $valorDeclarado;

    /**
     * @var string
     */
    private $pesoEnvioSolicitud;

    /**
     * @var string
     */
    private $tamanioAproximado;

    /**
     * @var integer
     */
    private $requiereRecoleccion;

    /**
     * @var string
     */
    private $direccionRecoleccion;

    /**
     * @var \DateTime
     */
    private $fechaRecoleccion;

    /**
     * @var string
     */
    private $observacionSolicitud;

    /**
     * @var string
     */
    private $anexosDigitales;

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
    private $asuntoSolicitud;

    /**
     * @var integer
     */
    private $referenciaCaja;

    /**
     * @var integer
     */
    private $cantidadMercancia;

    /**
     * @var string
     */
    private $fkIdsolicitudAfiliacion;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftSolicitudServicio
     *
     * @return integer
     */
    public function getIdftSolicitudServicio()
    {
        return $this->idftSolicitudServicio;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudServicio
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
     * Set fechaHoraSolicitud
     *
     * @param \DateTime $fechaHoraSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setFechaHoraSolicitud($fechaHoraSolicitud)
    {
        $this->fechaHoraSolicitud = $fechaHoraSolicitud;

        return $this;
    }

    /**
     * Get fechaHoraSolicitud
     *
     * @return \DateTime
     */
    public function getFechaHoraSolicitud()
    {
        return $this->fechaHoraSolicitud;
    }

    /**
     * Set ciudadOrigen
     *
     * @param integer $ciudadOrigen
     *
     * @return FtSolicitudServicio
     */
    public function setCiudadOrigen($ciudadOrigen)
    {
        $this->ciudadOrigen = $ciudadOrigen;

        return $this;
    }

    /**
     * Get ciudadOrigen
     *
     * @return integer
     */
    public function getCiudadOrigen()
    {
        return $this->ciudadOrigen;
    }

    /**
     * Set tipoSolicitudServi
     *
     * @param integer $tipoSolicitudServi
     *
     * @return FtSolicitudServicio
     */
    public function setTipoSolicitudServi($tipoSolicitudServi)
    {
        $this->tipoSolicitudServi = $tipoSolicitudServi;

        return $this;
    }

    /**
     * Get tipoSolicitudServi
     *
     * @return integer
     */
    public function getTipoSolicitudServi()
    {
        return $this->tipoSolicitudServi;
    }

    /**
     * Set tipoMercancia
     *
     * @param string $tipoMercancia
     *
     * @return FtSolicitudServicio
     */
    public function setTipoMercancia($tipoMercancia)
    {
        $this->tipoMercancia = $tipoMercancia;

        return $this;
    }

    /**
     * Get tipoMercancia
     *
     * @return string
     */
    public function getTipoMercancia()
    {
        return $this->tipoMercancia;
    }

    /**
     * Set tipoPrivilegios
     *
     * @param integer $tipoPrivilegios
     *
     * @return FtSolicitudServicio
     */
    public function setTipoPrivilegios($tipoPrivilegios)
    {
        $this->tipoPrivilegios = $tipoPrivilegios;

        return $this;
    }

    /**
     * Get tipoPrivilegios
     *
     * @return integer
     */
    public function getTipoPrivilegios()
    {
        return $this->tipoPrivilegios;
    }

    /**
     * Set tipoEnvioSolicitud
     *
     * @param integer $tipoEnvioSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setTipoEnvioSolicitud($tipoEnvioSolicitud)
    {
        $this->tipoEnvioSolicitud = $tipoEnvioSolicitud;

        return $this;
    }

    /**
     * Get tipoEnvioSolicitud
     *
     * @return integer
     */
    public function getTipoEnvioSolicitud()
    {
        return $this->tipoEnvioSolicitud;
    }

    /**
     * Set valorDeclarado
     *
     * @param integer $valorDeclarado
     *
     * @return FtSolicitudServicio
     */
    public function setValorDeclarado($valorDeclarado)
    {
        $this->valorDeclarado = $valorDeclarado;

        return $this;
    }

    /**
     * Get valorDeclarado
     *
     * @return integer
     */
    public function getValorDeclarado()
    {
        return $this->valorDeclarado;
    }

    /**
     * Set pesoEnvioSolicitud
     *
     * @param string $pesoEnvioSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setPesoEnvioSolicitud($pesoEnvioSolicitud)
    {
        $this->pesoEnvioSolicitud = $pesoEnvioSolicitud;

        return $this;
    }

    /**
     * Get pesoEnvioSolicitud
     *
     * @return string
     */
    public function getPesoEnvioSolicitud()
    {
        return $this->pesoEnvioSolicitud;
    }

    /**
     * Set tamanioAproximado
     *
     * @param string $tamanioAproximado
     *
     * @return FtSolicitudServicio
     */
    public function setTamanioAproximado($tamanioAproximado)
    {
        $this->tamanioAproximado = $tamanioAproximado;

        return $this;
    }

    /**
     * Get tamanioAproximado
     *
     * @return string
     */
    public function getTamanioAproximado()
    {
        return $this->tamanioAproximado;
    }

    /**
     * Set requiereRecoleccion
     *
     * @param integer $requiereRecoleccion
     *
     * @return FtSolicitudServicio
     */
    public function setRequiereRecoleccion($requiereRecoleccion)
    {
        $this->requiereRecoleccion = $requiereRecoleccion;

        return $this;
    }

    /**
     * Get requiereRecoleccion
     *
     * @return integer
     */
    public function getRequiereRecoleccion()
    {
        return $this->requiereRecoleccion;
    }

    /**
     * Set direccionRecoleccion
     *
     * @param string $direccionRecoleccion
     *
     * @return FtSolicitudServicio
     */
    public function setDireccionRecoleccion($direccionRecoleccion)
    {
        $this->direccionRecoleccion = $direccionRecoleccion;

        return $this;
    }

    /**
     * Get direccionRecoleccion
     *
     * @return string
     */
    public function getDireccionRecoleccion()
    {
        return $this->direccionRecoleccion;
    }

    /**
     * Set fechaRecoleccion
     *
     * @param \DateTime $fechaRecoleccion
     *
     * @return FtSolicitudServicio
     */
    public function setFechaRecoleccion($fechaRecoleccion)
    {
        $this->fechaRecoleccion = $fechaRecoleccion;

        return $this;
    }

    /**
     * Get fechaRecoleccion
     *
     * @return \DateTime
     */
    public function getFechaRecoleccion()
    {
        return $this->fechaRecoleccion;
    }

    /**
     * Set observacionSolicitud
     *
     * @param string $observacionSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setObservacionSolicitud($observacionSolicitud)
    {
        $this->observacionSolicitud = $observacionSolicitud;

        return $this;
    }

    /**
     * Get observacionSolicitud
     *
     * @return string
     */
    public function getObservacionSolicitud()
    {
        return $this->observacionSolicitud;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtSolicitudServicio
     */
    public function setAnexosDigitales($anexosDigitales)
    {
        $this->anexosDigitales = $anexosDigitales;

        return $this;
    }

    /**
     * Get anexosDigitales
     *
     * @return string
     */
    public function getAnexosDigitales()
    {
        return $this->anexosDigitales;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudServicio
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
     * @return FtSolicitudServicio
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
     * @return FtSolicitudServicio
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
     * @return FtSolicitudServicio
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
     * Set asuntoSolicitud
     *
     * @param string $asuntoSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setAsuntoSolicitud($asuntoSolicitud)
    {
        $this->asuntoSolicitud = $asuntoSolicitud;

        return $this;
    }

    /**
     * Get asuntoSolicitud
     *
     * @return string
     */
    public function getAsuntoSolicitud()
    {
        return $this->asuntoSolicitud;
    }

    /**
     * Set referenciaCaja
     *
     * @param integer $referenciaCaja
     *
     * @return FtSolicitudServicio
     */
    public function setReferenciaCaja($referenciaCaja)
    {
        $this->referenciaCaja = $referenciaCaja;

        return $this;
    }

    /**
     * Get referenciaCaja
     *
     * @return integer
     */
    public function getReferenciaCaja()
    {
        return $this->referenciaCaja;
    }

    /**
     * Set cantidadMercancia
     *
     * @param integer $cantidadMercancia
     *
     * @return FtSolicitudServicio
     */
    public function setCantidadMercancia($cantidadMercancia)
    {
        $this->cantidadMercancia = $cantidadMercancia;

        return $this;
    }

    /**
     * Get cantidadMercancia
     *
     * @return integer
     */
    public function getCantidadMercancia()
    {
        return $this->cantidadMercancia;
    }

    /**
     * Set fkIdsolicitudAfiliacion
     *
     * @param string $fkIdsolicitudAfiliacion
     *
     * @return FtSolicitudServicio
     */
    public function setFkIdsolicitudAfiliacion($fkIdsolicitudAfiliacion)
    {
        $this->fkIdsolicitudAfiliacion = $fkIdsolicitudAfiliacion;

        return $this;
    }

    /**
     * Get fkIdsolicitudAfiliacion
     *
     * @return string
     */
    public function getFkIdsolicitudAfiliacion()
    {
        return $this->fkIdsolicitudAfiliacion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolicitudServicio
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

