<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenidosCarrusel
 *
 * @ORM\Table(name="CONTENIDOS_CARRUSEL", indexes={@ORM\Index(name="i_contenidos_preview_ctx", columns={"PREVIEW"})})
 * @ORM\Entity
 */
class ContenidosCarrusel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONTENIDOS_CARRUSEL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CONTENIDOS_CARRUSEL_IDCONTENID", allocationSize=1, initialValue=1)
     */
    private $idcontenidosCarrusel;

    /**
     * @var integer
     *
     * @ORM\Column(name="CARRUSEL_IDCARRUSEL", type="integer", nullable=false)
     */
    private $carruselIdcarrusel;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '0';

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

    /**
     * @var string
     *
     * @ORM\Column(name="PREVIEW", type="text", nullable=true)
     */
    private $preview = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="MINIATURA", type="string", length=255, nullable=true)
     */
    private $miniatura;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIGN", type="string", length=20, nullable=true)
     */
    private $align = 'left';


}
