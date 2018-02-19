<?php

namespace Saia;

/**
 * Indicador
 */
class Indicador
{
    /**
     * @var integer
     */
    private $idindicador;

    /**
     * @var string
     */
    private $rutaFormulario;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $librerias;


    /**
     * Get idindicador
     *
     * @return integer
     */
    public function getIdindicador()
    {
        return $this->idindicador;
    }

    /**
     * Set rutaFormulario
     *
     * @param string $rutaFormulario
     *
     * @return Indicador
     */
    public function setRutaFormulario($rutaFormulario)
    {
        $this->rutaFormulario = $rutaFormulario;

        return $this;
    }

    /**
     * Get rutaFormulario
     *
     * @return string
     */
    public function getRutaFormulario()
    {
        return $this->rutaFormulario;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Indicador
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Indicador
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
     * Set librerias
     *
     * @param string $librerias
     *
     * @return Indicador
     */
    public function setLibrerias($librerias)
    {
        $this->librerias = $librerias;

        return $this;
    }

    /**
     * Get librerias
     *
     * @return string
     */
    public function getLibrerias()
    {
        return $this->librerias;
    }
}

