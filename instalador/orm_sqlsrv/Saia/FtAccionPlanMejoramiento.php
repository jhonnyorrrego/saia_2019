<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAccionPlanMejoramiento
 *
 * @ORM\Table(name="ft_accion_plan_mejoramiento")
 * @ORM\Entity
 */
class FtAccionPlanMejoramiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_accion_plan_mejoramiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAccionPlanMejoramiento;

    /**
     * @var string
     *
     * @ORM\Column(name="accion_item", type="text", length=65535, nullable=false)
     */
    private $accionItem;

    /**
     * @var string
     *
     * @ORM\Column(name="calificacion_total", type="string", length=255, nullable=false)
     */
    private $calificacionTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="costo_accion", type="integer", nullable=false)
     */
    private $costoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hallazgo", type="integer", nullable=false)
     */
    private $ftHallazgo;

    /**
     * @var integer
     *
     * @ORM\Column(name="riesgo_accion", type="integer", nullable=false)
     */
    private $riesgoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="volumen_accion", type="integer", nullable=false)
     */
    private $volumenAccion;


}

