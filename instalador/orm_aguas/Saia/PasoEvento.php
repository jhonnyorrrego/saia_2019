<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEvento
 *
 * @ORM\Table(name="PASO_EVENTO")
 * @ORM\Entity
 */
class PasoEvento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_EVENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_EVENTO_IDPASO_EVENTO_seq", allocationSize=1, initialValue=1)
     */
    private $idpasoEvento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="IDEVENTO", type="string", length=255, nullable=false)
     */
    private $idevento;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_EVENTO", type="string", length=255, nullable=false)
     */
    private $tipoEvento;


}
