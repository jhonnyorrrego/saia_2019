<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDiagnosticoTratamiento
 *
 * @ORM\Table(name="ft_diagnostico_tratamiento", indexes={@ORM\Index(name="i_ft_diagnostico_tratamiento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDiagnosticoTratamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_diagnostico_tratamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDiagnosticoTratamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_cita", type="integer", nullable=false)
     */
    private $ftSolicitudCita;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1012';

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_diagnostico", type="datetime", nullable=false)
     */
    private $fechaDiagnostico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_diagnosticado", type="string", length=255, nullable=false)
     */
    private $nombreDiagnosticado;

    /**
     * @var string
     *
     * @ORM\Column(name="sna", type="string", length=11, nullable=true)
     */
    private $sna;

    /**
     * @var integer
     *
     * @ORM\Column(name="snb", type="integer", nullable=true)
     */
    private $snb;

    /**
     * @var integer
     *
     * @ORM\Column(name="anb", type="integer", nullable=true)
     */
    private $anb;

    /**
     * @var integer
     *
     * @ORM\Column(name="mx_md", type="integer", nullable=true)
     */
    private $mxMd;

    /**
     * @var integer
     *
     * @ORM\Column(name="snmd", type="integer", nullable=true)
     */
    private $snmd;

    /**
     * @var integer
     *
     * @ORM\Column(name="wits", type="integer", nullable=true)
     */
    private $wits;

    /**
     * @var integer
     *
     * @ORM\Column(name="interincisivo", type="integer", nullable=true)
     */
    private $interincisivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="uno_mx", type="integer", nullable=true)
     */
    private $unoMx;

    /**
     * @var integer
     *
     * @ORM\Column(name="uno_md", type="integer", nullable=true)
     */
    private $unoMd;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_meaw", type="string", length=255, nullable=true)
     */
    private $etiquetaMeaw;

    /**
     * @var string
     *
     * @ORM\Column(name="odi", type="string", length=255, nullable=true)
     */
    private $odi;

    /**
     * @var integer
     *
     * @ORM\Column(name="apdi", type="integer", nullable=true)
     */
    private $apdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="cf", type="integer", nullable=true)
     */
    private $cf;

    /**
     * @var integer
     *
     * @ORM\Column(name="etiqueta_facial", type="integer", nullable=false)
     */
    private $etiquetaFacial;

    /**
     * @var integer
     *
     * @ORM\Column(name="linea_e_superior", type="integer", nullable=true)
     */
    private $lineaESuperior;

    /**
     * @var integer
     *
     * @ORM\Column(name="linea_e_inferior", type="integer", nullable=true)
     */
    private $lineaEInferior;

    /**
     * @var integer
     *
     * @ORM\Column(name="fhi_ls", type="integer", nullable=true)
     */
    private $fhiLs;

    /**
     * @var integer
     *
     * @ORM\Column(name="menor_nl", type="integer", nullable=true)
     */
    private $menorNl;

    /**
     * @var integer
     *
     * @ORM\Column(name="ortodoncista", type="integer", nullable=true)
     */
    private $ortodoncista;

    /**
     * @var string
     *
     * @ORM\Column(name="auxiliar", type="string", length=255, nullable=true)
     */
    private $auxiliar;

    /**
     * @var string
     *
     * @ORM\Column(name="esqueletico", type="text", length=65535, nullable=true)
     */
    private $esqueletico;

    /**
     * @var string
     *
     * @ORM\Column(name="oclusal", type="text", length=65535, nullable=true)
     */
    private $oclusal;

    /**
     * @var string
     *
     * @ORM\Column(name="dental", type="text", length=65535, nullable=true)
     */
    private $dental;

    /**
     * @var string
     *
     * @ORM\Column(name="tejido_blando", type="string", length=255, nullable=true)
     */
    private $tejidoBlando;

    /**
     * @var string
     *
     * @ORM\Column(name="funcional", type="text", length=65535, nullable=true)
     */
    private $funcional;

    /**
     * @var string
     *
     * @ORM\Column(name="plan_tratamiento", type="text", length=65535, nullable=true)
     */
    private $planTratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="re_evaluaciones", type="text", length=65535, nullable=true)
     */
    private $reEvaluaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="retencion", type="text", length=65535, nullable=true)
     */
    private $retencion;

    /**
     * @var string
     *
     * @ORM\Column(name="remision_procedimiento", type="text", length=65535, nullable=true)
     */
    private $remisionProcedimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="item_evolucion", type="string", length=255, nullable=true)
     */
    private $itemEvolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="plan_preventivo", type="string", length=255, nullable=true)
     */
    private $planPreventivo;

    /**
     * @var string
     *
     * @ORM\Column(name="ext_seriada", type="string", length=255, nullable=true)
     */
    private $extSeriada;

    /**
     * @var string
     *
     * @ORM\Column(name="ortopedia", type="string", length=255, nullable=true)
     */
    private $ortopedia;

    /**
     * @var string
     *
     * @ORM\Column(name="ortopedia_ortodoncia", type="string", length=255, nullable=true)
     */
    private $ortopediaOrtodoncia;

    /**
     * @var string
     *
     * @ORM\Column(name="otro_tratamiento", type="string", length=255, nullable=true)
     */
    private $otroTratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="ortodoncia_caso", type="string", length=255, nullable=true)
     */
    private $ortodonciaCaso;

    /**
     * @var string
     *
     * @ORM\Column(name="ortodoncia_no_complicada", type="string", length=255, nullable=true)
     */
    private $ortodonciaNoComplicada;

    /**
     * @var string
     *
     * @ORM\Column(name="ortodoncia", type="string", length=255, nullable=true)
     */
    private $ortodoncia;

    /**
     * @var string
     *
     * @ORM\Column(name="ortodoncia_cirugia", type="string", length=255, nullable=true)
     */
    private $ortodonciaCirugia;

    /**
     * @var string
     *
     * @ORM\Column(name="otro_evaluaciones", type="string", length=255, nullable=true)
     */
    private $otroEvaluaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
