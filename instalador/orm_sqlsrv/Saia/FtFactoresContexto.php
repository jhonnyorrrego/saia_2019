<?php

namespace Saia;

/**
 * FtFactoresContexto
 */
class FtFactoresContexto
{
    /**
     * @var integer
     */
    private $idftFactoresContexto;

    /**
     * @var string
     */
    private $factoresContexto;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $ftContextoExtrategico;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftFactoresContexto
     *
     * @return integer
     */
    public function getIdftFactoresContexto()
    {
        return $this->idftFactoresContexto;
    }

    /**
     * Set factoresContexto
     *
     * @param string $factoresContexto
     *
     * @return FtFactoresContexto
     */
    public function setFactoresContexto($factoresContexto)
    {
        $this->factoresContexto = $factoresContexto;

        return $this;
    }

    /**
     * Get factoresContexto
     *
     * @return string
     */
    public function getFactoresContexto()
    {
        return $this->factoresContexto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtFactoresContexto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set ftContextoExtrategico
     *
     * @param integer $ftContextoExtrategico
     *
     * @return FtFactoresContexto
     */
    public function setFtContextoExtrategico($ftContextoExtrategico)
    {
        $this->ftContextoExtrategico = $ftContextoExtrategico;

        return $this;
    }

    /**
     * Get ftContextoExtrategico
     *
     * @return integer
     */
    public function getFtContextoExtrategico()
    {
        return $this->ftContextoExtrategico;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFactoresContexto
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

