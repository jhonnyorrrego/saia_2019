<?php

namespace Saia;

/**
 * PantallaInclude
 */
class PantallaInclude
{
    /**
     * @var integer
     */
    private $idpantallaInclude;

    /**
     * @var integer
     */
    private $orden;

    /**
     * @var string
     */
    private $lugarIncluir;

    /**
     * @var string
     */
    private $accionesInclude;

    /**
     * @var integer
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     */
    private $fkIdpantallaLibreria;


    /**
     * Get idpantallaInclude
     *
     * @return integer
     */
    public function getIdpantallaInclude()
    {
        return $this->idpantallaInclude;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PantallaInclude
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set lugarIncluir
     *
     * @param string $lugarIncluir
     *
     * @return PantallaInclude
     */
    public function setLugarIncluir($lugarIncluir)
    {
        $this->lugarIncluir = $lugarIncluir;

        return $this;
    }

    /**
     * Get lugarIncluir
     *
     * @return string
     */
    public function getLugarIncluir()
    {
        return $this->lugarIncluir;
    }

    /**
     * Set accionesInclude
     *
     * @param string $accionesInclude
     *
     * @return PantallaInclude
     */
    public function setAccionesInclude($accionesInclude)
    {
        $this->accionesInclude = $accionesInclude;

        return $this;
    }

    /**
     * Get accionesInclude
     *
     * @return string
     */
    public function getAccionesInclude()
    {
        return $this->accionesInclude;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaInclude
     */
    public function setPantallaIdpantalla($pantallaIdpantalla)
    {
        $this->pantallaIdpantalla = $pantallaIdpantalla;

        return $this;
    }

    /**
     * Get pantallaIdpantalla
     *
     * @return integer
     */
    public function getPantallaIdpantalla()
    {
        return $this->pantallaIdpantalla;
    }

    /**
     * Set fkIdpantallaLibreria
     *
     * @param integer $fkIdpantallaLibreria
     *
     * @return PantallaInclude
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
}

