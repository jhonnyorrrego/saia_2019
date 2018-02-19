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
     * @ORM\Column(name="IDCARACTERISTICA_P", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CARACTERISTICA_P_IDCARACTERIST", allocationSize=1, initialValue=1)
     */
    private $idcaracteristicaP;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=true)
     */
    private $pantallaIdpantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=30, nullable=true)
     */
    private $nombre = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=200, nullable=true)
     */
    private $valor = ' ';


}

