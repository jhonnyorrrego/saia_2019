<?php

namespace Saia;

/**
 * EventoDespacho
 */
class EventoDespacho
{
    /**
     * @var integer
     */
    private $iddigitalizacion;

    /**
     * @var string
     */
    private $idftDestinoRadicacion;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $accion;

    /**
     * @var string
     */
    private $funcionario;

    /**
     * @var string
     */
    private $justificacion;


    /**
     * Get iddigitalizacion
     *
     * @return integer
     */
    public function getIddigitalizacion()
    {
        return $this->iddigitalizacion;
    }

    /**
     * Set idftDestinoRadicacion
     *
     * @param string $idftDestinoRadicacion
     *
     * @return EventoDespacho
     */
    public function setIdftDestinoRadicacion($idftDestinoRadicacion)
    {
        $this->idftDestinoRadicacion = $idftDestinoRadicacion;

        return $this;
    }

    /**
     * Get idftDestinoRadicacion
     *
     * @return string
     */
    public function getIdftDestinoRadicacion()
    {
        return $this->idftDestinoRadicacion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EventoDespacho
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set accion
     *
     * @param string $accion
     *
     * @return EventoDespacho
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set funcionario
     *
     * @param string $funcionario
     *
     * @return EventoDespacho
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return string
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     *
     * @return EventoDespacho
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }
}

