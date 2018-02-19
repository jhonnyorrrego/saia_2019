<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campos
 *
 * @ORM\Table(name="CAMPOS")
 * @ORM\Entity
 */
class Campos
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDCAMPOS", type="decimal", precision=11, scale=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CAMPOS_IDCAMPOS_seq", allocationSize=1, initialValue=1)
     */
    private $idcampos;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS", type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA", type="string", length=255, nullable=true)
     */
    private $tabla;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=true)
     */
    private $tipo;

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
     * @var string
     *
     * @ORM\Column(name="VISIBLE", type="string", length=1, nullable=true)
     */
    private $visible = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="SELECCIONADO", type="string", length=1, nullable=true)
     */
    private $seleccionado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=20, nullable=true)
     */
    private $tipoDato = 'text';


}

