<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesPasoAccion
 *
 * @ORM\Table(name="FUNCIONES_PASO_ACCION")
 * @ORM\Entity
 */
class FuncionesPasoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONES_PASO_ACCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONES_PASO_ACCION_IDFUNCIO", allocationSize=1, initialValue=1)
     */
    private $idfuncionesPasoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_IDACCION", type="integer", nullable=false)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PASO_IDFUNCIONES_PASO", type="integer", nullable=false)
     */
    private $pasoIdfuncionesPaso;


}
