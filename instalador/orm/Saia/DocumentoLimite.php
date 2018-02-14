<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoLimite
 *
 * @ORM\Table(name="documento_limite", indexes={@ORM\Index(name="i_documento_limite_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoLimite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_limite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoLimite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cambio", type="datetime", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=false)
     */
    private $fechaLimite;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;



    /**
     * Get iddocumentoLimite
     *
     * @return integer
     */
    public function getIddocumentoLimite()
    {
        return $this->iddocumentoLimite;
    }

    /**
     * Set fechaCambio
     *
     * @param \DateTime $fechaCambio
     *
     * @return DocumentoLimite
     */
    public function setFechaCambio($fechaCambio)
    {
        $this->fechaCambio = $fechaCambio;

        return $this;
    }

    /**
     * Get fechaCambio
     *
     * @return \DateTime
     */
    public function getFechaCambio()
    {
        return $this->fechaCambio;
    }

    /**
     * Set fechaLimite
     *
     * @param \DateTime $fechaLimite
     *
     * @return DocumentoLimite
     */
    public function setFechaLimite($fechaLimite)
    {
        $this->fechaLimite = $fechaLimite;

        return $this;
    }

    /**
     * Get fechaLimite
     *
     * @return \DateTime
     */
    public function getFechaLimite()
    {
        return $this->fechaLimite;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return DocumentoLimite
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoLimite
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return DocumentoLimite
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
