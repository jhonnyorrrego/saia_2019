<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemDespachoIngres
 *
 * @ORM\Table(name="ft_item_despacho_ingres", indexes={@ORM\Index(name="i_item_despacho_ingres_despacho_i", columns={"ft_despacho_ingresados"}), @ORM\Index(name="i_item_despacho_ingres_destino_ra", columns={"ft_destino_radicacio"}), @ORM\Index(name="i_item_despacho_ingres_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtItemDespachoIngres
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_despacho_ingres", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemDespachoIngres;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_destino_radicacio", type="integer", nullable=false)
     */
    private $ftDestinoRadicacio;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_despacho_ingresados", type="integer", nullable=false)
     */
    private $ftDespachoIngresados;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftItemDespachoIngres
     *
     * @return integer
     */
    public function getIdftItemDespachoIngres()
    {
        return $this->idftItemDespachoIngres;
    }

    /**
     * Set ftDestinoRadicacio
     *
     * @param integer $ftDestinoRadicacio
     *
     * @return FtItemDespachoIngres
     */
    public function setFtDestinoRadicacio($ftDestinoRadicacio)
    {
        $this->ftDestinoRadicacio = $ftDestinoRadicacio;

        return $this;
    }

    /**
     * Get ftDestinoRadicacio
     *
     * @return integer
     */
    public function getFtDestinoRadicacio()
    {
        return $this->ftDestinoRadicacio;
    }

    /**
     * Set ftDespachoIngresados
     *
     * @param integer $ftDespachoIngresados
     *
     * @return FtItemDespachoIngres
     */
    public function setFtDespachoIngresados($ftDespachoIngresados)
    {
        $this->ftDespachoIngresados = $ftDespachoIngresados;

        return $this;
    }

    /**
     * Get ftDespachoIngresados
     *
     * @return integer
     */
    public function getFtDespachoIngresados()
    {
        return $this->ftDespachoIngresados;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtItemDespachoIngres
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
