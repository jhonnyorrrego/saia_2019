<?php

namespace Saia;

/**
 * TareasListadoRecur
 */
class TareasListadoRecur
{
    /**
     * @var integer
     */
    private $idtareasListadoRecur;

    /**
     * @var integer
     */
    private $fkTareasListado;

    /**
     * @var integer
     */
    private $recurrencia;

    /**
     * @var integer
     */
    private $repetirCada;

    /**
     * @var \DateTime
     */
    private $empiezaEl;

    /**
     * @var integer
     */
    private $finalizaEl;

    /**
     * @var integer
     */
    private $finalizaElRepeticiones;

    /**
     * @var \DateTime
     */
    private $finalizaElFecha;

    /**
     * @var integer
     */
    private $repeticionesEjecutada;

    /**
     * @var integer
     */
    private $repetirMes;

    /**
     * @var string
     */
    private $diasSemana;

    /**
     * @var \DateTime
     */
    private $ejecutaProxima;


    /**
     * Get idtareasListadoRecur
     *
     * @return integer
     */
    public function getIdtareasListadoRecur()
    {
        return $this->idtareasListadoRecur;
    }

    /**
     * Set fkTareasListado
     *
     * @param integer $fkTareasListado
     *
     * @return TareasListadoRecur
     */
    public function setFkTareasListado($fkTareasListado)
    {
        $this->fkTareasListado = $fkTareasListado;

        return $this;
    }

    /**
     * Get fkTareasListado
     *
     * @return integer
     */
    public function getFkTareasListado()
    {
        return $this->fkTareasListado;
    }

    /**
     * Set recurrencia
     *
     * @param integer $recurrencia
     *
     * @return TareasListadoRecur
     */
    public function setRecurrencia($recurrencia)
    {
        $this->recurrencia = $recurrencia;

        return $this;
    }

    /**
     * Get recurrencia
     *
     * @return integer
     */
    public function getRecurrencia()
    {
        return $this->recurrencia;
    }

    /**
     * Set repetirCada
     *
     * @param integer $repetirCada
     *
     * @return TareasListadoRecur
     */
    public function setRepetirCada($repetirCada)
    {
        $this->repetirCada = $repetirCada;

        return $this;
    }

    /**
     * Get repetirCada
     *
     * @return integer
     */
    public function getRepetirCada()
    {
        return $this->repetirCada;
    }

    /**
     * Set empiezaEl
     *
     * @param \DateTime $empiezaEl
     *
     * @return TareasListadoRecur
     */
    public function setEmpiezaEl($empiezaEl)
    {
        $this->empiezaEl = $empiezaEl;

        return $this;
    }

    /**
     * Get empiezaEl
     *
     * @return \DateTime
     */
    public function getEmpiezaEl()
    {
        return $this->empiezaEl;
    }

    /**
     * Set finalizaEl
     *
     * @param integer $finalizaEl
     *
     * @return TareasListadoRecur
     */
    public function setFinalizaEl($finalizaEl)
    {
        $this->finalizaEl = $finalizaEl;

        return $this;
    }

    /**
     * Get finalizaEl
     *
     * @return integer
     */
    public function getFinalizaEl()
    {
        return $this->finalizaEl;
    }

    /**
     * Set finalizaElRepeticiones
     *
     * @param integer $finalizaElRepeticiones
     *
     * @return TareasListadoRecur
     */
    public function setFinalizaElRepeticiones($finalizaElRepeticiones)
    {
        $this->finalizaElRepeticiones = $finalizaElRepeticiones;

        return $this;
    }

    /**
     * Get finalizaElRepeticiones
     *
     * @return integer
     */
    public function getFinalizaElRepeticiones()
    {
        return $this->finalizaElRepeticiones;
    }

    /**
     * Set finalizaElFecha
     *
     * @param \DateTime $finalizaElFecha
     *
     * @return TareasListadoRecur
     */
    public function setFinalizaElFecha($finalizaElFecha)
    {
        $this->finalizaElFecha = $finalizaElFecha;

        return $this;
    }

    /**
     * Get finalizaElFecha
     *
     * @return \DateTime
     */
    public function getFinalizaElFecha()
    {
        return $this->finalizaElFecha;
    }

    /**
     * Set repeticionesEjecutada
     *
     * @param integer $repeticionesEjecutada
     *
     * @return TareasListadoRecur
     */
    public function setRepeticionesEjecutada($repeticionesEjecutada)
    {
        $this->repeticionesEjecutada = $repeticionesEjecutada;

        return $this;
    }

    /**
     * Get repeticionesEjecutada
     *
     * @return integer
     */
    public function getRepeticionesEjecutada()
    {
        return $this->repeticionesEjecutada;
    }

    /**
     * Set repetirMes
     *
     * @param integer $repetirMes
     *
     * @return TareasListadoRecur
     */
    public function setRepetirMes($repetirMes)
    {
        $this->repetirMes = $repetirMes;

        return $this;
    }

    /**
     * Get repetirMes
     *
     * @return integer
     */
    public function getRepetirMes()
    {
        return $this->repetirMes;
    }

    /**
     * Set diasSemana
     *
     * @param string $diasSemana
     *
     * @return TareasListadoRecur
     */
    public function setDiasSemana($diasSemana)
    {
        $this->diasSemana = $diasSemana;

        return $this;
    }

    /**
     * Get diasSemana
     *
     * @return string
     */
    public function getDiasSemana()
    {
        return $this->diasSemana;
    }

    /**
     * Set ejecutaProxima
     *
     * @param \DateTime $ejecutaProxima
     *
     * @return TareasListadoRecur
     */
    public function setEjecutaProxima($ejecutaProxima)
    {
        $this->ejecutaProxima = $ejecutaProxima;

        return $this;
    }

    /**
     * Get ejecutaProxima
     *
     * @return \DateTime
     */
    public function getEjecutaProxima()
    {
        return $this->ejecutaProxima;
    }
}

