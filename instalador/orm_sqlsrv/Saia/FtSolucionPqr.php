<?php

namespace Saia;

/**
 * FtSolucionPqr
 */
class FtSolucionPqr
{
    /**
     * @var integer
     */
    private $idftSolucionPqr;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $ftPqr;

    /**
     * @var string
     */
    private $estadoAvance;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaSolucion;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftSolucionPqr
     *
     * @return integer
     */
    public function getIdftSolucionPqr()
    {
        return $this->idftSolucionPqr;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolucionPqr
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set ftPqr
     *
     * @param integer $ftPqr
     *
     * @return FtSolucionPqr
     */
    public function setFtPqr($ftPqr)
    {
        $this->ftPqr = $ftPqr;

        return $this;
    }

    /**
     * Get ftPqr
     *
     * @return integer
     */
    public function getFtPqr()
    {
        return $this->ftPqr;
    }

    /**
     * Set estadoAvance
     *
     * @param string $estadoAvance
     *
     * @return FtSolucionPqr
     */
    public function setEstadoAvance($estadoAvance)
    {
        $this->estadoAvance = $estadoAvance;

        return $this;
    }

    /**
     * Get estadoAvance
     *
     * @return string
     */
    public function getEstadoAvance()
    {
        return $this->estadoAvance;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSolucionPqr
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSolucionPqr
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolucionPqr
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSolucionPqr
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSolucionPqr
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtSolucionPqr
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

    /**
     * Set fechaSolucion
     *
     * @param \DateTime $fechaSolucion
     *
     * @return FtSolucionPqr
     */
    public function setFechaSolucion($fechaSolucion)
    {
        $this->fechaSolucion = $fechaSolucion;

        return $this;
    }

    /**
     * Get fechaSolucion
     *
     * @return \DateTime
     */
    public function getFechaSolucion()
    {
        return $this->fechaSolucion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolucionPqr
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}

