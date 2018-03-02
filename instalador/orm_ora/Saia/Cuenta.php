<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuenta
 *
 * @ORM\Table(name="cuenta")
 * @ORM\Entity
 */
class Cuenta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcuenta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="CUENTA_IDCUENTA_seq", allocationSize=1, initialValue=1)
     */
    private $idcuenta;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50, nullable=false)
     */
    private $codigo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;


}

