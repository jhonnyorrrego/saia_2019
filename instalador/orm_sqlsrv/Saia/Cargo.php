<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargo
 *
 * @ORM\Table(name="cargo")
 * @ORM\Entity
 */
class Cargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcargo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcargo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_cargo", type="integer", nullable=true)
     */
    private $codigoCargo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_cargo", type="integer", nullable=false)
     */
    private $tipoCargo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="pertenece_nucleo", type="integer", nullable=false)
     */
    private $perteneceNucleo = '0';


}
