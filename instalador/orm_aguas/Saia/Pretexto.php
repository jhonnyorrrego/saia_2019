<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pretexto
 *
 * @ORM\Table(name="PRETEXTO")
 * @ORM\Entity
 */
class Pretexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRETEXTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PRETEXTO_IDPRETEXTO_seq", allocationSize=1, initialValue=1)
     */
    private $idpretexto;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="ASUNTO", type="string", length=255, nullable=true)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="string", length=1000, nullable=true)
     */
    private $ayuda;


}
