<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tareas
 *
 * @ORM\Table(name="TAREAS", indexes={@ORM\Index(name="i_tareas_responsable", columns={"RESPONSABLE"}), @ORM\Index(name="i_tareas_ejecutor", columns={"EJECUTOR"}), @ORM\Index(name="i_tareas_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class Tareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_IDTAREAS_seq", allocationSize=1, initialValue=1)
     */
    private $idtareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="TAREA", type="string", length=255, nullable=false)
     */
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIORIDAD", type="string", length=255, nullable=false)
     */
    private $prioridad = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_TAREA", type="date", nullable=false)
     */
    private $fechaTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="EJECUTOR", type="integer", nullable=false)
     */
    private $ejecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_TAREA", type="integer", nullable=false)
     */
    private $estadoTarea = '0';


}
