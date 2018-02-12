<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tareas
 *
 * @ORM\Table(name="tareas", indexes={@ORM\Index(name="i_tareas_documento_", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Tareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=255, nullable=false)
     */
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=255, nullable=false)
     */
    private $prioridad = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_tarea", type="date", nullable=false)
     */
    private $fechaTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor", type="integer", nullable=false)
     */
    private $ejecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_tarea", type="integer", nullable=false)
     */
    private $estadoTarea = '0';



    /**
     * Get idtareas
     *
     * @return integer
     */
    public function getIdtareas()
    {
        return $this->idtareas;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Tareas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     *
     * @return Tareas
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Tareas
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tareas
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
     * Set prioridad
     *
     * @param string $prioridad
     *
     * @return Tareas
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
     * Set fechaTarea
     *
     * @param \DateTime $fechaTarea
     *
     * @return Tareas
     */
    public function setFechaTarea($fechaTarea)
    {
        $this->fechaTarea = $fechaTarea;

        return $this;
    }

    /**
     * Get fechaTarea
     *
     * @return \DateTime
     */
    public function getFechaTarea()
    {
        return $this->fechaTarea;
    }

    /**
     * Set ejecutor
     *
     * @param integer $ejecutor
     *
     * @return Tareas
     */
    public function setEjecutor($ejecutor)
    {
        $this->ejecutor = $ejecutor;

        return $this;
    }

    /**
     * Get ejecutor
     *
     * @return integer
     */
    public function getEjecutor()
    {
        return $this->ejecutor;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Tareas
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
     * Set estadoTarea
     *
     * @param integer $estadoTarea
     *
     * @return Tareas
     */
    public function setEstadoTarea($estadoTarea)
    {
        $this->estadoTarea = $estadoTarea;

        return $this;
    }

    /**
     * Get estadoTarea
     *
     * @return integer
     */
    public function getEstadoTarea()
    {
        return $this->estadoTarea;
    }
}
