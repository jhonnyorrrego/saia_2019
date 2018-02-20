<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasBuzon
 *
 * @ORM\Table(name="TAREAS_BUZON")
 * @ORM\Entity
 */
class TareasBuzon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_BUZON", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_BUZON_IDTAREAS_BUZON_se", allocationSize=1, initialValue=1)
     */
    private $idtareasBuzon;

    /**
     * @var integer
     *
     * @ORM\Column(name="TERMINADO_POR", type="integer", nullable=false)
     */
    private $terminadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_ESTADO", type="text", nullable=false)
     */
    private $descripcionEstado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ESTADO", type="date", nullable=false)
     */
    private $fechaEstado;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREAS_IDTAREAS", type="integer", nullable=false)
     */
    private $tareasIdtareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';


}
