<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pretexto
 *
 * @ORM\Table(name="pretexto")
 * @ORM\Entity
 */
class Pretexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpretexto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpretexto;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="string", length=1000, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=true)
     */
    private $asunto;


}
