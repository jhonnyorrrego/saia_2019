<?php

namespace Saia;

/**
 * FtSeguimientoCliente
 */
class FtSeguimientoCliente
{
    /**
     * @var integer
     */
    private $idftSeguimientoCliente;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $ftRegistroCliente;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $empresaAsociada;

    /**
     * @var string
     */
    private $envioPropuesta;

    /**
     * @var string
     */
    private $estadoCliente;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \DateTime
     */
    private $fechaSeguimiento;

    /**
     * @var integer
     */
    private $formaContacto;

    /**
     * @var string
     */
    private $nombreProductoServicio;

    /**
     * @var string
     */
    private $nombrePropuesta;

    /**
     * @var string
     */
    private $resultadoSeguimiento;

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
    private $estadoPropuesta;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftSeguimientoCliente
     *
     * @return integer
     */
    public function getIdftSeguimientoCliente()
    {
        return $this->idftSeguimientoCliente;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSeguimientoCliente
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set ftRegistroCliente
     *
     * @param integer $ftRegistroCliente
     *
     * @return FtSeguimientoCliente
     */
    public function setFtRegistroCliente($ftRegistroCliente)
    {
        $this->ftRegistroCliente = $ftRegistroCliente;

        return $this;
    }

    /**
     * Get ftRegistroCliente
     *
     * @return integer
     */
    public function getFtRegistroCliente()
    {
        return $this->ftRegistroCliente;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSeguimientoCliente
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
     * Set empresaAsociada
     *
     * @param string $empresaAsociada
     *
     * @return FtSeguimientoCliente
     */
    public function setEmpresaAsociada($empresaAsociada)
    {
        $this->empresaAsociada = $empresaAsociada;

        return $this;
    }

    /**
     * Get empresaAsociada
     *
     * @return string
     */
    public function getEmpresaAsociada()
    {
        return $this->empresaAsociada;
    }

    /**
     * Set envioPropuesta
     *
     * @param string $envioPropuesta
     *
     * @return FtSeguimientoCliente
     */
    public function setEnvioPropuesta($envioPropuesta)
    {
        $this->envioPropuesta = $envioPropuesta;

        return $this;
    }

    /**
     * Get envioPropuesta
     *
     * @return string
     */
    public function getEnvioPropuesta()
    {
        return $this->envioPropuesta;
    }

    /**
     * Set estadoCliente
     *
     * @param string $estadoCliente
     *
     * @return FtSeguimientoCliente
     */
    public function setEstadoCliente($estadoCliente)
    {
        $this->estadoCliente = $estadoCliente;

        return $this;
    }

    /**
     * Get estadoCliente
     *
     * @return string
     */
    public function getEstadoCliente()
    {
        return $this->estadoCliente;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtSeguimientoCliente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechaSeguimiento
     *
     * @param \DateTime $fechaSeguimiento
     *
     * @return FtSeguimientoCliente
     */
    public function setFechaSeguimiento($fechaSeguimiento)
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    /**
     * Get fechaSeguimiento
     *
     * @return \DateTime
     */
    public function getFechaSeguimiento()
    {
        return $this->fechaSeguimiento;
    }

    /**
     * Set formaContacto
     *
     * @param integer $formaContacto
     *
     * @return FtSeguimientoCliente
     */
    public function setFormaContacto($formaContacto)
    {
        $this->formaContacto = $formaContacto;

        return $this;
    }

    /**
     * Get formaContacto
     *
     * @return integer
     */
    public function getFormaContacto()
    {
        return $this->formaContacto;
    }

    /**
     * Set nombreProductoServicio
     *
     * @param string $nombreProductoServicio
     *
     * @return FtSeguimientoCliente
     */
    public function setNombreProductoServicio($nombreProductoServicio)
    {
        $this->nombreProductoServicio = $nombreProductoServicio;

        return $this;
    }

    /**
     * Get nombreProductoServicio
     *
     * @return string
     */
    public function getNombreProductoServicio()
    {
        return $this->nombreProductoServicio;
    }

    /**
     * Set nombrePropuesta
     *
     * @param string $nombrePropuesta
     *
     * @return FtSeguimientoCliente
     */
    public function setNombrePropuesta($nombrePropuesta)
    {
        $this->nombrePropuesta = $nombrePropuesta;

        return $this;
    }

    /**
     * Get nombrePropuesta
     *
     * @return string
     */
    public function getNombrePropuesta()
    {
        return $this->nombrePropuesta;
    }

    /**
     * Set resultadoSeguimiento
     *
     * @param string $resultadoSeguimiento
     *
     * @return FtSeguimientoCliente
     */
    public function setResultadoSeguimiento($resultadoSeguimiento)
    {
        $this->resultadoSeguimiento = $resultadoSeguimiento;

        return $this;
    }

    /**
     * Get resultadoSeguimiento
     *
     * @return string
     */
    public function getResultadoSeguimiento()
    {
        return $this->resultadoSeguimiento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeguimientoCliente
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
     * @return FtSeguimientoCliente
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
     * @return FtSeguimientoCliente
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
     * @return FtSeguimientoCliente
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
     * Set estadoPropuesta
     *
     * @param integer $estadoPropuesta
     *
     * @return FtSeguimientoCliente
     */
    public function setEstadoPropuesta($estadoPropuesta)
    {
        $this->estadoPropuesta = $estadoPropuesta;

        return $this;
    }

    /**
     * Get estadoPropuesta
     *
     * @return integer
     */
    public function getEstadoPropuesta()
    {
        return $this->estadoPropuesta;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSeguimientoCliente
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

