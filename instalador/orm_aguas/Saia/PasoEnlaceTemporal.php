<?php

namespace Saia;

/**
 * PasoEnlaceTemporal
 */
class PasoEnlaceTemporal
{
    /**
     * @var integer
     */
    private $idpasoEnlaceTemporal;

    /**
     * @var string
     */
    private $origen;

    /**
     * @var integer
     */
    private $destino;

    /**
     * @var integer
     */
    private $diagramIddiagram;

    /**
     * @var integer
     */
    private $idconector;


    /**
     * Get idpasoEnlaceTemporal
     *
     * @return integer
     */
    public function getIdpasoEnlaceTemporal()
    {
        return $this->idpasoEnlaceTemporal;
    }

    /**
     * Set origen
     *
     * @param string $origen
     *
     * @return PasoEnlaceTemporal
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set destino
     *
     * @param integer $destino
     *
     * @return PasoEnlaceTemporal
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
     * Set diagramIddiagram
     *
     * @param integer $diagramIddiagram
     *
     * @return PasoEnlaceTemporal
     */
    public function setDiagramIddiagram($diagramIddiagram)
    {
        $this->diagramIddiagram = $diagramIddiagram;

        return $this;
    }

    /**
     * Get diagramIddiagram
     *
     * @return integer
     */
    public function getDiagramIddiagram()
    {
        return $this->diagramIddiagram;
    }

    /**
     * Set idconector
     *
     * @param integer $idconector
     *
     * @return PasoEnlaceTemporal
     */
    public function setIdconector($idconector)
    {
        $this->idconector = $idconector;

        return $this;
    }

    /**
     * Get idconector
     *
     * @return integer
     */
    public function getIdconector()
    {
        return $this->idconector;
    }
}

