<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargo
 *
 * @ORM\Table(name="CARGO")
 * @ORM\Entity
 */
class Cargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCARGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CARGO_IDCARGO_seq", allocationSize=1, initialValue=1)
     */
    private $idcargo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre = 'null';

    /**
     * @var integer
     *
     * @ORM\Column(name="CODIGO_CARGO", type="integer", nullable=true)
     */
    private $codigoCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=true)
     */
    private $tipo = '1';


}
