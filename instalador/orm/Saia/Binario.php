<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Binario
 *
 * @ORM\Table(name="binario")
 * @ORM\Entity
 */
class Binario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbinario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbinario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_original", type="string", length=255, nullable=true)
     */
    private $nombreOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="datos", type="blob", length=16777215, nullable=true)
     */
    private $datos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';



    /**
     * Get idbinario
     *
     * @return integer
     */
    public function getIdbinario()
    {
        return $this->idbinario;
    }

    /**
     * Set nombreOriginal
     *
     * @param string $nombreOriginal
     *
     * @return Binario
     */
    public function setNombreOriginal($nombreOriginal)
    {
        $this->nombreOriginal = $nombreOriginal;

        return $this;
    }

    /**
     * Get nombreOriginal
     *
     * @return string
     */
    public function getNombreOriginal()
    {
        return $this->nombreOriginal;
    }

    /**
     * Set datos
     *
     * @param string $datos
     *
     * @return Binario
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

    /**
     * Get datos
     *
     * @return string
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Binario
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
}
