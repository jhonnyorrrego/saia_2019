<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlTarea
 *
 * @ORM\Table(name="CONTROL_TAREA", indexes={@ORM\Index(name="i_control_ta_accion_ctx", columns={"ACCION"})})
 * @ORM\Entity
 */
class ControlTarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONTROL_TAREA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CONTROL_TAREA_IDCONTROL_TAREA_", allocationSize=1, initialValue=1)
     */
    private $idcontrolTarea;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="text", nullable=false)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERIOCIDAD", type="integer", nullable=true)
     */
    private $periocidad;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_PERIOCIDAD", type="string", length=15, nullable=true)
     */
    private $tipoPeriocidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREA_IDTAREA", type="integer", nullable=false)
     */
    private $tareaIdtarea;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado = 'pendiente';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ACTUALIZACION", type="date", nullable=true)
     */
    private $fechaActualizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ANTICIPACION", type="string", length=255, nullable=true)
     */
    private $tipoAnticipacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANTICIPACION", type="integer", nullable=true)
     */
    private $anticipacion = '0';


}

