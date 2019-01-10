<?php

namespace Saia;

/**
 * FtConfirNegociVehiculo
 */
class FtConfirNegociVehiculo
{
    /**
     * @var integer
     */
    private $idftConfirNegociVehiculo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $placaAsignadaVehiculo;

    /**
     * @var string
     */
    private $numeroMatricula;

    /**
     * @var integer
     */
    private $valorMatricula;

    /**
     * @var string
     */
    private $campoSeguros;

    /**
     * @var integer
     */
    private $valorSeguros;

    /**
     * @var string
     */
    private $datosCliente;

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
    private $observacionesNegocia;

    /**
     * @var string
     */
    private $datosVehiculo;

    /**
     * @var string
     */
    private $verInfoVehiculo;

    /**
     * @var \DateTime
     */
    private $fechaConfirmacion;

    /**
     * @var string
     */
    private $accesoriosVehiculo;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftConfirNegociVehiculo
     *
     * @return integer
     */
    public function getIdftConfirNegociVehiculo()
    {
        return $this->idftConfirNegociVehiculo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtConfirNegociVehiculo
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
     * Set placaAsignadaVehiculo
     *
     * @param string $placaAsignadaVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setPlacaAsignadaVehiculo($placaAsignadaVehiculo)
    {
        $this->placaAsignadaVehiculo = $placaAsignadaVehiculo;

        return $this;
    }

    /**
     * Get placaAsignadaVehiculo
     *
     * @return string
     */
    public function getPlacaAsignadaVehiculo()
    {
        return $this->placaAsignadaVehiculo;
    }

    /**
     * Set numeroMatricula
     *
     * @param string $numeroMatricula
     *
     * @return FtConfirNegociVehiculo
     */
    public function setNumeroMatricula($numeroMatricula)
    {
        $this->numeroMatricula = $numeroMatricula;

        return $this;
    }

    /**
     * Get numeroMatricula
     *
     * @return string
     */
    public function getNumeroMatricula()
    {
        return $this->numeroMatricula;
    }

    /**
     * Set valorMatricula
     *
     * @param integer $valorMatricula
     *
     * @return FtConfirNegociVehiculo
     */
    public function setValorMatricula($valorMatricula)
    {
        $this->valorMatricula = $valorMatricula;

        return $this;
    }

    /**
     * Get valorMatricula
     *
     * @return integer
     */
    public function getValorMatricula()
    {
        return $this->valorMatricula;
    }

    /**
     * Set campoSeguros
     *
     * @param string $campoSeguros
     *
     * @return FtConfirNegociVehiculo
     */
    public function setCampoSeguros($campoSeguros)
    {
        $this->campoSeguros = $campoSeguros;

        return $this;
    }

    /**
     * Get campoSeguros
     *
     * @return string
     */
    public function getCampoSeguros()
    {
        return $this->campoSeguros;
    }

    /**
     * Set valorSeguros
     *
     * @param integer $valorSeguros
     *
     * @return FtConfirNegociVehiculo
     */
    public function setValorSeguros($valorSeguros)
    {
        $this->valorSeguros = $valorSeguros;

        return $this;
    }

    /**
     * Get valorSeguros
     *
     * @return integer
     */
    public function getValorSeguros()
    {
        return $this->valorSeguros;
    }

    /**
     * Set datosCliente
     *
     * @param string $datosCliente
     *
     * @return FtConfirNegociVehiculo
     */
    public function setDatosCliente($datosCliente)
    {
        $this->datosCliente = $datosCliente;

        return $this;
    }

    /**
     * Get datosCliente
     *
     * @return string
     */
    public function getDatosCliente()
    {
        return $this->datosCliente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtConfirNegociVehiculo
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
     * @return FtConfirNegociVehiculo
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
     * @return FtConfirNegociVehiculo
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
     * @return FtConfirNegociVehiculo
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
     * Set observacionesNegocia
     *
     * @param string $observacionesNegocia
     *
     * @return FtConfirNegociVehiculo
     */
    public function setObservacionesNegocia($observacionesNegocia)
    {
        $this->observacionesNegocia = $observacionesNegocia;

        return $this;
    }

    /**
     * Get observacionesNegocia
     *
     * @return string
     */
    public function getObservacionesNegocia()
    {
        return $this->observacionesNegocia;
    }

    /**
     * Set datosVehiculo
     *
     * @param string $datosVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setDatosVehiculo($datosVehiculo)
    {
        $this->datosVehiculo = $datosVehiculo;

        return $this;
    }

    /**
     * Get datosVehiculo
     *
     * @return string
     */
    public function getDatosVehiculo()
    {
        return $this->datosVehiculo;
    }

    /**
     * Set verInfoVehiculo
     *
     * @param string $verInfoVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setVerInfoVehiculo($verInfoVehiculo)
    {
        $this->verInfoVehiculo = $verInfoVehiculo;

        return $this;
    }

    /**
     * Get verInfoVehiculo
     *
     * @return string
     */
    public function getVerInfoVehiculo()
    {
        return $this->verInfoVehiculo;
    }

    /**
     * Set fechaConfirmacion
     *
     * @param \DateTime $fechaConfirmacion
     *
     * @return FtConfirNegociVehiculo
     */
    public function setFechaConfirmacion($fechaConfirmacion)
    {
        $this->fechaConfirmacion = $fechaConfirmacion;

        return $this;
    }

    /**
     * Get fechaConfirmacion
     *
     * @return \DateTime
     */
    public function getFechaConfirmacion()
    {
        return $this->fechaConfirmacion;
    }

    /**
     * Set accesoriosVehiculo
     *
     * @param string $accesoriosVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setAccesoriosVehiculo($accesoriosVehiculo)
    {
        $this->accesoriosVehiculo = $accesoriosVehiculo;

        return $this;
    }

    /**
     * Get accesoriosVehiculo
     *
     * @return string
     */
    public function getAccesoriosVehiculo()
    {
        return $this->accesoriosVehiculo;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtConfirNegociVehiculo
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

