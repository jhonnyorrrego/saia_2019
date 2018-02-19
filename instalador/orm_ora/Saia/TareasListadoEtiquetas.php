<?php

namespace Saia;

/**
 * TareasListadoEtiquetas
 */
class TareasListadoEtiquetas
{
    /**
     * @var integer
     */
    private $idtareasListadoEtiquetas;

    /**
     * @var integer
     */
    private $etiquetaIdetiqueta;

    /**
     * @var integer
     */
    private $tareasListadoFk;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get idtareasListadoEtiquetas
     *
     * @return integer
     */
    public function getIdtareasListadoEtiquetas()
    {
        return $this->idtareasListadoEtiquetas;
    }

    /**
     * Set etiquetaIdetiqueta
     *
     * @param integer $etiquetaIdetiqueta
     *
     * @return TareasListadoEtiquetas
     */
    public function setEtiquetaIdetiqueta($etiquetaIdetiqueta)
    {
        $this->etiquetaIdetiqueta = $etiquetaIdetiqueta;

        return $this;
    }

    /**
     * Get etiquetaIdetiqueta
     *
     * @return integer
     */
    public function getEtiquetaIdetiqueta()
    {
        return $this->etiquetaIdetiqueta;
    }

    /**
     * Set tareasListadoFk
     *
     * @param integer $tareasListadoFk
     *
     * @return TareasListadoEtiquetas
     */
    public function setTareasListadoFk($tareasListadoFk)
    {
        $this->tareasListadoFk = $tareasListadoFk;

        return $this;
    }

    /**
     * Get tareasListadoFk
     *
     * @return integer
     */
    public function getTareasListadoFk()
    {
        return $this->tareasListadoFk;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TareasListadoEtiquetas
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
}

