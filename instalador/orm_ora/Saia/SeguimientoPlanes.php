<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeguimientoPlanes
 *
 * @ORM\Table(name="seguimiento_planes", indexes={@ORM\Index(name="i_seguimiento__plan_mejoram", columns={"plan_mejoramiento"})})
 * @ORM\Entity
 */
class SeguimientoPlanes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idseguimiento_planes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
