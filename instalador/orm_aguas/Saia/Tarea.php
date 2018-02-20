<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarea
 *
 * @ORM\Table(name="TAREA")
 * @ORM\Entity
 */
class Tarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREA_IDTAREA_seq", allocationSize=1, initialValue=1)
     */
    private $idtarea;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_RESPUESTA", type="integer", nullable=true)
     */
    private $tiempoRespuesta = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=300, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPROGRAMA", type="integer", nullable=true)
     */
    private $reprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_REPROGRAMA", type="string", length=30, nullable=true)
     */
    private $tipoReprograma;


}
