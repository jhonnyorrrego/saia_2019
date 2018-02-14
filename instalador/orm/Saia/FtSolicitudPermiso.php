<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPermiso
 *
 * @ORM\Table(name="ft_solicitud_permiso", indexes={@ORM\Index(name="i_solicitud_permiso_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_solicitud_permiso_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtSolicitudPermiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_permiso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_otro", type="text", length=65535, nullable=true)
     */
    private $motivoOtro;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_permiso", type="integer", nullable=true)
     */
    private $motivoPermiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_salida", type="time", nullable=false)
     */
    private $horaSalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_entrada", type="time", nullable=false)
     */
    private $horaEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_cita", type="datetime", nullable=false)
     */
    private $fechaHoraCita;

    /**
     * @var string
     *
     * @ORM\Column(name="gestion_humana", type="text", length=65535, nullable=true)
     */
    private $gestionHumana;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '856';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radiccion_permiso", type="date", nullable=false)
     */
    private $fechaRadiccionPermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
