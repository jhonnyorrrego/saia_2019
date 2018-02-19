<?php

namespace Saia;

/**
 * PermisoListadoTareas
 */
class PermisoListadoTareas
{
    /**
     * @var integer
     */
    private $idpermisoListadoTareas;

    /**
     * @var integer
     */
    private $entidadIdentidad;

    /**
     * @var integer
     */
    private $fkListadoTareas;

    /**
     * @var integer
     */
    private $llaveEntidad;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get idpermisoListadoTareas
     *
     * @return integer
     */
    public function getIdpermisoListadoTareas()
    {
        return $this->idpermisoListadoTareas;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return PermisoListadoTareas
     */
    public function setEntidadIdentidad($entidadIdentidad)
    {
        $this->entidadIdentidad = $entidadIdentidad;

        return $this;
    }

    /**
     * Get entidadIdentidad
     *
     * @return integer
     */
    public function getEntidadIdentidad()
    {
        return $this->entidadIdentidad;
    }

    /**
     * Set fkListadoTareas
     *
     * @param integer $fkListadoTareas
     *
     * @return PermisoListadoTareas
     */
    public function setFkListadoTareas($fkListadoTareas)
    {
        $this->fkListadoTareas = $fkListadoTareas;

        return $this;
    }

    /**
     * Get fkListadoTareas
     *
     * @return integer
     */
    public function getFkListadoTareas()
    {
        return $this->fkListadoTareas;
    }

    /**
     * Set llaveEntidad
     *
     * @param integer $llaveEntidad
     *
     * @return PermisoListadoTareas
     */
    public function setLlaveEntidad($llaveEntidad)
    {
        $this->llaveEntidad = $llaveEntidad;

        return $this;
    }

    /**
     * Get llaveEntidad
     *
     * @return integer
     */
    public function getLlaveEntidad()
    {
        return $this->llaveEntidad;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return PermisoListadoTareas
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PermisoListadoTareas
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
}

