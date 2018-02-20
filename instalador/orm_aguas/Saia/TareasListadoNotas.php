<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoNotas
 *
 * @ORM\Table(name="TAREAS_LISTADO_NOTAS")
 * @ORM\Entity
 */
class TareasListadoNotas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO_NOTAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_NOTAS_IDTAREAS_", allocationSize=1, initialValue=1)
     */
    private $idtareasListadoNotas;

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
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=false)
     */
    private $fechaCreacion;


}
