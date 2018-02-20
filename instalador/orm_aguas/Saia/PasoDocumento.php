<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoDocumento
 *
 * @ORM\Table(name="PASO_DOCUMENTO", indexes={@ORM\Index(name="i_paso_documento_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PasoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_DOCUMENTO_IDPASO_DOCUMENT", allocationSize=1, initialValue=1)
     */
    private $idpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_IDPASO", type="integer", nullable=false)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=false)
     */
    private $fechaAsignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM_INSTANCE", type="integer", nullable=false)
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_PASO_DOCUMENTO", type="integer", nullable=false)
     */
    private $estadoPasoDocumento = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_LIMITE", type="date", nullable=true)
     */
    private $fechaLimite;


}
