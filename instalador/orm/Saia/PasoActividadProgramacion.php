<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoActividadProgramacion
 *
 * @ORM\Table(name="paso_actividad_programacion")
 * @ORM\Entity
 */
class PasoActividadProgramacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_actividad_programacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoActividadProgramacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="datetime", nullable=false)
     */
    private $inicio;

    /**
     * @var string
     *
     * @ORM\Column(name="meses", type="string", length=255, nullable=false)
     */
    private $meses;

    /**
     * @var string
     *
     * @ORM\Column(name="dias", type="string", length=255, nullable=false)
     */
    private $dias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirar", type="datetime", nullable=true)
     */
    private $expirar;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="actividad_idpaso_actividad", type="integer", nullable=false)
     */
    private $actividadIdpasoActividad;



    /**
     * Get idpasoActividadProgramacion
     *
     * @return integer
     */
    public function getIdpasoActividadProgramacion()
    {
        return $this->idpasoActividadProgramacion;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     *
     * @return PasoActividadProgramacion
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set meses
     *
     * @param string $meses
     *
     * @return PasoActividadProgramacion
     */
    public function setMeses($meses)
    {
        $this->meses = $meses;

        return $this;
    }

    /**
     * Get meses
     *
     * @return string
     */
    public function getMeses()
    {
        return $this->meses;
    }

    /**
     * Set dias
     *
     * @param string $dias
     *
     * @return PasoActividadProgramacion
     */
    public function setDias($dias)
    {
        $this->dias = $dias;

        return $this;
    }

    /**
     * Get dias
     *
     * @return string
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * Set expirar
     *
     * @param \DateTime $expirar
     *
     * @return PasoActividadProgramacion
     */
    public function setExpirar($expirar)
    {
        $this->expirar = $expirar;

        return $this;
    }

    /**
     * Get expirar
     *
     * @return \DateTime
     */
    public function getExpirar()
    {
        return $this->expirar;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return PasoActividadProgramacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set actividadIdpasoActividad
     *
     * @param integer $actividadIdpasoActividad
     *
     * @return PasoActividadProgramacion
     */
    public function setActividadIdpasoActividad($actividadIdpasoActividad)
    {
        $this->actividadIdpasoActividad = $actividadIdpasoActividad;

        return $this;
    }

    /**
     * Get actividadIdpasoActividad
     *
     * @return integer
     */
    public function getActividadIdpasoActividad()
    {
        return $this->actividadIdpasoActividad;
    }
}
