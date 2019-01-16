<?php

namespace Saia;

/**
 * FtActividadProceso
 */
class FtActividadProceso
{
    /**
     * @var integer
     */
    private $idftActividadProceso;

    /**
     * @var integer
     */
    private $serieIdserie;

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
    private $firma;

    /**
     * @var string
     */
    private $proveedor;

    /**
     * @var string
     */
    private $entrada;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $puntoControl;

    /**
     * @var string
     */
    private $salida;

    /**
     * @var string
     */
    private $cliente;

    /**
     * @var integer
     */
    private $ftProceso;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftActividadProceso
     *
     * @return integer
     */
    public function getIdftActividadProceso()
    {
        return $this->idftActividadProceso;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtActividadProceso
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtActividadProceso
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
     * @return FtActividadProceso
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
     * @return FtActividadProceso
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtActividadProceso
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
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return FtActividadProceso
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set entrada
     *
     * @param string $entrada
     *
     * @return FtActividadProceso
     */
    public function setEntrada($entrada)
    {
        $this->entrada = $entrada;

        return $this;
    }

    /**
     * Get entrada
     *
     * @return string
     */
    public function getEntrada()
    {
        return $this->entrada;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtActividadProceso
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set puntoControl
     *
     * @param string $puntoControl
     *
     * @return FtActividadProceso
     */
    public function setPuntoControl($puntoControl)
    {
        $this->puntoControl = $puntoControl;

        return $this;
    }

    /**
     * Get puntoControl
     *
     * @return string
     */
    public function getPuntoControl()
    {
        return $this->puntoControl;
    }

    /**
     * Set salida
     *
     * @param string $salida
     *
     * @return FtActividadProceso
     */
    public function setSalida($salida)
    {
        $this->salida = $salida;

        return $this;
    }

    /**
     * Get salida
     *
     * @return string
     */
    public function getSalida()
    {
        return $this->salida;
    }

    /**
     * Set cliente
     *
     * @param string $cliente
     *
     * @return FtActividadProceso
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return string
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtActividadProceso
     */
    public function setFtProceso($ftProceso)
    {
        $this->ftProceso = $ftProceso;

        return $this;
    }

    /**
     * Get ftProceso
     *
     * @return integer
     */
    public function getFtProceso()
    {
        return $this->ftProceso;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtActividadProceso
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

