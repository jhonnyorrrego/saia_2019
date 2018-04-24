<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Binario
 *
 * @ORM\Table(name="binario")
 * @ORM\Entity
 */
class Binario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbinario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbinario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_original", type="string", length=255, nullable=true)
     */
    private $nombreOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="datos", type="blob", length=16777215, nullable=true)
     */
    private $datos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion = 'CURRENT_TIMESTAMP';


}
