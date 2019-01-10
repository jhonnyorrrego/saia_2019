<?php

namespace Saia;

/**
 * FtOrdenTrabajoVehiculo
 */
class FtOrdenTrabajoVehiculo
{
    /**
     * @var integer
     */
    private $idftOrdenTrabajoVehiculo;

    /**
     * @var integer
     */
    private $ftConfirNegociVehiculo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaOrdenTrabajo;

    /**
     * @var \DateTime
     */
    private $fechaCompromiso;

    /**
     * @var integer
     */
    private $prioridadServicio;

    /**
     * @var string
     */
    private $nombreSolicitante;

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
    private $nombreAsegurador;

    /**
     * @var string
     */
    private $motivoServicio;

    /**
     * @var integer
     */
    private $tipoServicio;

    /**
     * @var \DateTime
     */
    private $fechaSolicitudOrden;

    /**
     * @var string
     */
    private $llamadasRequeridas;

    /**
     * @var integer
     */
    private $kilometrosVehiculo;

    /**
     * @var string
     */
    private $campoServicio;

    /**
     * @var string
     */
    private $cttoNumero;

    /**
     * @var string
     */
    private $funcionarioRecibo;

    /**
     * @var string
     */
    private $firmaExternaCliente;

    /**
     * @var string
     */
    private $firmaExternaSatisfaccion;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftOrdenTrabajoVehiculo
     *
     * @return integer
     */
    public function getIdftOrdenTrabajoVehiculo()
    {
        return $this->idftOrdenTrabajoVehiculo;
    }

