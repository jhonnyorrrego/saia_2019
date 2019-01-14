<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoCondicional
 *
 * @ORM\Table(name="paso_condicional")
 * @ORM\Entity
 */
class PasoCondicional
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_condicional", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoCondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="idcondicional", type="string", length=255, nullable=false)
     */
    private $idcondicional;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_condicional", type="string", length=255, nullable=false)
     */
    private $tipoCondicional;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;



    /**
     * Get idpasoCondicional
     *
     * @return integer
     */
    public function getIdpasoCondicional()
    {
        return $this->idpasoCondicional;
    }

    /**
     * Set diagramIddiagram
     *
     * @param integer $diagramIddiagram
     *
     * @return PasoCondicional
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
     * Set idcondicional
     *
     * @param string $idcondicional
     *
     * @return PasoCondicional
     */
    public function setIdcondicional($idcondicional)
    {
        $this->idcondicional = $idcondicional;

        return $this;
    }

    /**
     * Get idcondicional
     *
     * @return string
     */
    public function getIdcondicional()
    {
        return $this->idcondicional;
    }

    /**
     * Set tipoCondicional
     *
     * @param string $tipoCondicional
     *
     * @return PasoCondicional
     */
    public function setTipoCondicional($tipoCondicional)
    {
        $this->tipoCondicional = $tipoCondicional;

        return $this;
    }

    /**
     * Get tipoCondicional
     *
     * @return string
     */
    public function getTipoCondicional()
    {
        return $this->tipoCondicional;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PasoCondicional
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }
}
