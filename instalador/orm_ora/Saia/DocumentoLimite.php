<?php

namespace Saia;

/**
 * DocumentoLimite
 */
class DocumentoLimite
{
    /**
     * @var integer
     */
    private $iddocumentoLimite;

    /**
     * @var \DateTime
     */
    private $fechaCambio;

    /**
     * @var \DateTime
     */
    private $fechaLimite;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
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

