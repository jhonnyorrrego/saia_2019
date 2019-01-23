<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoListadoTareas
 *
 * @ORM\Table(name="permiso_listado_tareas")
 * @ORM\Entity
 */
class PermisoListadoTareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_listado_tareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermisoListadoTareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_listado_tareas", type="integer", nullable=false)
     */
    private $fkListadoTareas = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha = 'CURRENT_TIMESTAMP';



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