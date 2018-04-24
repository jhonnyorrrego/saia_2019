<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListado
 *
 * @ORM\Table(name="tareas_listado")
 * @ORM\Entity
 */
class TareasListado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="listado_tareas_fk", type="integer", nullable=false)
     */
    private $listadoTareasFk;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_tarea", type="string", nullable=false)
     */
    private $estadoTarea = 'PENDIENTE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tarea", type="string", length=255, nullable=false)
     */
    private $nombreTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_tarea", type="string", length=255, nullable=false)
     */
    private $tipoTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_tarea", type="string", length=255, nullable=true)
     */
    private $responsableTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="co_participantes", type="string", length=255, nullable=true)
     */
    private $coParticipantes;

    /**
     * @var string
     *
     * @ORM\Column(name="seguidores", type="string", length=255, nullable=true)
     */
    private $seguidores;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_tarea", type="text", length=65535, nullable=true)
     */
    private $descripcionTarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=true)
     */
    private $fechaLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=255, nullable=true)
     */
    private $prioridad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_estimado", type="time", nullable=true)
     */
    private $tiempoEstimado;

    /**
     * @var string
     *
     * @ORM\Column(name="enviar_email", type="string", length=255, nullable=true)
     */
    private $enviarEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="progreso", type="integer", nullable=true)
     */
    private $progreso = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion", type="integer", nullable=true)
     */
    private $calificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="creador_tarea", type="integer", nullable=true)
     */
    private $creadorTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=false)
     */
    private $codPadre = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tarea_recurrencia", type="integer", nullable=true)
     */
    private $fkTareaRecurrencia;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluador", type="string", length=255, nullable=true)
     */
    private $evaluador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_planeada", type="datetime", nullable=true)
     */
    private $fechaPlaneada;

    /**
     * @var integer
     *
     * @ORM\Column(name="generica", type="integer", nullable=true)
     */
    private $generica = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="from_generica", type="integer", nullable=true)
     */
    private $fromGenerica = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="info_recurrencia", type="text", length=65535, nullable=true)
     */
    private $infoRecurrencia;


}
