<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paso
 *
 * @ORM\Table(name="paso")
 * @ORM\Entity
 */
class Paso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaso;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="text", length=65535, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_paso", type="string", length=255, nullable=false)
     */
    private $nombrePaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="idfigura", type="string", length=255, nullable=false)
     */
    private $idfigura;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="posicion", type="string", length=255, nullable=true)
     */
    private $posicion;

    /**
     * @var string
     *
     * @ORM\Column(name="plazo_paso", type="string", length=255, nullable=true)
     */
    private $plazoPaso;


}

