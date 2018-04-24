<?php

namespace Saia;

/**
 * FtElementoSalida
 */
class FtElementoSalida
{
    /**
     * @var integer
     */
    private $idftElementoSalida;

    /**
     * @var integer
     */
    private $ftSalidaElementos;

    /**
     * @var integer
     */
    private $itemSalida;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftElementoSalida
     *
     * @return integer
     */
    public function getIdftElementoSalida()
    {
        return $this->idftElementoSalida;
    }

    /**
     * Set ftSalidaElementos
     *
     * @param integer $ftSalidaElementos
     *
     * @return FtElementoSalida
     */
    public function setFtSalidaElementos($ftSalidaElementos)
    {
        $this->ftSalidaElementos = $ftSalidaElementos;

        return $this;
    }

    /**
     * Get ftSalidaElementos
     *
     * @return integer
     */
    public function getFtSalidaElementos()
    {
        return $this->ftSalidaElementos;
    }

    /**
     * Set itemSalida
     *
     * @param integer $itemSalida
     *
     * @return FtElementoSalida
     */
    public function setItemSalida($itemSalida)
    {
        $this->itemSalida = $itemSalida;

        return $this;
    }

    /**
     * Get itemSalida
     *
     * @return integer
     */
    public function getItemSalida()
    {
        return $this->itemSalida;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtElementoSalida
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

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtElementoSalida
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

