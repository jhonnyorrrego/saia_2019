<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoDevolucion
 *
 * @ORM\Table(name="PASO_DEVOLUCION", indexes={@ORM\Index(name="i_paso_devolucion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PasoDevolucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_DEVOLUCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_DEVOLUCION_IDPASO_DEVOLUC", allocationSize=1, initialValue=1)
     */
    private $idpasoDevolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ANTIGUO_PENDIENTE", type="integer", nullable=false)
     */
    private $idpasoAntiguoPendiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_NUEVO_PENDIENTE", type="integer", nullable=false)
     */
    private $idpasoNuevoPendiente;


}
