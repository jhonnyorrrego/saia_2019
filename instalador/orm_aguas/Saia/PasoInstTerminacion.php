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
     * @ORM\Column(name="DOCUMENTO_IDPASO_DOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="INSTANCIA_IDPASO_INSTANCIA", type="integer", nullable=false)
     */
    private $instanciaIdpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_JUSTIFICACION", type="date", nullable=false)
     */
    private $fechaJustificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=false)
     */
    private $observaciones;


}
