<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEstructuraArmadaP
 *
 * @ORM\Table(name="FT_ESTRUCTURA_ARMADA_P")
 * @ORM\Entity
 */
class FtEstructuraArmadaP
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ESTRUCTURA_ARMADA_P", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ESTRUCTURA_ARMADA_P_IDFT_ES", allocationSize=1, initialValue=1)
     */
    private $idftEstructuraArmadaP;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}

