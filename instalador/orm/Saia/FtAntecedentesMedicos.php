<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAntecedentesMedicos
 *
 * @ORM\Table(name="ft_antecedentes_medicos", indexes={@ORM\Index(name="i_ft_antecedentes_medicos_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_antecedentes_medicos_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtAntecedentesMedicos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_antecedentes_medicos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAntecedentesMedicos;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '999';

    /**
     * @var integer
     *
     * @ORM\Column(name="padece_enfermedad", type="integer", nullable=false)
     */
    private $padeceEnfermedad;

    /**
     * @var string
     *
     * @ORM\Column(name="cual_enfermedad", type="string", length=255, nullable=true)
     */
    private $cualEnfermedad;

    /**
     * @var integer
     *
     * @ORM\Column(name="recibe_medicamento", type="integer", nullable=false)
     */
    private $recibeMedicamento;

    /**
     * @var string
     *
     * @ORM\Column(name="cual_medicamento", type="string", length=255, nullable=true)
     */
    private $cualMedicamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="enfermedades_cardiacas", type="integer", nullable=true)
     */
    private $enfermedadesCardiacas;

    /**
     * @var integer
     *
     * @ORM\Column(name="hipertension_arterial", type="integer", nullable=true)
     */
    private $hipertensionArterial;

    /**
     * @var integer
     *
     * @ORM\Column(name="enfermedad_renal", type="integer", nullable=true)
     */
    private $enfermedadRenal;

    /**
     * @var integer
     *
     * @ORM\Column(name="diabetes", type="integer", nullable=true)
     */
    private $diabetes;

    /**
     * @var integer
     *
     * @ORM\Column(name="hepatitis", type="integer", nullable=true)
     */
    private $hepatitis;

    /**
     * @var integer
     *
     * @ORM\Column(name="trastorno_sanguineo", type="integer", nullable=true)
     */
    private $trastornoSanguineo;

    /**
     * @var integer
     *
     * @ORM\Column(name="alergias", type="integer", nullable=true)
     */
    private $alergias;

    /**
     * @var integer
     *
     * @ORM\Column(name="obstruccion_nasal", type="integer", nullable=true)
     */
    private $obstruccionNasal;

    /**
     * @var integer
     *
     * @ORM\Column(name="cirujias", type="integer", nullable=true)
     */
    private $cirujias;

    /**
     * @var string
     *
     * @ORM\Column(name="edad_menstruacion", type="string", length=255, nullable=true)
     */
    private $edadMenstruacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_ante", type="text", length=65535, nullable=true)
     */
    private $observacionAnte;

    /**
     * @var integer
     *
     * @ORM\Column(name="enfer_respiratoria", type="integer", nullable=true)
     */
    private $enferRespiratoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="adenoides", type="integer", nullable=true)
     */
    private $adenoides;

    /**
     * @var integer
     *
     * @ORM\Column(name="amigdalas", type="integer", nullable=true)
     */
    private $amigdalas;

    /**
     * @var string
     *
     * @ORM\Column(name="otro_antecedente", type="string", length=255, nullable=true)
     */
    private $otroAntecedente;

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
     * @ORM\Column(name="fiebre_reumatica", type="integer", nullable=true)
     */
    private $fiebreReumatica;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAntecedentesMedicos
     *
     * @return integer
     */
    public function getIdftAntecedentesMedicos()
    {
        return $this->idftAntecedentesMedicos;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAntecedentesMedicos
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
     * Set padeceEnfermedad
     *
     * @param integer $padeceEnfermedad
     *
     * @return FtAntecedentesMedicos
     */
    public function setPadeceEnfermedad($padeceEnfermedad)
    {
        $this->padeceEnfermedad = $padeceEnfermedad;

        return $this;
    }

    /**
     * Get padeceEnfermedad
     *
     * @return integer
     */
    public function getPadeceEnfermedad()
    {
        return $this->padeceEnfermedad;
    }

    /**
     * Set cualEnfermedad
     *
     * @param string $cualEnfermedad
     *
     * @return FtAntecedentesMedicos
     */
    public function setCualEnfermedad($cualEnfermedad)
    {
        $this->cualEnfermedad = $cualEnfermedad;

        return $this;
    }

    /**
     * Get cualEnfermedad
     *
     * @return string
     */
    public function getCualEnfermedad()
    {
        return $this->cualEnfermedad;
    }

    /**
     * Set recibeMedicamento
     *
     * @param integer $recibeMedicamento
     *
     * @return FtAntecedentesMedicos
     */
    public function setRecibeMedicamento($recibeMedicamento)
    {
        $this->recibeMedicamento = $recibeMedicamento;

        return $this;
    }

    /**
     * Get recibeMedicamento
     *
     * @return integer
     */
    public function getRecibeMedicamento()
    {
        return $this->recibeMedicamento;
    }

    /**
     * Set cualMedicamento
     *
     * @param string $cualMedicamento
     *
     * @return FtAntecedentesMedicos
     */
    public function setCualMedicamento($cualMedicamento)
    {
        $this->cualMedicamento = $cualMedicamento;

        return $this;
    }

    /**
     * Get cualMedicamento
     *
     * @return string
     */
    public function getCualMedicamento()
    {
        return $this->cualMedicamento;
    }

    /**
     * Set enfermedadesCardiacas
     *
     * @param integer $enfermedadesCardiacas
     *
     * @return FtAntecedentesMedicos
     */
    public function setEnfermedadesCardiacas($enfermedadesCardiacas)
    {
        $this->enfermedadesCardiacas = $enfermedadesCardiacas;

        return $this;
    }

    /**
     * Get enfermedadesCardiacas
     *
     * @return integer
     */
    public function getEnfermedadesCardiacas()
    {
        return $this->enfermedadesCardiacas;
    }

    /**
     * Set hipertensionArterial
     *
     * @param integer $hipertensionArterial
     *
     * @return FtAntecedentesMedicos
     */
    public function setHipertensionArterial($hipertensionArterial)
    {
        $this->hipertensionArterial = $hipertensionArterial;

        return $this;
    }

    /**
     * Get hipertensionArterial
     *
     * @return integer
     */
    public function getHipertensionArterial()
    {
        return $this->hipertensionArterial;
    }

    /**
     * Set enfermedadRenal
     *
     * @param integer $enfermedadRenal
     *
     * @return FtAntecedentesMedicos
     */
    public function setEnfermedadRenal($enfermedadRenal)
    {
        $this->enfermedadRenal = $enfermedadRenal;

        return $this;
    }

    /**
     * Get enfermedadRenal
     *
     * @return integer
     */
    public function getEnfermedadRenal()
    {
        return $this->enfermedadRenal;
    }

    /**
     * Set diabetes
     *
     * @param integer $diabetes
     *
     * @return FtAntecedentesMedicos
     */
    public function setDiabetes($diabetes)
    {
        $this->diabetes = $diabetes;

        return $this;
    }

    /**
     * Get diabetes
     *
     * @return integer
     */
    public function getDiabetes()
    {
        return $this->diabetes;
    }

    /**
     * Set hepatitis
     *
     * @param integer $hepatitis
     *
     * @return FtAntecedentesMedicos
     */
    public function setHepatitis($hepatitis)
    {
        $this->hepatitis = $hepatitis;

        return $this;
    }

    /**
     * Get hepatitis
     *
     * @return integer
     */
    public function getHepatitis()
    {
        return $this->hepatitis;
    }

    /**
     * Set trastornoSanguineo
     *
     * @param integer $trastornoSanguineo
     *
     * @return FtAntecedentesMedicos
     */
    public function setTrastornoSanguineo($trastornoSanguineo)
    {
        $this->trastornoSanguineo = $trastornoSanguineo;

        return $this;
    }

    /**
     * Get trastornoSanguineo
     *
     * @return integer
     */
    public function getTrastornoSanguineo()
    {
        return $this->trastornoSanguineo;
    }

    /**
     * Set alergias
     *
     * @param integer $alergias
     *
     * @return FtAntecedentesMedicos
     */
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;

        return $this;
    }

    /**
     * Get alergias
     *
     * @return integer
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Set obstruccionNasal
     *
     * @param integer $obstruccionNasal
     *
     * @return FtAntecedentesMedicos
     */
    public function setObstruccionNasal($obstruccionNasal)
    {
        $this->obstruccionNasal = $obstruccionNasal;

        return $this;
    }

    /**
     * Get obstruccionNasal
     *
     * @return integer
     */
    public function getObstruccionNasal()
    {
        return $this->obstruccionNasal;
    }

    /**
     * Set cirujias
     *
     * @param integer $cirujias
     *
     * @return FtAntecedentesMedicos
     */
    public function setCirujias($cirujias)
    {
        $this->cirujias = $cirujias;

        return $this;
    }

    /**
     * Get cirujias
     *
     * @return integer
     */
    public function getCirujias()
    {
        return $this->cirujias;
    }

    /**
     * Set edadMenstruacion
     *
     * @param string $edadMenstruacion
     *
     * @return FtAntecedentesMedicos
     */
    public function setEdadMenstruacion($edadMenstruacion)
    {
        $this->edadMenstruacion = $edadMenstruacion;

        return $this;
    }

    /**
     * Get edadMenstruacion
     *
     * @return string
     */
    public function getEdadMenstruacion()
    {
        return $this->edadMenstruacion;
    }

    /**
     * Set observacionAnte
     *
     * @param string $observacionAnte
     *
     * @return FtAntecedentesMedicos
     */
    public function setObservacionAnte($observacionAnte)
    {
        $this->observacionAnte = $observacionAnte;

        return $this;
    }

    /**
     * Get observacionAnte
     *
     * @return string
     */
    public function getObservacionAnte()
    {
        return $this->observacionAnte;
    }

    /**
     * Set enferRespiratoria
     *
     * @param integer $enferRespiratoria
     *
     * @return FtAntecedentesMedicos
     */
    public function setEnferRespiratoria($enferRespiratoria)
    {
        $this->enferRespiratoria = $enferRespiratoria;

        return $this;
    }

    /**
     * Get enferRespiratoria
     *
     * @return integer
     */
    public function getEnferRespiratoria()
    {
        return $this->enferRespiratoria;
    }

    /**
     * Set adenoides
     *
     * @param integer $adenoides
     *
     * @return FtAntecedentesMedicos
     */
    public function setAdenoides($adenoides)
    {
        $this->adenoides = $adenoides;

        return $this;
    }

    /**
     * Get adenoides
     *
     * @return integer
     */
    public function getAdenoides()
    {
        return $this->adenoides;
    }

    /**
     * Set amigdalas
     *
     * @param integer $amigdalas
     *
     * @return FtAntecedentesMedicos
     */
    public function setAmigdalas($amigdalas)
    {
        $this->amigdalas = $amigdalas;

        return $this;
    }

    /**
     * Get amigdalas
     *
     * @return integer
     */
    public function getAmigdalas()
    {
        return $this->amigdalas;
    }

    /**
     * Set otroAntecedente
     *
     * @param string $otroAntecedente
     *
     * @return FtAntecedentesMedicos
     */
    public function setOtroAntecedente($otroAntecedente)
    {
        $this->otroAntecedente = $otroAntecedente;

        return $this;
    }

    /**
     * Get otroAntecedente
     *
     * @return string
     */
    public function getOtroAntecedente()
    {
        return $this->otroAntecedente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAntecedentesMedicos
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
     * @return FtAntecedentesMedicos
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
     * @return FtAntecedentesMedicos
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
     * @return FtAntecedentesMedicos
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
     * Set fiebreReumatica
     *
     * @param integer $fiebreReumatica
     *
     * @return FtAntecedentesMedicos
     */
    public function setFiebreReumatica($fiebreReumatica)
    {
        $this->fiebreReumatica = $fiebreReumatica;

        return $this;
    }

    /**
     * Get fiebreReumatica
     *
     * @return integer
     */
    public function getFiebreReumatica()
    {
        return $this->fiebreReumatica;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAntecedentesMedicos
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
