<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasAvance
 *
 * @ORM\Table(name="tareas_avance", indexes={@ORM\Index(name="i_tareas_avanc_ejecutor", columns={"ejecutor"})})
 * @ORM\Entity
 */
class TareasAvance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_avance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasAvance;

    /**
     * @var integer
     *
     * @ORM\Column(name="tareas_idtareas", type="integer", nullable=false)
     */
    private $tareasIdtareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor", type="integer", nullable=false)
     */
    private $ejecutor;



    /**
     * Get idtareasAvance
     *
     * @return integer
     */
    public function getIdtareasAvance()
    {
        return $this->idtareasAvance;
    }

    /**
     * Set tareasIdtareas
     *
     * @param integer $tareasIdtareas
     *
     * @return TareasAvance
     */
    public function setTareasIdtareas($tareasIdtareas)
    {
        $this->tareasIdtareas = $tareasIdtareas;

        return $this;
    }

    /**
     * Get tareasIdtareas
     *
     * @return integer
     */
    public function getTareasIdtareas()
    {
        return $this->tareasIdtareas;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TareasAvance
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TareasAvance
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return TareasAvance
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ejecutor
     *
     * @param integer $ejecutor
     *
     * @return TareasAvance
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
}
