<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtElementoSalida
 *
 * @ORM\Table(name="ft_elemento_salida", indexes={@ORM\Index(name="i_elemento_salida_salida_ele", columns={"ft_salida_elementos"}), @ORM\Index(name="i_elemento_salida_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtElementoSalida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_elemento_salida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftElementoSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_salida_elementos", type="integer", nullable=false)
     */
    private $ftSalidaElementos;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_salida", type="integer", nullable=false)
     */
    private $itemSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
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
