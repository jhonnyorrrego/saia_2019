<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaPendiente
 *
 * @ORM\Table(name="PASO_INSTANCIA_PENDIENTE", indexes={@ORM\Index(name="i_paso_instancia_pendiente_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PasoInstanciaPendiente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_INSTANCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_INSTANCIA_PENDIENTE_IDPAS", allocationSize=1, initialValue=1)
     */
    private $idpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_IDPASO_ACTIVIDAD", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE", type="text", nullable=false)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;


}
