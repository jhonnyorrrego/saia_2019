<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Binario
 *
 * @ORM\Table(name="BINARIO")
 * @ORM\Entity
 */
class Binario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBINARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BINARIO_IDBINARIO_seq", allocationSize=1, initialValue=1)
     */
    private $idbinario;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ORIGINAL", type="string", length=255, nullable=true)
     */
    private $nombreOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="DATOS", type="blob", nullable=true)
     */
    private $datos = 'EMPTY_BLOB()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=true)
     */
    private $fechaCreacion = 'sysdate';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;


}
