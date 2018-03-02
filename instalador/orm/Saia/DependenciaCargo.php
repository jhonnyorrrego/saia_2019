<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DependenciaCargo
 *
 * @ORM\Table(name="dependencia_cargo", indexes={@ORM\Index(name="i_dependencia__dependencia_", columns={"dependencia_iddependencia"}), @ORM\Index(name="i_dependencia__funcionario_", columns={"funcionario_idfuncionario"}), @ORM\Index(name="i_dependencia__cargo_idcarg", columns={"cargo_idcargo"})})
 * @ORM\Entity
 */
class DependenciaCargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddependencia_cargo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddependenciaCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia_iddependencia", type="integer", nullable=false)
     */
    private $dependenciaIddependencia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_idcargo", type="integer", nullable=false)
     */
    private $cargoIdcargo = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="datetime", nullable=false)
     */
    private $fechaInicial = '2006-12-31 21:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="datetime", nullable=false)
     */
    private $fechaFinal = '2010-12-31 21:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime", nullable=false)
     */
    private $fechaIngreso = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo = '1';



    /**
     * Get iddependenciaCargo
     *
     * @return integer
     */
    public function getIddependenciaCargo()
    {
        return $this->iddependenciaCargo;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return DependenciaCargo
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
     * Set dependenciaIddependencia
     *
     * @param integer $dependenciaIddependencia
     *
     * @return DependenciaCargo
     */
    public function setDependenciaIddependencia($dependenciaIddependencia)
    {
        $this->dependenciaIddependencia = $dependenciaIddependencia;

        return $this;
    }

    /**
     * Get dependenciaIddependencia
     *
     * @return integer
     */
    public function getDependenciaIddependencia()
    {
        return $this->dependenciaIddependencia;
    }

    /**
     * Set cargoIdcargo
     *
     * @param integer $cargoIdcargo
     *
     * @return DependenciaCargo
     */
    public function setCargoIdcargo($cargoIdcargo)
    {
        $this->cargoIdcargo = $cargoIdcargo;

        return $this;
    }

    /**
     * Get cargoIdcargo
     *
     * @return integer
     */
    public function getCargoIdcargo()
    {
        return $this->cargoIdcargo;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return DependenciaCargo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaInicial
     *
     * @param \DateTime $fechaInicial
     *
     * @return DependenciaCargo
     */
    public function setFechaInicial($fechaInicial)
    {
        $this->fechaInicial = $fechaInicial;

        return $this;
    }

    /**
     * Get fechaInicial
     *
     * @return \DateTime
     */
    public function getFechaInicial()
    {
        return $this->fechaInicial;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return DependenciaCargo
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return DependenciaCargo
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set tipo
     *
     * @param boolean $tipo
     *
     * @return DependenciaCargo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return boolean
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
