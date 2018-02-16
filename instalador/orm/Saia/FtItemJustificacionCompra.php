<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemJustificacionCompra
 *
 * @ORM\Table(name="ft_item_justificacion_compra")
 * @ORM\Entity
 */
class FtItemJustificacionCompra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_justificacion_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftItemJustificacionCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=255, nullable=false)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_item", type="string", length=255, nullable=false)
     */
    private $descripcionItem;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_justificacion_compra", type="integer", nullable=false)
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
