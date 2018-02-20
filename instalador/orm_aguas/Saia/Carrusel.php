<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrusel
 *
 * @ORM\Table(name="CARRUSEL")
 * @ORM\Entity
 */
class Carrusel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCARRUSEL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CARRUSEL_IDCARRUSEL_seq", allocationSize=1, initialValue=1)
     */
    private $idcarrusel;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="AUTOPLAY", type="string", length=255, nullable=false)
     */
    private $autoplay = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="DELAY", type="string", length=255, nullable=false)
     */
    private $delay = '3000';

    /**
     * @var string
     *
     * @ORM\Column(name="ANIMATIONTIME", type="string", length=255, nullable=false)
     */
    private $animationtime = '600';

    /**
     * @var string
     *
     * @ORM\Column(name="EASING", type="string", length=255, nullable=true)
     */
    private $easing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FIN", type="date", nullable=false)
     */
    private $fechaFin;


}
