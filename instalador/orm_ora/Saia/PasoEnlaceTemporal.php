<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEnlaceTemporal
 *
 * @ORM\Table(name="PASO_ENLACE_TEMPORAL")
 * @ORM\Entity
 */
class PasoEnlaceTemporal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ENLACE_TEMPORAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_ENLACE_TEMPORAL_IDPASO_EN", allocationSize=1, initialValue=1)
     */
    private $idpasoEnlaceTemporal;

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
