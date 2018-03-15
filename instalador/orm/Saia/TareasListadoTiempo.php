<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoTiempo
 *
 * @ORM\Table(name="tareas_listado_tiempo")
 * @ORM\Entity
 */
class TareasListadoTiempo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_tiempo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasListadoTiempo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fechaRegistro = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_registrado", type="integer", nullable=false)
     */
    private $tiempoRegistrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", length=65535, nullable=true)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final", type="time", nullable=false)
     */
    private $horaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_avance", type="string", nullable=false)
     */
    private $estadoAvance;



    /**
     * Get idtareasListadoTiempo
     *
     * @return integer
     */
    public function getIdtareasListadoTiempo()
    {
        return $this->idtareasListadoTiempo;
    }

    /**
     * Set fkTareasListado
     *
     * @param integer $fkTareasListado
     *
     * @return TareasListadoTiempo
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return TareasListadoTiempo
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set tiempoRegistrado
     *
     * @param integer $tiempoRegistrado
     *
     * @return TareasListadoTiempo
     */
    public function setTiempoRegistrado($tiempoRegistrado)
    {
        $this->tiempoRegistrado = $tiempoRegistrado;

        return $this;
    }

    /**
     * Get tiempoRegistrado
     *
     * @return integer
     */
    public function getTiempoRegistrado()
    {
        return $this->tiempoRegistrado;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return TareasListadoTiempo
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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return TareasListadoTiempo
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return TareasListadoTiempo
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     *
     * @return TareasListadoTiempo
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinal
     *
     * @param \DateTime $horaFinal
     *
     * @return TareasListadoTiempo
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return \DateTime
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    /**
     * Set estadoAvance
     *
     * @param string $estadoAvance
     *
     * @return TareasListadoTiempo
     */
    public function setEstadoAvance($estadoAvance)
    {
        $this->estadoAvance = $estadoAvance;

        return $this;
    }

    /**
     * Get estadoAvance
     *
     * @return string
     */
    public function getEstadoAvance()
    {
        return $this->estadoAvance;
    }
}
