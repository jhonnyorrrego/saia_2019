<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfAcciones
 *
 * @ORM\Table(name="cf_acciones")
 * @ORM\Entity
 */
class CfAcciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_acciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfAcciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", length=65535, nullable=false)
     */
    private $observacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=false)
     */
    private $codPadre;


}

