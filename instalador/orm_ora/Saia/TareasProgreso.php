<?php

namespace Saia;

/**
 * TareasProgreso
 */
class TareasProgreso
{
    /**
     * @var integer
     */
    private $idtareasProgreso;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $fkTareasListado;

    /**
     * @var integer
     */
    private $progreso;

    /**
     * @var \DateTime
     */
    private $fechaProgreso;


    /**
     * Get idtareasProgreso
     *
     * @return integer
     */
    public function getIdtareasProgreso()
    {
        return $this->idtareasProgreso;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return TareasProgreso
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
     * @return TareasProgreso
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
     * Set progreso
     *
     * @param integer $progreso
     *
     * @return TareasProgreso
     */
    public function setProgreso($progreso)
    {
        $this->progreso = $progreso;

        return $this;
    }

    /**
     * Get progreso
     *
     * @return integer
     */
    public function getProgreso()
    {
        return $this->progreso;
    }

    /**
     * Set fechaProgreso
     *
     * @param \DateTime $fechaProgreso
     *
     * @return TareasProgreso
     */
    public function setFechaProgreso($fechaProgreso)
    {
        $this->fechaProgreso = $fechaProgreso;

        return $this;
    }

    /**
     * Get fechaProgreso
     *
     * @return \DateTime
     */
    public function getFechaProgreso()
    {
        return $this->fechaProgreso;
    }
}

