<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHallazgo
 *
 * @ORM\Table(name="ft_hallazgo", indexes={@ORM\Index(name="i_ft_hallazgo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_hallazgo_gestion_ca", columns={"ft_gestion_calid"}), @ORM\Index(name="i_hallazgo_plan_mejor", columns={"ft_plan_mejoramiento"}), @ORM\Index(name="i_hallazgo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtHallazgo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_hallazgo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftHallazgo;

    /**
     * @var integer
     *
     * @ORM\Column(name="notifica_cump", type="integer", nullable=true)
     */
    private $notificaCump;

    /**
     * @var integer
     *
     * @ORM\Column(name="notifica_seg", type="integer", nullable=true)
     */
    private $notificaSeg;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_gestion_calid", type="integer", nullable=true)
     */
    private $ftGestionCalid;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase_accion", type="integer", nullable=false)
     */
    private $claseAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="radicado_plan", type="string", length=20, nullable=true)
     */
    private $radicadoPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="consecutivo_hallazgo", type="string", length=255, nullable=true)
     */
    private $consecutivoHallazgo;

    /**
     * @var string
     *
     * @ORM\Column(name="procesos_vinculados", type="string", length=255, nullable=false)
     */
    private $procesosVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase_observacion", type="integer", nullable=false)
     */
    private $claseObservacion = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="deficiencia", type="text", length=65535, nullable=true)
     */
    private $deficiencia;

    /**
     * @var string
     *
     * @ORM\Column(name="correcion_hallazgo", type="text", length=65535, nullable=false)
     */
    private $correcionHallazgo;

    /**
     * @var string
     *
     * @ORM\Column(name="causas", type="text", length=65535, nullable=true)
     */
    private $causas;

    /**
     * @var string
     *
     * @ORM\Column(name="accion_mejoramiento", type="text", length=65535, nullable=false)
     */
    private $accionMejoramiento;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50, nullable=false)
     */
    private $estado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var string
     *
     * @ORM\Column(name="responsables", type="string", length=255, nullable=false)
     */
    private $responsables;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_cumplimiento", type="date", nullable=false)
     */
    private $tiempoCumplimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_seguimiento", type="date", nullable=false)
     */
    private $tiempoSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_seguimiento", type="string", length=255, nullable=false)
     */
    private $responsableSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="indicador_cumplimiento", type="text", length=65535, nullable=false)
     */
    private $indicadorCumplimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="mecanismo_interno", type="text", length=65535, nullable=false)
     */
    private $mecanismoInterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1055';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

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
     * @ORM\Column(name="ft_plan_mejoramiento", type="integer", nullable=false)
     */
    private $ftPlanMejoramiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftHallazgo
     *
     * @return integer
     */
    public function getIdftHallazgo()
    {
        return $this->idftHallazgo;
    }

    /**
     * Set notificaCump
     *
     * @param integer $notificaCump
     *
     * @return FtHallazgo
     */
    public function setNotificaCump($notificaCump)
    {
        $this->notificaCump = $notificaCump;

        return $this;
    }

    /**
     * Get notificaCump
     *
     * @return integer
     */
    public function getNotificaCump()
    {
        return $this->notificaCump;
    }

    /**
     * Set notificaSeg
     *
     * @param integer $notificaSeg
     *
     * @return FtHallazgo
     */
    public function setNotificaSeg($notificaSeg)
    {
        $this->notificaSeg = $notificaSeg;

        return $this;
    }

    /**
     * Get notificaSeg
     *
     * @return integer
     */
    public function getNotificaSeg()
    {
        return $this->notificaSeg;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtHallazgo
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
     * Set ftGestionCalid
     *
     * @param integer $ftGestionCalid
     *
     * @return FtHallazgo
     */
    public function setFtGestionCalid($ftGestionCalid)
    {
        $this->ftGestionCalid = $ftGestionCalid;

        return $this;
    }

    /**
     * Get ftGestionCalid
     *
     * @return integer
     */
    public function getFtGestionCalid()
    {
        return $this->ftGestionCalid;
    }

    /**
     * Set claseAccion
     *
     * @param integer $claseAccion
     *
     * @return FtHallazgo
     */
    public function setClaseAccion($claseAccion)
    {
        $this->claseAccion = $claseAccion;

        return $this;
    }

    /**
     * Get claseAccion
     *
     * @return integer
     */
    public function getClaseAccion()
    {
        return $this->claseAccion;
    }

    /**
     * Set radicadoPlan
     *
     * @param string $radicadoPlan
     *
     * @return FtHallazgo
     */
    public function setRadicadoPlan($radicadoPlan)
    {
        $this->radicadoPlan = $radicadoPlan;

        return $this;
    }

    /**
     * Get radicadoPlan
     *
     * @return string
     */
    public function getRadicadoPlan()
    {
        return $this->radicadoPlan;
    }

    /**
     * Set consecutivoHallazgo
     *
     * @param string $consecutivoHallazgo
     *
     * @return FtHallazgo
     */
    public function setConsecutivoHallazgo($consecutivoHallazgo)
    {
        $this->consecutivoHallazgo = $consecutivoHallazgo;

        return $this;
    }

    /**
     * Get consecutivoHallazgo
     *
     * @return string
     */
    public function getConsecutivoHallazgo()
    {
        return $this->consecutivoHallazgo;
    }

    /**
     * Set procesosVinculados
     *
     * @param string $procesosVinculados
     *
     * @return FtHallazgo
     */
    public function setProcesosVinculados($procesosVinculados)
    {
        $this->procesosVinculados = $procesosVinculados;

        return $this;
    }

    /**
     * Get procesosVinculados
     *
     * @return string
     */
    public function getProcesosVinculados()
    {
        return $this->procesosVinculados;
    }

    /**
     * Set claseObservacion
     *
     * @param integer $claseObservacion
     *
     * @return FtHallazgo
     */
    public function setClaseObservacion($claseObservacion)
    {
        $this->claseObservacion = $claseObservacion;

        return $this;
    }

    /**
     * Get claseObservacion
     *
     * @return integer
     */
    public function getClaseObservacion()
    {
        return $this->claseObservacion;
    }

    /**
     * Set deficiencia
     *
     * @param string $deficiencia
     *
     * @return FtHallazgo
     */
    public function setDeficiencia($deficiencia)
    {
        $this->deficiencia = $deficiencia;

        return $this;
    }

    /**
     * Get deficiencia
     *
     * @return string
     */
    public function getDeficiencia()
    {
        return $this->deficiencia;
    }

    /**
     * Set correcionHallazgo
     *
     * @param string $correcionHallazgo
     *
     * @return FtHallazgo
     */
    public function setCorrecionHallazgo($correcionHallazgo)
    {
        $this->correcionHallazgo = $correcionHallazgo;

        return $this;
    }

    /**
     * Get correcionHallazgo
     *
     * @return string
     */
    public function getCorrecionHallazgo()
    {
        return $this->correcionHallazgo;
    }

    /**
     * Set causas
     *
     * @param string $causas
     *
     * @return FtHallazgo
     */
    public function setCausas($causas)
    {
        $this->causas = $causas;

        return $this;
    }

    /**
     * Get causas
     *
     * @return string
     */
    public function getCausas()
    {
        return $this->causas;
    }

    /**
     * Set accionMejoramiento
     *
     * @param string $accionMejoramiento
     *
     * @return FtHallazgo
     */
    public function setAccionMejoramiento($accionMejoramiento)
    {
        $this->accionMejoramiento = $accionMejoramiento;

        return $this;
    }

    /**
     * Get accionMejoramiento
     *
     * @return string
     */
    public function getAccionMejoramiento()
    {
        return $this->accionMejoramiento;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtHallazgo
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
     * Set secretarias
     *
     * @param string $secretarias
     *
     * @return FtHallazgo
     */
    public function setSecretarias($secretarias)
    {
        $this->secretarias = $secretarias;

        return $this;
    }

    /**
     * Get secretarias
     *
     * @return string
     */
    public function getSecretarias()
    {
        return $this->secretarias;
    }

    /**
     * Set responsables
     *
     * @param string $responsables
     *
     * @return FtHallazgo
     */
    public function setResponsables($responsables)
    {
        $this->responsables = $responsables;

        return $this;
    }

    /**
     * Get responsables
     *
     * @return string
     */
    public function getResponsables()
    {
        return $this->responsables;
    }

    /**
     * Set tiempoCumplimiento
     *
     * @param \DateTime $tiempoCumplimiento
     *
     * @return FtHallazgo
     */
    public function setTiempoCumplimiento($tiempoCumplimiento)
    {
        $this->tiempoCumplimiento = $tiempoCumplimiento;

        return $this;
    }

    /**
     * Get tiempoCumplimiento
     *
     * @return \DateTime
     */
    public function getTiempoCumplimiento()
    {
        return $this->tiempoCumplimiento;
    }

    /**
     * Set tiempoSeguimiento
     *
     * @param \DateTime $tiempoSeguimiento
     *
     * @return FtHallazgo
     */
    public function setTiempoSeguimiento($tiempoSeguimiento)
    {
        $this->tiempoSeguimiento = $tiempoSeguimiento;

        return $this;
    }

    /**
     * Get tiempoSeguimiento
     *
     * @return \DateTime
     */
    public function getTiempoSeguimiento()
    {
        return $this->tiempoSeguimiento;
    }

    /**
     * Set responsableSeguimiento
     *
     * @param string $responsableSeguimiento
     *
     * @return FtHallazgo
     */
    public function setResponsableSeguimiento($responsableSeguimiento)
    {
        $this->responsableSeguimiento = $responsableSeguimiento;

        return $this;
    }

    /**
     * Get responsableSeguimiento
     *
     * @return string
     */
    public function getResponsableSeguimiento()
    {
        return $this->responsableSeguimiento;
    }

    /**
     * Set indicadorCumplimiento
     *
     * @param string $indicadorCumplimiento
     *
     * @return FtHallazgo
     */
    public function setIndicadorCumplimiento($indicadorCumplimiento)
    {
        $this->indicadorCumplimiento = $indicadorCumplimiento;

        return $this;
    }

    /**
     * Get indicadorCumplimiento
     *
     * @return string
     */
    public function getIndicadorCumplimiento()
    {
        return $this->indicadorCumplimiento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtHallazgo
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
     * Set mecanismoInterno
     *
     * @param string $mecanismoInterno
     *
     * @return FtHallazgo
     */
    public function setMecanismoInterno($mecanismoInterno)
    {
        $this->mecanismoInterno = $mecanismoInterno;

        return $this;
    }

    /**
     * Get mecanismoInterno
     *
     * @return string
     */
    public function getMecanismoInterno()
    {
        return $this->mecanismoInterno;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtHallazgo
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtHallazgo
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtHallazgo
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
     * @return FtHallazgo
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
     * Set ftPlanMejoramiento
     *
     * @param integer $ftPlanMejoramiento
     *
     * @return FtHallazgo
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtHallazgo
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
