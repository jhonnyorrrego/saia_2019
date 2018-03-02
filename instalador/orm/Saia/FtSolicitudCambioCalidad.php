<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudCambioCalidad
 *
 * @ORM\Table(name="ft_solicitud_cambio_calidad")
 * @ORM\Entity
 */
class FtSolicitudCambioCalidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_cambio_calidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftSolicitudCambioCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="proceso_macroproceso", type="string", length=5, nullable=true)
     */
    private $procesoMacroproceso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vigencia", type="datetime", nullable=true)
     */
    private $fechaVigencia;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_sgc", type="string", length=200, nullable=false)
     */
    private $firmaSgc;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_solicitud", type="integer", nullable=true)
     */
    private $tipoSolicitud = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="listado_procesos", type="string", length=255, nullable=false)
     */
    private $listadoProcesos;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_calidad", type="string", length=255, nullable=true)
     */
    private $documentoCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="version_original", type="string", length=255, nullable=true)
     */
    private $versionOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="nueva_version", type="string", length=255, nullable=true)
     */
    private $nuevaVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=16777215, nullable=false)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="propuesta", type="text", length=16777215, nullable=false)
     */
    private $propuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2561';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

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
     * Get idftSolicitudCambioCalidad
     *
     * @return integer
     */
    public function getIdftSolicitudCambioCalidad()
    {
        return $this->idftSolicitudCambioCalidad;
    }

    /**
     * Set procesoMacroproceso
     *
     * @param string $procesoMacroproceso
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setProcesoMacroproceso($procesoMacroproceso)
    {
        $this->procesoMacroproceso = $procesoMacroproceso;

        return $this;
    }

    /**
     * Get procesoMacroproceso
     *
     * @return string
     */
    public function getProcesoMacroproceso()
    {
        return $this->procesoMacroproceso;
    }

    /**
     * Set fechaVigencia
     *
     * @param \DateTime $fechaVigencia
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setFechaVigencia($fechaVigencia)
    {
        $this->fechaVigencia = $fechaVigencia;

        return $this;
    }

    /**
     * Get fechaVigencia
     *
     * @return \DateTime
     */
    public function getFechaVigencia()
    {
        return $this->fechaVigencia;
    }

    /**
     * Set firmaSgc
     *
     * @param string $firmaSgc
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setFirmaSgc($firmaSgc)
    {
        $this->firmaSgc = $firmaSgc;

        return $this;
    }

    /**
     * Get firmaSgc
     *
     * @return string
     */
    public function getFirmaSgc()
    {
        return $this->firmaSgc;
    }

    /**
     * Set tipoSolicitud
     *
     * @param integer $tipoSolicitud
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setTipoSolicitud($tipoSolicitud)
    {
        $this->tipoSolicitud = $tipoSolicitud;

        return $this;
    }

    /**
     * Get tipoSolicitud
     *
     * @return integer
     */
    public function getTipoSolicitud()
    {
        return $this->tipoSolicitud;
    }

    /**
     * Set listadoProcesos
     *
     * @param string $listadoProcesos
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setListadoProcesos($listadoProcesos)
    {
        $this->listadoProcesos = $listadoProcesos;

        return $this;
    }

    /**
     * Get listadoProcesos
     *
     * @return string
     */
    public function getListadoProcesos()
    {
        return $this->listadoProcesos;
    }

    /**
     * Set documentoCalidad
     *
     * @param string $documentoCalidad
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setDocumentoCalidad($documentoCalidad)
    {
        $this->documentoCalidad = $documentoCalidad;

        return $this;
    }

    /**
     * Get documentoCalidad
     *
     * @return string
     */
    public function getDocumentoCalidad()
    {
        return $this->documentoCalidad;
    }

    /**
     * Set versionOriginal
     *
     * @param string $versionOriginal
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setVersionOriginal($versionOriginal)
    {
        $this->versionOriginal = $versionOriginal;

        return $this;
    }

    /**
     * Get versionOriginal
     *
     * @return string
     */
    public function getVersionOriginal()
    {
        return $this->versionOriginal;
    }

    /**
     * Set nuevaVersion
     *
     * @param string $nuevaVersion
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setNuevaVersion($nuevaVersion)
    {
        $this->nuevaVersion = $nuevaVersion;

        return $this;
    }

    /**
     * Get nuevaVersion
     *
     * @return string
     */
    public function getNuevaVersion()
    {
        return $this->nuevaVersion;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set propuesta
     *
     * @param string $propuesta
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setPropuesta($propuesta)
    {
        $this->propuesta = $propuesta;

        return $this;
    }

    /**
     * Get propuesta
     *
     * @return string
     */
    public function getPropuesta()
    {
        return $this->propuesta;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtSolicitudCambioCalidad
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudCambioCalidad
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
     * @return FtSolicitudCambioCalidad
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSolicitudCambioCalidad
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSolicitudCambioCalidad
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
     * @return FtSolicitudCambioCalidad
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
}
