<?php

namespace Saia;

/**
 * BusquedaFiltroTemp
 */
class BusquedaFiltroTemp
{
    /**
     * @var integer
     */
    private $idbusquedaFiltroTemp;

    /**
     * @var integer
     */
    private $fkBusquedaComponente;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $detalle;


    /**
     * Get idbusquedaFiltroTemp
     *
     * @return integer
     */
    public function getIdbusquedaFiltroTemp()
    {
        return $this->idbusquedaFiltroTemp;
    }

    /**
     * Set fkBusquedaComponente
     *
     * @param integer $fkBusquedaComponente
     *
     * @return BusquedaFiltroTemp
     */
    public function setFkBusquedaComponente($fkBusquedaComponente)
    {
        $this->fkBusquedaComponente = $fkBusquedaComponente;

        return $this;
    }

    /**
     * Get fkBusquedaComponente
     *
     * @return integer
     */
    public function getFkBusquedaComponente()
    {
        return $this->fkBusquedaComponente;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return BusquedaFiltroTemp
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return BusquedaFiltroTemp
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return BusquedaFiltroTemp
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}

