<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoAccion
 *
 * @ORM\Table(name="documento_accion", indexes={@ORM\Index(name="i_documento_accion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=true)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;



    /**
     * Get iddocumentoAccion
     *
     * @return integer
     */
    public function getIddocumentoAccion()
    {
        return $this->iddocumentoAccion;
    }

    /**
     * Set accionIdaccion
     *
     * @param integer $accionIdaccion
     *
     * @return DocumentoAccion
     */
    public function setAccionIdaccion($accionIdaccion)
    {
        $this->accionIdaccion = $accionIdaccion;

        return $this;
    }

    /**
     * Get accionIdaccion
     *
     * @return integer
     */
    public function getAccionIdaccion()
    {
        return $this->accionIdaccion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoAccion
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
     * @return DocumentoAccion
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
