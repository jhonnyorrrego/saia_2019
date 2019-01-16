<?php

namespace Saia;

/**
 * FtActivoFijo
 */
class FtActivoFijo
{
    /**
     * @var integer
     */
    private $idftActivoFijo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $consideraciones;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $proveedor;

    /**
     * @var \DateTime
     */
    private $fechaCompra;

    /**
     * @var string
     */
    private $valorCompra;

    /**
     * @var string
     */
    private $propietario;

    /**
     * @var string
     */
    private $valorSeguro;

    /**
     * @var string
     */
    private $seguro1;

    /**
     * @var string
     */
    private $seguro2;

    /**
     * @var string
     */
    private $seguro3;

    /**
     * @var \DateTime
     */
    private $fechaVenta;

    /**
     * @var string
     */
    private $valorVenta;

    /**
     * @var \DateTime
     */
    private $fechaMantenimiento;

    /**
     * @var string
     */
    private $ubicacion;

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
    private $comprador;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var string
     */
    private $nombreActivo;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftActivoFijo
     *
     * @return integer
     */
    public function getIdftActivoFijo()
    {
        return $this->idftActivoFijo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtActivoFijo
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtActivoFijo
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return FtActivoFijo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtActivoFijo
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
     * Set consideraciones
     *
     * @param string $consideraciones
     *
     * @return FtActivoFijo
     */
    public function setConsideraciones($consideraciones)
    {
        $this->consideraciones = $consideraciones;

        return $this;
    }

    /**
     * Get consideraciones
     *
     * @return string
     */
    public function getConsideraciones()
    {
        return $this->consideraciones;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtActivoFijo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return FtActivoFijo
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
     * Set fechaCompra
     *
     * @param \DateTime $fechaCompra
     *
     * @return FtActivoFijo
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;

        return $this;
    }

    /**
     * Get fechaCompra
     *
     * @return \DateTime
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }

    /**
     * Set valorCompra
     *
     * @param string $valorCompra
     *
     * @return FtActivoFijo
     */
    public function setValorCompra($valorCompra)
    {
        $this->valorCompra = $valorCompra;

        return $this;
    }

    /**
     * Get valorCompra
     *
     * @return string
     */
    public function getValorCompra()
    {
        return $this->valorCompra;
    }

    /**
     * Set propietario
     *
     * @param string $propietario
     *
     * @return FtActivoFijo
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return string
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * Set valorSeguro
     *
     * @param string $valorSeguro
     *
     * @return FtActivoFijo
     */
    public function setValorSeguro($valorSeguro)
    {
        $this->valorSeguro = $valorSeguro;

        return $this;
    }

    /**
     * Get valorSeguro
     *
     * @return string
     */
    public function getValorSeguro()
    {
        return $this->valorSeguro;
    }

    /**
     * Set seguro1
     *
     * @param string $seguro1
     *
     * @return FtActivoFijo
     */
    public function setSeguro1($seguro1)
    {
        $this->seguro1 = $seguro1;

        return $this;
    }

    /**
     * Get seguro1
     *
     * @return string
     */
    public function getSeguro1()
    {
        return $this->seguro1;
    }

    /**
     * Set seguro2
     *
     * @param string $seguro2
     *
     * @return FtActivoFijo
     */
    public function setSeguro2($seguro2)
    {
        $this->seguro2 = $seguro2;

        return $this;
    }

    /**
     * Get seguro2
     *
     * @return string
     */
    public function getSeguro2()
    {
        return $this->seguro2;
    }

    /**
     * Set seguro3
     *
     * @param string $seguro3
     *
     * @return FtActivoFijo
     */
    public function setSeguro3($seguro3)
    {
        $this->seguro3 = $seguro3;

        return $this;
    }

    /**
     * Get seguro3
     *
     * @return string
     */
    public function getSeguro3()
    {
        return $this->seguro3;
    }

    /**
     * Set fechaVenta
     *
     * @param \DateTime $fechaVenta
     *
     * @return FtActivoFijo
     */
    public function setFechaVenta($fechaVenta)
    {
        $this->fechaVenta = $fechaVenta;

        return $this;
    }

    /**
     * Get fechaVenta
     *
     * @return \DateTime
     */
    public function getFechaVenta()
    {
        return $this->fechaVenta;
    }

    /**
     * Set valorVenta
     *
     * @param string $valorVenta
     *
     * @return FtActivoFijo
     */
    public function setValorVenta($valorVenta)
    {
        $this->valorVenta = $valorVenta;

        return $this;
    }

    /**
     * Get valorVenta
     *
     * @return string
     */
    public function getValorVenta()
    {
        return $this->valorVenta;
    }

    /**
     * Set fechaMantenimiento
     *
     * @param \DateTime $fechaMantenimiento
     *
     * @return FtActivoFijo
     */
    public function setFechaMantenimiento($fechaMantenimiento)
    {
        $this->fechaMantenimiento = $fechaMantenimiento;

        return $this;
    }

    /**
     * Get fechaMantenimiento
     *
     * @return \DateTime
     */
    public function getFechaMantenimiento()
    {
        return $this->fechaMantenimiento;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return FtActivoFijo
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtActivoFijo
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
     * @return FtActivoFijo
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
     * @return FtActivoFijo
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
     * @return FtActivoFijo
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
     * Set comprador
     *
     * @param string $comprador
     *
     * @return FtActivoFijo
     */
    public function setComprador($comprador)
    {
        $this->comprador = $comprador;

        return $this;
    }

    /**
     * Get comprador
     *
     * @return string
     */
    public function getComprador()
    {
        return $this->comprador;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return FtActivoFijo
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set nombreActivo
     *
     * @param string $nombreActivo
     *
     * @return FtActivoFijo
     */
    public function setNombreActivo($nombreActivo)
    {
        $this->nombreActivo = $nombreActivo;

        return $this;
    }

    /**
     * Get nombreActivo
     *
     * @return string
     */
    public function getNombreActivo()
    {
        return $this->nombreActivo;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtActivoFijo
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

