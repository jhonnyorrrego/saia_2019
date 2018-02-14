<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVinculados
 *
 * @ORM\Table(name="documento_vinculados")
 * @ORM\Entity
 */
class DocumentoVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_origen", type="integer", nullable=false)
     */
    private $documentoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_destino", type="integer", nullable=false)
     */
    private $documentoDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=16777215, nullable=true)
     */
    private $observaciones;



    /**
     * Get iddocumentoVinculados
     *
     * @return integer
     */
    public function getIddocumentoVinculados()
    {
        return $this->iddocumentoVinculados;
    }

    /**
     * Set documentoOrigen
     *
     * @param integer $documentoOrigen
     *
     * @return DocumentoVinculados
     */
    public function setDocumentoOrigen($documentoOrigen)
    {
        $this->documentoOrigen = $documentoOrigen;

        return $this;
    }

    /**
     * Get documentoOrigen
     *
     * @return integer
     */
    public function getDocumentoOrigen()
    {
        return $this->documentoOrigen;
    }

    /**
     * Set documentoDestino
     *
     * @param integer $documentoDestino
     *
     * @return DocumentoVinculados
     */
    public function setDocumentoDestino($documentoDestino)
    {
        $this->documentoDestino = $documentoDestino;

        return $this;
    }

    /**
     * Get documentoDestino
     *
     * @return integer
     */
    public function getDocumentoDestino()
    {
        return $this->documentoDestino;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DocumentoVinculados
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

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return DocumentoVinculados
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return DocumentoVinculados
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
