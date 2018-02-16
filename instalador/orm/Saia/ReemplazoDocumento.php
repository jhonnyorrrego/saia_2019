<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoDocumento
 *
 * @ORM\Table(name="reemplazo_documento")
 * @ORM\Entity
 */
class ReemplazoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idreemplazo_saia", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_reemplazo_doc", type="integer", nullable=false)
     */
    private $tipoReemplazoDoc;



    /**
     * Get idreemplazoDocumento
     *
     * @return integer
     */
    public function getIdreemplazoDocumento()
    {
        return $this->idreemplazoDocumento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return ReemplazoDocumento
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
     * Set fkIdreemplazoSaia
     *
     * @param integer $fkIdreemplazoSaia
     *
     * @return ReemplazoDocumento
     */
    public function setFkIdreemplazoSaia($fkIdreemplazoSaia)
    {
        $this->fkIdreemplazoSaia = $fkIdreemplazoSaia;

        return $this;
    }

    /**
     * Get fkIdreemplazoSaia
     *
     * @return integer
     */
    public function getFkIdreemplazoSaia()
    {
        return $this->fkIdreemplazoSaia;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return ReemplazoDocumento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoReemplazoDoc
     *
     * @param integer $tipoReemplazoDoc
     *
     * @return ReemplazoDocumento
     */
    public function setTipoReemplazoDoc($tipoReemplazoDoc)
    {
        $this->tipoReemplazoDoc = $tipoReemplazoDoc;

        return $this;
    }

    /**
     * Get tipoReemplazoDoc
     *
     * @return integer
     */
    public function getTipoReemplazoDoc()
    {
        return $this->tipoReemplazoDoc;
    }
}
