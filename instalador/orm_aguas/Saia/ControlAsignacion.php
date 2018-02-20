<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControlAsignacion
 *
 * @ORM\Table(name="CONTROL_ASIGNACION", indexes={@ORM\Index(name="i_control_as_accion_ctx", columns={"ACCION"})})
 * @ORM\Entity
 */
class ControlAsignacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONTROL_ASIGNACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CONTROL_ASIGNACION_IDCONTROL_A", allocationSize=1, initialValue=1)
     */
    private $idcontrolAsignacion;

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
     * @ORM\Column(name="ASIGNACION_IDASIGNACION", type="integer", nullable=true)
     */
    private $asignacionIdasignacion;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ANTICIPACION", type="string", length=15, nullable=true)
     */
    private $tipoAnticipacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANTICIPACION", type="integer", nullable=true)
     */
    private $anticipacion = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EJECUTAR_HASTA", type="date", nullable=true)
     */
    private $ejecutarHasta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ACTUALIZACION", type="date", nullable=true)
     */
    private $fechaActualizacion;


}

