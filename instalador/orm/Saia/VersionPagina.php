<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionPagina
 *
 * @ORM\Table(name="version_pagina")
 * @ORM\Entity
 */
class VersionPagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_pagina", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idversionPagina;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_miniatura", type="string", length=255, nullable=true)
     */
    private $rutaMiniatura;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=true)
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina_idpagina", type="integer", nullable=true)
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
