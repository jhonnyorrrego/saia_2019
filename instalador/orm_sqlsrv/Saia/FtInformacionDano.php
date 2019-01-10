<?php

namespace Saia;

/**
 * FtInformacionDano
 */
class FtInformacionDano
{
    /**
     * @var integer
     */
    private $idftInformacionDano;

    /**
     * @var string
     */
    private $problema;

    /**
     * @var integer
     */
    private $ftOrdenTrabajoVehiculo;

    /**
     * @var string
     */
    private $x;

    /**
     * @var string
     */
    private $y;

    /**
     * @var string
     */
    private $x2;

    /**
     * @var string
     */
    private $y2;

    /**
     * @var string
     */
    private $w;

    /**
     * @var string
     */
    private $h;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftInformacionDano
     *
     * @return integer
     */
    public function getIdftInformacionDano()
    {
        return $this->idftInformacionDano;
    }

    /**
     * Set problema
     *
     * @param string $problema
     *
     * @return FtInformacionDano
     */
    public function setProblema($problema)
    {
        $this->problema = $problema;

        return $this;
    }

    /**
     * Get problema
     *
     * @return string
     */
    public function getProblema()
    {
        return $this->problema;
    }

    /**
     * Set ftOrdenTrabajoVehiculo
     *
     * @param integer $ftOrdenTrabajoVehiculo
     *
     * @return FtInformacionDano
     */
    public function setFtOrdenTrabajoVehiculo($ftOrdenTrabajoVehiculo)
    {
        $this->ftOrdenTrabajoVehiculo = $ftOrdenTrabajoVehiculo;

        return $this;
    }

    /**
     * Get ftOrdenTrabajoVehiculo
     *
     * @return integer
     */
    public function getFtOrdenTrabajoVehiculo()
    {
        return $this->ftOrdenTrabajoVehiculo;
    }

    /**
     * Set x
     *
     * @param string $x
     *
     * @return FtInformacionDano
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get x
     *
     * @return string
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param string $y
     *
     * @return FtInformacionDano
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get y
     *
     * @return string
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set x2
     *
     * @param string $x2
     *
     * @return FtInformacionDano
     */
    public function setX2($x2)
    {
        $this->x2 = $x2;

        return $this;
    }

    /**
     * Get x2
     *
     * @return string
     */
    public function getX2()
    {
        return $this->x2;
    }

    /**
     * Set y2
     *
     * @param string $y2
     *
     * @return FtInformacionDano
     */
    public function setY2($y2)
    {
        $this->y2 = $y2;

        return $this;
    }

    /**
     * Get y2
     *
     * @return string
     */
    public function getY2()
    {
        return $this->y2;
    }

    /**
     * Set w
     *
     * @param string $w
     *
     * @return FtInformacionDano
     */
    public function setW($w)
    {
        $this->w = $w;

        return $this;
    }

    /**
     * Get w
     *
     * @return string
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * Set h
     *
     * @param string $h
     *
     * @return FtInformacionDano
     */
    public function setH($h)
    {
        $this->h = $h;

        return $this;
    }

    /**
     * Get h
     *
     * @return string
     */
    public function getH()
    {
        return $this->h;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInformacionDano
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

