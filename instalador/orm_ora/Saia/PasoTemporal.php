<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoTemporal
 *
 * @ORM\Table(name="PASO_TEMPORAL")
 * @ORM\Entity
 */
class PasoTemporal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_TEMPORAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_TEMPORAL_IDPASO_TEMPORAL_", allocationSize=1, initialValue=1)
     */
    private $idpasoTemporal;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_PASO", type="string", length=255, nullable=true)
     */
    private $nombrePaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="FIGURA_IDFIGURA", type="integer", nullable=true)
     */
    private $figuraIdfigura;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=true)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="POSICION", type="string", length=255, nullable=true)
     */
    private $posicion;


}

