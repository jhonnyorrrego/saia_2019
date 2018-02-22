<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoExpediente
 *
 * @ORM\Table(name="reemplazo_expediente")
 * @ORM\Entity
 */
class ReemplazoExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_expediente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazoExpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_identidad_expediente", type="string", length=255, nullable=false)
     */
    private $fkIdentidadExpediente;

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
