<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAccionesRiesgo
 *
 * @ORM\Table(name="ft_acciones_riesgo", indexes={@ORM\Index(name="i_ft_acciones_riesgo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_acciones_riesgo_riesgos_pr", columns={"ft_riesgos_proceso"}), @ORM\Index(name="i_acciones_riesgo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtAccionesRiesgo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_acciones_riesgo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAccionesRiesgo;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_control", type="string", length=255, nullable=false)
     */
    private $accionesControl;

    /**
     * @var string
     *
     * @ORM\Column(name="reponsables", type="string", length=255, nullable=false)
     */
    private $reponsables;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_accion", type="text", length=65535, nullable=false)
     */
    private $accionesAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="opcio_admin_riesgo", type="string", length=10, nullable=false)
     */
    private $opcioAdminRiesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="indicador", type="text", length=65535, nullable=false)
     */
    private $indicador;

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
     * @ORM\Column(name="ft_riesgos_proceso", type="integer", nullable=false)
     */
    private $ftRiesgosProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '3018';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_accion", type="date", nullable=false)
     */
    private $fechaAccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cumplimiento", type="date", nullable=false)
     */
    private $fechaCumplimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAccionesRiesgo
     *
     * @return integer
     */
    public function getIdftAccionesRiesgo()
    {
        return $this->idftAccionesRiesgo;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtAccionesRiesgo
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
     * Set accionesControl
     *
     * @param string $accionesControl
     *
     * @return FtAccionesRiesgo
     */
    public function setAccionesControl($accionesControl)
    {
        $this->accionesControl = $accionesControl;

        return $this;
    }

    /**
     * Get accionesControl
     *
     * @return string
     */
    public function getAccionesControl()
    {
        return $this->accionesControl;
    }

    /**
     * Set reponsables
     *
     * @param string $reponsables
     *
     * @return FtAccionesRiesgo
     */
    public function setReponsables($reponsables)
    {
        $this->reponsables = $reponsables;

        return $this;
    }

    /**
     * Get reponsables
     *
     * @return string
     */
    public function getReponsables()
    {
        return $this->reponsables;
    }

    /**
     * Set accionesAccion
     *
     * @param string $accionesAccion
     *
     * @return FtAccionesRiesgo
     */
    public function setAccionesAccion($accionesAccion)
    {
        $this->accionesAccion = $accionesAccion;

        return $this;
    }

    /**
     * Get accionesAccion
     *
     * @return string
     */
    public function getAccionesAccion()
    {
        return $this->accionesAccion;
    }

    /**
     * Set opcioAdminRiesgo
     *
     * @param string $opcioAdminRiesgo
     *
     * @return FtAccionesRiesgo
     */
    public function setOpcioAdminRiesgo($opcioAdminRiesgo)
    {
        $this->opcioAdminRiesgo = $opcioAdminRiesgo;

        return $this;
    }

    /**
     * Get opcioAdminRiesgo
     *
     * @return string
     */
    public function getOpcioAdminRiesgo()
    {
        return $this->opcioAdminRiesgo;
    }

    /**
     * Set indicador
     *
     * @param string $indicador
     *
     * @return FtAccionesRiesgo
     */
    public function setIndicador($indicador)
    {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return string
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAccionesRiesgo
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
     * @return FtAccionesRiesgo
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
     * Set ftRiesgosProceso
     *
     * @param integer $ftRiesgosProceso
     *
     * @return FtAccionesRiesgo
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAccionesRiesgo
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtAccionesRiesgo
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
     * Set fechaAccion
     *
     * @param \DateTime $fechaAccion
     *
     * @return FtAccionesRiesgo
     */
    public function setFechaAccion($fechaAccion)
    {
        $this->fechaAccion = $fechaAccion;

        return $this;
    }

    /**
     * Get fechaAccion
     *
     * @return \DateTime
     */
    public function getFechaAccion()
    {
        return $this->fechaAccion;
    }

    /**
     * Set fechaCumplimiento
     *
     * @param \DateTime $fechaCumplimiento
     *
     * @return FtAccionesRiesgo
     */
    public function setFechaCumplimiento($fechaCumplimiento)
    {
        $this->fechaCumplimiento = $fechaCumplimiento;

        return $this;
    }

    /**
     * Get fechaCumplimiento
     *
     * @return \DateTime
     */
    public function getFechaCumplimiento()
    {
        return $this->fechaCumplimiento;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAccionesRiesgo
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
