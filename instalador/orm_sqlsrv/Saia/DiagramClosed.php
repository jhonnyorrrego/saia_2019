<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramClosed
 *
 * @ORM\Table(name="diagram_closed")
 * @ORM\Entity
 */
class DiagramClosed
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddiagram_closed", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddiagramClosed;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram_instance", type="integer", nullable=false)
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_original", type="integer", nullable=false)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_final", type="integer", nullable=false)
     */
    private $estadoFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=16777215, nullable=false)
     */
    private $observaciones;


}
