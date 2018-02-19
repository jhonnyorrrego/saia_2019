<?php

namespace Saia;

/**
 * FtRecepcionCotizacion
 */
class FtRecepcionCotizacion
{
    /**
     * @var integer
     */
    private $idftRecepcionCotizacion;

    /**
     * @var integer
     */
    private $ftJustificacionCompra;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $adjuntos;

    /**
     * @var \DateTime
     */
    private $fechaRecepcionCotiza;

    /**
     * @var string
     */
    private $proveedor;

    /**
     * @var integer
     */
    private $regimen;

    /**
     * @var string
     */
    private $subtotal;

    /**
     * @var string
     */
    private $valorIva;

    /**
     * @var string
     */
    private $valorTotal;

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
     * Get idftRecepcionCotizacion
     *
     * @return integer
     */
    public function getIdftRecepcionCotizacion()
    {
        return $this->idftRecepcionCotizacion;
    }

    /**
     * Set ftJustificacionCompra
     *
     * @param integer $ftJustificacionCompra
     *
     * @return FtRecepcionCotizacion
     */
    public function setFtJustificacionCompra($ftJustificacionCompra)
    {
        $this->ftJustificacionCompra = $ftJustificacionCompra;

        return $this;
    }

    /**
     * Get ftJustificacionCompra
     *
     * @return integer
     */
    public function getFtJustificacionCompra()
    {
        return $this->ftJustificacionCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRecepcionCotizacion
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
     * Set adjuntos
     *
     * @param string $adjuntos
     *
     * @return FtRecepcionCotizacion
     */
    public function setAdjuntos($adjuntos)
    {
        $this->adjuntos = $adjuntos;

        return $this;
    }

    /**
     * Get adjuntos
     *
     * @return string
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }

    /**
     * Set fechaRecepcionCotiza
     *
     * @param \DateTime $fechaRecepcionCotiza
     *
     * @return FtRecepcionCotizacion
     */
    public function setFechaRecepcionCotiza($fechaRecepcionCotiza)
    {
        $this->fechaRecepcionCotiza = $fechaRecepcionCotiza;

        return $this;
    }

    /**
     * Get fechaRecepcionCotiza
     *
     * @return \DateTime
     */
    public function getFechaRecepcionCotiza()
    {
        return $this->fechaRecepcionCotiza;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return FtRecepcionCotizacion
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
     * Set regimen
     *
     * @param integer $regimen
     *
     * @return FtRecepcionCotizacion
     */
    public function setRegimen($regimen)
    {
        $this->regimen = $regimen;

        return $this;
    }

    /**
     * Get regimen
     *
     * @return integer
     */
    public function getRegimen()
    {
        return $this->regimen;
    }

    /**
     * Set subtotal
     *
     * @param string $subtotal
     *
     * @return FtRecepcionCotizacion
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return string
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set valorIva
     *
     * @param string $valorIva
     *
     * @return FtRecepcionCotizacion
     */
    public function setValorIva($valorIva)
    {
        $this->valorIva = $valorIva;

        return $this;
    }

    /**
     * Get valorIva
     *
     * @return string
     */
    public function getValorIva()
    {
        return $this->valorIva;
    }

    /**
     * Set valorTotal
     *
     * @param string $valorTotal
     *
     * @return FtRecepcionCotizacion
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return string
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRecepcionCotizacion
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
     * @return FtRecepcionCotizacion
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
     * @return FtRecepcionCotizacion
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
     * @return FtRecepcionCotizacion
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
     * @return FtRecepcionCotizacion
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

