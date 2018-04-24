<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasBuzon
 *
 * @ORM\Table(name="tareas_buzon")
 * @ORM\Entity
 */
class TareasBuzon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_buzon", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareasBuzon;

    /**
     * @var integer
     *
     * @ORM\Column(name="terminado_por", type="integer", nullable=false)
     */
    private $terminadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_estado", type="text", length=65535, nullable=false)
     */
    private $descripcionEstado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_estado", type="datetime", nullable=false)
     */
    private $fechaEstado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tareas_idtareas", type="integer", nullable=false)
     */
    private $tareasIdtareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';


}

