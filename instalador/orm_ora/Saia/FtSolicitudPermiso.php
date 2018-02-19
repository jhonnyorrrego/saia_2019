<?php

namespace Saia;

/**
 * FtSolicitudPermiso
 */
class FtSolicitudPermiso
{
    /**
     * @var integer
     */
    private $idftSolicitudPermiso;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $motivoOtro;

    /**
     * @var integer
     */
    private $motivoPermiso;

    /**
     * @var \DateTime
     */
    private $horaSalida;

    /**
     * @var \DateTime
     */
    private $horaEntrada;

    /**
     * @var \DateTime
     */
    private $fechaHoraCita;

    /**
     * @var string
     */
    private $gestionHumana;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var \DateTime
     */
    private $fechaRadiccionPermiso;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftSolicitudPermiso
     *
     * @return integer
     */
    public function getIdftSolicitudPermiso()
    {
        return $this->idftSolicitudPermiso;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSolicitudPermiso
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSolicitudPermiso
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudPermiso
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
     * Set motivoOtro
     *
     * @param string $motivoOtro
     *
     * @return FtSolicitudPermiso
     */
    public function setMotivoOtro($motivoOtro)
    {
        $this->motivoOtro = $motivoOtro;

        return $this;
    }

    /**
     * Get motivoOtro
     *
     * @return string
     */
    public function getMotivoOtro()
    {
        return $this->motivoOtro;
    }

    /**
     * Set motivoPermiso
     *
     * @param integer $motivoPermiso
     *
     * @return FtSolicitudPermiso
     */
    public function setMotivoPermiso($motivoPermiso)
    {
        $this->motivoPermiso = $motivoPermiso;

        return $this;
    }

    /**
     * Get motivoPermiso
     *
     * @return integer
     */
    public function getMotivoPermiso()
    {
        return $this->motivoPermiso;
    }

    /**
     * Set horaSalida
     *
     * @param \DateTime $horaSalida
     *
     * @return FtSolicitudPermiso
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
     * Set horaEntrada
     *
     * @param \DateTime $horaEntrada
     *
     * @return FtSolicitudPermiso
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
     * Set fechaHoraCita
     *
     * @param \DateTime $fechaHoraCita
     *
     * @return FtSolicitudPermiso
     */
    public function setFechaHoraCita($fechaHoraCita)
    {
        $this->fechaHoraCita = $fechaHoraCita;

        return $this;
    }

    /**
     * Get fechaHoraCita
     *
     * @return \DateTime
     */
    public function getFechaHoraCita()
    {
        return $this->fechaHoraCita;
    }

    /**
     * Set gestionHumana
     *
     * @param string $gestionHumana
     *
     * @return FtSolicitudPermiso
     */
    public function setGestionHumana($gestionHumana)
    {
        $this->gestionHumana = $gestionHumana;

        return $this;
    }

    /**
     * Get gestionHumana
     *
     * @return string
     */
    public function getGestionHumana()
    {
        return $this->gestionHumana;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudPermiso
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
     * @return FtSolicitudPermiso
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
     * Set fechaRadiccionPermiso
     *
     * @param \DateTime $fechaRadiccionPermiso
     *
     * @return FtSolicitudPermiso
     */
    public function setFechaRadiccionPermiso($fechaRadiccionPermiso)
    {
        $this->fechaRadiccionPermiso = $fechaRadiccionPermiso;

        return $this;
    }

    /**
     * Get fechaRadiccionPermiso
     *
     * @return \DateTime
     */
    public function getFechaRadiccionPermiso()
    {
        return $this->fechaRadiccionPermiso;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolicitudPermiso
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

