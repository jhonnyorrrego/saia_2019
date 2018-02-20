<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListado
 *
 * @ORM\Table(name="TAREAS_LISTADO")
 * @ORM\Entity
 */
class TareasListado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_IDTAREAS_LISTAD", allocationSize=1, initialValue=1)
     */
    private $idtareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="LISTADO_TAREAS_FK", type="integer", nullable=false)
     */
    private $listadoTareasFk;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_TAREA", type="string", length=9, nullable=false)
     */
    private $estadoTarea = 'PENDIENTE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_TAREA", type="string", length=255, nullable=false)
     */
    private $nombreTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_TAREA", type="string", length=255, nullable=false)
     */
    private $tipoTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE_TAREA", type="string", length=255, nullable=true)
     */
    private $responsableTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_PARTICIPANTES", type="string", length=255, nullable=true)
     */
    private $coParticipantes;

    /**
     * @var string
     *
     * @ORM\Column(name="SEGUIDORES", type="string", length=255, nullable=true)
     */
    private $seguidores;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_TAREA", type="text", nullable=true)
     */
    private $descripcionTarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_LIMITE", type="date", nullable=true)
     */
    private $fechaLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIORIDAD", type="string", length=255, nullable=true)
     */
    private $prioridad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TIEMPO_ESTIMADO", type="date", nullable=true)
     */
    private $tiempoEstimado;

    /**
     * @var string
     *
     * @ORM\Column(name="ENVIAR_EMAIL", type="string", length=255, nullable=true)
     */
    private $enviarEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="PROGRESO", type="integer", nullable=true)
     */
    private $progreso = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION", type="integer", nullable=true)
     */
    private $calificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="CREADOR_TAREA", type="integer", nullable=true)
     */
    private $creadorTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=false)
     */
    private $codPadre = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREA_RECURRENCIA", type="integer", nullable=true)
     */
    private $fkTareaRecurrencia;

    /**
     * @var string
     *
     * @ORM\Column(name="EVALUADOR", type="string", length=255, nullable=true)
     */
    private $evaluador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_PLANEADA", type="date", nullable=true)
     */
    private $fechaPlaneada;

    /**
     * @var integer
     *
     * @ORM\Column(name="GENERICA", type="integer", nullable=true)
     */
    private $generica = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FROM_GENERICA", type="integer", nullable=true)
     */
    private $fromGenerica = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_RECURRENCIA", type="text", nullable=true)
     */
    private $infoRecurrencia;


}
