<?php

namespace Saia;

/**
 * DocumentoVersion
 */
class DocumentoVersion
{
    /**
     * @var integer
     */
    private $iddocumentoVersion;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $numeroVersion;

    /**
     * @var string
     */
    private $prefijo;

    /**
     * @var string
     */
    private $sufijo;

    /**
     * @var integer
     */
    private $cargaInicial;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $funcionario;


    /**
     * Get iddocumentoVersion
     *
     * @return integer
     */
    public function getIddocumentoVersion()
    {
        return $this->iddocumentoVersion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoVersion
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
     * Set numeroVersion
     *
     * @param integer $numeroVersion
     *
     * @return DocumentoVersion
     */
    public function setNumeroVersion($numeroVersion)
    {
        $this->numeroVersion = $numeroVersion;

        return $this;
    }

    /**
     * Get numeroVersion
     *
     * @return integer
     */
    public function getNumeroVersion()
    {
        return $this->numeroVersion;
    }

    /**
     * Set prefijo
     *
     * @param string $prefijo
     *
     * @return DocumentoVersion
     */
    public function setPrefijo($prefijo)
    {
        $this->prefijo = $prefijo;

        return $this;
    }

    /**
     * Get prefijo
     *
     * @return string
     */
    public function getPrefijo()
    {
        return $this->prefijo;
    }

    /**
     * Set sufijo
     *
     * @param string $sufijo
     *
     * @return DocumentoVersion
     */
    public function setSufijo($sufijo)
    {
        $this->sufijo = $sufijo;

        return $this;
    }

    /**
     * Get sufijo
     *
     * @return string
     */
    public function getSufijo()
    {
        return $this->sufijo;
    }

    /**
     * Set cargaInicial
     *
     * @param integer $cargaInicial
     *
     * @return DocumentoVersion
     */
    public function setCargaInicial($cargaInicial)
    {
        $this->cargaInicial = $cargaInicial;

        return $this;
    }

    /**
     * Get cargaInicial
     *
     * @return integer
     */
    public function getCargaInicial()
    {
        return $this->cargaInicial;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DocumentoVersion
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
     * Set funcionario
     *
     * @param integer $funcionario
     *
     * @return DocumentoVersion
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return integer
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }
}

