<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaPendiente
 *
 * @ORM\Table(name="paso_instancia_pendiente", indexes={@ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PasoInstanciaPendiente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_instancia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idpaso_actividad", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="text", length=65535, nullable=false)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;


}
