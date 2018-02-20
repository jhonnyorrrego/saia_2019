<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentroCosto
 *
 * @ORM\Table(name="CENTRO_COSTO")
 * @ORM\Entity
 */
class CentroCosto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCENTRO_COSTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CENTRO_COSTO_IDCENTRO_COSTO_se", allocationSize=1, initialValue=1)
     */
    private $idcentroCosto;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODIGO", type="integer", nullable=false)
     */
    private $codigo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}

