<?php

namespace Saia;

/**
 * FtAntecedentesMedicos
 */
class FtAntecedentesMedicos
{
    /**
     * @var integer
     */
    private $idftAntecedentesMedicos;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $padeceEnfermedad;

    /**
     * @var string
     */
    private $cualEnfermedad;

    /**
     * @var integer
     */
    private $recibeMedicamento;

    /**
     * @var string
     */
    private $cualMedicamento;

    /**
     * @var integer
     */
    private $enfermedadesCardiacas;

    /**
     * @var integer
     */
    private $hipertensionArterial;

    /**
     * @var integer
     */
    private $enfermedadRenal;

    /**
     * @var integer
     */
    private $diabetes;

    /**
     * @var integer
     */
    private $hepatitis;

    /**
     * @var integer
     */
    private $trastornoSanguineo;

    /**
     * @var integer
     */
    private $alergias;

    /**
     * @var integer
     */
    private $obstruccionNasal;

    /**
     * @var integer
     */
    private $cirujias;

    /**
     * @var string
     */
    private $edadMenstruacion;

    /**
     * @var string
     */
    private $observacionAnte;

    /**
     * @var integer
     */
    private $enferRespiratoria;

    /**
     * @var integer
     */
    private $adenoides;

    /**
     * @var integer
     */
    private $amigdalas;

    /**
     * @var string
     */
    private $otroAntecedente;

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
    private $fiebreReumatica;

    /**
     * @var integer
     */
    private $estadoDocumento;


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

