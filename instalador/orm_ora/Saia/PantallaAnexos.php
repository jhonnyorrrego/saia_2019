<?php

namespace Saia;

/**
 * PantallaAnexos
 */
class PantallaAnexos
{
    /**
     * @var integer
     */
    private $idpantallaAnexos;

    /**
     * @var string
     */
    private $anexo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $pantallaIdpantalla;


    /**
     * Get idpantallaAnexos
     *
     * @return integer
     */
    public function getIdpantallaAnexos()
    {
        return $this->idpantallaAnexos;
    }

    /**
     * Set anexo
     *
     * @param string $anexo
     *
     * @return PantallaAnexos
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return PantallaAnexos
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

    /**
     * Set documentoIddocumento
     *
     * @param string $documentoIddocumento
     *
     * @return PantallaAnexos
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return string
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaAnexos
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

