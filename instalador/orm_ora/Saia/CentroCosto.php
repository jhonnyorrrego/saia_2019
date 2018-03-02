<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentroCosto
 *
 * @ORM\Table(name="centro_costo")
 * @ORM\Entity
 */
class CentroCosto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcentro_costo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="CENTRO_COSTO_IDCENTRO_COSTO_se", allocationSize=1, initialValue=1)
     */
    private $idcentroCosto;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     */
    private $codigo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;


}

