<?php

namespace Saia;

/**
 * FtRadicacionFacturas
 */
class FtRadicacionFacturas
{
    /**
     * @var integer
     */
    private $idftRadicacionFacturas;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $adjuntar;

    /**
     * @var string
     */
    private $detalleFactura;

    /**
     * @var string
     */
    private $empresaGuia;

    /**
     * @var \DateTime
     */
    private $fechaExpedicion;

    /**
     * @var \DateTime
     */
    private $fechaVencimiento;

    /**
     * @var integer
     */
    private $ftOrdenCompra;

    /**
     * @var string
     */
    private $guia;

    /**
     * @var string
     */
    private $numeroFactura;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $proveedor;

    /**
     * @var string
     */
    private $responsableOp;

    /**
     * @var integer
     */
    private $tipoDocumento;

    /**
     * @var string
     */
    private $valorFactura;

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
    private $estadoDocumento;


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

