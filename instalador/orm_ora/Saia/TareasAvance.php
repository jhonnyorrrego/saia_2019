<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasAvance
 *
 * @ORM\Table(name="tareas_avance", indexes={@ORM\Index(name="i_tareas_avanc_ejecutor", columns={"ejecutor"})})
 * @ORM\Entity
 */
class TareasAvance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_avance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasAvance;

    /**
     * @var integer
     *
     * @ORM\Column(name="tareas_idtareas", type="integer", nullable=false)
     */
    private $tareasIdtareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor", type="integer", nullable=false)
     */
    private $ejecutor;


}
