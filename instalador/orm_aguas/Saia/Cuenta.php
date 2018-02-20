<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuenta
 *
 * @ORM\Table(name="CUENTA")
 * @ORM\Entity
 */
class Cuenta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCUENTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CUENTA_IDCUENTA_seq", allocationSize=1, initialValue=1)
     */
    private $idcuenta;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=50, nullable=false)
     */
    private $codigo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;


}

