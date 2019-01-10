<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tareas
 *
 * @ORM\Table(name="tareas")
 * @ORM\Entity
 */
class Tareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
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
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
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
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_tarea", type="integer", nullable=false)
     */
    private $estadoTarea = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_tareas", type="integer", nullable=false)
     */
    private $ordenTareas = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_aprob", type="integer", nullable=false)
     */
    private $rutaAprob = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_tareas", type="integer", nullable=false)
     */
    private $accionTareas = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idtema", type="integer", nullable=true)
     */
    private $idtema = '0';


}

