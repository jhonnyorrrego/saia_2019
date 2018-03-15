<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respuesta
 *
 * @ORM\Table(name="respuesta", indexes={@ORM\Index(name="i_respuesta_destino", columns={"destino"}), @ORM\Index(name="i_respuesta_origen", columns={"origen"})})
 * @ORM\Entity
 */
class Respuesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrespuesta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idrespuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=false)
     */
    private $destino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idbuzon", type="integer", nullable=false)
     */
    private $idbuzon = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="plantilla", type="string", length=30, nullable=false)
     */
    private $plantilla = 'CARTA';



    /**
     * Get idrespuesta
     *
     * @return integer
     */
    public function getIdrespuesta()
    {
        return $this->idrespuesta;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Respuesta
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
     * Set destino
     *
     * @param integer $destino
     *
     * @return Respuesta
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return integer
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set origen
     *
     * @param integer $origen
     *
     * @return Respuesta
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return integer
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set idbuzon
     *
     * @param integer $idbuzon
     *
     * @return Respuesta
     */
    public function setIdbuzon($idbuzon)
    {
        $this->idbuzon = $idbuzon;

        return $this;
    }

    /**
     * Get idbuzon
     *
     * @return integer
     */
    public function getIdbuzon()
    {
        return $this->idbuzon;
    }

    /**
     * Set plantilla
     *
     * @param string $plantilla
     *
     * @return Respuesta
     */
    public function setPlantilla($plantilla)
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    /**
     * Get plantilla
     *
     * @return string
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }
}
