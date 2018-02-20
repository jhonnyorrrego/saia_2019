<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasAvance
 *
 * @ORM\Table(name="TAREAS_AVANCE", indexes={@ORM\Index(name="i_tareas_avanc_ejecutor", columns={"EJECUTOR"})})
 * @ORM\Entity
 */
class TareasAvance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_AVANCE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_AVANCE_IDTAREAS_AVANCE_", allocationSize=1, initialValue=1)
     */
    private $idtareasAvance;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREAS_IDTAREAS", type="integer", nullable=false)
     */
    private $tareasIdtareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="EJECUTOR", type="integer", nullable=false)
     */
    private $ejecutor;


}
