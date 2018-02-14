<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedadDespacho
 *
 * @ORM\Table(name="ft_novedad_despacho", indexes={@ORM\Index(name="i_ft_novedad_despacho_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtNovedadDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedad_despacho", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedadDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1215';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_despacho_ingresados", type="integer", nullable=false)
     */
    private $ftDespachoIngresados;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="novedad", type="string", length=255, nullable=false)
     */
    private $novedad;

    /**
     * @var string
     *
     * @ORM\Column(name="item_radicacion", type="string", length=255, nullable=false)
     */
    private $itemRadicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_novedad", type="datetime", nullable=false)
     */
    private $fechaNovedad;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_soporte", type="string", length=255, nullable=true)
     */
    private $anexoSoporte;



    /**
     * Get idftNovedadDespacho
     *
     * @return integer
     */
    public function getIdftNovedadDespacho()
    {
        return $this->idftNovedadDespacho;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtNovedadDespacho
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtNovedadDespacho
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtNovedadDespacho
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtNovedadDespacho
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtNovedadDespacho
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtNovedadDespacho
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set ftDespachoIngresados
     *
     * @param integer $ftDespachoIngresados
     *
     * @return FtNovedadDespacho
     */
    public function setFtDespachoIngresados($ftDespachoIngresados)
    {
        $this->ftDespachoIngresados = $ftDespachoIngresados;

        return $this;
    }

    /**
     * Get ftDespachoIngresados
     *
     * @return integer
     */
    public function getFtDespachoIngresados()
    {
        return $this->ftDespachoIngresados;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtNovedadDespacho
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
     * Set novedad
     *
     * @param string $novedad
     *
     * @return FtNovedadDespacho
     */
    public function setNovedad($novedad)
    {
        $this->novedad = $novedad;

        return $this;
    }

    /**
     * Get novedad
     *
     * @return string
     */
    public function getNovedad()
    {
        return $this->novedad;
    }

    /**
     * Set itemRadicacion
     *
     * @param string $itemRadicacion
     *
     * @return FtNovedadDespacho
     */
    public function setItemRadicacion($itemRadicacion)
    {
        $this->itemRadicacion = $itemRadicacion;

        return $this;
    }

    /**
     * Get itemRadicacion
     *
     * @return string
     */
    public function getItemRadicacion()
    {
        return $this->itemRadicacion;
    }

    /**
     * Set fechaNovedad
     *
     * @param \DateTime $fechaNovedad
     *
     * @return FtNovedadDespacho
     */
    public function setFechaNovedad($fechaNovedad)
    {
        $this->fechaNovedad = $fechaNovedad;

        return $this;
    }

    /**
     * Get fechaNovedad
     *
     * @return \DateTime
     */
    public function getFechaNovedad()
    {
        return $this->fechaNovedad;
    }

    /**
     * Set anexoSoporte
     *
     * @param string $anexoSoporte
     *
     * @return FtNovedadDespacho
     */
    public function setAnexoSoporte($anexoSoporte)
    {
        $this->anexoSoporte = $anexoSoporte;

        return $this;
    }

    /**
     * Get anexoSoporte
     *
     * @return string
     */
    public function getAnexoSoporte()
    {
        return $this->anexoSoporte;
    }
}
