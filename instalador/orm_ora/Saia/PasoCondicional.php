<?php

namespace Saia;

/**
 * PasoCondicional
 */
class PasoCondicional
{
    /**
     * @var integer
     */
    private $idpasoCondicional;

    /**
     * @var integer
     */
    private $diagramIddiagram;

    /**
     * @var string
     */
    private $idcondicional;

    /**
     * @var string
     */
    private $tipoCondicional;

    /**
     * @var string
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

