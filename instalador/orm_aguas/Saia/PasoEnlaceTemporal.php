<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEnlaceTemporal
 *
 * @ORM\Table(name="paso_enlace_temporal")
 * @ORM\Entity
 */
class PasoEnlaceTemporal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_enlace_temporal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoEnlaceTemporal;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=true)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var integer
     *
     * @ORM\Column(name="idconector", type="integer", nullable=false)
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
