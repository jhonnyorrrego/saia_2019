<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtMonitoreoRevision
 *
 * @ORM\Table(name="ft_monitoreo_revision", indexes={@ORM\Index(name="i_ft_monitoreo_revision_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_monitoreo_revision_riesgos_pr", columns={"ft_riesgos_proceso"}), @ORM\Index(name="i_monitoreo_revision_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtMonitoreoRevision
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_monitoreo_revision", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftMonitoreoRevision;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_monitoreo", type="date", nullable=false)
     */
    private $fechaMonitoreo;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_riesgo", type="integer", nullable=false)
     */
    private $numeroRiesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_riesgo", type="string", length=255, nullable=false)
     */
    private $nombreRiesgo;

    /**
     * @var integer
     *
     * @ORM\Column(name="cambio_identificacion", type="integer", nullable=false)
     */
    private $cambioIdentificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_cambio", type="text", length=65535, nullable=true)
     */
    private $descripcionCambio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cambios_analisis", type="integer", nullable=false)
     */
    private $cambiosAnalisis;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_analisis", type="text", length=65535, nullable=true)
     */
    private $descripcionAnalisis;

    /**
     * @var string
     *
     * @ORM\Column(name="controles_existentes", type="string", length=255, nullable=false)
     */
    private $controlesExistentes;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado_evaluacion", type="text", length=65535, nullable=false)
     */
    private $resultadoEvaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_propuestas", type="string", length=255, nullable=false)
     */
    private $accionesPropuestas;

    /**
     * @var string
     *
     * @ORM\Column(name="logros_alcanzados", type="text", length=65535, nullable=false)
     */
    private $logrosAlcanzados;

    /**
     * @var integer
     *
     * @ORM\Column(name="controles_nuevos", type="integer", nullable=false)
     */
    private $controlesNuevos;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_ncontrol", type="text", length=65535, nullable=false)
     */
    private $descripcionNcontrol;

    /**
     * @var string
     *
     * @ORM\Column(name="evidencias_adjuntas", type="string", length=255, nullable=true)
     */
    private $evidenciasAdjuntas;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_generales", type="text", length=65535, nullable=true)
     */
    private $observacionesGenerales;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_riesgos_proceso", type="integer", nullable=false)
     */
    private $ftRiesgosProceso;

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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '3258';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftMonitoreoRevision
     *
     * @return integer
     */
    public function getIdftMonitoreoRevision()
    {
        return $this->idftMonitoreoRevision;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtMonitoreoRevision
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
     * Set fechaMonitoreo
     *
     * @param \DateTime $fechaMonitoreo
     *
     * @return FtMonitoreoRevision
     */
    public function setFechaMonitoreo($fechaMonitoreo)
    {
        $this->fechaMonitoreo = $fechaMonitoreo;

        return $this;
    }

    /**
     * Get fechaMonitoreo
     *
     * @return \DateTime
     */
    public function getFechaMonitoreo()
    {
        return $this->fechaMonitoreo;
    }

    /**
     * Set numeroRiesgo
     *
     * @param integer $numeroRiesgo
     *
     * @return FtMonitoreoRevision
     */
    public function setNumeroRiesgo($numeroRiesgo)
    {
        $this->numeroRiesgo = $numeroRiesgo;

        return $this;
    }

    /**
     * Get numeroRiesgo
     *
     * @return integer
     */
    public function getNumeroRiesgo()
    {
        return $this->numeroRiesgo;
    }

    /**
     * Set nombreRiesgo
     *
     * @param string $nombreRiesgo
     *
     * @return FtMonitoreoRevision
     */
    public function setNombreRiesgo($nombreRiesgo)
    {
        $this->nombreRiesgo = $nombreRiesgo;

        return $this;
    }

    /**
     * Get nombreRiesgo
     *
     * @return string
     */
    public function getNombreRiesgo()
    {
        return $this->nombreRiesgo;
    }

    /**
     * Set cambioIdentificacion
     *
     * @param integer $cambioIdentificacion
     *
     * @return FtMonitoreoRevision
     */
    public function setCambioIdentificacion($cambioIdentificacion)
    {
        $this->cambioIdentificacion = $cambioIdentificacion;

        return $this;
    }

    /**
     * Get cambioIdentificacion
     *
     * @return integer
     */
    public function getCambioIdentificacion()
    {
        return $this->cambioIdentificacion;
    }

    /**
     * Set descripcionCambio
     *
     * @param string $descripcionCambio
     *
     * @return FtMonitoreoRevision
     */
    public function setDescripcionCambio($descripcionCambio)
    {
        $this->descripcionCambio = $descripcionCambio;

        return $this;
    }

    /**
     * Get descripcionCambio
     *
     * @return string
     */
    public function getDescripcionCambio()
    {
        return $this->descripcionCambio;
    }

    /**
     * Set cambiosAnalisis
     *
     * @param integer $cambiosAnalisis
     *
     * @return FtMonitoreoRevision
     */
    public function setCambiosAnalisis($cambiosAnalisis)
    {
        $this->cambiosAnalisis = $cambiosAnalisis;

        return $this;
    }

    /**
     * Get cambiosAnalisis
     *
     * @return integer
     */
    public function getCambiosAnalisis()
    {
        return $this->cambiosAnalisis;
    }

    /**
     * Set descripcionAnalisis
     *
     * @param string $descripcionAnalisis
     *
     * @return FtMonitoreoRevision
     */
    public function setDescripcionAnalisis($descripcionAnalisis)
    {
        $this->descripcionAnalisis = $descripcionAnalisis;

        return $this;
    }

    /**
     * Get descripcionAnalisis
     *
     * @return string
     */
    public function getDescripcionAnalisis()
    {
        return $this->descripcionAnalisis;
    }

    /**
     * Set controlesExistentes
     *
     * @param string $controlesExistentes
     *
     * @return FtMonitoreoRevision
     */
    public function setControlesExistentes($controlesExistentes)
    {
        $this->controlesExistentes = $controlesExistentes;

        return $this;
    }

    /**
     * Get controlesExistentes
     *
     * @return string
     */
    public function getControlesExistentes()
    {
        return $this->controlesExistentes;
    }

    /**
     * Set resultadoEvaluacion
     *
     * @param string $resultadoEvaluacion
     *
     * @return FtMonitoreoRevision
     */
    public function setResultadoEvaluacion($resultadoEvaluacion)
    {
        $this->resultadoEvaluacion = $resultadoEvaluacion;

        return $this;
    }

    /**
     * Get resultadoEvaluacion
     *
     * @return string
     */
    public function getResultadoEvaluacion()
    {
        return $this->resultadoEvaluacion;
    }

    /**
     * Set accionesPropuestas
     *
     * @param string $accionesPropuestas
     *
     * @return FtMonitoreoRevision
     */
    public function setAccionesPropuestas($accionesPropuestas)
    {
        $this->accionesPropuestas = $accionesPropuestas;

        return $this;
    }

    /**
     * Get accionesPropuestas
     *
     * @return string
     */
    public function getAccionesPropuestas()
    {
        return $this->accionesPropuestas;
    }

    /**
     * Set logrosAlcanzados
     *
     * @param string $logrosAlcanzados
     *
     * @return FtMonitoreoRevision
     */
    public function setLogrosAlcanzados($logrosAlcanzados)
    {
        $this->logrosAlcanzados = $logrosAlcanzados;

        return $this;
    }

    /**
     * Get logrosAlcanzados
     *
     * @return string
     */
    public function getLogrosAlcanzados()
    {
        return $this->logrosAlcanzados;
    }

    /**
     * Set controlesNuevos
     *
     * @param integer $controlesNuevos
     *
     * @return FtMonitoreoRevision
     */
    public function setControlesNuevos($controlesNuevos)
    {
        $this->controlesNuevos = $controlesNuevos;

        return $this;
    }

    /**
     * Get controlesNuevos
     *
     * @return integer
     */
    public function getControlesNuevos()
    {
        return $this->controlesNuevos;
    }

    /**
     * Set descripcionNcontrol
     *
     * @param string $descripcionNcontrol
     *
     * @return FtMonitoreoRevision
     */
    public function setDescripcionNcontrol($descripcionNcontrol)
    {
        $this->descripcionNcontrol = $descripcionNcontrol;

        return $this;
    }

    /**
     * Get descripcionNcontrol
     *
     * @return string
     */
    public function getDescripcionNcontrol()
    {
        return $this->descripcionNcontrol;
    }

    /**
     * Set evidenciasAdjuntas
     *
     * @param string $evidenciasAdjuntas
     *
     * @return FtMonitoreoRevision
     */
    public function setEvidenciasAdjuntas($evidenciasAdjuntas)
    {
        $this->evidenciasAdjuntas = $evidenciasAdjuntas;

        return $this;
    }

    /**
     * Get evidenciasAdjuntas
     *
     * @return string
     */
    public function getEvidenciasAdjuntas()
    {
        return $this->evidenciasAdjuntas;
    }

    /**
     * Set observacionesGenerales
     *
     * @param string $observacionesGenerales
     *
     * @return FtMonitoreoRevision
     */
    public function setObservacionesGenerales($observacionesGenerales)
    {
        $this->observacionesGenerales = $observacionesGenerales;

        return $this;
    }

    /**
     * Get observacionesGenerales
     *
     * @return string
     */
    public function getObservacionesGenerales()
    {
        return $this->observacionesGenerales;
    }

    /**
     * Set ftRiesgosProceso
     *
     * @param integer $ftRiesgosProceso
     *
     * @return FtMonitoreoRevision
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtMonitoreoRevision
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
     * @return FtMonitoreoRevision
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
     * @return FtMonitoreoRevision
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
     * @return FtMonitoreoRevision
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
     * @return FtMonitoreoRevision
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
