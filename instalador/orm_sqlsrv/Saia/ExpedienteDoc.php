<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteDoc
 *
 * @ORM\Table(name="expediente_doc", indexes={@ORM\Index(name="i_expediente_doc_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class ExpedienteDoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idexpediente_doc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexpedienteDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';



    /**
     * Get idexpedienteDoc
     *
     * @return integer
     */
    public function getIdexpedienteDoc()
    {
        return $this->idexpedienteDoc;
    }

    /**
     * Set expedienteIdexpediente
     *
     * @param integer $expedienteIdexpediente
     *
     * @return ExpedienteDoc
     */
    public function setExpedienteIdexpediente($expedienteIdexpediente)
    {
        $this->expedienteIdexpediente = $expedienteIdexpediente;

        return $this;
    }

    /**
     * Get expedienteIdexpediente
     *
     * @return integer
     */
    public function getExpedienteIdexpediente()
    {
        return $this->expedienteIdexpediente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return ExpedienteDoc
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
     * @return ExpedienteDoc
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
