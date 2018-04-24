<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfEmpresaTrans
 *
 * @ORM\Table(name="cf_empresa_trans")
 * @ORM\Entity
 */
class CfEmpresaTrans
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_empresa_trans", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcfEmpresaTrans;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_padre", type="string", length=255, nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=true)
     */
    private $categoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;


}
