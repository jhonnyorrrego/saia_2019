<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtControlCita
 *
 * @ORM\Table(name="ft_control_cita", indexes={@ORM\Index(name="i_ft_control_cita_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtControlCita
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_control_cita", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftControlCita;

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
    private $serieIdserie = '1011';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_control_cita", type="text", length=65535, nullable=true)
     */
    private $descripcionControlCita;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_control_cita", type="integer", nullable=true)
     */
    private $estadoControlCita;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_paciente_control", type="string", length=255, nullable=false)
     */
    private $nombrePacienteControl;

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
