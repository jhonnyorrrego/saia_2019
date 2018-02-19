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
     * @ORM\Column(name="NOMBRE", type="string", length=250, nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RESPUESTA", type="date", nullable=true)
     */
    private $respuesta = 'TO_DATE(\'01-06-70 00:00:00\', \'dd-MM-yy hh24:mi:ss\')';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=200, nullable=true)
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

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_RESPUESTA", type="integer", nullable=true)
     */
    private $tiempoRespuesta;


}

