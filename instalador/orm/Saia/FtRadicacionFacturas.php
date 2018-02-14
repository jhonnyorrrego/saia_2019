<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionFacturas
 *
 * @ORM\Table(name="ft_radicacion_facturas")
 * @ORM\Entity
 */
class FtRadicacionFacturas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_radicacion_facturas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRadicacionFacturas;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1024';

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntar", type="string", length=255, nullable=true)
     */
    private $adjuntar;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle_factura", type="string", length=255, nullable=false)
     */
    private $detalleFactura;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_guia", type="string", length=255, nullable=true)
     */
    private $empresaGuia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expedicion", type="date", nullable=false)
     */
    private $fechaExpedicion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=false)
     */
    private $fechaVencimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_orden_compra", type="integer", nullable=false)
     */
    private $ftOrdenCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="guia", type="string", length=255, nullable=true)
     */
    private $guia;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_factura", type="string", length=255, nullable=false)
     */
    private $numeroFactura;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor", type="string", length=255, nullable=false)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_op", type="string", length=255, nullable=false)
     */
    private $responsableOp;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_documento", type="integer", nullable=false)
     */
    private $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_factura", type="string", length=255, nullable=false)
     */
    private $valorFactura;

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
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftRadicacionFacturas
     *
     * @return integer
     */
    public function getIdftRadicacionFacturas()
    {
        return $this->idftRadicacionFacturas;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRadicacionFacturas
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
     * Set adjuntar
     *
     * @param string $adjuntar
     *
     * @return FtRadicacionFacturas
     */
    public function setAdjuntar($adjuntar)
    {
        $this->adjuntar = $adjuntar;

        return $this;
    }

    /**
     * Get adjuntar
     *
     * @return string
     */
    public function getAdjuntar()
    {
        return $this->adjuntar;
    }

    /**
     * Set detalleFactura
     *
     * @param string $detalleFactura
     *
     * @return FtRadicacionFacturas
     */
    public function setDetalleFactura($detalleFactura)
    {
        $this->detalleFactura = $detalleFactura;

        return $this;
    }

    /**
     * Get detalleFactura
     *
     * @return string
     */
    public function getDetalleFactura()
    {
        return $this->detalleFactura;
    }

    /**
     * Set empresaGuia
     *
     * @param string $empresaGuia
     *
     * @return FtRadicacionFacturas
     */
    public function setEmpresaGuia($empresaGuia)
    {
        $this->empresaGuia = $empresaGuia;

        return $this;
    }

    /**
     * Get empresaGuia
     *
     * @return string
     */
    public function getEmpresaGuia()
    {
        return $this->empresaGuia;
    }

    /**
     * Set fechaExpedicion
     *
     * @param \DateTime $fechaExpedicion
     *
     * @return FtRadicacionFacturas
     */
    public function setFechaExpedicion($fechaExpedicion)
    {
        $this->fechaExpedicion = $fechaExpedicion;

        return $this;
    }

    /**
     * Get fechaExpedicion
     *
     * @return \DateTime
     */
    public function getFechaExpedicion()
    {
        return $this->fechaExpedicion;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     *
     * @return FtRadicacionFacturas
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set ftOrdenCompra
     *
     * @param integer $ftOrdenCompra
     *
     * @return FtRadicacionFacturas
     */
    public function setFtOrdenCompra($ftOrdenCompra)
    {
        $this->ftOrdenCompra = $ftOrdenCompra;

        return $this;
    }

    /**
     * Get ftOrdenCompra
     *
     * @return integer
     */
    public function getFtOrdenCompra()
    {
        return $this->ftOrdenCompra;
    }

    /**
     * Set guia
     *
     * @param string $guia
     *
     * @return FtRadicacionFacturas
     */
    public function setGuia($guia)
    {
        $this->guia = $guia;

        return $this;
    }

    /**
     * Get guia
     *
     * @return string
     */
    public function getGuia()
    {
        return $this->guia;
    }

    /**
     * Set numeroFactura
     *
     * @param string $numeroFactura
     *
     * @return FtRadicacionFacturas
     */
    public function setNumeroFactura($numeroFactura)
    {
        $this->numeroFactura = $numeroFactura;

        return $this;
    }

    /**
     * Get numeroFactura
     *
     * @return string
     */
    public function getNumeroFactura()
    {
        return $this->numeroFactura;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtRadicacionFacturas
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
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return FtRadicacionFacturas
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
     * Set responsableOp
     *
     * @param string $responsableOp
     *
     * @return FtRadicacionFacturas
     */
    public function setResponsableOp($responsableOp)
    {
        $this->responsableOp = $responsableOp;

        return $this;
    }

    /**
     * Get responsableOp
     *
     * @return string
     */
    public function getResponsableOp()
    {
        return $this->responsableOp;
    }

    /**
     * Set tipoDocumento
     *
     * @param integer $tipoDocumento
     *
     * @return FtRadicacionFacturas
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return integer
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set valorFactura
     *
     * @param string $valorFactura
     *
     * @return FtRadicacionFacturas
     */
    public function setValorFactura($valorFactura)
    {
        $this->valorFactura = $valorFactura;

        return $this;
    }

    /**
     * Get valorFactura
     *
     * @return string
     */
    public function getValorFactura()
    {
        return $this->valorFactura;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRadicacionFacturas
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
     * @return FtRadicacionFacturas
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
     * @return FtRadicacionFacturas
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
     * @return FtRadicacionFacturas
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRadicacionFacturas
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
