<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionAnexos
 *
 * @ORM\Table(name="version_anexos", indexes={@ORM\Index(name="i_version_anexos_documento_", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class VersionAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_anexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idversionAnexos;

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
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=true)
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_idanexos", type="integer", nullable=true)
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
