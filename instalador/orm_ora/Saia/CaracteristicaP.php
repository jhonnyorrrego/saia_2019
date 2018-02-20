<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristicaP
 *
 * @ORM\Table(name="caracteristica_p")
 * @ORM\Entity
 */
class CaracteristicaP
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcaracteristica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idcaracteristica;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=200, nullable=false)
     */
    private $valor;


}

