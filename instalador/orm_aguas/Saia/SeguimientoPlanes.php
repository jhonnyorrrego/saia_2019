<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeguimientoPlanes
 *
 * @ORM\Table(name="SEGUIMIENTO_PLANES", indexes={@ORM\Index(name="i_seguimiento__plan_mejoram", columns={"PLAN_MEJORAMIENTO"})})
 * @ORM\Entity
 */
class SeguimientoPlanes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDSEGUIMIENTO_PLANES", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SEGUIMIENTO_PLANES_IDSEGUIMIEN", allocationSize=1, initialValue=1)
     */
    private $idseguimientoPlanes;

    /**
     * @var integer
     *
     * @ORM\Column(name="PLAN_MEJORAMIENTO", type="integer", nullable=false)
     */
    private $planMejoramiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_SEGUIMIENTO_INDICADOR", type="integer", nullable=false)
     */
    private $idftSeguimientoIndicador;


}
