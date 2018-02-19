<?php

namespace Saia;

/**
 * FuncionarioValidacion
 */
class FuncionarioValidacion
{
    /**
     * @var integer
     */
    private $idfuncionarioValidacion;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $tipo;


    /**
     * Get idfuncionarioValidacion
     *
     * @return integer
     */
    public function getIdfuncionarioValidacion()
    {
        return $this->idfuncionarioValidacion;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FuncionarioValidacion
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
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return FuncionarioValidacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}

