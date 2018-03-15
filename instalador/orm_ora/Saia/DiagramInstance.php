<?php

namespace Saia;

/**
 * DiagramInstance
 */
class DiagramInstance
{
    /**
     * @var integer
     */
    private $iddiagramInstance;

    /**
     * @var integer
     */
    private $diagramIddiagram;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     */
    private $estadoDiagramInstance;


    /**
     * Get iddiagramInstance
     *
     * @return integer
     */
    public function getIddiagramInstance()
    {
        return $this->iddiagramInstance;
    }

    /**
     * Set diagramIddiagram
     *
     * @param integer $diagramIddiagram
     *
     * @return DiagramInstance
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DiagramInstance
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
     * Set funcionarioCodigo
     *
     * @param integer $funcionarioCodigo
     *
     * @return DiagramInstance
     */
    public function setFuncionarioCodigo($funcionarioCodigo)
    {
        $this->funcionarioCodigo = $funcionarioCodigo;

        return $this;
    }

    /**
     * Get funcionarioCodigo
     *
     * @return integer
     */
    public function getFuncionarioCodigo()
    {
        return $this->funcionarioCodigo;
    }

    /**
     * Set estadoDiagramInstance
     *
     * @param integer $estadoDiagramInstance
     *
     * @return DiagramInstance
     */
    public function setEstadoDiagramInstance($estadoDiagramInstance)
    {
        $this->estadoDiagramInstance = $estadoDiagramInstance;

        return $this;
    }

    /**
     * Get estadoDiagramInstance
     *
     * @return integer
     */
    public function getEstadoDiagramInstance()
    {
        return $this->estadoDiagramInstance;
    }
}

