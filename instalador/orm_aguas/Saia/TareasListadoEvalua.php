<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoEvalua
 *
 * @ORM\Table(name="TAREAS_LISTADO_EVALUA")
 * @ORM\Entity
 */
class TareasListadoEvalua
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO_EVALUA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_EVALUA_IDTAREAS", allocationSize=1, initialValue=1)
     */
    private $idtareasListadoEvalua;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREAS_LISTADO", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION", type="integer", nullable=false)
     */
    private $calificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_HORA", type="date", nullable=false)
     */
    private $fechaHora;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}
