<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarea
 *
 * @ORM\Table(name="tarea")
 * @ORM\Entity
 */
class Tarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtarea;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_respuesta", type="integer", nullable=true)
     */
    private $tiempoRespuesta = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=300, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reprograma", type="boolean", nullable=true)
     */
    private $reprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_reprograma", type="string", length=30, nullable=true)
     */
    private $tipoReprograma;


}

