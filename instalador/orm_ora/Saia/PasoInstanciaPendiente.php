<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaPendiente
 *
 * @ORM\Table(name="PASO_INSTANCIA_PENDIENTE")
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
     * @ORM\Column(name="ACTIVIDAD_IDPASO_ACTIVIDAD", type="integer", nullable=true)
     */
    private $actividadIdpasoActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE", type="text", nullable=true)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;


}

