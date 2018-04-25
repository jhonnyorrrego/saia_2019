<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionarioValidacion
 *
 * @ORM\Table(name="funcionario_validacion")
 * @ORM\Entity
 */
class FuncionarioValidacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario_validacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionarioValidacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
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
