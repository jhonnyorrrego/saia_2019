<?php

namespace Saia;

/**
 * Reemplazo
 */
class Reemplazo
{
    /**
     * @var integer
     */
    private $idreemplazo;

    /**
     * @var integer
     */
    private $antiguo;

    /**
     * @var integer
     */
    private $nuevo;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     */
    private $fechaFin;

    /**
     * @var integer
     */
    private $cargoNuevo;

    /**
     * @var string
     */
    private $activo;


    /**
     * Get idreemplazo
     *
     * @return integer
     */
    public function getIdreemplazo()
    {
        return $this->idreemplazo;
    }

    /**
     * Set antiguo
     *
     * @param integer $antiguo
     *
     * @return Reemplazo
     */
    public function setAntiguo($antiguo)
    {
        $this->antiguo = $antiguo;

        return $this;
    }

    /**
     * Get antiguo
     *
     * @return integer
     */
    public function getAntiguo()
    {
        return $this->antiguo;
    }

    /**
     * Set nuevo
     *
     * @param integer $nuevo
     *
     * @return Reemplazo
     */
    public function setNuevo($nuevo)
    {
        $this->nuevo = $nuevo;

        return $this;
    }

    /**
     * Get nuevo
     *
     * @return integer
     */
    public function getNuevo()
    {
        return $this->nuevo;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Reemplazo
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
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Reemplazo
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set cargoNuevo
     *
     * @param integer $cargoNuevo
     *
     * @return Reemplazo
     */
    public function setCargoNuevo($cargoNuevo)
    {
        $this->cargoNuevo = $cargoNuevo;

        return $this;
    }

    /**
     * Get cargoNuevo
     *
     * @return integer
     */
    public function getCargoNuevo()
    {
        return $this->cargoNuevo;
    }

    /**
     * Set activo
     *
     * @param string $activo
     *
     * @return Reemplazo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return string
     */
    public function getActivo()
    {
        return $this->activo;
    }
}

