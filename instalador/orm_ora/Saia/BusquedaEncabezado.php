<?php

namespace Saia;

/**
 * BusquedaEncabezado
 */
class BusquedaEncabezado
{
    /**
     * @var integer
     */
    private $idbusquedaEncabezado;

    /**
     * @var string
     */
    private $encabezado;

    /**
     * @var string
     */
    private $pie;

    /**
     * @var integer
     */
    private $fkIdbusquedaComponente;


    /**
     * Get idbusquedaEncabezado
     *
     * @return integer
     */
    public function getIdbusquedaEncabezado()
    {
        return $this->idbusquedaEncabezado;
    }

    /**
     * Set encabezado
     *
     * @param string $encabezado
     *
     * @return BusquedaEncabezado
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return string
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set pie
     *
     * @param string $pie
     *
     * @return BusquedaEncabezado
     */
    public function setPie($pie)
    {
        $this->pie = $pie;

        return $this;
    }

    /**
     * Get pie
     *
     * @return string
     */
    public function getPie()
    {
        return $this->pie;
    }

    /**
     * Set fkIdbusquedaComponente
     *
     * @param integer $fkIdbusquedaComponente
     *
     * @return BusquedaEncabezado
     */
    public function setFkIdbusquedaComponente($fkIdbusquedaComponente)
    {
        $this->fkIdbusquedaComponente = $fkIdbusquedaComponente;

        return $this;
    }

    /**
     * Get fkIdbusquedaComponente
     *
     * @return integer
     */
    public function getFkIdbusquedaComponente()
    {
        return $this->fkIdbusquedaComponente;
    }
}

