<?php

namespace Saia;

/**
 * TareasListadoTiempo
 */
class TareasListadoTiempo
{
    /**
     * @var integer
     */
    private $idtareasListadoTiempo;

    /**
     * @var integer
     */
    private $fkTareasListado;

    /**
     * @var \DateTime
     */
    private $fechaRegistro;

    /**
     * @var integer
     */
    private $tiempoRegistrado;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     */
    private $horaInicio;

    /**
     * @var \DateTime
     */
    private $horaFinal;

    /**
     * @var string
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

