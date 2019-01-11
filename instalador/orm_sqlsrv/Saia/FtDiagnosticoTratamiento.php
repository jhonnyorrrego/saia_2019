<?php

namespace Saia;

/**
 * FtDiagnosticoTratamiento
 */
class FtDiagnosticoTratamiento
{
    /**
     * @var integer
     */
    private $idftDiagnosticoTratamiento;

    /**
     * @var integer
     */
    private $ftSolicitudCita;

    /**
     * @var integer
     */
    private $serieIdserie;

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
     * @var \DateTime
     */
    private $fechaDiagnostico;

    /**
     * @var string
     */
    private $nombreDiagnosticado;

    /**
     * @var string
     */
    private $sna;

    /**
     * @var integer
     */
    private $snb;

    /**
     * @var integer
     */
    private $anb;

    /**
     * @var integer
     */
    private $mxMd;

    /**
     * @var integer
     */
    private $snmd;

    /**
     * @var integer
     */
    private $wits;

    /**
     * @var integer
     */
    private $interincisivo;

    /**
     * @var integer
     */
    private $unoMx;

    /**
     * @var integer
     */
    private $unoMd;

    /**
     * @var string
     */
    private $etiquetaMeaw;

    /**
     * @var string
     */
    private $odi;

    /**
     * @var integer
     */
    private $apdi;

    /**
     * @var integer
     */
    private $cf;

    /**
     * @var integer
     */
    private $etiquetaFacial;

    /**
     * @var integer
     */
    private $lineaESuperior;

    /**
     * @var integer
     */
    private $lineaEInferior;

    /**
     * @var integer
     */
    private $fhiLs;

    /**
     * @var integer
     */
    private $menorNl;

    /**
     * @var integer
     */
    private $ortodoncista;

    /**
     * @var string
     */
    private $auxiliar;

    /**
     * @var string
     */
    private $esqueletico;

    /**
     * @var string
     */
    private $oclusal;

    /**
     * @var string
     */
    private $dental;

    /**
     * @var string
     */
    private $tejidoBlando;

    /**
     * @var string
     */
    private $funcional;

    /**
     * @var string
     */
    private $planTratamiento;

    /**
     * @var string
     */
    private $reEvaluaciones;

    /**
     * @var string
     */
    private $retencion;

    /**
     * @var string
     */
    private $remisionProcedimiento;

    /**
     * @var string
     */
    private $itemEvolucion;

    /**
     * @var string
     */
    private $planPreventivo;

    /**
     * @var string
     */
    private $extSeriada;

    /**
     * @var string
     */
    private $ortopedia;

    /**
     * @var string
     */
    private $ortopediaOrtodoncia;

    /**
     * @var string
     */
    private $otroTratamiento;

    /**
     * @var string
     */
    private $ortodonciaCaso;

    /**
     * @var string
     */
    private $ortodonciaNoComplicada;

    /**
     * @var string
     */
    private $ortodoncia;

    /**
     * @var string
     */
    private $ortodonciaCirugia;

    /**
     * @var string
     */
    private $otroEvaluaciones;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftDiagnosticoTratamiento
     *
     * @return integer
     */
    public function getIdftDiagnosticoTratamiento()
    {
        return $this->idftDiagnosticoTratamiento;
    }

