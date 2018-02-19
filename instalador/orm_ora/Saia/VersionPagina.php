<?php

namespace Saia;

/**
 * VersionPagina
 */
class VersionPagina
{
    /**
     * @var integer
     */
    private $idversionPagina;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var string
     */
    private $rutaMiniatura;

    /**
     * @var integer
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     */
    private $paginaIdpagina;


    /**
     * Get idversionPagina
     *
     * @return integer
     */
    public function getIdversionPagina()
    {
        return $this->idversionPagina;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return VersionPagina
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
     * @return VersionPagina
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
     * Set rutaMiniatura
     *
     * @param string $rutaMiniatura
     *
     * @return VersionPagina
     */
    public function setRutaMiniatura($rutaMiniatura)
    {
        $this->rutaMiniatura = $rutaMiniatura;

        return $this;
    }

    /**
     * Get rutaMiniatura
     *
     * @return string
     */
    public function getRutaMiniatura()
    {
        return $this->rutaMiniatura;
    }

    /**
     * Set fkIdversionDocumento
     *
     * @param integer $fkIdversionDocumento
     *
     * @return VersionPagina
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
     * Set paginaIdpagina
     *
     * @param integer $paginaIdpagina
     *
     * @return VersionPagina
     */
    public function setPaginaIdpagina($paginaIdpagina)
    {
        $this->paginaIdpagina = $paginaIdpagina;

        return $this;
    }

    /**
     * Get paginaIdpagina
     *
     * @return integer
     */
    public function getPaginaIdpagina()
    {
        return $this->paginaIdpagina;
    }
}

