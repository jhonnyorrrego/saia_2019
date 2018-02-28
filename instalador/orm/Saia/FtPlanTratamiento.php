<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPlanTratamiento
 *
 * @ORM\Table(name="ft_plan_tratamiento", indexes={@ORM\Index(name="i_plan_tratamiento_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_plan_tratamiento_clinica_or", columns={"ft_clinica_ortodoncia"}), @ORM\Index(name="i_plan_tratamiento_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPlanTratamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_plan_tratamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPlanTratamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clinica_ortodoncia", type="integer", nullable=false)
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1014';

    /**
     * @var string
     *
     * @ORM\Column(name="plan_diagnostico", type="text", length=65535, nullable=true)
     */
    private $planDiagnostico;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_plan_tratamiento", type="integer", nullable=true)
     */
    private $valorPlanTratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="paciente_tratamiento", type="string", length=255, nullable=false)
     */
    private $pacienteTratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_paciente", type="string", length=255, nullable=true)
     */
    private $documentoPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="odontologo_tratamiento", type="string", length=255, nullable=true)
     */
    private $odontologoTratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="registro_tratamiento", type="string", length=255, nullable=true)
     */
    private $registroTratamiento;

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
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
