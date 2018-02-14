<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRiesgosProceso
 *
 * @ORM\Table(name="ft_riesgos_proceso", indexes={@ORM\Index(name="i_riesgos_proceso_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_riesgos_proceso_proceso", columns={"ft_proceso"}), @ORM\Index(name="i_riesgos_proceso_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtRiesgosProceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_riesgos_proceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRiesgosProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="riesgo_antiguo", type="string", length=5, nullable=true)
     */
    private $riesgoAntiguo = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_riesgo", type="date", nullable=false)
     */
    private $fechaRiesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1042';

    /**
     * @var integer
     *
     * @ORM\Column(name="consecutivo", type="integer", nullable=false)
     */
    private $consecutivo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", length=65535, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="area_responsable", type="string", length=255, nullable=false)
     */
    private $areaResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="riesgo", type="string", length=255, nullable=false)
     */
    private $riesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="controles", type="string", length=255, nullable=true)
     */
    private $controles;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_riesgo", type="string", length=255, nullable=false)
     */
    private $tipoRiesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="fuente_causa", type="text", length=65535, nullable=false)
     */
    private $fuenteCausa;

    /**
     * @var string
     *
     * @ORM\Column(name="consecuencia", type="text", length=65535, nullable=false)
     */
    private $consecuencia;

    /**
     * @var string
     *
     * @ORM\Column(name="opciones_manejo", type="string", length=255, nullable=true)
     */
    private $opcionesManejo = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="acciones", type="text", length=65535, nullable=true)
     */
    private $acciones;

    /**
     * @var string
     *
     * @ORM\Column(name="responsables", type="string", length=255, nullable=true)
     */
    private $responsables;

    /**
     * @var string
     *
     * @ORM\Column(name="probabilidad", type="string", length=255, nullable=false)
     */
    private $probabilidad = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="indicador", type="text", length=65535, nullable=true)
     */
    private $indicador;

    /**
     * @var string
     *
     * @ORM\Column(name="cronograma", type="text", length=65535, nullable=true)
     */
    private $cronograma;

    /**
     * @var string
     *
     * @ORM\Column(name="impacto", type="string", length=255, nullable=true)
     */
    private $impacto;

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
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="from_riesgos", type="integer", nullable=true)
     */
    private $fromRiesgos;



    /**
     * Get idftRiesgosProceso
     *
     * @return integer
     */
    public function getIdftRiesgosProceso()
    {
        return $this->idftRiesgosProceso;
    }

    /**
     * Set riesgoAntiguo
     *
     * @param string $riesgoAntiguo
     *
     * @return FtRiesgosProceso
     */
    public function setRiesgoAntiguo($riesgoAntiguo)
    {
        $this->riesgoAntiguo = $riesgoAntiguo;

        return $this;
    }

    /**
     * Get riesgoAntiguo
     *
     * @return string
     */
    public function getRiesgoAntiguo()
    {
        return $this->riesgoAntiguo;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtRiesgosProceso
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
     * Set fechaRiesgo
     *
     * @param \DateTime $fechaRiesgo
     *
     * @return FtRiesgosProceso
     */
    public function setFechaRiesgo($fechaRiesgo)
    {
        $this->fechaRiesgo = $fechaRiesgo;

        return $this;
    }

    /**
     * Get fechaRiesgo
     *
     * @return \DateTime
     */
    public function getFechaRiesgo()
    {
        return $this->fechaRiesgo;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtRiesgosProceso
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRiesgosProceso
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
     * Set consecutivo
     *
     * @param integer $consecutivo
     *
     * @return FtRiesgosProceso
     */
    public function setConsecutivo($consecutivo)
    {
        $this->consecutivo = $consecutivo;

        return $this;
    }

    /**
     * Get consecutivo
     *
     * @return integer
     */
    public function getConsecutivo()
    {
        return $this->consecutivo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtRiesgosProceso
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set areaResponsable
     *
     * @param string $areaResponsable
     *
     * @return FtRiesgosProceso
     */
    public function setAreaResponsable($areaResponsable)
    {
        $this->areaResponsable = $areaResponsable;

        return $this;
    }

    /**
     * Get areaResponsable
     *
     * @return string
     */
    public function getAreaResponsable()
    {
        return $this->areaResponsable;
    }

    /**
     * Set riesgo
     *
     * @param string $riesgo
     *
     * @return FtRiesgosProceso
     */
    public function setRiesgo($riesgo)
    {
        $this->riesgo = $riesgo;

        return $this;
    }

    /**
     * Get riesgo
     *
     * @return string
     */
    public function getRiesgo()
    {
        return $this->riesgo;
    }

    /**
     * Set controles
     *
     * @param string $controles
     *
     * @return FtRiesgosProceso
     */
    public function setControles($controles)
    {
        $this->controles = $controles;

        return $this;
    }

    /**
     * Get controles
     *
     * @return string
     */
    public function getControles()
    {
        return $this->controles;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtRiesgosProceso
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
     * Set tipoRiesgo
     *
     * @param string $tipoRiesgo
     *
     * @return FtRiesgosProceso
     */
    public function setTipoRiesgo($tipoRiesgo)
    {
        $this->tipoRiesgo = $tipoRiesgo;

        return $this;
    }

    /**
     * Get tipoRiesgo
     *
     * @return string
     */
    public function getTipoRiesgo()
    {
        return $this->tipoRiesgo;
    }

    /**
     * Set fuenteCausa
     *
     * @param string $fuenteCausa
     *
     * @return FtRiesgosProceso
     */
    public function setFuenteCausa($fuenteCausa)
    {
        $this->fuenteCausa = $fuenteCausa;

        return $this;
    }

    /**
     * Get fuenteCausa
     *
     * @return string
     */
    public function getFuenteCausa()
    {
        return $this->fuenteCausa;
    }

    /**
     * Set consecuencia
     *
     * @param string $consecuencia
     *
     * @return FtRiesgosProceso
     */
    public function setConsecuencia($consecuencia)
    {
        $this->consecuencia = $consecuencia;

        return $this;
    }

    /**
     * Get consecuencia
     *
     * @return string
     */
    public function getConsecuencia()
    {
        return $this->consecuencia;
    }

    /**
     * Set opcionesManejo
     *
     * @param string $opcionesManejo
     *
     * @return FtRiesgosProceso
     */
    public function setOpcionesManejo($opcionesManejo)
    {
        $this->opcionesManejo = $opcionesManejo;

        return $this;
    }

    /**
     * Get opcionesManejo
     *
     * @return string
     */
    public function getOpcionesManejo()
    {
        return $this->opcionesManejo;
    }

    /**
     * Set acciones
     *
     * @param string $acciones
     *
     * @return FtRiesgosProceso
     */
    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;

        return $this;
    }

    /**
     * Get acciones
     *
     * @return string
     */
    public function getAcciones()
    {
        return $this->acciones;
    }

    /**
     * Set responsables
     *
     * @param string $responsables
     *
     * @return FtRiesgosProceso
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
     * Set probabilidad
     *
     * @param string $probabilidad
     *
     * @return FtRiesgosProceso
     */
    public function setProbabilidad($probabilidad)
    {
        $this->probabilidad = $probabilidad;

        return $this;
    }

    /**
     * Get probabilidad
     *
     * @return string
     */
    public function getProbabilidad()
    {
        return $this->probabilidad;
    }

    /**
     * Set indicador
     *
     * @param string $indicador
     *
     * @return FtRiesgosProceso
     */
    public function setIndicador($indicador)
    {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return string
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * Set cronograma
     *
     * @param string $cronograma
     *
     * @return FtRiesgosProceso
     */
    public function setCronograma($cronograma)
    {
        $this->cronograma = $cronograma;

        return $this;
    }

    /**
     * Get cronograma
     *
     * @return string
     */
    public function getCronograma()
    {
        return $this->cronograma;
    }

    /**
     * Set impacto
     *
     * @param string $impacto
     *
     * @return FtRiesgosProceso
     */
    public function setImpacto($impacto)
    {
        $this->impacto = $impacto;

        return $this;
    }

    /**
     * Get impacto
     *
     * @return string
     */
    public function getImpacto()
    {
        return $this->impacto;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtRiesgosProceso
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
     * @return FtRiesgosProceso
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRiesgosProceso
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
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtRiesgosProceso
     */
    public function setFtProceso($ftProceso)
    {
        $this->ftProceso = $ftProceso;

        return $this;
    }

    /**
     * Get ftProceso
     *
     * @return integer
     */
    public function getFtProceso()
    {
        return $this->ftProceso;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRiesgosProceso
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

    /**
     * Set fromRiesgos
     *
     * @param integer $fromRiesgos
     *
     * @return FtRiesgosProceso
     */
    public function setFromRiesgos($fromRiesgos)
    {
        $this->fromRiesgos = $fromRiesgos;

        return $this;
    }

    /**
     * Get fromRiesgos
     *
     * @return integer
     */
    public function getFromRiesgos()
    {
        return $this->fromRiesgos;
    }
}
