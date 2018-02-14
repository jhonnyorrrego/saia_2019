<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSeguimientoRiesgo
 *
 * @ORM\Table(name="ft_seguimiento_riesgo")
 * @ORM\Entity
 */
class FtSeguimientoRiesgo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seguimiento_riesgo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSeguimientoRiesgo;

    /**
     * @var integer
     *
     * @ORM\Column(name="minimiza", type="integer", nullable=true)
     */
    private $minimiza;

    /**
     * @var integer
     *
     * @ORM\Column(name="probabilidad", type="integer", nullable=true)
     */
    private $probabilidad = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="aplican", type="integer", nullable=true)
     */
    private $aplican;

    /**
     * @var string
     *
     * @ORM\Column(name="seguimiento_antiguo", type="string", length=5, nullable=true)
     */
    private $seguimientoAntiguo = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="documentados", type="integer", nullable=true)
     */
    private $documentados;

    /**
     * @var integer
     *
     * @ORM\Column(name="impacto", type="integer", nullable=true)
     */
    private $impacto = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1043';

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
     * @ORM\Column(name="ft_riesgos_proceso", type="integer", nullable=false)
     */
    private $ftRiesgosProceso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     */
    private $fechaSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="accion_vinculacion", type="string", length=255, nullable=false)
     */
    private $accionVinculacion;

    /**
     * @var string
     *
     * @ORM\Column(name="logro", type="string", length=255, nullable=false)
     */
    private $logro;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="evidencia_documental", type="string", length=255, nullable=true)
     */
    private $evidenciaDocumental;

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
     * Get idftSeguimientoRiesgo
     *
     * @return integer
     */
    public function getIdftSeguimientoRiesgo()
    {
        return $this->idftSeguimientoRiesgo;
    }

    /**
     * Set minimiza
     *
     * @param integer $minimiza
     *
     * @return FtSeguimientoRiesgo
     */
    public function setMinimiza($minimiza)
    {
        $this->minimiza = $minimiza;

        return $this;
    }

    /**
     * Get minimiza
     *
     * @return integer
     */
    public function getMinimiza()
    {
        return $this->minimiza;
    }

    /**
     * Set probabilidad
     *
     * @param integer $probabilidad
     *
     * @return FtSeguimientoRiesgo
     */
    public function setProbabilidad($probabilidad)
    {
        $this->probabilidad = $probabilidad;

        return $this;
    }

    /**
     * Get probabilidad
     *
     * @return integer
     */
    public function getProbabilidad()
    {
        return $this->probabilidad;
    }

    /**
     * Set aplican
     *
     * @param integer $aplican
     *
     * @return FtSeguimientoRiesgo
     */
    public function setAplican($aplican)
    {
        $this->aplican = $aplican;

        return $this;
    }

    /**
     * Get aplican
     *
     * @return integer
     */
    public function getAplican()
    {
        return $this->aplican;
    }

    /**
     * Set seguimientoAntiguo
     *
     * @param string $seguimientoAntiguo
     *
     * @return FtSeguimientoRiesgo
     */
    public function setSeguimientoAntiguo($seguimientoAntiguo)
    {
        $this->seguimientoAntiguo = $seguimientoAntiguo;

        return $this;
    }

    /**
     * Get seguimientoAntiguo
     *
     * @return string
     */
    public function getSeguimientoAntiguo()
    {
        return $this->seguimientoAntiguo;
    }

    /**
     * Set documentados
     *
     * @param integer $documentados
     *
     * @return FtSeguimientoRiesgo
     */
    public function setDocumentados($documentados)
    {
        $this->documentados = $documentados;

        return $this;
    }

    /**
     * Get documentados
     *
     * @return integer
     */
    public function getDocumentados()
    {
        return $this->documentados;
    }

    /**
     * Set impacto
     *
     * @param integer $impacto
     *
     * @return FtSeguimientoRiesgo
     */
    public function setImpacto($impacto)
    {
        $this->impacto = $impacto;

        return $this;
    }

    /**
     * Get impacto
     *
     * @return integer
     */
    public function getImpacto()
    {
        return $this->impacto;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeguimientoRiesgo
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSeguimientoRiesgo
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSeguimientoRiesgo
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
     * @return FtSeguimientoRiesgo
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
     * Set ftRiesgosProceso
     *
     * @param integer $ftRiesgosProceso
     *
     * @return FtSeguimientoRiesgo
     */
    public function setFtRiesgosProceso($ftRiesgosProceso)
    {
        $this->ftRiesgosProceso = $ftRiesgosProceso;

        return $this;
    }

    /**
     * Get ftRiesgosProceso
     *
     * @return integer
     */
    public function getFtRiesgosProceso()
    {
        return $this->ftRiesgosProceso;
    }

    /**
     * Set fechaSeguimiento
     *
     * @param \DateTime $fechaSeguimiento
     *
     * @return FtSeguimientoRiesgo
     */
    public function setFechaSeguimiento($fechaSeguimiento)
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    /**
     * Get fechaSeguimiento
     *
     * @return \DateTime
     */
    public function getFechaSeguimiento()
    {
        return $this->fechaSeguimiento;
    }

    /**
     * Set accionVinculacion
     *
     * @param string $accionVinculacion
     *
     * @return FtSeguimientoRiesgo
     */
    public function setAccionVinculacion($accionVinculacion)
    {
        $this->accionVinculacion = $accionVinculacion;

        return $this;
    }

    /**
     * Get accionVinculacion
     *
     * @return string
     */
    public function getAccionVinculacion()
    {
        return $this->accionVinculacion;
    }

    /**
     * Set logro
     *
     * @param string $logro
     *
     * @return FtSeguimientoRiesgo
     */
    public function setLogro($logro)
    {
        $this->logro = $logro;

        return $this;
    }

    /**
     * Get logro
     *
     * @return string
     */
    public function getLogro()
    {
        return $this->logro;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSeguimientoRiesgo
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set evidenciaDocumental
     *
     * @param string $evidenciaDocumental
     *
     * @return FtSeguimientoRiesgo
     */
    public function setEvidenciaDocumental($evidenciaDocumental)
    {
        $this->evidenciaDocumental = $evidenciaDocumental;

        return $this;
    }

    /**
     * Get evidenciaDocumental
     *
     * @return string
     */
    public function getEvidenciaDocumental()
    {
        return $this->evidenciaDocumental;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSeguimientoRiesgo
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
     * @return FtSeguimientoRiesgo
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
