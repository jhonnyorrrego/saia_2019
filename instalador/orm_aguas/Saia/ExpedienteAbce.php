<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteAbce
 *
 * @ORM\Table(name="EXPEDIENTE_ABCE", indexes={@ORM\Index(name="i_expediente_a_funcionario_", columns={"FUNCIONARIO_CIERRE"}), @ORM\Index(name="i_expediente_a_expediente_i", columns={"EXPEDIENTE_IDEXPEDIENTE"})})
 * @ORM\Entity
 */
class ExpedienteAbce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDEXPEDIENTE_ABCE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="EXPEDIENTE_ABCE_IDEXPEDIENTE_A", allocationSize=1, initialValue=1)
     */
    private $idexpedienteAbce;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXPEDIENTE_IDEXPEDIENTE", type="integer", nullable=false)
     */
    private $expedienteIdexpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_CIERRE", type="integer", nullable=false)
     */
    private $estadoCierre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CIERRE", type="date", nullable=false)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CIERRE", type="integer", nullable=false)
     */
    private $funcionarioCierre;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}
