<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfEmpresaTrans
 *
 * @ORM\Table(name="CF_EMPRESA_TRANS", indexes={@ORM\Index(name="i_cf_empresa_t_categoria", columns={"CATEGORIA"})})
 * @ORM\Entity
 */
class CfEmpresaTrans
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCF_EMPRESA_TRANS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CF_EMPRESA_TRANS_IDCF_EMPRESA_", allocationSize=1, initialValue=1)
     */
    private $idcfEmpresaTrans;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="COD_PADRE", type="string", length=255, nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="CATEGORIA", type="string", length=255, nullable=true)
     */
    private $categoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado;


}
