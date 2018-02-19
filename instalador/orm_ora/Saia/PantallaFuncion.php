<?php

namespace Saia;

/**
 * PantallaFuncion
 */
class PantallaFuncion
{
    /**
     * @var integer
     */
    private $idpantallaFuncion;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $parametros;

    /**
     * @var integer
     */
    private $fkIdpantallaLibreria;

    /**
     * @var string
     */
    private $tipoFuncion;

    /**
     * @var string
     */
    private $ayuda;


    /**
     * Get idpantallaFuncion
     *
     * @return integer
     */
    public function getIdpantallaFuncion()
    {
        return $this->idpantallaFuncion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaFuncion
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
     * Set parametros
     *
     * @param string $parametros
     *
     * @return PantallaFuncion
     */
    public function setParametros($parametros)
    {
        $this->parametros = $parametros;

        return $this;
    }

    /**
     * Get parametros
     *
     * @return string
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * Set fkIdpantallaLibreria
     *
     * @param integer $fkIdpantallaLibreria
     *
     * @return PantallaFuncion
     */
    public function setFkIdpantallaLibreria($fkIdpantallaLibreria)
    {
        $this->fkIdpantallaLibreria = $fkIdpantallaLibreria;

        return $this;
    }

    /**
     * Get fkIdpantallaLibreria
     *
     * @return integer
     */
    public function getFkIdpantallaLibreria()
    {
        return $this->fkIdpantallaLibreria;
    }

    /**
     * Set tipoFuncion
     *
     * @param string $tipoFuncion
     *
     * @return PantallaFuncion
     */
    public function setTipoFuncion($tipoFuncion)
    {
        $this->tipoFuncion = $tipoFuncion;

        return $this;
    }

    /**
     * Get tipoFuncion
     *
     * @return string
     */
    public function getTipoFuncion()
    {
        return $this->tipoFuncion;
    }

    /**
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return PantallaFuncion
     */
    public function setAyuda($ayuda)
    {
        $this->ayuda = $ayuda;

        return $this;
    }

    /**
     * Get ayuda
     *
     * @return string
     */
    public function getAyuda()
    {
        return $this->ayuda;
    }
}

