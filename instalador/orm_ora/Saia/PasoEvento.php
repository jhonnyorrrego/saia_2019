<?php

namespace Saia;

/**
 * PasoEvento
 */
class PasoEvento
{
    /**
     * @var integer
     */
    private $idpasoEvento;

    /**
     * @var integer
     */
    private $diagramIddiagram;

    /**
     * @var string
     */
    private $idevento;

    /**
     * @var string
     */
    private $tipoEvento;


    /**
     * Get idpasoEvento
     *
     * @return integer
     */
    public function getIdpasoEvento()
    {
        return $this->idpasoEvento;
    }

    /**
     * Set diagramIddiagram
     *
     * @param integer $diagramIddiagram
     *
     * @return PasoEvento
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
     * Set idevento
     *
     * @param string $idevento
     *
     * @return PasoEvento
     */
    public function setIdevento($idevento)
    {
        $this->idevento = $idevento;

        return $this;
    }

    /**
     * Get idevento
     *
     * @return string
     */
    public function getIdevento()
    {
        return $this->idevento;
    }

    /**
     * Set tipoEvento
     *
     * @param string $tipoEvento
     *
     * @return PasoEvento
     */
    public function setTipoEvento($tipoEvento)
    {
        $this->tipoEvento = $tipoEvento;

        return $this;
    }

    /**
     * Get tipoEvento
     *
     * @return string
     */
    public function getTipoEvento()
    {
        return $this->tipoEvento;
    }
}

