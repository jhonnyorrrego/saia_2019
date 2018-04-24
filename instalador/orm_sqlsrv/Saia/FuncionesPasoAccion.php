<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesPasoAccion
 *
 * @ORM\Table(name="funciones_paso_accion")
 * @ORM\Entity
 */
class FuncionesPasoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_paso_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionesPasoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=false)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="paso_idfunciones_paso", type="integer", nullable=false)
     */
    private $pasoIdfuncionesPaso;


}
