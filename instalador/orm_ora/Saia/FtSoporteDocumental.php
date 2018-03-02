<?php

namespace Saia;

/**
 * FtSoporteDocumental
 */
class FtSoporteDocumental
{
    /**
     * @var integer
     */
    private $idftSoporteDocumental;

    /**
     * @var integer
     */
    private $ftAcopio;

    /**
     * @var string
     */
    private $soportesDocumental;

    /**
     * @var integer
     */
    private $tipoSoporte;

    /**
     * @var string
     */
    private $observaciones;


    /**
     * Get idftSoporteDocumental
     *
     * @return integer
     */
    public function getIdftSoporteDocumental()
    {
        return $this->idftSoporteDocumental;
    }

    /**
     * Set ftAcopio
     *
     * @param integer $ftAcopio
     *
     * @return FtSoporteDocumental
     */
    public function setFtAcopio($ftAcopio)
    {
        $this->ftAcopio = $ftAcopio;

        return $this;
    }

    /**
     * Get ftAcopio
     *
     * @return integer
     */
    public function getFtAcopio()
    {
        return $this->ftAcopio;
    }

    /**
     * Set soportesDocumental
     *
     * @param string $soportesDocumental
     *
     * @return FtSoporteDocumental
     */
    public function setSoportesDocumental($soportesDocumental)
    {
        $this->soportesDocumental = $soportesDocumental;

        return $this;
    }

    /**
     * Get soportesDocumental
     *
     * @return string
     */
    public function getSoportesDocumental()
    {
        return $this->soportesDocumental;
    }

    /**
     * Set tipoSoporte
     *
     * @param integer $tipoSoporte
     *
     * @return FtSoporteDocumental
     */
    public function setTipoSoporte($tipoSoporte)
    {
        $this->tipoSoporte = $tipoSoporte;

        return $this;
    }

    /**
     * Get tipoSoporte
     *
     * @return integer
     */
    public function getTipoSoporte()
    {
        return $this->tipoSoporte;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSoporteDocumental
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

