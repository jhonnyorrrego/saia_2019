<?php

namespace Saia;

/**
 * FtSolicitSoporte
 */
class FtSolicitSoporte
{
    /**
     * @var integer
     */
    private $idftSolicitSoporte;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaReq;

    /**
     * @var string
     */
    private $soliSop;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $ftClasifSoporte;


    /**
     * Get idftSolicitSoporte
     *
     * @return integer
     */
    public function getIdftSolicitSoporte()
    {
        return $this->idftSolicitSoporte;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitSoporte
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
     * Set fechaReq
     *
     * @param \DateTime $fechaReq
     *
     * @return FtSolicitSoporte
     */
    public function setFechaReq($fechaReq)
    {
        $this->fechaReq = $fechaReq;

        return $this;
    }

    /**
     * Get fechaReq
     *
     * @return \DateTime
     */
    public function getFechaReq()
    {
        return $this->fechaReq;
    }

    /**
     * Set soliSop
     *
     * @param string $soliSop
     *
     * @return FtSolicitSoporte
     */
    public function setSoliSop($soliSop)
    {
        $this->soliSop = $soliSop;

        return $this;
    }

    /**
     * Get soliSop
     *
     * @return string
     */
    public function getSoliSop()
    {
        return $this->soliSop;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitSoporte
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSolicitSoporte
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSolicitSoporte
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSolicitSoporte
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSolicitSoporte
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
     * Set ftClasifSoporte
     *
     * @param integer $ftClasifSoporte
     *
     * @return FtSolicitSoporte
     */
    public function setFtClasifSoporte($ftClasifSoporte)
    {
        $this->ftClasifSoporte = $ftClasifSoporte;

        return $this;
    }

    /**
     * Get ftClasifSoporte
     *
     * @return integer
     */
    public function getFtClasifSoporte()
    {
        return $this->ftClasifSoporte;
    }
}

