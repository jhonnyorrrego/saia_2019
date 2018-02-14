<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudCita
 *
 * @ORM\Table(name="ft_solicitud_cita")
 * @ORM\Entity
 */
class FtSolicitudCita
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_cita", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudCita;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clinica_ortodoncia", type="integer", nullable=false)
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1010';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_paciente", type="string", length=255, nullable=false)
     */
    private $nombrePaciente;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_consulta", type="integer", nullable=false)
     */
    private $motivoConsulta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_cita", type="text", length=65535, nullable=true)
     */
    private $descripcionCita;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_cita", type="datetime", nullable=false)
     */
    private $fechaHoraCita;

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
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSolicitudCita
     *
     * @return integer
     */
    public function getIdftSolicitudCita()
    {
        return $this->idftSolicitudCita;
    }

    /**
     * Set ftClinicaOrtodoncia
     *
     * @param integer $ftClinicaOrtodoncia
     *
     * @return FtSolicitudCita
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudCita
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
     * Set nombrePaciente
     *
     * @param string $nombrePaciente
     *
     * @return FtSolicitudCita
     */
    public function setNombrePaciente($nombrePaciente)
    {
        $this->nombrePaciente = $nombrePaciente;

        return $this;
    }

    /**
     * Get nombrePaciente
     *
     * @return string
     */
    public function getNombrePaciente()
    {
        return $this->nombrePaciente;
    }

    /**
     * Set motivoConsulta
     *
     * @param integer $motivoConsulta
     *
     * @return FtSolicitudCita
     */
    public function setMotivoConsulta($motivoConsulta)
    {
        $this->motivoConsulta = $motivoConsulta;

        return $this;
    }

    /**
     * Get motivoConsulta
     *
     * @return integer
     */
    public function getMotivoConsulta()
    {
        return $this->motivoConsulta;
    }

    /**
     * Set descripcionCita
     *
     * @param string $descripcionCita
     *
     * @return FtSolicitudCita
     */
    public function setDescripcionCita($descripcionCita)
    {
        $this->descripcionCita = $descripcionCita;

        return $this;
    }

    /**
     * Get descripcionCita
     *
     * @return string
     */
    public function getDescripcionCita()
    {
        return $this->descripcionCita;
    }

    /**
     * Set fechaHoraCita
     *
     * @param \DateTime $fechaHoraCita
     *
     * @return FtSolicitudCita
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudCita
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
     * @return FtSolicitudCita
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
     * @return FtSolicitudCita
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
     * @return FtSolicitudCita
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
     * @return FtSolicitudCita
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
