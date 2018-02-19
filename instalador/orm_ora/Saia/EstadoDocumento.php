<?php

namespace Saia;

/**
 * EstadoDocumento
 */
class EstadoDocumento
{
    /**
     * @var integer
     */
    private $idestadoDocumento;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var integer
     */
    private $enUso;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idestadoDocumento
     *
     * @return integer
     */
    public function getIdestadoDocumento()
    {
        return $this->idestadoDocumento;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return EstadoDocumento
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
     * Set enUso
     *
     * @param integer $enUso
     *
     * @return EstadoDocumento
     */
    public function setEnUso($enUso)
    {
        $this->enUso = $enUso;

        return $this;
    }

    /**
     * Get enUso
     *
     * @return integer
     */
    public function getEnUso()
    {
        return $this->enUso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return EstadoDocumento
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
}

