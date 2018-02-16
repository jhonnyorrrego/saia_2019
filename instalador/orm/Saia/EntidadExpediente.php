<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadExpediente
 *
 * @ORM\Table(name="entidad_expediente", indexes={@ORM\Index(name="expediente_idexpediente", columns={"expediente_idexpediente"}), @ORM\Index(name="llave_entidad", columns={"llave_entidad"}), @ORM\Index(name="llave_entidad_2", columns={"llave_entidad"})})
 * @ORM\Entity
 */
class EntidadExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_expediente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identidadExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente = '0';

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
     * @var string
     *
     * @ORM\Column(name="permiso", type="string", length=255, nullable=true)
     */
    private $permiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;



    /**
     * Get identidadExpediente
     *
     * @return integer
     */
    public function getIdentidadExpediente()
    {
        return $this->identidadExpediente;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return EntidadExpediente
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
     * Set expedienteIdexpediente
     *
     * @param integer $expedienteIdexpediente
     *
     * @return EntidadExpediente
     */
    public function setExpedienteIdexpediente($expedienteIdexpediente)
    {
        $this->expedienteIdexpediente = $expedienteIdexpediente;

        return $this;
    }

    /**
     * Get expedienteIdexpediente
     *
     * @return integer
     */
    public function getExpedienteIdexpediente()
    {
        return $this->expedienteIdexpediente;
    }

    /**
     * Set llaveEntidad
     *
     * @param integer $llaveEntidad
     *
     * @return EntidadExpediente
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
     * @return EntidadExpediente
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
     * Set permiso
     *
     * @param string $permiso
     *
     * @return EntidadExpediente
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;

        return $this;
    }

    /**
     * Get permiso
     *
     * @return string
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EntidadExpediente
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
