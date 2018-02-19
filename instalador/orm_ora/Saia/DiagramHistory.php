<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramHistory
 *
 * @ORM\Table(name="DIAGRAM_HISTORY")
 * @ORM\Entity
 */
class DiagramHistory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDIAGRAM_HISTORY", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DIAGRAM_HISTORY_IDDIAGRAM_HIST", allocationSize=1, initialValue=1)
     */
    private $iddiagramHistory;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_IMAGEN", type="string", length=255, nullable=true)
     */
    private $rutaImagen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPONSABLE", type="integer", nullable=true)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=true)
     */
    private $diagramIddiagram;


}

