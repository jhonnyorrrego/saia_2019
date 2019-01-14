<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagramInstance
 *
 * @ORM\Table(name="diagram_instance")
 * @ORM\Entity
 */
class DiagramInstance
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddiagram_instance", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddiagramInstance;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_diagram_instance", type="integer", nullable=false)
     */
    private $estadoDiagramInstance = '0';



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
