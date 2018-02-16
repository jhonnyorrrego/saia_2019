<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasBuzon
 *
 * @ORM\Table(name="tareas_buzon")
 * @ORM\Entity
 */
class TareasBuzon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_buzon", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasBuzon;

    /**
     * @var integer
     *
     * @ORM\Column(name="terminado_por", type="integer", nullable=false)
     */
    private $terminadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_estado", type="text", length=65535, nullable=false)
     */
    private $descripcionEstado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_estado", type="datetime", nullable=false)
     */
    private $fechaEstado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tareas_idtareas", type="integer", nullable=false)
     */
    private $tareasIdtareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';



    /**
     * Get idtareasBuzon
     *
     * @return integer
     */
    public function getIdtareasBuzon()
    {
        return $this->idtareasBuzon;
    }

    /**
     * Set terminadoPor
     *
     * @param integer $terminadoPor
     *
     * @return TareasBuzon
     */
    public function setTerminadoPor($terminadoPor)
    {
        $this->terminadoPor = $terminadoPor;

        return $this;
    }

    /**
     * Get terminadoPor
     *
     * @return integer
     */
    public function getTerminadoPor()
    {
        return $this->terminadoPor;
    }

    /**
     * Set descripcionEstado
     *
     * @param string $descripcionEstado
     *
     * @return TareasBuzon
     */
    public function setDescripcionEstado($descripcionEstado)
    {
        $this->descripcionEstado = $descripcionEstado;

        return $this;
    }

    /**
     * Get descripcionEstado
     *
     * @return string
     */
    public function getDescripcionEstado()
    {
        return $this->descripcionEstado;
    }

    /**
     * Set fechaEstado
     *
     * @param \DateTime $fechaEstado
     *
     * @return TareasBuzon
     */
    public function setFechaEstado($fechaEstado)
    {
        $this->fechaEstado = $fechaEstado;

        return $this;
    }

    /**
     * Get fechaEstado
     *
     * @return \DateTime
     */
    public function getFechaEstado()
    {
        return $this->fechaEstado;
    }

    /**
     * Set tareasIdtareas
     *
     * @param integer $tareasIdtareas
     *
     * @return TareasBuzon
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return TareasBuzon
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
}
