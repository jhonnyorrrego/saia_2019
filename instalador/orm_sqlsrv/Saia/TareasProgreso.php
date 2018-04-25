<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasProgreso
 *
 * @ORM\Table(name="tareas_progreso")
 * @ORM\Entity
 */
class TareasProgreso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_progreso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareasProgreso;

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
     * @var integer
     *
     * @ORM\Column(name="progreso", type="integer", nullable=false)
     */
    private $progreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_progreso", type="datetime", nullable=false)
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
