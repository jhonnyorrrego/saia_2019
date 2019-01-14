<?php

namespace Saia;

/**
 * FtControlCita
 */
class FtControlCita
{
    /**
     * @var integer
     */
    private $idftControlCita;

    /**
     * @var integer
     */
    private $ftSolicitudCita;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $descripcionControlCita;

    /**
     * @var integer
     */
    private $estadoControlCita;

    /**
     * @var string
     */
    private $nombrePacienteControl;

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
     * Get idftControlCita
     *
     * @return integer
     */
    public function getIdftControlCita()
    {
        return $this->idftControlCita;
    }

    /**
     * Set ftSolicitudCita
     *
     * @param integer $ftSolicitudCita
     *
     * @return FtControlCita
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
     * @return FtControlCita
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
     * Set descripcionControlCita
     *
     * @param string $descripcionControlCita
     *
     * @return FtControlCita
     */
    public function setDescripcionControlCita($descripcionControlCita)
    {
        $this->descripcionControlCita = $descripcionControlCita;

        return $this;
    }

    /**
     * Get descripcionControlCita
     *
     * @return string
     */
    public function getDescripcionControlCita()
    {
        return $this->descripcionControlCita;
    }

    /**
     * Set estadoControlCita
     *
     * @param integer $estadoControlCita
     *
     * @return FtControlCita
     */
    public function setEstadoControlCita($estadoControlCita)
    {
        $this->estadoControlCita = $estadoControlCita;

        return $this;
    }

    /**
     * Get estadoControlCita
     *
     * @return integer
     */
    public function getEstadoControlCita()
    {
        return $this->estadoControlCita;
    }

    /**
     * Set nombrePacienteControl
     *
     * @param string $nombrePacienteControl
     *
     * @return FtControlCita
     */
    public function setNombrePacienteControl($nombrePacienteControl)
    {
        $this->nombrePacienteControl = $nombrePacienteControl;

        return $this;
    }

    /**
     * Get nombrePacienteControl
     *
     * @return string
     */
    public function getNombrePacienteControl()
    {
        return $this->nombrePacienteControl;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtControlCita
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
     * @return FtControlCita
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
     * @return FtControlCita
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
     * @return FtControlCita
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
     * @return FtControlCita
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

