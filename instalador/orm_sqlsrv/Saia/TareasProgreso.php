<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasProgreso
 *
 * @ORM\Table(name="tareas_progreso")
 * @ORM\Entity
 */
class TareasProgreso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_progreso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareasProgreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="progreso", type="integer", nullable=false)
     */
    private $progreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_progreso", type="datetime", nullable=false)
     */
    private $fechaProgreso;


}
