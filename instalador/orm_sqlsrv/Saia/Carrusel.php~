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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

