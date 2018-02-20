<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tareas
 *
 * @ORM\Table(name="tareas", indexes={@ORM\Index(name="i_tareas_responsable", columns={"responsable"}), @ORM\Index(name="i_tareas_ejecutor", columns={"ejecutor"}), @ORM\Index(name="i_tareas_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Tareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=255, nullable=false)
     */
    private $tarea;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=255, nullable=false)
     */
    private $prioridad = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_tarea", type="date", nullable=false)
     */
    private $fechaTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor", type="integer", nullable=false)
     */
    private $ejecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_tarea", type="integer", nullable=false)
     */
    private $estadoTarea = '0';


}
