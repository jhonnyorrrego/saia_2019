<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInformeRecibo
 *
 * @ORM\Table(name="ft_informe_recibo", indexes={@ORM\Index(name="i_ft_informe_recibo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtInformeRecibo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_informe_recibo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftInformeRecibo;

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
    private $serieIdserie = '906';

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
     * @ORM\Column(name="bien_servicio", type="integer", nullable=false)
     */
    private $bienServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=255, nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="califica_servicio", type="integer", nullable=false)
     */
    private $calificaServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="otras_compras", type="integer", nullable=false)
     */
    private $otrasCompras = '44';

    /**
     * @var string
     *
     * @ORM\Column(name="numer_ext", type="string", length=255, nullable=false)
     */
    private $numerExt = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="otro_responsable", type="string", length=255, nullable=false)
     */
    private $otroResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_op", type="integer", nullable=false)
     */
    private $requiereOp;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_op", type="string", length=255, nullable=false)
     */
    private $responsableOp;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=false)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftInformeRecibo
     *
     * @return integer
     */
    public function getIdftInformeRecibo()
    {
        return $this->idftInformeRecibo;
    }

    /**
     * Set ftFacturaProveedor
     *
     * @param integer $ftFacturaProveedor
     *
     * @return FtInformeRecibo
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
     * @return FtInformeRecibo
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtInformeRecibo
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
     * @return FtInformeRecibo
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
     * @return FtInformeRecibo
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
     * @return FtInformeRecibo
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
     * Set bienServicio
     *
     * @param integer $bienServicio
     *
     * @return FtInformeRecibo
     */
    public function setBienServicio($bienServicio)
    {
        $this->bienServicio = $bienServicio;

        return $this;
    }

    /**
     * Get bienServicio
     *
     * @return integer
     */
    public function getBienServicio()
    {
        return $this->bienServicio;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return FtInformeRecibo
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtInformeRecibo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set calificaServicio
     *
     * @param integer $calificaServicio
     *
     * @return FtInformeRecibo
     */
    public function setCalificaServicio($calificaServicio)
    {
        $this->calificaServicio = $calificaServicio;

        return $this;
    }

    /**
     * Get calificaServicio
     *
     * @return integer
     */
    public function getCalificaServicio()
    {
        return $this->calificaServicio;
    }

    /**
     * Set otrasCompras
     *
     * @param integer $otrasCompras
     *
     * @return FtInformeRecibo
     */
    public function setOtrasCompras($otrasCompras)
    {
        $this->otrasCompras = $otrasCompras;

        return $this;
    }

    /**
     * Get otrasCompras
     *
     * @return integer
     */
    public function getOtrasCompras()
    {
        return $this->otrasCompras;
    }

    /**
     * Set numerExt
     *
     * @param string $numerExt
     *
     * @return FtInformeRecibo
     */
    public function setNumerExt($numerExt)
    {
        $this->numerExt = $numerExt;

        return $this;
    }

    /**
     * Get numerExt
     *
     * @return string
     */
    public function getNumerExt()
    {
        return $this->numerExt;
    }

    /**
     * Set otroResponsable
     *
     * @param string $otroResponsable
     *
     * @return FtInformeRecibo
     */
    public function setOtroResponsable($otroResponsable)
    {
        $this->otroResponsable = $otroResponsable;

        return $this;
    }

    /**
     * Get otroResponsable
     *
     * @return string
     */
    public function getOtroResponsable()
    {
        return $this->otroResponsable;
    }

    /**
     * Set requiereOp
     *
     * @param integer $requiereOp
     *
     * @return FtInformeRecibo
     */
    public function setRequiereOp($requiereOp)
    {
        $this->requiereOp = $requiereOp;

        return $this;
    }

    /**
     * Get requiereOp
     *
     * @return integer
     */
    public function getRequiereOp()
    {
        return $this->requiereOp;
    }

    /**
     * Set responsableOp
     *
     * @param string $responsableOp
     *
     * @return FtInformeRecibo
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtInformeRecibo
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
     * @return FtInformeRecibo
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
