<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSalidaPlanta
 *
 * @ORM\Table(name="ft_salida_planta")
 * @ORM\Entity
 */
class FtSalidaPlanta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_salida_planta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftSalidaPlanta;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1183';

    /**
     * @var string
     *
     * @ORM\Column(name="control_interno", type="string", length=255, nullable=true)
     */
    private $controlInterno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_control", type="datetime", nullable=true)
     */
    private $fechaControl;

    /**
     * @var string
     *
     * @ORM\Column(name="turno_datos", type="string", length=255, nullable=true)
     */
    private $turnoDatos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="date", nullable=true)
     */
    private $fechaSalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_salida", type="time", nullable=false)
     */
    private $horaSalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrada", type="date", nullable=false)
     */
    private $fechaEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_entrada", type="time", nullable=false)
     */
    private $horaEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_salida", type="string", length=255, nullable=false)
     */
    private $motivoSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_permiso", type="string", length=255, nullable=true)
     */
    private $motivoPermiso;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

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