    /**
     * Set ftConfirNegociVehiculo
     *
     * @param integer $ftConfirNegociVehiculo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFtConfirNegociVehiculo($ftConfirNegociVehiculo)
    {
        $this->ftConfirNegociVehiculo = $ftConfirNegociVehiculo;

        return $this;
    }

    /**
     * Get ftConfirNegociVehiculo
     *
     * @return integer
     */
    public function getFtConfirNegociVehiculo()
    {
        return $this->ftConfirNegociVehiculo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenTrabajoVehiculo
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
     * Set fechaOrdenTrabajo
     *
     * @param \DateTime $fechaOrdenTrabajo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFechaOrdenTrabajo($fechaOrdenTrabajo)
    {
        $this->fechaOrdenTrabajo = $fechaOrdenTrabajo;

        return $this;
    }

    /**
     * Get fechaOrdenTrabajo
     *
     * @return \DateTime
     */
    public function getFechaOrdenTrabajo()
    {
        return $this->fechaOrdenTrabajo;
    }

    /**
     * Set fechaCompromiso
     *
     * @param \DateTime $fechaCompromiso
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFechaCompromiso($fechaCompromiso)
    {
        $this->fechaCompromiso = $fechaCompromiso;

        return $this;
    }

    /**
     * Get fechaCompromiso
     *
     * @return \DateTime
     */
    public function getFechaCompromiso()
    {
        return $this->fechaCompromiso;
    }

    /**
     * Set prioridadServicio
     *
     * @param integer $prioridadServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setPrioridadServicio($prioridadServicio)
    {
        $this->prioridadServicio = $prioridadServicio;

        return $this;
    }

    /**
     * Get prioridadServicio
     *
     * @return integer
     */
    public function getPrioridadServicio()
    {
        return $this->prioridadServicio;
    }

    /**
     * Set nombreSolicitante
     *
     * @param string $nombreSolicitante
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setNombreSolicitante($nombreSolicitante)
    {
        $this->nombreSolicitante = $nombreSolicitante;

        return $this;
    }

    /**
     * Get nombreSolicitante
     *
     * @return string
     */
    public function getNombreSolicitante()
    {
        return $this->nombreSolicitante;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenTrabajoVehiculo
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
     * @return FtOrdenTrabajoVehiculo
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
     * @return FtOrdenTrabajoVehiculo
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
     * @return FtOrdenTrabajoVehiculo
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
     * Set nombreAsegurador
     *
     * @param string $nombreAsegurador
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setNombreAsegurador($nombreAsegurador)
    {
        $this->nombreAsegurador = $nombreAsegurador;

        return $this;
    }

    /**
     * Get nombreAsegurador
     *
     * @return string
     */
    public function getNombreAsegurador()
    {
        return $this->nombreAsegurador;
    }

    /**
     * Set motivoServicio
     *
     * @param string $motivoServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setMotivoServicio($motivoServicio)
    {
        $this->motivoServicio = $motivoServicio;

        return $this;
    }

    /**
     * Get motivoServicio
     *
     * @return string
     */
    public function getMotivoServicio()
    {
        return $this->motivoServicio;
    }

    /**
     * Set tipoServicio
     *
     * @param integer $tipoServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setTipoServicio($tipoServicio)
    {
        $this->tipoServicio = $tipoServicio;

        return $this;
    }

    /**
     * Get tipoServicio
     *
     * @return integer
     */
    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    /**
     * Set fechaSolicitudOrden
     *
     * @param \DateTime $fechaSolicitudOrden
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFechaSolicitudOrden($fechaSolicitudOrden)
    {
        $this->fechaSolicitudOrden = $fechaSolicitudOrden;

        return $this;
    }

    /**
     * Get fechaSolicitudOrden
     *
     * @return \DateTime
     */
    public function getFechaSolicitudOrden()
    {
        return $this->fechaSolicitudOrden;
    }

    /**
     * Set llamadasRequeridas
     *
     * @param string $llamadasRequeridas
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setLlamadasRequeridas($llamadasRequeridas)
    {
        $this->llamadasRequeridas = $llamadasRequeridas;

        return $this;
    }

    /**
     * Get llamadasRequeridas
     *
     * @return string
     */
    public function getLlamadasRequeridas()
    {
        return $this->llamadasRequeridas;
    }

    /**
     * Set kilometrosVehiculo
     *
     * @param integer $kilometrosVehiculo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setKilometrosVehiculo($kilometrosVehiculo)
    {
        $this->kilometrosVehiculo = $kilometrosVehiculo;

        return $this;
    }

    /**
     * Get kilometrosVehiculo
     *
     * @return integer
     */
    public function getKilometrosVehiculo()
    {
        return $this->kilometrosVehiculo;
    }

    /**
     * Set campoServicio
     *
     * @param string $campoServicio
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setCampoServicio($campoServicio)
    {
        $this->campoServicio = $campoServicio;

        return $this;
    }

    /**
     * Get campoServicio
     *
     * @return string
     */
    public function getCampoServicio()
    {
        return $this->campoServicio;
    }

    /**
     * Set cttoNumero
     *
     * @param string $cttoNumero
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setCttoNumero($cttoNumero)
    {
        $this->cttoNumero = $cttoNumero;

        return $this;
    }

    /**
     * Get cttoNumero
     *
     * @return string
     */
    public function getCttoNumero()
    {
        return $this->cttoNumero;
    }

    /**
     * Set funcionarioRecibo
     *
     * @param string $funcionarioRecibo
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFuncionarioRecibo($funcionarioRecibo)
    {
        $this->funcionarioRecibo = $funcionarioRecibo;

        return $this;
    }

    /**
     * Get funcionarioRecibo
     *
     * @return string
     */
    public function getFuncionarioRecibo()
    {
        return $this->funcionarioRecibo;
    }

    /**
     * Set firmaExternaCliente
     *
     * @param string $firmaExternaCliente
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFirmaExternaCliente($firmaExternaCliente)
    {
        $this->firmaExternaCliente = $firmaExternaCliente;

        return $this;
    }

    /**
     * Get firmaExternaCliente
     *
     * @return string
     */
    public function getFirmaExternaCliente()
    {
        return $this->firmaExternaCliente;
    }

    /**
     * Set firmaExternaSatisfaccion
     *
     * @param string $firmaExternaSatisfaccion
     *
     * @return FtOrdenTrabajoVehiculo
     */
    public function setFirmaExternaSatisfaccion($firmaExternaSatisfaccion)
    {
        $this->firmaExternaSatisfaccion = $firmaExternaSatisfaccion;

        return $this;
    }

    /**
     * Get firmaExternaSatisfaccion
     *
     * @return string
     */
    public function getFirmaExternaSatisfaccion()
    {
        return $this->firmaExternaSatisfaccion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtOrdenTrabajoVehiculo
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

