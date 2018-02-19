<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstTerminacion
 *
 * @ORM\Table(name="PASO_INST_TERMINACION")
 * @ORM\Entity
 */
class PasoInstTerminacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_INST_TERMINACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_INST_TERMINACION_IDPASO_I", allocationSize=1, initialValue=1)
     */
    private $idpasoInstTerminacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDPASO_DOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="INSTANCIA_IDPASO_INSTANCIA", type="integer", nullable=true)
     */
    private $instanciaIdpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=true)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_JUSTIFICACION", type="date", nullable=true)
     */
    private $fechaJustificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}
