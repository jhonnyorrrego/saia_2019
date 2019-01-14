<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemConclusiones
 *
 * @ORM\Table(name="ft_item_conclusiones")
 * @ORM\Entity
 */
class FtItemConclusiones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_conclusiones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemConclusiones;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta_reunion", type="integer", nullable=false)
     */
    private $ftActaReunion;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusiones", type="text", length=65535, nullable=false)
     */
    private $conclusiones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}

