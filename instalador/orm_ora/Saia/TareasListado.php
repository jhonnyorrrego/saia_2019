<?php

namespace Saia;

/**
 * TareasListado
 */
class TareasListado
{
    /**
     * @var integer
     */
    private $idtareasListado;

    /**
     * @var integer
     */
    private $listadoTareasFk;

    /**
     * @var string
     */
    private $estadoTarea;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var string
     */
    private $nombreTarea;

    /**
     * @var string
     */
    private $tipoTarea;

    /**
     * @var string
     */
    private $responsableTarea;

    /**
     * @var string
     */
    private $coParticipantes;

    /**
     * @var string
     */
    private $seguidores;

    /**
     * @var string
     */
    private $descripcionTarea;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     */
    private $fechaLimite;

    /**
     * @var string
     */
    private $prioridad;

    /**
     * @var \DateTime
     */
    private $tiempoEstimado;

    /**
     * @var string
     */
    private $enviarEmail;

    /**
     * @var integer
     */
    private $progreso;

    /**
     * @var integer
     */
    private $calificacion;

    /**
     * @var integer
     */
    private $creadorTarea;

    /**
     * @var integer
     */
    private $codPadre;

    /**
     * @var integer
     */
    private $fkTareaRecurrencia;

    /**
     * @var string
     */
    private $evaluador;

    /**
     * @var \DateTime
     */
    private $fechaPlaneada;

    /**
     * @var integer
     */
    private $generica;

    /**
     * @var integer
     */
    private $fromGenerica;

    /**
     * @var string
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

