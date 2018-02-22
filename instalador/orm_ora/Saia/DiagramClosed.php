<?php

namespace Saia;

/**
 * DiagramClosed
 */
class DiagramClosed
{
    /**
     * @var integer
     */
    private $iddiagramClosed;

    /**
     * @var integer
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $estadoOriginal;

    /**
     * @var integer
     */
    private $estadoFinal;

    /**
     * @var string
     */
    private $observaciones;


    /**
     * Get iddiagramClosed
     *
     * @return integer
     */
    public function getIddiagramClosed()
    {
        return $this->iddiagramClosed;
    }

    /**
     * Set diagramIddiagramInstance
     *
     * @param integer $diagramIddiagramInstance
     *
     * @return DiagramClosed
     */
    public function setDiagramIddiagramInstance($diagramIddiagramInstance)
    {
        $this->diagramIddiagramInstance = $diagramIddiagramInstance;

        return $this;
    }

    /**
     * Get diagramIddiagramInstance
     *
     * @return integer
     */
    public function getDiagramIddiagramInstance()
    {
        return $this->diagramIddiagramInstance;
    }

    /**
     * Set documentoIdpasoDocumento
     *
     * @param integer $documentoIdpasoDocumento
     *
     * @return DiagramClosed
     */
    public function setDocumentoIdpasoDocumento($documentoIdpasoDocumento)
    {
        $this->documentoIdpasoDocumento = $documentoIdpasoDocumento;

        return $this;
    }

    /**
     * Get documentoIdpasoDocumento
     *
     * @return integer
     */
    public function getDocumentoIdpasoDocumento()
    {
        return $this->documentoIdpasoDocumento;
    }

    /**
     * Set funcionarioCodigo
     *
     * @param integer $funcionarioCodigo
     *
     * @return DiagramClosed
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DiagramClosed
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
     * Set estadoOriginal
     *
     * @param integer $estadoOriginal
     *
     * @return DiagramClosed
     */
    public function setEstadoOriginal($estadoOriginal)
    {
        $this->estadoOriginal = $estadoOriginal;

        return $this;
    }

    /**
     * Get estadoOriginal
     *
     * @return integer
     */
    public function getEstadoOriginal()
    {
        return $this->estadoOriginal;
    }

    /**
     * Set estadoFinal
     *
     * @param integer $estadoFinal
     *
     * @return DiagramClosed
     */
    public function setEstadoFinal($estadoFinal)
    {
        $this->estadoFinal = $estadoFinal;

        return $this;
    }

    /**
     * Get estadoFinal
     *
     * @return integer
     */
    public function getEstadoFinal()
    {
        return $this->estadoFinal;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return DiagramClosed
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}

