<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaFormato
 *
 * @ORM\Table(name="CATEGORIA_FORMATO")
 * @ORM\Entity
 */
class CategoriaFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCATEGORIA_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CATEGORIA_FORMATO_IDCATEGORIA_", allocationSize=1, initialValue=1)
     */
    private $idcategoriaFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado;


}

