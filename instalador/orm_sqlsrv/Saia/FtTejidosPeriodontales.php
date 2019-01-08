<?php

namespace Saia;

/**
 * FtTejidosPeriodontales
 */
class FtTejidosPeriodontales
{
    /**
     * @var integer
     */
    private $idftTejidosPeriodontales;

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
     * @var string
     */
    private $cajaUno;

    /**
     * @var string
     */
    private $cajaDos;

    /**
     * @var string
     */
    private $cajaTres;

    /**
     * @var string
     */
    private $cajaCuatro;

    /**
     * @var integer
     */
    private $ftSolicitudCita;

    /**
     * @var integer
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var \DateTime
     */
    private $fechaPeriodontal;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftTejidosPeriodontales
     *
     * @return integer
     */
    public function getIdftTejidosPeriodontales()
    {
        return $this->idftTejidosPeriodontales;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtTejidosPeriodontales
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
     * @return FtTejidosPeriodontales
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
     * @return FtTejidosPeriodontales
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
     * @return FtTejidosPeriodontales
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
     * @return FtTejidosPeriodontales
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
     * Set cajaUno
     *
     * @param string $cajaUno
     *
     * @return FtTejidosPeriodontales
     */
    public function setCajaUno($cajaUno)
    {
        $this->cajaUno = $cajaUno;

        return $this;
    }

    /**
     * Get cajaUno
     *
     * @return string
     */
    public function getCajaUno()
    {
        return $this->cajaUno;
    }

    /**
     * Set cajaDos
     *
     * @param string $cajaDos
     *
     * @return FtTejidosPeriodontales
     */
    public function setCajaDos($cajaDos)
    {
        $this->cajaDos = $cajaDos;

        return $this;
    }

    /**
     * Get cajaDos
     *
     * @return string
     */
    public function getCajaDos()
    {
        return $this->cajaDos;
    }

    /**
     * Set cajaTres
     *
     * @param string $cajaTres
     *
     * @return FtTejidosPeriodontales
     */
    public function setCajaTres($cajaTres)
    {
        $this->cajaTres = $cajaTres;

        return $this;
    }

    /**
     * Get cajaTres
     *
     * @return string
     */
    public function getCajaTres()
    {
        return $this->cajaTres;
    }

    /**
     * Set cajaCuatro
     *
     * @param string $cajaCuatro
     *
     * @return FtTejidosPeriodontales
     */
    public function setCajaCuatro($cajaCuatro)
    {
        $this->cajaCuatro = $cajaCuatro;

        return $this;
    }

    /**
     * Get cajaCuatro
     *
     * @return string
     */
    public function getCajaCuatro()
    {
        return $this->cajaCuatro;
    }

    /**
     * Set ftSolicitudCita
     *
     * @param integer $ftSolicitudCita
     *
     * @return FtTejidosPeriodontales
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
     * Set ftClinicaOrtodoncia
     *
     * @param integer $ftClinicaOrtodoncia
     *
     * @return FtTejidosPeriodontales
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
     * Set fechaPeriodontal
     *
     * @param \DateTime $fechaPeriodontal
     *
     * @return FtTejidosPeriodontales
     */
    public function setFechaPeriodontal($fechaPeriodontal)
    {
        $this->fechaPeriodontal = $fechaPeriodontal;

        return $this;
    }

    /**
     * Get fechaPeriodontal
     *
     * @return \DateTime
     */
    public function getFechaPeriodontal()
    {
        return $this->fechaPeriodontal;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtTejidosPeriodontales
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

