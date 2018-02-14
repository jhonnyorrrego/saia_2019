<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDevolucionFactura
 *
 * @ORM\Table(name="ft_devolucion_factura", indexes={@ORM\Index(name="i_ft_devolucion_factura_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDevolucionFactura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_devolucion_factura", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDevolucionFactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_factura_proveedor", type="integer", nullable=false)
     */
    private $ftFacturaProveedor;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '912';

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntar", type="string", length=255, nullable=true)
     */
    private $adjuntar;

    /**
     * @var integer
     *
     * @ORM\Column(name="forma_envio", type="integer", nullable=false)
     */
    private $formaEnvio;

    /**
     * @var integer
     *
     * @ORM\Column(name="iniciales", type="integer", nullable=false)
     */
    private $iniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor", type="string", length=255, nullable=true)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_creador", type="string", length=255, nullable=true)
     */
    private $datosCreador;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_proveedor", type="string", length=255, nullable=true)
     */
    private $datosProveedor;

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
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftDevolucionFactura
     *
     * @return integer
     */
    public function getIdftDevolucionFactura()
    {
        return $this->idftDevolucionFactura;
    }

    /**
     * Set ftFacturaProveedor
     *
     * @param integer $ftFacturaProveedor
     *
     * @return FtDevolucionFactura
     */
    public function setFtFacturaProveedor($ftFacturaProveedor)
    {
        $this->ftFacturaProveedor = $ftFacturaProveedor;

        return $this;
    }

    /**
     * Get ftFacturaProveedor
     *
     * @return integer
     */
    public function getFtFacturaProveedor()
    {
        return $this->ftFacturaProveedor;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDevolucionFactura
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
     * @return FtDevolucionFactura
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
     * Set formaEnvio
     *
     * @param integer $formaEnvio
     *
     * @return FtDevolucionFactura
     */
    public function setFormaEnvio($formaEnvio)
    {
        $this->formaEnvio = $formaEnvio;

        return $this;
    }

    /**
     * Get formaEnvio
     *
     * @return integer
     */
    public function getFormaEnvio()
    {
        return $this->formaEnvio;
    }

    /**
     * Set iniciales
     *
     * @param integer $iniciales
     *
     * @return FtDevolucionFactura
     */
    public function setIniciales($iniciales)
    {
        $this->iniciales = $iniciales;

        return $this;
    }

    /**
     * Get iniciales
     *
     * @return integer
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return FtDevolucionFactura
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
     * Set datosCreador
     *
     * @param string $datosCreador
     *
     * @return FtDevolucionFactura
     */
    public function setDatosCreador($datosCreador)
    {
        $this->datosCreador = $datosCreador;

        return $this;
    }

    /**
     * Get datosCreador
     *
     * @return string
     */
    public function getDatosCreador()
    {
        return $this->datosCreador;
    }

    /**
     * Set datosProveedor
     *
     * @param string $datosProveedor
     *
     * @return FtDevolucionFactura
     */
    public function setDatosProveedor($datosProveedor)
    {
        $this->datosProveedor = $datosProveedor;

        return $this;
    }

    /**
     * Get datosProveedor
     *
     * @return string
     */
    public function getDatosProveedor()
    {
        return $this->datosProveedor;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDevolucionFactura
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
     * @return FtDevolucionFactura
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
     * @return FtDevolucionFactura
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
     * @return FtDevolucionFactura
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtDevolucionFactura
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDevolucionFactura
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
