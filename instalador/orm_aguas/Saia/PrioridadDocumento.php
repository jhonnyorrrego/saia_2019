<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrioridadDocumento
 *
 * @ORM\Table(name="PRIORIDAD_DOCUMENTO", indexes={@ORM\Index(name="i_prioridad_documento_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PrioridadDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPRIORIDAD_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PRIORIDAD_DOCUMENTO_IDPRIORIDA", allocationSize=1, initialValue=1)
     */
    private $idprioridadDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=false)
     */
    private $fechaAsignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIORIDAD", type="integer", nullable=false)
     */
    private $prioridad;


}
