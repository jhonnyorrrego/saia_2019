<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadProgramacion
 *
 * @ORM\Table(name="PASO_ACTIVIDAD_PROGRAMACION")
 * @ORM\Entity
 */
class PasoActividadProgramacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ACTIVIDAD_PROGRAMACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_ACTIVIDAD_PROGRAMACION_ID", allocationSize=1, initialValue=1)
     */
    private $idpasoActividadProgramacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="INICIO", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var string
     *
     * @ORM\Column(name="MESES", type="string", length=255, nullable=false)
     */
    private $meses;

    /**
     * @var string
     *
     * @ORM\Column(name="DIAS", type="string", length=255, nullable=false)
     */
    private $dias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EXPIRAR", type="date", nullable=true)
     */
    private $expirar;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_IDPASO_ACTIVIDAD", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;


}
