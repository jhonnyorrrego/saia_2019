<?php

namespace Saia;

/**
 * TareasPlaneadas
 */
class TareasPlaneadas
{
    /**
     * @var integer
     */
    private $idtareasPlaneadas;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $fkTareasListado;

    /**
     * @var string
     */
    private $rolTareas;

    /**
     * @var \DateTime
     */
    private $fechaPlaneada;

    /**
     * @var \DateTime
     */
    private $fechaPlaneadaFin;


    /**
     * Get idtareasPlaneadas
     *
     * @return integer
     */
    public function getIdtareasPlaneadas()
    {
        return $this->idtareasPlaneadas;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return TareasPlaneadas
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
     * Set fkTareasListado
     *
     * @param integer $fkTareasListado
     *
     * @return TareasPlaneadas
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
     * Set rolTareas
     *
     * @param string $rolTareas
     *
     * @return TareasPlaneadas
     */
    public function setRolTareas($rolTareas)
    {
        $this->rolTareas = $rolTareas;

        return $this;
    }

    /**
     * Get rolTareas
     *
     * @return string
     */
    public function getRolTareas()
    {
        return $this->rolTareas;
    }

    /**
     * Set fechaPlaneada
     *
     * @param \DateTime $fechaPlaneada
     *
     * @return TareasPlaneadas
     */
    public function setFechaPlaneada($fechaPlaneada)
    {
        $this->fechaPlaneada = $fechaPlaneada;

        return $this;
    }

    /**
     * Get fechaPlaneada
     *
     * @return \DateTime
     */
    public function getFechaPlaneada()
    {
        return $this->fechaPlaneada;
    }

    /**
     * Set fechaPlaneadaFin
     *
     * @param \DateTime $fechaPlaneadaFin
     *
     * @return TareasPlaneadas
     */
    public function setFechaPlaneadaFin($fechaPlaneadaFin)
    {
        $this->fechaPlaneadaFin = $fechaPlaneadaFin;

        return $this;
    }

    /**
     * Get fechaPlaneadaFin
     *
     * @return \DateTime
     */
    public function getFechaPlaneadaFin()
    {
        return $this->fechaPlaneadaFin;
    }
}

