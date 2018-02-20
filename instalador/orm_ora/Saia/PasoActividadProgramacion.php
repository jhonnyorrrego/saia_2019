<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadProgramacion
 *
 * @ORM\Table(name="paso_actividad_programacion")
 * @ORM\Entity
 */
class PasoActividadProgramacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_actividad_programacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoActividadProgramacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var string
     *
     * @ORM\Column(name="meses", type="string", length=255, nullable=false)
     */
    private $meses;

    /**
     * @var string
     *
     * @ORM\Column(name="dias", type="string", length=255, nullable=false)
     */
    private $dias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirar", type="date", nullable=true)
     */
    private $expirar;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idpaso_actividad", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;


}
