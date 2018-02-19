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
     * @ORM\Column(name="TERMINADO_POR", type="integer", nullable=true)
     */
    private $terminadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_ESTADO", type="string", length=4000, nullable=true)
     */
    private $descripcionEstado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ESTADO", type="date", nullable=true)
     */
    private $fechaEstado = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREAS_IDTAREAS", type="integer", nullable=true)
     */
    private $tareasIdtareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';


}
