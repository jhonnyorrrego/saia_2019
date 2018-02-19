<?php

namespace Saia;

/**
 * PantallaAccion
 */
class PantallaAccion
{
    /**
     * @var integer
     */
    private $idpantallaAccion;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var integer
     */
    private $tipoAccion;

    /**
     * @var integer
     */
    private $fkIdpantalla;


    /**
     * Get idpantallaAccion
     *
     * @return integer
     */
    public function getIdpantallaAccion()
    {
        return $this->idpantallaAccion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaAccion
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
     * @return PantallaAccion
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
     * Set tipoAccion
     *
     * @param integer $tipoAccion
     *
     * @return PantallaAccion
     */
    public function setTipoAccion($tipoAccion)
    {
        $this->tipoAccion = $tipoAccion;

        return $this;
    }

    /**
     * Get tipoAccion
     *
     * @return integer
     */
    public function getTipoAccion()
    {
        return $this->tipoAccion;
    }

    /**
     * Set fkIdpantalla
     *
     * @param integer $fkIdpantalla
     *
     * @return PantallaAccion
     */
    public function setFkIdpantalla($fkIdpantalla)
    {
        $this->fkIdpantalla = $fkIdpantalla;

        return $this;
    }

    /**
     * Get fkIdpantalla
     *
     * @return integer
     */
    public function getFkIdpantalla()
    {
        return $this->fkIdpantalla;
    }
}

