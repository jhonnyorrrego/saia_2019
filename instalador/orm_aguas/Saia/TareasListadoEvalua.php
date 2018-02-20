<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoEvalua
 *
 * @ORM\Table(name="tareas_listado_evalua")
 * @ORM\Entity
 */
class TareasListadoEvalua
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_evalua", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasListadoEvalua;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion", type="integer", nullable=false)
     */
    private $calificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora", type="date", nullable=false)
     */
    private $fechaHora;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;


}
