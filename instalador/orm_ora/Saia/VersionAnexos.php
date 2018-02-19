<?php

namespace Saia;

/**
 * VersionAnexos
 */
class VersionAnexos
{
    /**
     * @var integer
     */
    private $idversionAnexos;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var integer
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     */
    private $anexosIdanexos;


    /**
     * Get idversionAnexos
     *
     * @return integer
     */
    public function getIdversionAnexos()
    {
        return $this->idversionAnexos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return VersionAnexos
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
     * Set ruta
     *
     * @param string $ruta
     *
     * @return VersionAnexos
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
     * Set fkIdversionDocumento
     *
     * @param integer $fkIdversionDocumento
     *
     * @return VersionAnexos
     */
    public function setFkIdversionDocumento($fkIdversionDocumento)
    {
        $this->fkIdversionDocumento = $fkIdversionDocumento;

        return $this;
    }

    /**
     * Get fkIdversionDocumento
     *
     * @return integer
     */
    public function getFkIdversionDocumento()
    {
        return $this->fkIdversionDocumento;
    }

    /**
     * Set anexosIdanexos
     *
     * @param integer $anexosIdanexos
     *
     * @return VersionAnexos
     */
    public function setAnexosIdanexos($anexosIdanexos)
    {
        $this->anexosIdanexos = $anexosIdanexos;

        return $this;
    }

    /**
     * Get anexosIdanexos
     *
     * @return integer
     */
    public function getAnexosIdanexos()
    {
        return $this->anexosIdanexos;
    }
}

