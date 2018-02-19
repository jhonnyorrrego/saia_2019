<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEnlace
 *
 * @ORM\Table(name="PASO_ENLACE")
 * @ORM\Entity
 */
class PasoEnlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ENLACE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_ENLACE_IDPASO_ENLACE_seq", allocationSize=1, initialValue=1)
     */
    private $idpasoEnlace;

    /**
     * @var string
     *
     * @ORM\Column(name="ORIGEN", type="string", length=255, nullable=true)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=true)
     */
    private $diagramIddiagram;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONECTOR", type="integer", nullable=true)
     */
    private $idconector;


}
