<?php

namespace Saia;

/**
 * TareasAvance
 */
class TareasAvance
{
    /**
     * @var integer
     */
    private $idtareasAvance;

    /**
     * @var integer
     */
    private $tareasIdtareas;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var integer
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

