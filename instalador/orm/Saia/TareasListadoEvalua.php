<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoEvalua
 *
 * @ORM\Table(name="tareas_listado_evalua")
 * @ORM\Entity
 */
class TareasListadoEvalua
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_evalua", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasListadoEvalua;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion", type="integer", nullable=false)
     */
    private $calificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora", type="datetime", nullable=false)
     */
    private $fechaHora;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;



    /**
     * Get idtareasListadoEvalua
     *
     * @return integer
     */
    public function getIdtareasListadoEvalua()
    {
        return $this->idtareasListadoEvalua;
    }

    /**
     * Set fkTareasListado
     *
     * @param integer $fkTareasListado
     *
     * @return TareasListadoEvalua
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return TareasListadoEvalua
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
     * Set calificacion
     *
     * @param integer $calificacion
     *
     * @return TareasListadoEvalua
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return integer
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set fechaHora
     *
     * @param \DateTime $fechaHora
     *
     * @return TareasListadoEvalua
     */
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    /**
     * Get fechaHora
     *
     * @return \DateTime
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return TareasListadoEvalua
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
