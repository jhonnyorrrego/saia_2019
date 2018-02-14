<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOrdenPago
 *
 * @ORM\Table(name="ft_orden_pago", indexes={@ORM\Index(name="i_ft_orden_pago_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtOrdenPago
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_orden_pago", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftOrdenPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_informe_recibo", type="integer", nullable=false)
     */
    private $ftInformeRecibo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '907';

    /**
     * @var integer
     *
     * @ORM\Column(name="adicionales_orden", type="integer", nullable=false)
     */
    private $adicionalesOrden = '78';

    /**
     * @var string
     *
     * @ORM\Column(name="centro_costos", type="string", length=255, nullable=true)
     */
    private $centroCostos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="page_a", type="string", length=255, nullable=false)
     */
    private $pageA;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_pago", type="integer", nullable=false)
     */
    private $ordenPago;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_iva", type="text", length=65535, nullable=false)
     */
    private $observacionesIva;

    /**
     * @var integer
     *
     * @ORM\Column(name="urgencia_pago", type="integer", nullable=false)
     */
    private $urgenciaPago;

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
     * Get idftOrdenPago
     *
     * @return integer
     */
    public function getIdftOrdenPago()
    {
        return $this->idftOrdenPago;
    }

    /**
     * Set ftInformeRecibo
     *
     * @param integer $ftInformeRecibo
     *
     * @return FtOrdenPago
     */
    public function setFtInformeRecibo($ftInformeRecibo)
    {
        $this->ftInformeRecibo = $ftInformeRecibo;

        return $this;
    }

    /**
     * Get ftInformeRecibo
     *
     * @return integer
     */
    public function getFtInformeRecibo()
    {
        return $this->ftInformeRecibo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenPago
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
     * Set adicionalesOrden
     *
     * @param integer $adicionalesOrden
     *
     * @return FtOrdenPago
     */
    public function setAdicionalesOrden($adicionalesOrden)
    {
        $this->adicionalesOrden = $adicionalesOrden;

        return $this;
    }

    /**
     * Get adicionalesOrden
     *
     * @return integer
     */
    public function getAdicionalesOrden()
    {
        return $this->adicionalesOrden;
    }

    /**
     * Set centroCostos
     *
     * @param string $centroCostos
     *
     * @return FtOrdenPago
     */
    public function setCentroCostos($centroCostos)
    {
        $this->centroCostos = $centroCostos;

        return $this;
    }

    /**
     * Get centroCostos
     *
     * @return string
     */
    public function getCentroCostos()
    {
        return $this->centroCostos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtOrdenPago
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
     * Set pageA
     *
     * @param string $pageA
     *
     * @return FtOrdenPago
     */
    public function setPageA($pageA)
    {
        $this->pageA = $pageA;

        return $this;
    }

    /**
     * Get pageA
     *
     * @return string
     */
    public function getPageA()
    {
        return $this->pageA;
    }

    /**
     * Set ordenPago
     *
     * @param integer $ordenPago
     *
     * @return FtOrdenPago
     */
    public function setOrdenPago($ordenPago)
    {
        $this->ordenPago = $ordenPago;

        return $this;
    }

    /**
     * Get ordenPago
     *
     * @return integer
     */
    public function getOrdenPago()
    {
        return $this->ordenPago;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtOrdenPago
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
     * Set observacionesIva
     *
     * @param string $observacionesIva
     *
     * @return FtOrdenPago
     */
    public function setObservacionesIva($observacionesIva)
    {
        $this->observacionesIva = $observacionesIva;

        return $this;
    }

    /**
     * Get observacionesIva
     *
     * @return string
     */
    public function getObservacionesIva()
    {
        return $this->observacionesIva;
    }

    /**
     * Set urgenciaPago
     *
     * @param integer $urgenciaPago
     *
     * @return FtOrdenPago
     */
    public function setUrgenciaPago($urgenciaPago)
    {
        $this->urgenciaPago = $urgenciaPago;

        return $this;
    }

    /**
     * Get urgenciaPago
     *
     * @return integer
     */
    public function getUrgenciaPago()
    {
        return $this->urgenciaPago;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenPago
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
     * @return FtOrdenPago
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
     * @return FtOrdenPago
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
     * @return FtOrdenPago
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
     * @return FtOrdenPago
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
