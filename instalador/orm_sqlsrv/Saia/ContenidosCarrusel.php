<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenidosCarrusel
 *
 * @ORM\Table(name="contenidos_carrusel")
 * @ORM\Entity
 */
class ContenidosCarrusel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcontenidos_carrusel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontenidosCarrusel;

    /**
     * @var integer
     *
     * @ORM\Column(name="carrusel_idcarrusel", type="integer", nullable=false)
     */
    private $carruselIdcarrusel;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '0';

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
     * @var string
     *
     * @ORM\Column(name="preview", type="text", length=65535, nullable=false)
     */
    private $preview;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=600, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="miniatura", type="string", length=255, nullable=true)
     */
    private $miniatura;

    /**
     * @var string
     *
     * @ORM\Column(name="align", type="string", length=20, nullable=true)
     */
    private $align = 'left';


}
