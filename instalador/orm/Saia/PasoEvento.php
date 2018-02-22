<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEvento
 *
 * @ORM\Table(name="paso_evento")
 * @ORM\Entity
 */
class PasoEvento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_evento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoEvento;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="idevento", type="string", length=255, nullable=false)
     */
    private $idevento;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_evento", type="string", length=255, nullable=false)
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
