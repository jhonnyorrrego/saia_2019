<?php

namespace Saia;

/**
 * PantallaBusqueda
 */
class PantallaBusqueda
{
    /**
     * @var integer
     */
    private $idpantallaBusqueda;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var integer
     */
    private $estado;


    /**
     * Get idpantallaBusqueda
     *
     * @return integer
     */
    public function getIdpantallaBusqueda()
    {
        return $this->idpantallaBusqueda;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaBusqueda
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PantallaBusqueda
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

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return PantallaBusqueda
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return PantallaBusqueda
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

