<?php

namespace Saia;

/**
 * FtContratoLaboral
 */
class FtContratoLaboral
{
    /**
     * @var integer
     */
    private $idftContratoLaboral;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $tipoContrato;

    /**
     * @var string
     */
    private $numContarto;

    /**
     * @var \DateTime
     */
    private $fechaFinal;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $ftHojaVida;

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
    private $adjuntarDocumento;

    /**
     * @var string
     */
    private $sueldoFinal;

    /**
     * @var string
     */
    private $sueldoIni;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftContratoLaboral
     *
     * @return integer
     */
    public function getIdftContratoLaboral()
    {
        return $this->idftContratoLaboral;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtContratoLaboral
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
     * @return FtContratoLaboral
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
     * Set tipoContrato
     *
     * @param integer $tipoContrato
     *
     * @return FtContratoLaboral
     */
    public function setTipoContrato($tipoContrato)
    {
        $this->tipoContrato = $tipoContrato;

        return $this;
    }

    /**
     * Get tipoContrato
     *
     * @return integer
     */
    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }

    /**
     * Set numContarto
     *
     * @param string $numContarto
     *
     * @return FtContratoLaboral
     */
    public function setNumContarto($numContarto)
    {
        $this->numContarto = $numContarto;

        return $this;
    }

    /**
     * Get numContarto
     *
     * @return string
     */
    public function getNumContarto()
    {
        return $this->numContarto;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return FtContratoLaboral
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return FtContratoLaboral
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtContratoLaboral
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
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtContratoLaboral
     */
    public function setFtHojaVida($ftHojaVida)
    {
        $this->ftHojaVida = $ftHojaVida;

        return $this;
    }

    /**
     * Get ftHojaVida
     *
     * @return integer
     */
    public function getFtHojaVida()
    {
        return $this->ftHojaVida;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtContratoLaboral
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
     * @return FtContratoLaboral
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
     * Set adjuntarDocumento
     *
     * @param string $adjuntarDocumento
     *
     * @return FtContratoLaboral
     */
    public function setAdjuntarDocumento($adjuntarDocumento)
    {
        $this->adjuntarDocumento = $adjuntarDocumento;

        return $this;
    }

    /**
     * Get adjuntarDocumento
     *
     * @return string
     */
    public function getAdjuntarDocumento()
    {
        return $this->adjuntarDocumento;
    }

    /**
     * Set sueldoFinal
     *
     * @param string $sueldoFinal
     *
     * @return FtContratoLaboral
     */
    public function setSueldoFinal($sueldoFinal)
    {
        $this->sueldoFinal = $sueldoFinal;

        return $this;
    }

    /**
     * Get sueldoFinal
     *
     * @return string
     */
    public function getSueldoFinal()
    {
        return $this->sueldoFinal;
    }

    /**
     * Set sueldoIni
     *
     * @param string $sueldoIni
     *
     * @return FtContratoLaboral
     */
    public function setSueldoIni($sueldoIni)
    {
        $this->sueldoIni = $sueldoIni;

        return $this;
    }

    /**
     * Get sueldoIni
     *
     * @return string
     */
    public function getSueldoIni()
    {
        return $this->sueldoIni;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtContratoLaboral
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

