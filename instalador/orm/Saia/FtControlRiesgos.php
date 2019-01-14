<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtControlRiesgos
 *
 * @ORM\Table(name="ft_control_riesgos", indexes={@ORM\Index(name="i_ft_control_riesgos_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_control_riesgos_riesgos_pr", columns={"ft_riesgos_proceso"}), @ORM\Index(name="i_control_riesgos_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtControlRiesgos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_control_riesgos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftControlRiesgos;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="consecutivo_control", type="string", length=255, nullable=true)
     */
    private $consecutivoControl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_valoracion", type="date", nullable=false)
     */
    private $fechaValoracion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_control", type="text", length=65535, nullable=false)
     */
    private $descripcionControl;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_control", type="string", length=255, nullable=false)
     */
    private $tipoControl;

    /**
     * @var string
     *
     * @ORM\Column(name="desplazamiento", type="string", length=255, nullable=true)
     */
    private $desplazamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_riesgos_proceso", type="integer", nullable=false)
     */
    private $ftRiesgosProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '3638';

    /**
     * @var string
     *
     * @ORM\Column(name="herramienta_ejercer", type="string", length=255, nullable=false)
     */
    private $herramientaEjercer;

    /**
     * @var string
     *
     * @ORM\Column(name="procedimiento_herramienta", type="string", length=255, nullable=false)
     */
    private $procedimientoHerramienta;

    /**
     * @var string
     *
     * @ORM\Column(name="herramienta_efectiva", type="string", length=255, nullable=false)
     */
    private $herramientaEfectiva;

    /**
     * @var string
     *
     * @ORM\Column(name="responsables_ejecucion", type="string", length=255, nullable=false)
     */
    private $responsablesEjecucion;

    /**
     * @var string
     *
     * @ORM\Column(name="frecuencia_ejecucion", type="string", length=255, nullable=false)
     */
    private $frecuenciaEjecucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
     * Get idftControlRiesgos
     *
     * @return integer
     */
    public function getIdftControlRiesgos()
    {
        return $this->idftControlRiesgos;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtControlRiesgos
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
     * Set consecutivoControl
     *
     * @param string $consecutivoControl
     *
     * @return FtControlRiesgos
     */
    public function setConsecutivoControl($consecutivoControl)
    {
        $this->consecutivoControl = $consecutivoControl;

        return $this;
    }

    /**
     * Get consecutivoControl
     *
     * @return string
     */
    public function getConsecutivoControl()
    {
        return $this->consecutivoControl;
    }

    /**
     * Set fechaValoracion
     *
     * @param \DateTime $fechaValoracion
     *
     * @return FtControlRiesgos
     */
    public function setFechaValoracion($fechaValoracion)
    {
        $this->fechaValoracion = $fechaValoracion;

        return $this;
    }

    /**
     * Get fechaValoracion
     *
     * @return \DateTime
     */
    public function getFechaValoracion()
    {
        return $this->fechaValoracion;
    }

    /**
     * Set descripcionControl
     *
     * @param string $descripcionControl
     *
     * @return FtControlRiesgos
     */
    public function setDescripcionControl($descripcionControl)
    {
        $this->descripcionControl = $descripcionControl;

        return $this;
    }

    /**
     * Get descripcionControl
     *
     * @return string
     */
    public function getDescripcionControl()
    {
        return $this->descripcionControl;
    }

    /**
     * Set tipoControl
     *
     * @param string $tipoControl
     *
     * @return FtControlRiesgos
     */
    public function setTipoControl($tipoControl)
    {
        $this->tipoControl = $tipoControl;

        return $this;
    }

    /**
     * Get tipoControl
     *
     * @return string
     */
    public function getTipoControl()
    {
        return $this->tipoControl;
    }

    /**
     * Set desplazamiento
     *
     * @param string $desplazamiento
     *
     * @return FtControlRiesgos
     */
    public function setDesplazamiento($desplazamiento)
    {
        $this->desplazamiento = $desplazamiento;

        return $this;
    }

    /**
     * Get desplazamiento
     *
     * @return string
     */
    public function getDesplazamiento()
    {
        return $this->desplazamiento;
    }

    /**
     * Set ftRiesgosProceso
     *
     * @param integer $ftRiesgosProceso
     *
     * @return FtControlRiesgos
     */
    public function setFtRiesgosProceso($ftRiesgosProceso)
    {
        $this->ftRiesgosProceso = $ftRiesgosProceso;

        return $this;
    }

    /**
     * Get ftRiesgosProceso
     *
     * @return integer
     */
    public function getFtRiesgosProceso()
    {
        return $this->ftRiesgosProceso;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtControlRiesgos
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
     * Set herramientaEjercer
     *
     * @param string $herramientaEjercer
     *
     * @return FtControlRiesgos
     */
    public function setHerramientaEjercer($herramientaEjercer)
    {
        $this->herramientaEjercer = $herramientaEjercer;

        return $this;
    }

    /**
     * Get herramientaEjercer
     *
     * @return string
     */
    public function getHerramientaEjercer()
    {
        return $this->herramientaEjercer;
    }

    /**
     * Set procedimientoHerramienta
     *
     * @param string $procedimientoHerramienta
     *
     * @return FtControlRiesgos
     */
    public function setProcedimientoHerramienta($procedimientoHerramienta)
    {
        $this->procedimientoHerramienta = $procedimientoHerramienta;

        return $this;
    }

    /**
     * Get procedimientoHerramienta
     *
     * @return string
     */
    public function getProcedimientoHerramienta()
    {
        return $this->procedimientoHerramienta;
    }

    /**
     * Set herramientaEfectiva
     *
     * @param string $herramientaEfectiva
     *
     * @return FtControlRiesgos
     */
    public function setHerramientaEfectiva($herramientaEfectiva)
    {
        $this->herramientaEfectiva = $herramientaEfectiva;

        return $this;
    }

    /**
     * Get herramientaEfectiva
     *
     * @return string
     */
    public function getHerramientaEfectiva()
    {
        return $this->herramientaEfectiva;
    }

    /**
     * Set responsablesEjecucion
     *
     * @param string $responsablesEjecucion
     *
     * @return FtControlRiesgos
     */
    public function setResponsablesEjecucion($responsablesEjecucion)
    {
        $this->responsablesEjecucion = $responsablesEjecucion;

        return $this;
    }

    /**
     * Get responsablesEjecucion
     *
     * @return string
     */
    public function getResponsablesEjecucion()
    {
        return $this->responsablesEjecucion;
    }

    /**
     * Set frecuenciaEjecucion
     *
     * @param string $frecuenciaEjecucion
     *
     * @return FtControlRiesgos
     */
    public function setFrecuenciaEjecucion($frecuenciaEjecucion)
    {
        $this->frecuenciaEjecucion = $frecuenciaEjecucion;

        return $this;
    }

    /**
     * Get frecuenciaEjecucion
     *
     * @return string
     */
    public function getFrecuenciaEjecucion()
    {
        return $this->frecuenciaEjecucion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtControlRiesgos
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtControlRiesgos
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
     * @return FtControlRiesgos
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
     * @return FtControlRiesgos
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
