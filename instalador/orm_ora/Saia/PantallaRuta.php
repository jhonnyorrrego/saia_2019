<?php

namespace Saia;

/**
 * PantallaRuta
 */
class PantallaRuta
{
    /**
     * @var integer
     */
    private $idpantallaRuta;

    /**
     * @var string
     */
    private $firmaExterna;

    /**
     * @var string
     */
    private $destino;

    /**
     * @var integer
     */
    private $tipoOrigen;

    /**
     * @var integer
     */
    private $tipoDestino;

    /**
     * @var string
     */
    private $obligatorio;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $origen;

    /**
     * @var string
     */
    private $llaveRutaTemporal;

    /**
     * @var integer
     */
    private $pantallaIdpantalla;


    /**
     * Get idpantallaRuta
     *
     * @return integer
     */
    public function getIdpantallaRuta()
    {
        return $this->idpantallaRuta;
    }

    /**
     * Set firmaExterna
     *
     * @param string $firmaExterna
     *
     * @return PantallaRuta
     */
    public function setFirmaExterna($firmaExterna)
    {
        $this->firmaExterna = $firmaExterna;

        return $this;
    }

    /**
     * Get firmaExterna
     *
     * @return string
     */
    public function getFirmaExterna()
    {
        return $this->firmaExterna;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return PantallaRuta
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     *
     * @return PantallaRuta
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return integer
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set tipoDestino
     *
     * @param integer $tipoDestino
     *
     * @return PantallaRuta
     */
    public function setTipoDestino($tipoDestino)
    {
        $this->tipoDestino = $tipoDestino;

        return $this;
    }

    /**
     * Get tipoDestino
     *
     * @return integer
     */
    public function getTipoDestino()
    {
        return $this->tipoDestino;
    }

    /**
     * Set obligatorio
     *
     * @param string $obligatorio
     *
     * @return PantallaRuta
     */
    public function setObligatorio($obligatorio)
    {
        $this->obligatorio = $obligatorio;

        return $this;
    }

    /**
     * Get obligatorio
     *
     * @return string
     */
    public function getObligatorio()
    {
        return $this->obligatorio;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PantallaRuta
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

    /**
     * Set origen
     *
     * @param integer $origen
     *
     * @return PantallaRuta
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return integer
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set llaveRutaTemporal
     *
     * @param string $llaveRutaTemporal
     *
     * @return PantallaRuta
     */
    public function setLlaveRutaTemporal($llaveRutaTemporal)
    {
        $this->llaveRutaTemporal = $llaveRutaTemporal;

        return $this;
    }

    /**
     * Get llaveRutaTemporal
     *
     * @return string
     */
    public function getLlaveRutaTemporal()
    {
        return $this->llaveRutaTemporal;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaRuta
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
}

