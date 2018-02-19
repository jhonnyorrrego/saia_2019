<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEstructuraArmadaH
 *
 * @ORM\Table(name="FT_ESTRUCTURA_ARMADA_H", indexes={@ORM\Index(name="i_ft_estructura_armada_p", columns={"FT_ESTRUCTURA_ARMADA_P"})})
 * @ORM\Entity
 */
class FtEstructuraArmadaH
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ESTRUCTURA_ARMADA_H", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ESTRUCTURA_ARMADA_H_IDFT_ES", allocationSize=1, initialValue=1)
     */
    private $idftEstructuraArmadaH;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ESTRUCTURA_ARMADA_P", type="integer", nullable=false)
     */
    private $ftEstructuraArmadaP;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}

