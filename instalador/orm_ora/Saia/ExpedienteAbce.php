<?php

namespace Saia;

/**
 * ExpedienteAbce
 */
class ExpedienteAbce
{
    /**
     * @var integer
     */
    private $idexpedienteAbce;

    /**
     * @var integer
     */
    private $expedienteIdexpediente;

    /**
     * @var integer
     */
    private $estadoCierre;

    /**
     * @var \DateTime
     */
    private $fechaCierre;

    /**
     * @var integer
     */
    private $funcionarioCierre;

    /**
     * @var string
     */
    private $observaciones;


    /**
     * Get idexpedienteAbce
     *
     * @return integer
     */
    public function getIdexpedienteAbce()
    {
        return $this->idexpedienteAbce;
    }

    /**
     * Set expedienteIdexpediente
     *
     * @param integer $expedienteIdexpediente
     *
     * @return ExpedienteAbce
     */
    public function setExpedienteIdexpediente($expedienteIdexpediente)
    {
        $this->expedienteIdexpediente = $expedienteIdexpediente;

        return $this;
    }

    /**
     * Get expedienteIdexpediente
     *
     * @return integer
     */
    public function getExpedienteIdexpediente()
    {
        return $this->expedienteIdexpediente;
    }

    /**
     * Set estadoCierre
     *
     * @param integer $estadoCierre
     *
     * @return ExpedienteAbce
     */
    public function setEstadoCierre($estadoCierre)
    {
        $this->estadoCierre = $estadoCierre;

        return $this;
    }

    /**
     * Get estadoCierre
     *
     * @return integer
     */
    public function getEstadoCierre()
    {
        return $this->estadoCierre;
    }

    /**
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     *
     * @return ExpedienteAbce
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set funcionarioCierre
     *
     * @param integer $funcionarioCierre
     *
     * @return ExpedienteAbce
     */
    public function setFuncionarioCierre($funcionarioCierre)
    {
        $this->funcionarioCierre = $funcionarioCierre;

        return $this;
    }

    /**
     * Get funcionarioCierre
     *
     * @return integer
     */
    public function getFuncionarioCierre()
    {
        return $this->funcionarioCierre;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return ExpedienteAbce
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

