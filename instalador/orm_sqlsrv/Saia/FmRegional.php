<?php

namespace Saia;

/**
 * FmRegional
 */
class FmRegional
{
    /**
     * @var integer
     */
    private $idregional;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idregional
     *
     * @return integer
     */
    public function getIdregional()
    {
        return $this->idregional;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FmRegional
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FmRegional
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}

