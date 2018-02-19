<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrioridadDocumento
 *
 * @ORM\Table(name="PRIORIDAD_DOCUMENTO")
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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=true)
     */
    private $fechaAsignacion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="PRIORIDAD", type="integer", nullable=true)
     */
    private $prioridad;


}

