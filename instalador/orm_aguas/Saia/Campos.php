<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campos
 *
 * @ORM\Table(name="CAMPOS", indexes={@ORM\Index(name="i_campos_tipo_ctx", columns={"TIPO"})})
 * @ORM\Entity
 */
class Campos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCAMPOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CAMPOS_IDCAMPOS_seq", allocationSize=1, initialValue=1)
     */
    private $idcampos;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS", type="string", length=255, nullable=false)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA", type="string", length=255, nullable=false)
     */
    private $tabla;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=false)
     */
    private $tipo = 'TEXT';

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="string", length=255, nullable=true)
     */
    private $ayuda;

    /**
     * @var integer
     *
     * @ORM\Column(name="VISIBLE", type="integer", nullable=false)
     */
    private $visible = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="SELECCIONADO", type="string", length=1, nullable=false)
     */
    private $seleccionado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=20, nullable=false)
     */
    private $tipoDato = 'varchar';


}

