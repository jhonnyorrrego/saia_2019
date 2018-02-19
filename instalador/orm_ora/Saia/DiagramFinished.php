<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramFinished
 *
 * @ORM\Table(name="DIAGRAM_FINISHED")
 * @ORM\Entity
 */
class DiagramFinished
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDIAGRAM_INSTANCE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DIAGRAM_FINISHED_IDDIAGRAM_INS", allocationSize=1, initialValue=1)
     */
    private $iddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM", type="integer", nullable=true)
     */
    private $diagramIddiagram;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=true)
     */
    private $funcionarioCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones = 'empty_clob()';


}

