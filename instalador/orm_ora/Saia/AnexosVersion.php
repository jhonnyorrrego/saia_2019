<?php

namespace Saia;

/**
 * AnexosVersion
 */
class AnexosVersion
{
    /**
     * @var integer
     */
    private $idanexosVersion;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $versionNumero;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $tipo;


    /**
     * Get idanexosVersion
     *
     * @return integer
     */
    public function getIdanexosVersion()
    {
        return $this->idanexosVersion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return AnexosVersion
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set versionNumero
     *
     * @param integer $versionNumero
     *
     * @return AnexosVersion
     */
    public function setVersionNumero($versionNumero)
    {
        $this->versionNumero = $versionNumero;

        return $this;
    }

    /**
     * Get versionNumero
     *
     * @return integer
     */
    public function getVersionNumero()
    {
        return $this->versionNumero;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return AnexosVersion
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return AnexosVersion
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AnexosVersion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}

