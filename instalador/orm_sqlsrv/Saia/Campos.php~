<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campos
 *
 * @ORM\Table(name="campos")
 * @ORM\Entity
 */
class Campos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcampos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=false)
     */
    private $alias = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tabla", type="string", length=255, nullable=false)
     */
    private $tabla = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo = 'TEXT';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="string", length=255, nullable=true)
     */
    private $ayuda;

    /**
     * @var integer
     *
     * @ORM\Column(name="visible", type="integer", nullable=false)
     */
    private $visible = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="seleccionado", type="string", length=1, nullable=false)
     */
    private $seleccionado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=20, nullable=false)
     */
    private $tipoDato = 'varchar';


}

