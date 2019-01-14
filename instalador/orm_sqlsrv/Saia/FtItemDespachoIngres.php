<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemDespachoIngres
 *
 * @ORM\Table(name="ft_item_despacho_ingres")
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


}
