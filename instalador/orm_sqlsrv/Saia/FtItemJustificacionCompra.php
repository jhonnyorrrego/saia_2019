<?php

namespace Saia;

/**
 * FtItemJustificacionCompra
 */
class FtItemJustificacionCompra
{
    /**
     * @var integer
     */
    private $idftItemJustificacionCompra;

    /**
     * @var string
     */
    private $cantidad;

    /**
     * @var string
     */
    private $descripcionItem;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $ftJustificacionCompra;


    /**
     * Get idftItemJustificacionCompra
     *
     * @return integer
     */
    public function getIdftItemJustificacionCompra()
    {
        return $this->idftItemJustificacionCompra;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return FtItemJustificacionCompra
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set descripcionItem
     *
     * @param string $descripcionItem
     *
     * @return FtItemJustificacionCompra
     */
    public function setDescripcionItem($descripcionItem)
    {
        $this->descripcionItem = $descripcionItem;

        return $this;
    }

    /**
     * Get descripcionItem
     *
     * @return string
     */
    public function getDescripcionItem()
    {
        return $this->descripcionItem;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return FtItemJustificacionCompra
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtItemJustificacionCompra
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

    /**
     * Set ftJustificacionCompra
     *
     * @param integer $ftJustificacionCompra
     *
     * @return FtItemJustificacionCompra
     */
    public function setFtJustificacionCompra($ftJustificacionCompra)
    {
        $this->ftJustificacionCompra = $ftJustificacionCompra;

        return $this;
    }

    /**
     * Get ftJustificacionCompra
     *
     * @return integer
     */
    public function getFtJustificacionCompra()
    {
        return $this->ftJustificacionCompra;
    }
}

