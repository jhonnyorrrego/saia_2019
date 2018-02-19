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
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="AUTOPLAY", type="string", length=255, nullable=true)
     */
    private $autoplay;

    /**
     * @var string
     *
     * @ORM\Column(name="DELAY", type="string", length=255, nullable=true)
     */
    private $delay;

    /**
     * @var string
     *
     * @ORM\Column(name="STARTSTOPPED", type="string", length=255, nullable=true)
     */
    private $startstopped;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIMATIONTIME", type="string", length=255, nullable=true)
     */
    private $animationtime;

    /**
     * @var string
     *
     * @ORM\Column(name="BUILDNAVIGATION", type="string", length=255, nullable=true)
     */
    private $buildnavigation;

    /**
     * @var string
     *
     * @ORM\Column(name="PAUSEONHOVER", type="string", length=255, nullable=true)
     */
    private $pauseonhover;

    /**
     * @var string
     *
     * @ORM\Column(name="STARTTEXT", type="string", length=255, nullable=true)
     */
    private $starttext;

    /**
     * @var string
     *
     * @ORM\Column(name="STOPTEXT", type="string", length=255, nullable=true)
     */
    private $stoptext;

    /**
     * @var string
     *
     * @ORM\Column(name="EASING", type="string", length=255, nullable=true)
     */
    private $easing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=true)
     */
    private $fechaInicio = 'sysdate';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FIN", type="date", nullable=true)
     */
    private $fechaFin = 'sysdate';

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=true)
     */
    private $ancho;

    /**
     * @var integer
     *
     * @ORM\Column(name="ALTO", type="integer", nullable=true)
     */
    private $alto;

    /**
     * @var string
     *
     * @ORM\Column(name="CSS", type="string", length=255, nullable=true)
     */
    private $css;


}
