<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosVersion
 *
 * @ORM\Table(name="anexos_version", indexes={@ORM\Index(name="i_anexos_version_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class AnexosVersion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_version", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexosVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="version_numero", type="integer", nullable=false)
     */
    private $versionNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
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
