<?php

namespace Saia;

/**
 * FtAnamnesisClinica
 */
class FtAnamnesisClinica
{
    /**
     * @var integer
     */
    private $idftAnamnesisClinica;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $motivoConsulta;

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
    private $enfermedadActual;

    /**
     * @var string
     */
    private $antecedentesMedicos;

    /**
     * @var integer
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var string
     */
    private $antecedentesFamiliaresA;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftAnamnesisClinica
     *
     * @return integer
     */
    public function getIdftAnamnesisClinica()
    {
        return $this->idftAnamnesisClinica;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAnamnesisClinica
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
     * Set motivoConsulta
     *
     * @param string $motivoConsulta
     *
     * @return FtAnamnesisClinica
     */
    public function setMotivoConsulta($motivoConsulta)
    {
        $this->motivoConsulta = $motivoConsulta;

        return $this;
    }

    /**
     * Get motivoConsulta
     *
     * @return string
     */
    public function getMotivoConsulta()
    {
        return $this->motivoConsulta;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAnamnesisClinica
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
     * @return FtAnamnesisClinica
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
     * @return FtAnamnesisClinica
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
     * @return FtAnamnesisClinica
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
     * Set enfermedadActual
     *
     * @param string $enfermedadActual
     *
     * @return FtAnamnesisClinica
     */
    public function setEnfermedadActual($enfermedadActual)
    {
        $this->enfermedadActual = $enfermedadActual;

        return $this;
    }

    /**
     * Get enfermedadActual
     *
     * @return string
     */
    public function getEnfermedadActual()
    {
        return $this->enfermedadActual;
    }

    /**
     * Set antecedentesMedicos
     *
     * @param string $antecedentesMedicos
     *
     * @return FtAnamnesisClinica
     */
    public function setAntecedentesMedicos($antecedentesMedicos)
    {
        $this->antecedentesMedicos = $antecedentesMedicos;

        return $this;
    }

    /**
     * Get antecedentesMedicos
     *
     * @return string
     */
    public function getAntecedentesMedicos()
    {
        return $this->antecedentesMedicos;
    }

    /**
     * Set ftClinicaOrtodoncia
     *
     * @param integer $ftClinicaOrtodoncia
     *
     * @return FtAnamnesisClinica
     */
    public function setFtClinicaOrtodoncia($ftClinicaOrtodoncia)
    {
        $this->ftClinicaOrtodoncia = $ftClinicaOrtodoncia;

        return $this;
    }

    /**
     * Get ftClinicaOrtodoncia
     *
     * @return integer
     */
    public function getFtClinicaOrtodoncia()
    {
        return $this->ftClinicaOrtodoncia;
    }

    /**
     * Set antecedentesFamiliaresA
     *
     * @param string $antecedentesFamiliaresA
     *
     * @return FtAnamnesisClinica
     */
    public function setAntecedentesFamiliaresA($antecedentesFamiliaresA)
    {
        $this->antecedentesFamiliaresA = $antecedentesFamiliaresA;

        return $this;
    }

    /**
     * Get antecedentesFamiliaresA
     *
     * @return string
     */
    public function getAntecedentesFamiliaresA()
    {
        return $this->antecedentesFamiliaresA;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAnamnesisClinica
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