    /**
     * Set ftSolicitudCita
     *
     * @param integer $ftSolicitudCita
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setFtSolicitudCita($ftSolicitudCita)
    {
        $this->ftSolicitudCita = $ftSolicitudCita;

        return $this;
    }

    /**
     * Get ftSolicitudCita
     *
     * @return integer
     */
    public function getFtSolicitudCita()
    {
        return $this->ftSolicitudCita;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDiagnosticoTratamiento
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDiagnosticoTratamiento
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
     * @return FtDiagnosticoTratamiento
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
     * @return FtDiagnosticoTratamiento
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
     * @return FtDiagnosticoTratamiento
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
     * Set fechaDiagnostico
     *
     * @param \DateTime $fechaDiagnostico
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setFechaDiagnostico($fechaDiagnostico)
    {
        $this->fechaDiagnostico = $fechaDiagnostico;

        return $this;
    }

    /**
     * Get fechaDiagnostico
     *
     * @return \DateTime
     */
    public function getFechaDiagnostico()
    {
        return $this->fechaDiagnostico;
    }

    /**
     * Set nombreDiagnosticado
     *
     * @param string $nombreDiagnosticado
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setNombreDiagnosticado($nombreDiagnosticado)
    {
        $this->nombreDiagnosticado = $nombreDiagnosticado;

        return $this;
    }

    /**
     * Get nombreDiagnosticado
     *
     * @return string
     */
    public function getNombreDiagnosticado()
    {
        return $this->nombreDiagnosticado;
    }

    /**
     * Set sna
     *
     * @param string $sna
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setSna($sna)
    {
        $this->sna = $sna;

        return $this;
    }

    /**
     * Get sna
     *
     * @return string
     */
    public function getSna()
    {
        return $this->sna;
    }

    /**
     * Set snb
     *
     * @param integer $snb
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setSnb($snb)
    {
        $this->snb = $snb;

        return $this;
    }

    /**
     * Get snb
     *
     * @return integer
     */
    public function getSnb()
    {
        return $this->snb;
    }

    /**
     * Set anb
     *
     * @param integer $anb
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setAnb($anb)
    {
        $this->anb = $anb;

        return $this;
    }

    /**
     * Get anb
     *
     * @return integer
     */
    public function getAnb()
    {
        return $this->anb;
    }

    /**
     * Set mxMd
     *
     * @param integer $mxMd
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setMxMd($mxMd)
    {
        $this->mxMd = $mxMd;

        return $this;
    }

    /**
     * Get mxMd
     *
     * @return integer
     */
    public function getMxMd()
    {
        return $this->mxMd;
    }

    /**
     * Set snmd
     *
     * @param integer $snmd
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setSnmd($snmd)
    {
        $this->snmd = $snmd;

        return $this;
    }

    /**
     * Get snmd
     *
     * @return integer
     */
    public function getSnmd()
    {
        return $this->snmd;
    }

    /**
     * Set wits
     *
     * @param integer $wits
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setWits($wits)
    {
        $this->wits = $wits;

        return $this;
    }

    /**
     * Get wits
     *
     * @return integer
     */
    public function getWits()
    {
        return $this->wits;
    }

    /**
     * Set interincisivo
     *
     * @param integer $interincisivo
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setInterincisivo($interincisivo)
    {
        $this->interincisivo = $interincisivo;

        return $this;
    }

    /**
     * Get interincisivo
     *
     * @return integer
     */
    public function getInterincisivo()
    {
        return $this->interincisivo;
    }

    /**
     * Set unoMx
     *
     * @param integer $unoMx
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setUnoMx($unoMx)
    {
        $this->unoMx = $unoMx;

        return $this;
    }

    /**
     * Get unoMx
     *
     * @return integer
     */
    public function getUnoMx()
    {
        return $this->unoMx;
    }

    /**
     * Set unoMd
     *
     * @param integer $unoMd
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setUnoMd($unoMd)
    {
        $this->unoMd = $unoMd;

        return $this;
    }

    /**
     * Get unoMd
     *
     * @return integer
     */
    public function getUnoMd()
    {
        return $this->unoMd;
    }

    /**
     * Set etiquetaMeaw
     *
     * @param string $etiquetaMeaw
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setEtiquetaMeaw($etiquetaMeaw)
    {
        $this->etiquetaMeaw = $etiquetaMeaw;

        return $this;
    }

    /**
     * Get etiquetaMeaw
     *
     * @return string
     */
    public function getEtiquetaMeaw()
    {
        return $this->etiquetaMeaw;
    }

    /**
     * Set odi
     *
     * @param string $odi
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOdi($odi)
    {
        $this->odi = $odi;

        return $this;
    }

    /**
     * Get odi
     *
     * @return string
     */
    public function getOdi()
    {
        return $this->odi;
    }

    /**
     * Set apdi
     *
     * @param integer $apdi
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setApdi($apdi)
    {
        $this->apdi = $apdi;

        return $this;
    }

    /**
     * Get apdi
     *
     * @return integer
     */
    public function getApdi()
    {
        return $this->apdi;
    }

    /**
     * Set cf
     *
     * @param integer $cf
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setCf($cf)
    {
        $this->cf = $cf;

        return $this;
    }

    /**
     * Get cf
     *
     * @return integer
     */
    public function getCf()
    {
        return $this->cf;
    }

    /**
     * Set etiquetaFacial
     *
     * @param integer $etiquetaFacial
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setEtiquetaFacial($etiquetaFacial)
    {
        $this->etiquetaFacial = $etiquetaFacial;

        return $this;
    }

    /**
     * Get etiquetaFacial
     *
     * @return integer
     */
    public function getEtiquetaFacial()
    {
        return $this->etiquetaFacial;
    }

    /**
     * Set lineaESuperior
     *
     * @param integer $lineaESuperior
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setLineaESuperior($lineaESuperior)
    {
        $this->lineaESuperior = $lineaESuperior;

        return $this;
    }

    /**
     * Get lineaESuperior
     *
     * @return integer
     */
    public function getLineaESuperior()
    {
        return $this->lineaESuperior;
    }

    /**
     * Set lineaEInferior
     *
     * @param integer $lineaEInferior
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setLineaEInferior($lineaEInferior)
    {
        $this->lineaEInferior = $lineaEInferior;

        return $this;
    }

    /**
     * Get lineaEInferior
     *
     * @return integer
     */
    public function getLineaEInferior()
    {
        return $this->lineaEInferior;
    }

    /**
     * Set fhiLs
     *
     * @param integer $fhiLs
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setFhiLs($fhiLs)
    {
        $this->fhiLs = $fhiLs;

        return $this;
    }

    /**
     * Get fhiLs
     *
     * @return integer
     */
    public function getFhiLs()
    {
        return $this->fhiLs;
    }

    /**
     * Set menorNl
     *
     * @param integer $menorNl
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setMenorNl($menorNl)
    {
        $this->menorNl = $menorNl;

        return $this;
    }

    /**
     * Get menorNl
     *
     * @return integer
     */
    public function getMenorNl()
    {
        return $this->menorNl;
    }

    /**
     * Set ortodoncista
     *
     * @param integer $ortodoncista
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtodoncista($ortodoncista)
    {
        $this->ortodoncista = $ortodoncista;

        return $this;
    }

    /**
     * Get ortodoncista
     *
     * @return integer
     */
    public function getOrtodoncista()
    {
        return $this->ortodoncista;
    }

    /**
     * Set auxiliar
     *
     * @param string $auxiliar
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setAuxiliar($auxiliar)
    {
        $this->auxiliar = $auxiliar;

        return $this;
    }

    /**
     * Get auxiliar
     *
     * @return string
     */
    public function getAuxiliar()
    {
        return $this->auxiliar;
    }

    /**
     * Set esqueletico
     *
     * @param string $esqueletico
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setEsqueletico($esqueletico)
    {
        $this->esqueletico = $esqueletico;

        return $this;
    }

    /**
     * Get esqueletico
     *
     * @return string
     */
    public function getEsqueletico()
    {
        return $this->esqueletico;
    }

    /**
     * Set oclusal
     *
     * @param string $oclusal
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOclusal($oclusal)
    {
        $this->oclusal = $oclusal;

        return $this;
    }

    /**
     * Get oclusal
     *
     * @return string
     */
    public function getOclusal()
    {
        return $this->oclusal;
    }

    /**
     * Set dental
     *
     * @param string $dental
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setDental($dental)
    {
        $this->dental = $dental;

        return $this;
    }

    /**
     * Get dental
     *
     * @return string
     */
    public function getDental()
    {
        return $this->dental;
    }

    /**
     * Set tejidoBlando
     *
     * @param string $tejidoBlando
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setTejidoBlando($tejidoBlando)
    {
        $this->tejidoBlando = $tejidoBlando;

        return $this;
    }

    /**
     * Get tejidoBlando
     *
     * @return string
     */
    public function getTejidoBlando()
    {
        return $this->tejidoBlando;
    }

    /**
     * Set funcional
     *
     * @param string $funcional
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setFuncional($funcional)
    {
        $this->funcional = $funcional;

        return $this;
    }

    /**
     * Get funcional
     *
     * @return string
     */
    public function getFuncional()
    {
        return $this->funcional;
    }

    /**
     * Set planTratamiento
     *
     * @param string $planTratamiento
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setPlanTratamiento($planTratamiento)
    {
        $this->planTratamiento = $planTratamiento;

        return $this;
    }

    /**
     * Get planTratamiento
     *
     * @return string
     */
    public function getPlanTratamiento()
    {
        return $this->planTratamiento;
    }

    /**
     * Set reEvaluaciones
     *
     * @param string $reEvaluaciones
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setReEvaluaciones($reEvaluaciones)
    {
        $this->reEvaluaciones = $reEvaluaciones;

        return $this;
    }

    /**
     * Get reEvaluaciones
     *
     * @return string
     */
    public function getReEvaluaciones()
    {
        return $this->reEvaluaciones;
    }

    /**
     * Set retencion
     *
     * @param string $retencion
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setRetencion($retencion)
    {
        $this->retencion = $retencion;

        return $this;
    }

    /**
     * Get retencion
     *
     * @return string
     */
    public function getRetencion()
    {
        return $this->retencion;
    }

    /**
     * Set remisionProcedimiento
     *
     * @param string $remisionProcedimiento
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setRemisionProcedimiento($remisionProcedimiento)
    {
        $this->remisionProcedimiento = $remisionProcedimiento;

        return $this;
    }

    /**
     * Get remisionProcedimiento
     *
     * @return string
     */
    public function getRemisionProcedimiento()
    {
        return $this->remisionProcedimiento;
    }

    /**
     * Set itemEvolucion
     *
     * @param string $itemEvolucion
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setItemEvolucion($itemEvolucion)
    {
        $this->itemEvolucion = $itemEvolucion;

        return $this;
    }

    /**
     * Get itemEvolucion
     *
     * @return string
     */
    public function getItemEvolucion()
    {
        return $this->itemEvolucion;
    }

    /**
     * Set planPreventivo
     *
     * @param string $planPreventivo
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setPlanPreventivo($planPreventivo)
    {
        $this->planPreventivo = $planPreventivo;

        return $this;
    }

    /**
     * Get planPreventivo
     *
     * @return string
     */
    public function getPlanPreventivo()
    {
        return $this->planPreventivo;
    }

    /**
     * Set extSeriada
     *
     * @param string $extSeriada
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setExtSeriada($extSeriada)
    {
        $this->extSeriada = $extSeriada;

        return $this;
    }

    /**
     * Get extSeriada
     *
     * @return string
     */
    public function getExtSeriada()
    {
        return $this->extSeriada;
    }

    /**
     * Set ortopedia
     *
     * @param string $ortopedia
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtopedia($ortopedia)
    {
        $this->ortopedia = $ortopedia;

        return $this;
    }

    /**
     * Get ortopedia
     *
     * @return string
     */
    public function getOrtopedia()
    {
        return $this->ortopedia;
    }

    /**
     * Set ortopediaOrtodoncia
     *
     * @param string $ortopediaOrtodoncia
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtopediaOrtodoncia($ortopediaOrtodoncia)
    {
        $this->ortopediaOrtodoncia = $ortopediaOrtodoncia;

        return $this;
    }

    /**
     * Get ortopediaOrtodoncia
     *
     * @return string
     */
    public function getOrtopediaOrtodoncia()
    {
        return $this->ortopediaOrtodoncia;
    }

    /**
     * Set otroTratamiento
     *
     * @param string $otroTratamiento
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOtroTratamiento($otroTratamiento)
    {
        $this->otroTratamiento = $otroTratamiento;

        return $this;
    }

    /**
     * Get otroTratamiento
     *
     * @return string
     */
    public function getOtroTratamiento()
    {
        return $this->otroTratamiento;
    }

    /**
     * Set ortodonciaCaso
     *
     * @param string $ortodonciaCaso
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtodonciaCaso($ortodonciaCaso)
    {
        $this->ortodonciaCaso = $ortodonciaCaso;

        return $this;
    }

    /**
     * Get ortodonciaCaso
     *
     * @return string
     */
    public function getOrtodonciaCaso()
    {
        return $this->ortodonciaCaso;
    }

    /**
     * Set ortodonciaNoComplicada
     *
     * @param string $ortodonciaNoComplicada
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtodonciaNoComplicada($ortodonciaNoComplicada)
    {
        $this->ortodonciaNoComplicada = $ortodonciaNoComplicada;

        return $this;
    }

    /**
     * Get ortodonciaNoComplicada
     *
     * @return string
     */
    public function getOrtodonciaNoComplicada()
    {
        return $this->ortodonciaNoComplicada;
    }

    /**
     * Set ortodoncia
     *
     * @param string $ortodoncia
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtodoncia($ortodoncia)
    {
        $this->ortodoncia = $ortodoncia;

        return $this;
    }

    /**
     * Get ortodoncia
     *
     * @return string
     */
    public function getOrtodoncia()
    {
        return $this->ortodoncia;
    }

    /**
     * Set ortodonciaCirugia
     *
     * @param string $ortodonciaCirugia
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOrtodonciaCirugia($ortodonciaCirugia)
    {
        $this->ortodonciaCirugia = $ortodonciaCirugia;

        return $this;
    }

    /**
     * Get ortodonciaCirugia
     *
     * @return string
     */
    public function getOrtodonciaCirugia()
    {
        return $this->ortodonciaCirugia;
    }

    /**
     * Set otroEvaluaciones
     *
     * @param string $otroEvaluaciones
     *
     * @return FtDiagnosticoTratamiento
     */
    public function setOtroEvaluaciones($otroEvaluaciones)
    {
        $this->otroEvaluaciones = $otroEvaluaciones;

        return $this;
    }

    /**
     * Get otroEvaluaciones
     *
     * @return string
     */
    public function getOtroEvaluaciones()
    {
        return $this->otroEvaluaciones;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDiagnosticoTratamiento
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

