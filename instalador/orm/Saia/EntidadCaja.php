<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadCaja
 *
 * @ORM\Table(name="entidad_caja")
 * @ORM\Entity
 */
class EntidadCaja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_caja", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identidadCaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="caja_idcaja", type="integer", nullable=false)
     */
    private $cajaIdcaja = '0';

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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;



    /**
     * Get identidadCaja
     *
     * @return integer
     */
    public function getIdentidadCaja()
    {
        return $this->identidadCaja;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return EntidadCaja
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
     * Set cajaIdcaja
     *
     * @param integer $cajaIdcaja
     *
     * @return EntidadCaja
     */
    public function setCajaIdcaja($cajaIdcaja)
    {
        $this->cajaIdcaja = $cajaIdcaja;

        return $this;
    }

    /**
     * Get cajaIdcaja
     *
     * @return integer
     */
    public function getCajaIdcaja()
    {
        return $this->cajaIdcaja;
    }

    /**
     * Set llaveEntidad
     *
     * @param integer $llaveEntidad
     *
     * @return EntidadCaja
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
     * @return EntidadCaja
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
     * @return EntidadCaja
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
     * @return EntidadCaja
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
