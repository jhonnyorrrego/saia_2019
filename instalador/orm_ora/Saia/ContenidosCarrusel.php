<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenidosCarrusel
 *
 * @ORM\Table(name="CONTENIDOS_CARRUSEL")
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
     * @ORM\Column(name="CARRUSEL_IDCARRUSEL", type="integer", nullable=true)
     */
    private $carruselIdcarrusel;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=true)
     */
    private $contenido = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden = '0';

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
     * @var string
     *
     * @ORM\Column(name="PREVIEW", type="text", nullable=true)
     */
    private $preview = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="ALIGN", type="string", length=50, nullable=true)
     */
    private $align = 'left';

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="text", nullable=true)
     */
    private $imagen = 'empty_clob()';


}

