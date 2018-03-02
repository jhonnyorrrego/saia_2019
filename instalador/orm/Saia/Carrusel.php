<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrusel
 *
 * @ORM\Table(name="carrusel")
 * @ORM\Entity
 */
class Carrusel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcarrusel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcarrusel;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="autoplay", type="string", length=255, nullable=false)
     */
    private $autoplay = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="delay", type="string", length=255, nullable=false)
     */
    private $delay = '3000';

    /**
     * @var string
     *
     * @ORM\Column(name="animationtime", type="string", length=255, nullable=false)
     */
    private $animationtime = '600';

    /**
     * @var string
     *
     * @ORM\Column(name="easing", type="string", length=255, nullable=true)
     */
    private $easing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;



    /**
     * Get idcarrusel
     *
     * @return integer
     */
    public function getIdcarrusel()
    {
        return $this->idcarrusel;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Carrusel
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set autoplay
     *
     * @param string $autoplay
     *
     * @return Carrusel
     */
    public function setAutoplay($autoplay)
    {
        $this->autoplay = $autoplay;

        return $this;
    }

    /**
     * Get autoplay
     *
     * @return string
     */
    public function getAutoplay()
    {
        return $this->autoplay;
    }

    /**
     * Set delay
     *
     * @param string $delay
     *
     * @return Carrusel
     */
    public function setDelay($delay)
    {
        $this->delay = $delay;

        return $this;
    }

    /**
     * Get delay
     *
     * @return string
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * Set animationtime
     *
     * @param string $animationtime
     *
     * @return Carrusel
     */
    public function setAnimationtime($animationtime)
    {
        $this->animationtime = $animationtime;

        return $this;
    }

    /**
     * Get animationtime
     *
     * @return string
     */
    public function getAnimationtime()
    {
        return $this->animationtime;
    }

    /**
     * Set easing
     *
     * @param string $easing
     *
     * @return Carrusel
     */
    public function setEasing($easing)
    {
        $this->easing = $easing;

        return $this;
    }

    /**
     * Get easing
     *
     * @return string
     */
    public function getEasing()
    {
        return $this->easing;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Carrusel
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Carrusel
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }
}
