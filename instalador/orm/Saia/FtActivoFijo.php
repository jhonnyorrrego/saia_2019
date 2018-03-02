<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActivoFijo
 *
 * @ORM\Table(name="ft_activo_fijo", indexes={@ORM\Index(name="i_ft_activo_fijo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtActivoFijo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_activo_fijo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftActivoFijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '900';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=false)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="consideraciones", type="string", length=255, nullable=false)
     */
    private $consideraciones;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor", type="string", length=255, nullable=true)
     */
    private $proveedor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compra", type="date", nullable=false)
     */
    private $fechaCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_compra", type="string", length=255, nullable=true)
     */
    private $valorCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="propietario", type="string", length=255, nullable=true)
     */
    private $propietario;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_seguro", type="string", length=255, nullable=true)
     */
    private $valorSeguro;

    /**
     * @var string
     *
     * @ORM\Column(name="seguro1", type="string", length=255, nullable=true)
     */
    private $seguro1;

    /**
     * @var string
     *
     * @ORM\Column(name="seguro2", type="string", length=255, nullable=true)
     */
    private $seguro2;

    /**
     * @var string
     *
     * @ORM\Column(name="seguro3", type="string", length=255, nullable=true)
     */
    private $seguro3;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_venta", type="date", nullable=true)
     */
    private $fechaVenta;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_venta", type="string", length=255, nullable=true)
     */
    private $valorVenta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mantenimiento", type="date", nullable=true)
     */
    private $fechaMantenimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=true)
     */
    private $ubicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="comprador", type="string", length=255, nullable=true)
     */
    private $comprador;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_activo", type="string", length=255, nullable=false)
     */
    private $nombreActivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
