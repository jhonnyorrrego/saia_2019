<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAnamnesisClinica
 *
 * @ORM\Table(name="ft_anamnesis_clinica", indexes={@ORM\Index(name="i_ft_anamnesis_clinica_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtAnamnesisClinica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_anamnesis_clinica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftAnamnesisClinica;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1004';

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_consulta", type="string", length=255, nullable=false)
     */
    private $motivoConsulta;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="enfermedad_actual", type="text", length=65535, nullable=false)
     */
    private $enfermedadActual;

    /**
     * @var string
     *
     * @ORM\Column(name="antecedentes_medicos", type="text", length=65535, nullable=false)
     */
    private $antecedentesMedicos;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clinica_ortodoncia", type="integer", nullable=false)
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var string
     *
     * @ORM\Column(name="antecedentes_familiares_a", type="text", length=65535, nullable=false)
     */
    private $antecedentesFamiliaresA;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
