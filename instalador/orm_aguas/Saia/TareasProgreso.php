<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasProgreso
 *
 * @ORM\Table(name="TAREAS_PROGRESO")
 * @ORM\Entity
 */
class TareasProgreso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_PROGRESO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_PROGRESO_IDTAREAS_PROGR", allocationSize=1, initialValue=1)
     */
    private $idtareasProgreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREAS_LISTADO", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="PROGRESO", type="integer", nullable=false)
     */
    private $progreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_PROGRESO", type="date", nullable=false)
     */
    private $fechaProgreso;


}
