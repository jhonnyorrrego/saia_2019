<?php

namespace Saia;

/**
 * FtPlanTratamiento
 */
class FtPlanTratamiento
{
    /**
     * @var integer
     */
    private $idftPlanTratamiento;

    /**
     * @var integer
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $planDiagnostico;

    /**
     * @var integer
     */
    private $valorPlanTratamiento;

    /**
     * @var string
     */
    private $pacienteTratamiento;

    /**
     * @var string
     */
    private $documentoPaciente;

    /**
     * @var string
     */
    private $odontologoTratamiento;

    /**
     * @var string
     */
    private $registroTratamiento;

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
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftPlanTratamiento
     *
     * @return integer
     */
    public function getIdftPlanTratamiento()
    {
        return $this->idftPlanTratamiento;
    }

    /**
     * Set ftClinicaOrtodoncia
     *
     * @param integer $ftClinicaOrtodoncia
     *
     * @return FtPlanTratamiento
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPlanTratamiento
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
     * Set planDiagnostico
     *
     * @param string $planDiagnostico
     *
     * @return FtPlanTratamiento
     */
    public function setPlanDiagnostico($planDiagnostico)
    {
        $this->planDiagnostico = $planDiagnostico;

        return $this;
    }

    /**
     * Get planDiagnostico
     *
     * @return string
     */
    public function getPlanDiagnostico()
    {
        return $this->planDiagnostico;
    }

    /**
     * Set valorPlanTratamiento
     *
     * @param integer $valorPlanTratamiento
     *
     * @return FtPlanTratamiento
     */
    public function setValorPlanTratamiento($valorPlanTratamiento)
    {
        $this->valorPlanTratamiento = $valorPlanTratamiento;

        return $this;
    }

    /**
     * Get valorPlanTratamiento
     *
     * @return integer
     */
    public function getValorPlanTratamiento()
    {
        return $this->valorPlanTratamiento;
    }

    /**
     * Set pacienteTratamiento
     *
     * @param string $pacienteTratamiento
     *
     * @return FtPlanTratamiento
     */
    public function setPacienteTratamiento($pacienteTratamiento)
    {
        $this->pacienteTratamiento = $pacienteTratamiento;

        return $this;
    }

    /**
     * Get pacienteTratamiento
     *
     * @return string
     */
    public function getPacienteTratamiento()
    {
        return $this->pacienteTratamiento;
    }

    /**
     * Set documentoPaciente
     *
     * @param string $documentoPaciente
     *
     * @return FtPlanTratamiento
     */
    public function setDocumentoPaciente($documentoPaciente)
    {
        $this->documentoPaciente = $documentoPaciente;

        return $this;
    }

    /**
     * Get documentoPaciente
     *
     * @return string
     */
    public function getDocumentoPaciente()
    {
        return $this->documentoPaciente;
    }

    /**
     * Set odontologoTratamiento
     *
     * @param string $odontologoTratamiento
     *
     * @return FtPlanTratamiento
     */
    public function setOdontologoTratamiento($odontologoTratamiento)
    {
        $this->odontologoTratamiento = $odontologoTratamiento;

        return $this;
    }

    /**
     * Get odontologoTratamiento
     *
     * @return string
     */
    public function getOdontologoTratamiento()
    {
        return $this->odontologoTratamiento;
    }

    /**
     * Set registroTratamiento
     *
     * @param string $registroTratamiento
     *
     * @return FtPlanTratamiento
     */
    public function setRegistroTratamiento($registroTratamiento)
    {
        $this->registroTratamiento = $registroTratamiento;

        return $this;
    }

    /**
     * Get registroTratamiento
     *
     * @return string
     */
    public function getRegistroTratamiento()
    {
        return $this->registroTratamiento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPlanTratamiento
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
     * @return FtPlanTratamiento
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
     * @return FtPlanTratamiento
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
     * @return FtPlanTratamiento
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtPlanTratamiento
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

