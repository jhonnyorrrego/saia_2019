<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListado
 *
 * @ORM\Table(name="tareas_listado")
 * @ORM\Entity
 */
class TareasListado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="listado_tareas_fk", type="integer", nullable=false)
     */
    private $listadoTareasFk;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_tarea", type="string", nullable=false)
     */
    private $estadoTarea = 'PENDIENTE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tarea", type="string", length=255, nullable=false)
     */
    private $nombreTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_tarea", type="string", length=255, nullable=false)
     */
    private $tipoTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_tarea", type="string", length=255, nullable=true)
     */
    private $responsableTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="co_participantes", type="string", length=255, nullable=true)
     */
    private $coParticipantes;

    /**
     * @var string
     *
     * @ORM\Column(name="seguidores", type="string", length=255, nullable=true)
     */
    private $seguidores;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_tarea", type="text", length=65535, nullable=true)
     */
    private $descripcionTarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=true)
     */
    private $fechaLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=255, nullable=true)
     */
    private $prioridad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_estimado", type="time", nullable=true)
     */
    private $tiempoEstimado;

    /**
     * @var string
     *
     * @ORM\Column(name="enviar_email", type="string", length=255, nullable=true)
     */
    private $enviarEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="progreso", type="integer", nullable=true)
     */
    private $progreso = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion", type="integer", nullable=true)
     */
    private $calificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="creador_tarea", type="integer", nullable=true)
     */
    private $creadorTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=false)
     */
    private $codPadre = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tarea_recurrencia", type="integer", nullable=true)
     */
    private $fkTareaRecurrencia;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluador", type="string", length=255, nullable=true)
     */
    private $evaluador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_planeada", type="datetime", nullable=true)
     */
    private $fechaPlaneada;

    /**
     * @var integer
     *
     * @ORM\Column(name="generica", type="integer", nullable=true)
     */
    private $generica = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="from_generica", type="integer", nullable=true)
     */
    private $fromGenerica = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="info_recurrencia", type="text", length=65535, nullable=true)
     */
    private $infoRecurrencia;



    /**
     * Get idtareasListado
     *
     * @return integer
     */
    public function getIdtareasListado()
    {
        return $this->idtareasListado;
    }

    /**
     * Set listadoTareasFk
     *
     * @param integer $listadoTareasFk
     *
     * @return TareasListado
     */
    public function setListadoTareasFk($listadoTareasFk)
    {
        $this->listadoTareasFk = $listadoTareasFk;

        return $this;
    }

    /**
     * Get listadoTareasFk
     *
     * @return integer
     */
    public function getListadoTareasFk()
    {
        return $this->listadoTareasFk;
    }

    /**
     * Set estadoTarea
     *
     * @param string $estadoTarea
     *
     * @return TareasListado
     */
    public function setEstadoTarea($estadoTarea)
    {
        $this->estadoTarea = $estadoTarea;

        return $this;
    }

    /**
     * Get estadoTarea
     *
     * @return string
     */
    public function getEstadoTarea()
    {
        return $this->estadoTarea;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return TareasListado
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set nombreTarea
     *
     * @param string $nombreTarea
     *
     * @return TareasListado
     */
    public function setNombreTarea($nombreTarea)
    {
        $this->nombreTarea = $nombreTarea;

        return $this;
    }

    /**
     * Get nombreTarea
     *
     * @return string
     */
    public function getNombreTarea()
    {
        return $this->nombreTarea;
    }

    /**
     * Set tipoTarea
     *
     * @param string $tipoTarea
     *
     * @return TareasListado
     */
    public function setTipoTarea($tipoTarea)
    {
        $this->tipoTarea = $tipoTarea;

        return $this;
    }

    /**
     * Get tipoTarea
     *
     * @return string
     */
    public function getTipoTarea()
    {
        return $this->tipoTarea;
    }

    /**
     * Set responsableTarea
     *
     * @param string $responsableTarea
     *
     * @return TareasListado
     */
    public function setResponsableTarea($responsableTarea)
    {
        $this->responsableTarea = $responsableTarea;

        return $this;
    }

    /**
     * Get responsableTarea
     *
     * @return string
     */
    public function getResponsableTarea()
    {
        return $this->responsableTarea;
    }

    /**
     * Set coParticipantes
     *
     * @param string $coParticipantes
     *
     * @return TareasListado
     */
    public function setCoParticipantes($coParticipantes)
    {
        $this->coParticipantes = $coParticipantes;

        return $this;
    }

    /**
     * Get coParticipantes
     *
     * @return string
     */
    public function getCoParticipantes()
    {
        return $this->coParticipantes;
    }

    /**
     * Set seguidores
     *
     * @param string $seguidores
     *
     * @return TareasListado
     */
    public function setSeguidores($seguidores)
    {
        $this->seguidores = $seguidores;

        return $this;
    }

    /**
     * Get seguidores
     *
     * @return string
     */
    public function getSeguidores()
    {
        return $this->seguidores;
    }

    /**
     * Set descripcionTarea
     *
     * @param string $descripcionTarea
     *
     * @return TareasListado
     */
    public function setDescripcionTarea($descripcionTarea)
    {
        $this->descripcionTarea = $descripcionTarea;

        return $this;
    }

    /**
     * Get descripcionTarea
     *
     * @return string
     */
    public function getDescripcionTarea()
    {
        return $this->descripcionTarea;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return TareasListado
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaLimite
     *
     * @param \DateTime $fechaLimite
     *
     * @return TareasListado
     */
    public function setFechaLimite($fechaLimite)
    {
        $this->fechaLimite = $fechaLimite;

        return $this;
    }

    /**
     * Get fechaLimite
     *
     * @return \DateTime
     */
    public function getFechaLimite()
    {
        return $this->fechaLimite;
    }

    /**
     * Set prioridad
     *
     * @param string $prioridad
     *
     * @return TareasListado
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return string
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set tiempoEstimado
     *
     * @param \DateTime $tiempoEstimado
     *
     * @return TareasListado
     */
    public function setTiempoEstimado($tiempoEstimado)
    {
        $this->tiempoEstimado = $tiempoEstimado;

        return $this;
    }

    /**
     * Get tiempoEstimado
     *
     * @return \DateTime
     */
    public function getTiempoEstimado()
    {
        return $this->tiempoEstimado;
    }

    /**
     * Set enviarEmail
     *
     * @param string $enviarEmail
     *
     * @return TareasListado
     */
    public function setEnviarEmail($enviarEmail)
    {
        $this->enviarEmail = $enviarEmail;

        return $this;
    }

    /**
     * Get enviarEmail
     *
     * @return string
     */
    public function getEnviarEmail()
    {
        return $this->enviarEmail;
    }

    /**
     * Set progreso
     *
     * @param integer $progreso
     *
     * @return TareasListado
     */
    public function setProgreso($progreso)
    {
        $this->progreso = $progreso;

        return $this;
    }

    /**
     * Get progreso
     *
     * @return integer
     */
    public function getProgreso()
    {
        return $this->progreso;
    }

    /**
     * Set calificacion
     *
     * @param integer $calificacion
     *
     * @return TareasListado
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return integer
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set creadorTarea
     *
     * @param integer $creadorTarea
     *
     * @return TareasListado
     */
    public function setCreadorTarea($creadorTarea)
    {
        $this->creadorTarea = $creadorTarea;

        return $this;
    }

    /**
     * Get creadorTarea
     *
     * @return integer
     */
    public function getCreadorTarea()
    {
        return $this->creadorTarea;
    }

    /**
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return TareasListado
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return integer
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set fkTareaRecurrencia
     *
     * @param integer $fkTareaRecurrencia
     *
     * @return TareasListado
     */
    public function setFkTareaRecurrencia($fkTareaRecurrencia)
    {
        $this->fkTareaRecurrencia = $fkTareaRecurrencia;

        return $this;
    }

    /**
     * Get fkTareaRecurrencia
     *
     * @return integer
     */
    public function getFkTareaRecurrencia()
    {
        return $this->fkTareaRecurrencia;
    }

    /**
     * Set evaluador
     *
     * @param string $evaluador
     *
     * @return TareasListado
     */
    public function setEvaluador($evaluador)
    {
        $this->evaluador = $evaluador;

        return $this;
    }

    /**
     * Get evaluador
     *
     * @return string
     */
    public function getEvaluador()
    {
        return $this->evaluador;
    }

    /**
     * Set fechaPlaneada
     *
     * @param \DateTime $fechaPlaneada
     *
     * @return TareasListado
     */
    public function setFechaPlaneada($fechaPlaneada)
    {
        $this->fechaPlaneada = $fechaPlaneada;

        return $this;
    }

    /**
     * Get fechaPlaneada
     *
     * @return \DateTime
     */
    public function getFechaPlaneada()
    {
        return $this->fechaPlaneada;
    }

    /**
     * Set generica
     *
     * @param integer $generica
     *
     * @return TareasListado
     */
    public function setGenerica($generica)
    {
        $this->generica = $generica;

        return $this;
    }

    /**
     * Get generica
     *
     * @return integer
     */
    public function getGenerica()
    {
        return $this->generica;
    }

    /**
     * Set fromGenerica
     *
     * @param integer $fromGenerica
     *
     * @return TareasListado
     */
    public function setFromGenerica($fromGenerica)
    {
        $this->fromGenerica = $fromGenerica;

        return $this;
    }

    /**
     * Get fromGenerica
     *
     * @return integer
     */
    public function getFromGenerica()
    {
        return $this->fromGenerica;
    }

    /**
     * Set infoRecurrencia
     *
     * @param string $infoRecurrencia
     *
     * @return TareasListado
     */
    public function setInfoRecurrencia($infoRecurrencia)
    {
        $this->infoRecurrencia = $infoRecurrencia;

        return $this;
    }

    /**
     * Get infoRecurrencia
     *
     * @return string
     */
    public function getInfoRecurrencia()
    {
        return $this->infoRecurrencia;
    }
}
