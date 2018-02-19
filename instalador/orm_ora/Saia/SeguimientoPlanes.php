<?php

namespace Saia;

/**
 * SeguimientoPlanes
 */
class SeguimientoPlanes
{
    /**
     * @var integer
     */
    private $idseguimientoPlanes;

    /**
     * @var integer
     */
    private $planMejoramiento;

    /**
     * @var integer
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

