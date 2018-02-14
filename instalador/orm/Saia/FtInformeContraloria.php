<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInformeContraloria
 *
 * @ORM\Table(name="ft_informe_contraloria", indexes={@ORM\Index(name="i_ft_informe_contraloria_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtInformeContraloria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_informe_contraloria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftInformeContraloria;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="municipio_informe", type="string", length=255, nullable=true)
     */
    private $municipioInforme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compromisos", type="date", nullable=false)
     */
    private $fechaCompromisos;

    /**
     * @var string
     *
     * @ORM\Column(name="proceso_auditado", type="text", length=65535, nullable=true)
     */
    private $procesoAuditado;

    /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento_general", type="text", length=65535, nullable=true)
     */
    private $cumplimientoGeneral;

    /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento_especificos", type="text", length=65535, nullable=true)
     */
    private $cumplimientoEspecificos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento_plan", type="string", length=255, nullable=false)
     */
    private $cumplimientoPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusiones", type="text", length=65535, nullable=true)
     */
    private $conclusiones;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_plan_mejoramiento", type="integer", nullable=false)
     */
    private $ftPlanMejoramiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="jefe_control", type="string", length=255, nullable=false)
     */
    private $jefeControl;

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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2580';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftInformeContraloria
     *
     * @return integer
     */
    public function getIdftInformeContraloria()
    {
        return $this->idftInformeContraloria;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtInformeContraloria
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
     * Set municipioInforme
     *
     * @param string $municipioInforme
     *
     * @return FtInformeContraloria
     */
    public function setMunicipioInforme($municipioInforme)
    {
        $this->municipioInforme = $municipioInforme;

        return $this;
    }

    /**
     * Get municipioInforme
     *
     * @return string
     */
    public function getMunicipioInforme()
    {
        return $this->municipioInforme;
    }

    /**
     * Set fechaCompromisos
     *
     * @param \DateTime $fechaCompromisos
     *
     * @return FtInformeContraloria
     */
    public function setFechaCompromisos($fechaCompromisos)
    {
        $this->fechaCompromisos = $fechaCompromisos;

        return $this;
    }

    /**
     * Get fechaCompromisos
     *
     * @return \DateTime
     */
    public function getFechaCompromisos()
    {
        return $this->fechaCompromisos;
    }

    /**
     * Set procesoAuditado
     *
     * @param string $procesoAuditado
     *
     * @return FtInformeContraloria
     */
    public function setProcesoAuditado($procesoAuditado)
    {
        $this->procesoAuditado = $procesoAuditado;

        return $this;
    }

    /**
     * Get procesoAuditado
     *
     * @return string
     */
    public function getProcesoAuditado()
    {
        return $this->procesoAuditado;
    }

    /**
     * Set cumplimientoGeneral
     *
     * @param string $cumplimientoGeneral
     *
     * @return FtInformeContraloria
     */
    public function setCumplimientoGeneral($cumplimientoGeneral)
    {
        $this->cumplimientoGeneral = $cumplimientoGeneral;

        return $this;
    }

    /**
     * Get cumplimientoGeneral
     *
     * @return string
     */
    public function getCumplimientoGeneral()
    {
        return $this->cumplimientoGeneral;
    }

    /**
     * Set cumplimientoEspecificos
     *
     * @param string $cumplimientoEspecificos
     *
     * @return FtInformeContraloria
     */
    public function setCumplimientoEspecificos($cumplimientoEspecificos)
    {
        $this->cumplimientoEspecificos = $cumplimientoEspecificos;

        return $this;
    }

    /**
     * Get cumplimientoEspecificos
     *
     * @return string
     */
    public function getCumplimientoEspecificos()
    {
        return $this->cumplimientoEspecificos;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtInformeContraloria
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
     * Set cumplimientoPlan
     *
     * @param string $cumplimientoPlan
     *
     * @return FtInformeContraloria
     */
    public function setCumplimientoPlan($cumplimientoPlan)
    {
        $this->cumplimientoPlan = $cumplimientoPlan;

        return $this;
    }

    /**
     * Get cumplimientoPlan
     *
     * @return string
     */
    public function getCumplimientoPlan()
    {
        return $this->cumplimientoPlan;
    }

    /**
     * Set conclusiones
     *
     * @param string $conclusiones
     *
     * @return FtInformeContraloria
     */
    public function setConclusiones($conclusiones)
    {
        $this->conclusiones = $conclusiones;

        return $this;
    }

    /**
     * Get conclusiones
     *
     * @return string
     */
    public function getConclusiones()
    {
        return $this->conclusiones;
    }

    /**
     * Set ftPlanMejoramiento
     *
     * @param integer $ftPlanMejoramiento
     *
     * @return FtInformeContraloria
     */
    public function setFtPlanMejoramiento($ftPlanMejoramiento)
    {
        $this->ftPlanMejoramiento = $ftPlanMejoramiento;

        return $this;
    }

    /**
     * Get ftPlanMejoramiento
     *
     * @return integer
     */
    public function getFtPlanMejoramiento()
    {
        return $this->ftPlanMejoramiento;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtInformeContraloria
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
     * Set jefeControl
     *
     * @param string $jefeControl
     *
     * @return FtInformeContraloria
     */
    public function setJefeControl($jefeControl)
    {
        $this->jefeControl = $jefeControl;

        return $this;
    }

    /**
     * Get jefeControl
     *
     * @return string
     */
    public function getJefeControl()
    {
        return $this->jefeControl;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtInformeContraloria
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
     * @return FtInformeContraloria
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInformeContraloria
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
     * @param integer $estadoDocumento
     *
     * @return FtInformeContraloria
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
