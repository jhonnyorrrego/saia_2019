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



    /**
     * Get idseguimientoPlanes
     *
     * @return integer
     */
    public function getIdseguimientoPlanes()
    {
        return $this->idseguimientoPlanes;
    }

    /**
     * Set planMejoramiento
     *
     * @param integer $planMejoramiento
     *
     * @return SeguimientoPlanes
     */
    public function setPlanMejoramiento($planMejoramiento)
    {
        $this->planMejoramiento = $planMejoramiento;

        return $this;
    }

    /**
     * Get planMejoramiento
     *
     * @return integer
     */
    public function getPlanMejoramiento()
    {
        return $this->planMejoramiento;
    }

    /**
     * Set idftSeguimientoIndicador
     *
     * @param integer $idftSeguimientoIndicador
     *
     * @return SeguimientoPlanes
     */
    public function setIdftSeguimientoIndicador($idftSeguimientoIndicador)
    {
        $this->idftSeguimientoIndicador = $idftSeguimientoIndicador;

        return $this;
    }

    /**
     * Get idftSeguimientoIndicador
     *
     * @return integer
     */
    public function getIdftSeguimientoIndicador()
    {
        return $this->idftSeguimientoIndicador;
    }
}
