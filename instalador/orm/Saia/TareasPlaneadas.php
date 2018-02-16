<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasPlaneadas
 *
 * @ORM\Table(name="tareas_planeadas")
 * @ORM\Entity
 */
class TareasPlaneadas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_planeadas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasPlaneadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var string
     *
     * @ORM\Column(name="rol_tareas", type="string", length=255, nullable=false)
     */
    private $rolTareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_planeada", type="datetime", nullable=true)
     */
    private $fechaPlaneada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_planeada_fin", type="datetime", nullable=true)
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
