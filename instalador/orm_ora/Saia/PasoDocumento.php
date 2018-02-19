<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoDocumento
 *
 * @ORM\Table(name="PASO_DOCUMENTO")
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
     * @ORM\Column(name="PASO_IDPASO", type="integer", nullable=true)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=true)
     */
    private $fechaAsignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAGRAM_IDDIAGRAM_INSTANCE", type="integer", nullable=true)
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_PASO_DOCUMENTO", type="integer", nullable=true)
     */
    private $estadoPasoDocumento = '0';


}

