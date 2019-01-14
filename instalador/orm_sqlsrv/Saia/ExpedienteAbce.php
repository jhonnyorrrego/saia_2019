<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteAbce
 *
 * @ORM\Table(name="expediente_abce")
 * @ORM\Entity
 */
class ExpedienteAbce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idexpediente_abce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexpedienteAbce;

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_cierre", type="integer", nullable=false)
     */
    private $estadoCierre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="date", nullable=false)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_cierre", type="integer", nullable=false)
     */
    private $funcionarioCierre;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
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
