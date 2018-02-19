<?php

namespace Saia;

/**
 * ReemplazoDocumento
 */
class ReemplazoDocumento
{
    /**
     * @var integer
     */
    private $idreemplazoDocumento;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var integer
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

