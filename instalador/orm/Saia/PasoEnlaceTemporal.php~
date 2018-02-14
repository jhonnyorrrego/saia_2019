<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEnlaceTemporal
 *
 * @ORM\Table(name="paso_enlace_temporal")
 * @ORM\Entity
 */
class PasoEnlaceTemporal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_enlace_temporal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoEnlaceTemporal;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=true)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var integer
     *
     * @ORM\Column(name="idconector", type="integer", nullable=false)
     */
    private $idconector;


}

