<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoEtiqueta
 *
 * @ORM\Table(name="documento_etiqueta", indexes={@ORM\Index(name="i_doc_etiq_etiq_idetiqueta", columns={"etiqueta_idetiqueta"}), @ORM\Index(name="i_doc_etiq_doc_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoEtiqueta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_etiqueta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoEtiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="etiqueta_idetiqueta", type="integer", nullable=false)
     */
    private $etiquetaIdetiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';



    /**
     * Get iddocumentoEtiqueta
     *
     * @return integer
     */
    public function getIddocumentoEtiqueta()
    {
        return $this->iddocumentoEtiqueta;
    }

    /**
     * Set etiquetaIdetiqueta
     *
     * @param integer $etiquetaIdetiqueta
     *
     * @return DocumentoEtiqueta
     */
    public function setEtiquetaIdetiqueta($etiquetaIdetiqueta)
    {
        $this->etiquetaIdetiqueta = $etiquetaIdetiqueta;

        return $this;
    }

    /**
     * Get etiquetaIdetiqueta
     *
     * @return integer
     */
    public function getEtiquetaIdetiqueta()
    {
        return $this->etiquetaIdetiqueta;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoEtiqueta
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DocumentoEtiqueta
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
}
