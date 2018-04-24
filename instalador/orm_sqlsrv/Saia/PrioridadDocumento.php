<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrioridadDocumento
 *
 * @ORM\Table(name="prioridad_documento")
 * @ORM\Entity
 */
class PrioridadDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprioridad_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprioridadDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asignacion", type="datetime", nullable=false)
     */
    private $fechaAsignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad;


}
