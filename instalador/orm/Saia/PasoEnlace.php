<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEnlace
 *
 * @ORM\Table(name="paso_enlace")
 * @ORM\Entity
 */
class PasoEnlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_enlace", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoEnlace;

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
     * @var string
     *
     * @ORM\Column(name="idconector", type="string", length=255, nullable=false)
     */
    private $idconector;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_origen", type="string", length=255, nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_destino", type="string", length=255, nullable=false)
     */
    private $tipoDestino;



    /**
     * Get idpasoEnlace
     *
     * @return integer
     */
    public function getIdpasoEnlace()
    {
        return $this->idpasoEnlace;
    }

    /**
     * Set origen
     *
     * @param string $origen
     *
     * @return PasoEnlace
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
     * @return PasoEnlace
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
     * @return PasoEnlace
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
     * @param string $idconector
     *
     * @return PasoEnlace
     */
    public function setIdconector($idconector)
    {
        $this->idconector = $idconector;

        return $this;
    }

    /**
     * Get idconector
     *
     * @return string
     */
    public function getIdconector()
    {
        return $this->idconector;
    }

    /**
     * Set tipoOrigen
     *
     * @param string $tipoOrigen
     *
     * @return PasoEnlace
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return string
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set tipoDestino
     *
     * @param string $tipoDestino
     *
     * @return PasoEnlace
     */
    public function setTipoDestino($tipoDestino)
    {
        $this->tipoDestino = $tipoDestino;

        return $this;
    }

    /**
     * Get tipoDestino
     *
     * @return string
     */
    public function getTipoDestino()
    {
        return $this->tipoDestino;
    }
}
