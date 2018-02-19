<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramClosed
 *
 * @ORM\Table(name="DIAGRAM_CLOSED")
 * @ORM\Entity
 */
class DiagramClosed
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDIAGRAM_CLOSED", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DIAGRAM_CLOSED_IDDIAGRAM_CLOSE", allocationSize=1, initialValue=1)
     */
    private $iddiagramClosed;

    /**
     * @var integer
     *
     * @ORM\Column(name="INSTANCE_IDDIAGRAM_INSTANCE", type="integer", nullable=true)
     */
    private $instanceIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDPASO_DOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=true)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_ORIGINAL", type="integer", nullable=true)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_FINAL", type="integer", nullable=true)
     */
    private $estadoFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}

