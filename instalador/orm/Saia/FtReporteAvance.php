<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReporteAvance
 *
 * @ORM\Table(name="ft_reporte_avance", indexes={@ORM\Index(name="i_reporte_avance_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_reporte_avance_solicitud_", columns={"ft_solicitud_soporte"}), @ORM\Index(name="i_reporte_avance_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtReporteAvance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_reporte_avance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftReporteAvance;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_soporte", type="integer", nullable=false)
     */
    private $ftSolicitudSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '899';

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=false)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_proceso", type="string", length=255, nullable=false)
     */
    private $estadoProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="insumos", type="string", length=255, nullable=true)
     */
    private $insumos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

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
     * Get idftReporteAvance
     *
     * @return integer
     */
    public function getIdftReporteAvance()
    {
        return $this->idftReporteAvance;
    }

    /**
     * Set ftSolicitudSoporte
     *
     * @param integer $ftSolicitudSoporte
     *
     * @return FtReporteAvance
     */
    public function setFtSolicitudSoporte($ftSolicitudSoporte)
    {
        $this->ftSolicitudSoporte = $ftSolicitudSoporte;

        return $this;
    }

    /**
     * Get ftSolicitudSoporte
     *
     * @return integer
     */
    public function getFtSolicitudSoporte()
    {
        return $this->ftSolicitudSoporte;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReporteAvance
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
     * Set categoria
     *
     * @param string $categoria
     *
     * @return FtReporteAvance
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set estadoProceso
     *
     * @param string $estadoProceso
     *
     * @return FtReporteAvance
     */
    public function setEstadoProceso($estadoProceso)
    {
        $this->estadoProceso = $estadoProceso;

        return $this;
    }

    /**
     * Get estadoProceso
     *
     * @return string
     */
    public function getEstadoProceso()
    {
        return $this->estadoProceso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtReporteAvance
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
     * Set insumos
     *
     * @param string $insumos
     *
     * @return FtReporteAvance
     */
    public function setInsumos($insumos)
    {
        $this->insumos = $insumos;

        return $this;
    }

    /**
     * Get insumos
     *
     * @return string
     */
    public function getInsumos()
    {
        return $this->insumos;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtReporteAvance
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtReporteAvance
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
     * @return FtReporteAvance
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
