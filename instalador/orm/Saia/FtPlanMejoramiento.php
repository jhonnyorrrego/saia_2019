<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPlanMejoramiento
 *
 * @ORM\Table(name="ft_plan_mejoramiento", indexes={@ORM\Index(name="i_plan_mejoramiento_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_plan_mejoramiento_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPlanMejoramiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_plan_mejoramiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPlanMejoramiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_terminado", type="string", length=5, nullable=true)
     */
    private $estadoTerminado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_elaborado", type="datetime", nullable=true)
     */
    private $fechaElaborado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobado", type="datetime", nullable=true)
     */
    private $fechaAprobado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revisado", type="datetime", nullable=true)
     */
    private $fechaRevisado;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_plan", type="string", length=10, nullable=false)
     */
    private $tipoPlan;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_suscripcion", type="date", nullable=false)
     */
    private $fechaSuscripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_informe", type="date", nullable=false)
     */
    private $fechaInforme;

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntos", type="string", length=255, nullable=true)
     */
    private $adjuntos;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_auditoria", type="string", length=255, nullable=false)
     */
    private $tipoAuditoria = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="auditor", type="string", length=255, nullable=false)
     */
    private $auditor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_otros", type="text", length=65535, nullable=true)
     */
    private $descripcionOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_plan", type="text", length=65535, nullable=false)
     */
    private $descripcionPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_plan_mejoramiento", type="string", length=255, nullable=true)
     */
    private $estadoPlanMejoramiento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50, nullable=false)
     */
    private $estado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="periodo_evaluado", type="string", length=255, nullable=false)
     */
    private $periodoEvaluado;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", length=65535, nullable=false)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos_especificos", type="text", length=65535, nullable=false)
     */
    private $objetivosEspecificos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="elaborado", type="string", length=255, nullable=false)
     */
    private $elaborado;

    /**
     * @var string
     *
     * @ORM\Column(name="revisado", type="string", length=255, nullable=false)
     */
    private $revisado;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado", type="string", length=255, nullable=false)
     */
    private $aprobado;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=true)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1054';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftPlanMejoramiento
     *
     * @return integer
     */
    public function getIdftPlanMejoramiento()
    {
        return $this->idftPlanMejoramiento;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtPlanMejoramiento
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
     * Set estadoTerminado
     *
     * @param string $estadoTerminado
     *
     * @return FtPlanMejoramiento
     */
    public function setEstadoTerminado($estadoTerminado)
    {
        $this->estadoTerminado = $estadoTerminado;

        return $this;
    }

    /**
     * Get estadoTerminado
     *
     * @return string
     */
    public function getEstadoTerminado()
    {
        return $this->estadoTerminado;
    }

    /**
     * Set fechaElaborado
     *
     * @param \DateTime $fechaElaborado
     *
     * @return FtPlanMejoramiento
     */
    public function setFechaElaborado($fechaElaborado)
    {
        $this->fechaElaborado = $fechaElaborado;

        return $this;
    }

    /**
     * Get fechaElaborado
     *
     * @return \DateTime
     */
    public function getFechaElaborado()
    {
        return $this->fechaElaborado;
    }

    /**
     * Set fechaAprobado
     *
     * @param \DateTime $fechaAprobado
     *
     * @return FtPlanMejoramiento
     */
    public function setFechaAprobado($fechaAprobado)
    {
        $this->fechaAprobado = $fechaAprobado;

        return $this;
    }

    /**
     * Get fechaAprobado
     *
     * @return \DateTime
     */
    public function getFechaAprobado()
    {
        return $this->fechaAprobado;
    }

    /**
     * Set fechaRevisado
     *
     * @param \DateTime $fechaRevisado
     *
     * @return FtPlanMejoramiento
     */
    public function setFechaRevisado($fechaRevisado)
    {
        $this->fechaRevisado = $fechaRevisado;

        return $this;
    }

    /**
     * Get fechaRevisado
     *
     * @return \DateTime
     */
    public function getFechaRevisado()
    {
        return $this->fechaRevisado;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtPlanMejoramiento
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
     * Set tipoPlan
     *
     * @param string $tipoPlan
     *
     * @return FtPlanMejoramiento
     */
    public function setTipoPlan($tipoPlan)
    {
        $this->tipoPlan = $tipoPlan;

        return $this;
    }

    /**
     * Get tipoPlan
     *
     * @return string
     */
    public function getTipoPlan()
    {
        return $this->tipoPlan;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPlanMejoramiento
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
     * Set fechaSuscripcion
     *
     * @param \DateTime $fechaSuscripcion
     *
     * @return FtPlanMejoramiento
     */
    public function setFechaSuscripcion($fechaSuscripcion)
    {
        $this->fechaSuscripcion = $fechaSuscripcion;

        return $this;
    }

    /**
     * Get fechaSuscripcion
     *
     * @return \DateTime
     */
    public function getFechaSuscripcion()
    {
        return $this->fechaSuscripcion;
    }

    /**
     * Set fechaInforme
     *
     * @param \DateTime $fechaInforme
     *
     * @return FtPlanMejoramiento
     */
    public function setFechaInforme($fechaInforme)
    {
        $this->fechaInforme = $fechaInforme;

        return $this;
    }

    /**
     * Get fechaInforme
     *
     * @return \DateTime
     */
    public function getFechaInforme()
    {
        return $this->fechaInforme;
    }

    /**
     * Set adjuntos
     *
     * @param string $adjuntos
     *
     * @return FtPlanMejoramiento
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
     * Set tipoAuditoria
     *
     * @param string $tipoAuditoria
     *
     * @return FtPlanMejoramiento
     */
    public function setTipoAuditoria($tipoAuditoria)
    {
        $this->tipoAuditoria = $tipoAuditoria;

        return $this;
    }

    /**
     * Get tipoAuditoria
     *
     * @return string
     */
    public function getTipoAuditoria()
    {
        return $this->tipoAuditoria;
    }

    /**
     * Set auditor
     *
     * @param string $auditor
     *
     * @return FtPlanMejoramiento
     */
    public function setAuditor($auditor)
    {
        $this->auditor = $auditor;

        return $this;
    }

    /**
     * Get auditor
     *
     * @return string
     */
    public function getAuditor()
    {
        return $this->auditor;
    }

    /**
     * Set descripcionOtros
     *
     * @param string $descripcionOtros
     *
     * @return FtPlanMejoramiento
     */
    public function setDescripcionOtros($descripcionOtros)
    {
        $this->descripcionOtros = $descripcionOtros;

        return $this;
    }

    /**
     * Get descripcionOtros
     *
     * @return string
     */
    public function getDescripcionOtros()
    {
        return $this->descripcionOtros;
    }

    /**
     * Set descripcionPlan
     *
     * @param string $descripcionPlan
     *
     * @return FtPlanMejoramiento
     */
    public function setDescripcionPlan($descripcionPlan)
    {
        $this->descripcionPlan = $descripcionPlan;

        return $this;
    }

    /**
     * Get descripcionPlan
     *
     * @return string
     */
    public function getDescripcionPlan()
    {
        return $this->descripcionPlan;
    }

    /**
     * Set estadoPlanMejoramiento
     *
     * @param string $estadoPlanMejoramiento
     *
     * @return FtPlanMejoramiento
     */
    public function setEstadoPlanMejoramiento($estadoPlanMejoramiento)
    {
        $this->estadoPlanMejoramiento = $estadoPlanMejoramiento;

        return $this;
    }

    /**
     * Get estadoPlanMejoramiento
     *
     * @return string
     */
    public function getEstadoPlanMejoramiento()
    {
        return $this->estadoPlanMejoramiento;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtPlanMejoramiento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set periodoEvaluado
     *
     * @param string $periodoEvaluado
     *
     * @return FtPlanMejoramiento
     */
    public function setPeriodoEvaluado($periodoEvaluado)
    {
        $this->periodoEvaluado = $periodoEvaluado;

        return $this;
    }

    /**
     * Get periodoEvaluado
     *
     * @return string
     */
    public function getPeriodoEvaluado()
    {
        return $this->periodoEvaluado;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return FtPlanMejoramiento
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set objetivosEspecificos
     *
     * @param string $objetivosEspecificos
     *
     * @return FtPlanMejoramiento
     */
    public function setObjetivosEspecificos($objetivosEspecificos)
    {
        $this->objetivosEspecificos = $objetivosEspecificos;

        return $this;
    }

    /**
     * Get objetivosEspecificos
     *
     * @return string
     */
    public function getObjetivosEspecificos()
    {
        return $this->objetivosEspecificos;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtPlanMejoramiento
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
     * Set elaborado
     *
     * @param string $elaborado
     *
     * @return FtPlanMejoramiento
     */
    public function setElaborado($elaborado)
    {
        $this->elaborado = $elaborado;

        return $this;
    }

    /**
     * Get elaborado
     *
     * @return string
     */
    public function getElaborado()
    {
        return $this->elaborado;
    }

    /**
     * Set revisado
     *
     * @param string $revisado
     *
     * @return FtPlanMejoramiento
     */
    public function setRevisado($revisado)
    {
        $this->revisado = $revisado;

        return $this;
    }

    /**
     * Get revisado
     *
     * @return string
     */
    public function getRevisado()
    {
        return $this->revisado;
    }

    /**
     * Set aprobado
     *
     * @param string $aprobado
     *
     * @return FtPlanMejoramiento
     */
    public function setAprobado($aprobado)
    {
        $this->aprobado = $aprobado;

        return $this;
    }

    /**
     * Get aprobado
     *
     * @return string
     */
    public function getAprobado()
    {
        return $this->aprobado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtPlanMejoramiento
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPlanMejoramiento
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
     * Set version
     *
     * @param integer $version
     *
     * @return FtPlanMejoramiento
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtPlanMejoramiento
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
