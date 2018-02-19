<?php

namespace Saia;

/**
 * ReemplazoExpediente
 */
class ReemplazoExpediente
{
    /**
     * @var integer
     */
    private $idreemplazoExpediente;

    /**
     * @var string
     */
    private $fkIdentidadExpediente;

    /**
     * @var integer
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     */
    private $estado;


    /**
     * Get idreemplazoExpediente
     *
     * @return integer
     */
    public function getIdreemplazoExpediente()
    {
        return $this->idreemplazoExpediente;
    }

    /**
     * Set fkIdentidadExpediente
     *
     * @param string $fkIdentidadExpediente
     *
     * @return ReemplazoExpediente
     */
    public function setFkIdentidadExpediente($fkIdentidadExpediente)
    {
        $this->fkIdentidadExpediente = $fkIdentidadExpediente;

        return $this;
    }

    /**
     * Get fkIdentidadExpediente
     *
     * @return string
     */
    public function getFkIdentidadExpediente()
    {
        return $this->fkIdentidadExpediente;
    }

    /**
     * Set fkIdreemplazoSaia
     *
     * @param integer $fkIdreemplazoSaia
     *
     * @return ReemplazoExpediente
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
     * @return ReemplazoExpediente
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
}

