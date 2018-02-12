<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRecepcionCotizacion
 *
 * @ORM\Table(name="ft_recepcion_cotizacion", indexes={@ORM\Index(name="i_recepcion_cotizacion_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_recepcion_cotizacion_justificac", columns={"ft_justificacion_compra"}), @ORM\Index(name="i_recepcion_cotizacion_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtRecepcionCotizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_recepcion_cotizacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRecepcionCotizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_justificacion_compra", type="integer", nullable=false)
     */
    private $ftJustificacionCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1017';

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntos", type="string", length=255, nullable=true)
     */
    private $adjuntos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recepcion_cotiza", type="date", nullable=false)
     */
    private $fechaRecepcionCotiza;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor", type="string", length=255, nullable=false)
     */
    private $proveedor;

    /**
     * @var integer
     *
     * @ORM\Column(name="regimen", type="integer", nullable=false)
     */
    private $regimen = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="subtotal", type="string", length=255, nullable=true)
     */
    private $subtotal;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_iva", type="string", length=255, nullable=false)
     */
    private $valorIva;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_total", type="string", length=255, nullable=true)
     */
    private $valorTotal;

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
