<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramInstance
 *
 * @ORM\Table(name="diagram_instance")
 * @ORM\Entity
 */
class DiagramInstance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddiagram_instance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_diagram_instance", type="integer", nullable=false)
     */
    private $estadoDiagramInstance = '0';


}
