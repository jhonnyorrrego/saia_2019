<?php

namespace Saia;

/**
 * PantallaEsquema
 */
class PantallaEsquema
{
    /**
     * @var integer
     */
    private $idpantallaEsquema;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $ruta;


    /**
     * Get idpantallaEsquema
     *
     * @return integer
     */
    public function getIdpantallaEsquema()
    {
        return $this->idpantallaEsquema;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return PantallaEsquema
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
     * @return PantallaEsquema
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
}

