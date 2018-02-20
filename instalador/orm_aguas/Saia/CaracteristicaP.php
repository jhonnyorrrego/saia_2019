<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristicaP
 *
 * @ORM\Table(name="CARACTERISTICA_P")
 * @ORM\Entity
 */
class CaracteristicaP
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCARACTERISTICA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcaracteristica;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=200, nullable=false)
     */
    private $valor;


}

