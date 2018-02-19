<?php

namespace Saia;

/**
 * ReemplazoSaia
 */
class ReemplazoSaia
{
    /**
     * @var integer
     */
    private $idreemplazoSaia;

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
    private $estado;

    /**
     * @var integer
     */
    private $tipoReemplazo;

    /**
     * @var string
     */
    private $observaciones;


    /**
     * Get idreemplazoSaia
     *
     * @return integer
     */
    public function getIdreemplazoSaia()
    {
        return $this->idreemplazoSaia;
    }

    /**
     * Set antiguo
     *
     * @param integer $antiguo
     *
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * Set estado
     *
     * @param string $estado
     *
     * @return ReemplazoSaia
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoReemplazo
     *
     * @param integer $tipoReemplazo
     *
     * @return ReemplazoSaia
     */
    public function setTipoReemplazo($tipoReemplazo)
    {
        $this->tipoReemplazo = $tipoReemplazo;

        return $this;
    }

    /**
     * Get tipoReemplazo
     *
     * @return integer
     */
    public function getTipoReemplazo()
    {
        return $this->tipoReemplazo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return ReemplazoSaia
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

