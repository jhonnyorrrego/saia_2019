<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDevoluFacturaRadica
 *
 * @ORM\Table(name="ft_devolu_factura_radica", indexes={@ORM\Index(name="i_ft_devolu_factura_radica_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDevoluFacturaRadica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_devolu_factura_radica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftDevoluFacturaRadica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_facturas", type="integer", nullable=false)
     */
    private $ftRadicacionFacturas;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1031';

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
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor_devolucion", type="string", length=255, nullable=false)
     */
    private $proveedorDevolucion;

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
     * Get idftDevoluFacturaRadica
     *
     * @return integer
     */
    public function getIdftDevoluFacturaRadica()
    {
        return $this->idftDevoluFacturaRadica;
    }

    /**
     * Set ftRadicacionFacturas
     *
     * @param integer $ftRadicacionFacturas
     *
     * @return FtDevoluFacturaRadica
     */
    public function setFtRadicacionFacturas($ftRadicacionFacturas)
    {
        $this->ftRadicacionFacturas = $ftRadicacionFacturas;

        return $this;
    }

    /**
     * Get ftRadicacionFacturas
     *
     * @return integer
     */
    public function getFtRadicacionFacturas()
    {
        return $this->ftRadicacionFacturas;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtDevoluFacturaRadica
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
     * Set proveedorDevolucion
     *
     * @param string $proveedorDevolucion
     *
     * @return FtDevoluFacturaRadica
     */
    public function setProveedorDevolucion($proveedorDevolucion)
    {
        $this->proveedorDevolucion = $proveedorDevolucion;

        return $this;
    }

    /**
     * Get proveedorDevolucion
     *
     * @return string
     */
    public function getProveedorDevolucion()
    {
        return $this->proveedorDevolucion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
     * @return FtDevoluFacturaRadica
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
