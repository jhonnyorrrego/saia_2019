<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramClosed
 *
 * @ORM\Table(name="diagram_closed")
 * @ORM\Entity
 */
class DiagramClosed
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddiagram_closed", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddiagramClosed;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram_instance", type="integer", nullable=false)
     */
    private $diagramIddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_original", type="integer", nullable=false)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_final", type="integer", nullable=false)
     */
    private $estadoFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=16777215, nullable=false)
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
