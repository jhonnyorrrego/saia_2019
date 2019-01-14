<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfMotivoIncapacidad
 *
 * @ORM\Table(name="cf_motivo_incapacidad")
 * @ORM\Entity
 */
class CfMotivoIncapacidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_motivo_incapacidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfMotivoIncapacidad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;


}

