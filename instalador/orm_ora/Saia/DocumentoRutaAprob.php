<?php

namespace Saia;

/**
 * DocumentoRutaAprob
 */
class DocumentoRutaAprob
{
    /**
     * @var integer
     */
    private $iddocumentoRutaAprob;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     */
    private $fechaVencimiento;

    /**
     * @var integer
     */
    private $estadoRutaAprob;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var integer
     */
    private $idfuncCreador;

    /**
     * @var integer
     */
    private $aprobacionEn;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get iddocumentoRutaAprob
     *
     * @return integer
     */
    public function getIddocumentoRutaAprob()
    {
        return $this->iddocumentoRutaAprob;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return DocumentoRutaAprob
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
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     *
     * @return DocumentoRutaAprob
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set estadoRutaAprob
     *
     * @param integer $estadoRutaAprob
     *
     * @return DocumentoRutaAprob
     */
    public function setEstadoRutaAprob($estadoRutaAprob)
    {
        $this->estadoRutaAprob = $estadoRutaAprob;

        return $this;
    }

    /**
     * Get estadoRutaAprob
     *
     * @return integer
     */
    public function getEstadoRutaAprob()
    {
        return $this->estadoRutaAprob;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return DocumentoRutaAprob
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set idfuncCreador
     *
     * @param integer $idfuncCreador
     *
     * @return DocumentoRutaAprob
     */
    public function setIdfuncCreador($idfuncCreador)
    {
        $this->idfuncCreador = $idfuncCreador;

        return $this;
    }

    /**
     * Get idfuncCreador
     *
     * @return integer
     */
    public function getIdfuncCreador()
    {
        return $this->idfuncCreador;
    }

    /**
     * Set aprobacionEn
     *
     * @param integer $aprobacionEn
     *
     * @return DocumentoRutaAprob
     */
    public function setAprobacionEn($aprobacionEn)
    {
        $this->aprobacionEn = $aprobacionEn;

        return $this;
    }

    /**
     * Get aprobacionEn
     *
     * @return integer
     */
    public function getAprobacionEn()
    {
        return $this->aprobacionEn;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return DocumentoRutaAprob
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return DocumentoRutaAprob
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}

