<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadFunciones
 *
 * @ORM\Table(name="PASO_ACTIVIDAD_FUNCIONES")
 * @ORM\Entity
 */
class PasoActividadFunciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_ACTIVIDAD_FUNCIONES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_ACTIVIDAD_FUNCIONES_IDPAS", allocationSize=1, initialValue=1)
     */
    private $idpasoActividadFunciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_IDFUNCIONES_PASO", type="integer", nullable=true)
     */
    private $pasoIdfuncionesPaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_IDPASO", type="integer", nullable=true)
     */
    private $pasoIdpaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_IDPASO_ACTIVIDAD", type="integer", nullable=true)
     */
    private $actividadIdpasoActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_IDACCION", type="integer", nullable=true)
     */
    private $accionIdaccion;


}

