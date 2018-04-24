<?php

namespace Saia;

/**
 * FtAccesoriosVehiculo
 */
class FtAccesoriosVehiculo
{
    /**
     * @var integer
     */
    private $idftAccesoriosVehiculo;

    /**
     * @var integer
     */
    private $ftDatosVehiculo;

    /**
     * @var string
     */
    private $accesorioVehiculo;

    /**
     * @var integer
     */
    private $valorAccesorio;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftAccesoriosVehiculo
     *
     * @return integer
     */
    public function getIdftAccesoriosVehiculo()
    {
        return $this->idftAccesoriosVehiculo;
    }

    /**
     * Set ftDatosVehiculo
     *
     * @param integer $ftDatosVehiculo
     *
     * @return FtAccesoriosVehiculo
     */
    public function setFtDatosVehiculo($ftDatosVehiculo)
    {
        $this->ftDatosVehiculo = $ftDatosVehiculo;

        return $this;
    }

    /**
     * Get ftDatosVehiculo
     *
     * @return integer
     */
    public function getFtDatosVehiculo()
    {
        return $this->ftDatosVehiculo;
    }

    /**
     * Set accesorioVehiculo
     *
     * @param string $accesorioVehiculo
     *
     * @return FtAccesoriosVehiculo
     */
    public function setAccesorioVehiculo($accesorioVehiculo)
    {
        $this->accesorioVehiculo = $accesorioVehiculo;

        return $this;
    }

    /**
     * Get accesorioVehiculo
     *
     * @return string
     */
    public function getAccesorioVehiculo()
    {
        return $this->accesorioVehiculo;
    }

    /**
     * Set valorAccesorio
     *
     * @param integer $valorAccesorio
     *
     * @return FtAccesoriosVehiculo
     */
    public function setValorAccesorio($valorAccesorio)
    {
        $this->valorAccesorio = $valorAccesorio;

        return $this;
    }

    /**
     * Get valorAccesorio
     *
     * @return integer
     */
    public function getValorAccesorio()
    {
        return $this->valorAccesorio;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAccesoriosVehiculo
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }
}

