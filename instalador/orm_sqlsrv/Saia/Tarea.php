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



    /**
     * Get idtarea
     *
     * @return integer
     */
    public function getIdtarea()
    {
        return $this->idtarea;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Tarea
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Tarea
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tiempoRespuesta
     *
     * @param integer $tiempoRespuesta
     *
     * @return Tarea
     */
    public function setTiempoRespuesta($tiempoRespuesta)
    {
        $this->tiempoRespuesta = $tiempoRespuesta;

        return $this;
    }

    /**
     * Get tiempoRespuesta
     *
     * @return integer
     */
    public function getTiempoRespuesta()
    {
        return $this->tiempoRespuesta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tarea
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set reprograma
     *
     * @param boolean $reprograma
     *
     * @return Tarea
     */
    public function setReprograma($reprograma)
    {
        $this->reprograma = $reprograma;

        return $this;
    }

    /**
     * Get reprograma
     *
     * @return boolean
     */
    public function getReprograma()
    {
        return $this->reprograma;
    }

    /**
     * Set tipoReprograma
     *
     * @param string $tipoReprograma
     *
     * @return Tarea
     */
    public function setTipoReprograma($tipoReprograma)
    {
        $this->tipoReprograma = $tipoReprograma;

        return $this;
    }

    /**
     * Get tipoReprograma
     *
     * @return string
     */
    public function getTipoReprograma()
    {
        return $this->tipoReprograma;
    }
}
