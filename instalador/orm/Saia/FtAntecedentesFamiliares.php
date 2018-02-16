<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAntecedentesFamiliares
 *
 * @ORM\Table(name="ft_antecedentes_familiares", indexes={@ORM\Index(name="i_ft_antecedentes_familiares_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtAntecedentesFamiliares
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_antecedentes_familiares", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftAntecedentesFamiliares;

    /**
     * @var integer
     *
     * @ORM\Column(name="diabetes_mellitus", type="integer", nullable=false)
     */
    private $diabetesMellitus;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1001';

    /**
     * @var string
     *
     * @ORM\Column(name="cancer_quien", type="string", length=255, nullable=true)
     */
    private $cancerQuien;

    /**
     * @var integer
     *
     * @ORM\Column(name="cancer_familia", type="integer", nullable=false)
     */
    private $cancerFamilia;

    /**
     * @var string
     *
     * @ORM\Column(name="respiratorio_quien", type="string", length=255, nullable=true)
     */
    private $respiratorioQuien;

    /**
     * @var string
     *
     * @ORM\Column(name="diabetes_quien", type="string", length=255, nullable=true)
     */
    private $diabetesQuien;

    /**
     * @var integer
     *
     * @ORM\Column(name="asma_familia", type="integer", nullable=false)
     */
    private $asmaFamilia;

    /**
     * @var string
     *
     * @ORM\Column(name="asma_quien", type="string", length=255, nullable=true)
     */
    private $asmaQuien;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_familia", type="text", length=65535, nullable=true)
     */
    private $observacionFamilia;

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
     * @var integer
     *
     * @ORM\Column(name="hipertension_familia", type="integer", nullable=false)
     */
    private $hipertensionFamilia;

    /**
     * @var integer
     *
     * @ORM\Column(name="cardiaca_familia", type="integer", nullable=false)
     */
    private $cardiacaFamilia;

    /**
     * @var integer
     *
     * @ORM\Column(name="respiratoria_familia", type="integer", nullable=false)
     */
    private $respiratoriaFamilia;

    /**
     * @var string
     *
     * @ORM\Column(name="cardiaca_quien", type="string", length=255, nullable=true)
     */
    private $cardiacaQuien;

    /**
     * @var string
     *
     * @ORM\Column(name="hipertension_quien", type="string", length=255, nullable=true)
     */
    private $hipertensionQuien;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAntecedentesFamiliares
     *
     * @return integer
     */
    public function getIdftAntecedentesFamiliares()
    {
        return $this->idftAntecedentesFamiliares;
    }

    /**
     * Set diabetesMellitus
     *
     * @param integer $diabetesMellitus
     *
     * @return FtAntecedentesFamiliares
     */
    public function setDiabetesMellitus($diabetesMellitus)
    {
        $this->diabetesMellitus = $diabetesMellitus;

        return $this;
    }

    /**
     * Get diabetesMellitus
     *
     * @return integer
     */
    public function getDiabetesMellitus()
    {
        return $this->diabetesMellitus;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAntecedentesFamiliares
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
     * Set cancerQuien
     *
     * @param string $cancerQuien
     *
     * @return FtAntecedentesFamiliares
     */
    public function setCancerQuien($cancerQuien)
    {
        $this->cancerQuien = $cancerQuien;

        return $this;
    }

    /**
     * Get cancerQuien
     *
     * @return string
     */
    public function getCancerQuien()
    {
        return $this->cancerQuien;
    }

    /**
     * Set cancerFamilia
     *
     * @param integer $cancerFamilia
     *
     * @return FtAntecedentesFamiliares
     */
    public function setCancerFamilia($cancerFamilia)
    {
        $this->cancerFamilia = $cancerFamilia;

        return $this;
    }

    /**
     * Get cancerFamilia
     *
     * @return integer
     */
    public function getCancerFamilia()
    {
        return $this->cancerFamilia;
    }

    /**
     * Set respiratorioQuien
     *
     * @param string $respiratorioQuien
     *
     * @return FtAntecedentesFamiliares
     */
    public function setRespiratorioQuien($respiratorioQuien)
    {
        $this->respiratorioQuien = $respiratorioQuien;

        return $this;
    }

    /**
     * Get respiratorioQuien
     *
     * @return string
     */
    public function getRespiratorioQuien()
    {
        return $this->respiratorioQuien;
    }

    /**
     * Set diabetesQuien
     *
     * @param string $diabetesQuien
     *
     * @return FtAntecedentesFamiliares
     */
    public function setDiabetesQuien($diabetesQuien)
    {
        $this->diabetesQuien = $diabetesQuien;

        return $this;
    }

    /**
     * Get diabetesQuien
     *
     * @return string
     */
    public function getDiabetesQuien()
    {
        return $this->diabetesQuien;
    }

    /**
     * Set asmaFamilia
     *
     * @param integer $asmaFamilia
     *
     * @return FtAntecedentesFamiliares
     */
    public function setAsmaFamilia($asmaFamilia)
    {
        $this->asmaFamilia = $asmaFamilia;

        return $this;
    }

    /**
     * Get asmaFamilia
     *
     * @return integer
     */
    public function getAsmaFamilia()
    {
        return $this->asmaFamilia;
    }

    /**
     * Set asmaQuien
     *
     * @param string $asmaQuien
     *
     * @return FtAntecedentesFamiliares
     */
    public function setAsmaQuien($asmaQuien)
    {
        $this->asmaQuien = $asmaQuien;

        return $this;
    }

    /**
     * Get asmaQuien
     *
     * @return string
     */
    public function getAsmaQuien()
    {
        return $this->asmaQuien;
    }

    /**
     * Set observacionFamilia
     *
     * @param string $observacionFamilia
     *
     * @return FtAntecedentesFamiliares
     */
    public function setObservacionFamilia($observacionFamilia)
    {
        $this->observacionFamilia = $observacionFamilia;

        return $this;
    }

    /**
     * Get observacionFamilia
     *
     * @return string
     */
    public function getObservacionFamilia()
    {
        return $this->observacionFamilia;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAntecedentesFamiliares
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
     * @return FtAntecedentesFamiliares
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
     * @return FtAntecedentesFamiliares
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
     * @return FtAntecedentesFamiliares
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
     * Set hipertensionFamilia
     *
     * @param integer $hipertensionFamilia
     *
     * @return FtAntecedentesFamiliares
     */
    public function setHipertensionFamilia($hipertensionFamilia)
    {
        $this->hipertensionFamilia = $hipertensionFamilia;

        return $this;
    }

    /**
     * Get hipertensionFamilia
     *
     * @return integer
     */
    public function getHipertensionFamilia()
    {
        return $this->hipertensionFamilia;
    }

    /**
     * Set cardiacaFamilia
     *
     * @param integer $cardiacaFamilia
     *
     * @return FtAntecedentesFamiliares
     */
    public function setCardiacaFamilia($cardiacaFamilia)
    {
        $this->cardiacaFamilia = $cardiacaFamilia;

        return $this;
    }

    /**
     * Get cardiacaFamilia
     *
     * @return integer
     */
    public function getCardiacaFamilia()
    {
        return $this->cardiacaFamilia;
    }

    /**
     * Set respiratoriaFamilia
     *
     * @param integer $respiratoriaFamilia
     *
     * @return FtAntecedentesFamiliares
     */
    public function setRespiratoriaFamilia($respiratoriaFamilia)
    {
        $this->respiratoriaFamilia = $respiratoriaFamilia;

        return $this;
    }

    /**
     * Get respiratoriaFamilia
     *
     * @return integer
     */
    public function getRespiratoriaFamilia()
    {
        return $this->respiratoriaFamilia;
    }

    /**
     * Set cardiacaQuien
     *
     * @param string $cardiacaQuien
     *
     * @return FtAntecedentesFamiliares
     */
    public function setCardiacaQuien($cardiacaQuien)
    {
        $this->cardiacaQuien = $cardiacaQuien;

        return $this;
    }

    /**
     * Get cardiacaQuien
     *
     * @return string
     */
    public function getCardiacaQuien()
    {
        return $this->cardiacaQuien;
    }

    /**
     * Set hipertensionQuien
     *
     * @param string $hipertensionQuien
     *
     * @return FtAntecedentesFamiliares
     */
    public function setHipertensionQuien($hipertensionQuien)
    {
        $this->hipertensionQuien = $hipertensionQuien;

        return $this;
    }

    /**
     * Get hipertensionQuien
     *
     * @return string
     */
    public function getHipertensionQuien()
    {
        return $this->hipertensionQuien;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAntecedentesFamiliares
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
