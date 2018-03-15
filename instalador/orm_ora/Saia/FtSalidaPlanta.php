<?php

namespace Saia;

/**
 * FtSalidaPlanta
 */
class FtSalidaPlanta
{
    /**
     * @var integer
     */
    private $idftSalidaPlanta;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $controlInterno;

    /**
     * @var \DateTime
     */
    private $fechaControl;

    /**
     * @var string
     */
    private $turnoDatos;

    /**
     * @var \DateTime
     */
    private $fechaSalida;

    /**
     * @var \DateTime
     */
    private $horaSalida;

    /**
     * @var \DateTime
     */
    private $fechaEntrada;

    /**
     * @var \DateTime
     */
    private $horaEntrada;

    /**
     * @var string
     */
    private $motivoSalida;

    /**
     * @var string
     */
    private $motivoPermiso;

    /**
     * @var string
     */
    private $observaciones;

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
     * Get idftSalidaPlanta
     *
     * @return integer
     */
    public function getIdftSalidaPlanta()
    {
        return $this->idftSalidaPlanta;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSalidaPlanta
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
     * Set controlInterno
     *
     * @param string $controlInterno
     *
     * @return FtSalidaPlanta
     */
    public function setControlInterno($controlInterno)
    {
        $this->controlInterno = $controlInterno;

        return $this;
    }

    /**
     * Get controlInterno
     *
     * @return string
     */
    public function getControlInterno()
    {
        return $this->controlInterno;
    }

    /**
     * Set fechaControl
     *
     * @param \DateTime $fechaControl
     *
     * @return FtSalidaPlanta
     */
    public function setFechaControl($fechaControl)
    {
        $this->fechaControl = $fechaControl;

        return $this;
    }

    /**
     * Get fechaControl
     *
     * @return \DateTime
     */
    public function getFechaControl()
    {
        return $this->fechaControl;
    }

    /**
     * Set turnoDatos
     *
     * @param string $turnoDatos
     *
     * @return FtSalidaPlanta
     */
    public function setTurnoDatos($turnoDatos)
    {
        $this->turnoDatos = $turnoDatos;

        return $this;
    }

    /**
     * Get turnoDatos
     *
     * @return string
     */
    public function getTurnoDatos()
    {
        return $this->turnoDatos;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     *
     * @return FtSalidaPlanta
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set horaSalida
     *
     * @param \DateTime $horaSalida
     *
     * @return FtSalidaPlanta
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    /**
     * Get horaSalida
     *
     * @return \DateTime
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * Set fechaEntrada
     *
     * @param \DateTime $fechaEntrada
     *
     * @return FtSalidaPlanta
     */
    public function setFechaEntrada($fechaEntrada)
    {
        $this->fechaEntrada = $fechaEntrada;

        return $this;
    }

    /**
     * Get fechaEntrada
     *
     * @return \DateTime
     */
    public function getFechaEntrada()
    {
        return $this->fechaEntrada;
    }

    /**
     * Set horaEntrada
     *
     * @param \DateTime $horaEntrada
     *
     * @return FtSalidaPlanta
     */
    public function setHoraEntrada($horaEntrada)
    {
        $this->horaEntrada = $horaEntrada;

        return $this;
    }

    /**
     * Get horaEntrada
     *
     * @return \DateTime
     */
    public function getHoraEntrada()
    {
        return $this->horaEntrada;
    }

    /**
     * Set motivoSalida
     *
     * @param string $motivoSalida
     *
     * @return FtSalidaPlanta
     */
    public function setMotivoSalida($motivoSalida)
    {
        $this->motivoSalida = $motivoSalida;

        return $this;
    }

    /**
     * Get motivoSalida
     *
     * @return string
     */
    public function getMotivoSalida()
    {
        return $this->motivoSalida;
    }

    /**
     * Set motivoPermiso
     *
     * @param string $motivoPermiso
     *
     * @return FtSalidaPlanta
     */
    public function setMotivoPermiso($motivoPermiso)
    {
        $this->motivoPermiso = $motivoPermiso;

        return $this;
    }

    /**
     * Get motivoPermiso
     *
     * @return string
     */
    public function getMotivoPermiso()
    {
        return $this->motivoPermiso;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSalidaPlanta
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSalidaPlanta
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
     * @return FtSalidaPlanta
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
     * @return FtSalidaPlanta
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
     * @return FtSalidaPlanta
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
     * @return FtSalidaPlanta
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

