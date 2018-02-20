<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteAbce
 *
 * @ORM\Table(name="expediente_abce", indexes={@ORM\Index(name="i_expediente_a_funcionario_", columns={"funcionario_cierre"}), @ORM\Index(name="i_expediente_a_expediente_i", columns={"expediente_idexpediente"})})
 * @ORM\Entity
 */
class ExpedienteAbce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idexpediente_abce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="EXPEDIENTE_ABCE_IDEXPEDIENTE_A", allocationSize=1, initialValue=1)
     */
    private $idexpedienteAbce;

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_cierre", type="integer", nullable=false)
     */
    private $estadoCierre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="date", nullable=false)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_cierre", type="integer", nullable=false)
     */
    private $funcionarioCierre;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;


}
