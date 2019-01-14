<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeguimientoPlanes
 *
 * @ORM\Table(name="seguimiento_planes")
 * @ORM\Entity
 */
class SeguimientoPlanes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idseguimiento_planes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseguimientoPlanes;

    /**
     * @var integer
     *
     * @ORM\Column(name="plan_mejoramiento", type="integer", nullable=false)
     */
    private $planMejoramiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seguimiento_indicador", type="integer", nullable=false)
     */
    private $idftSeguimientoIndicador;


}

