<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTejidosPeriodontales
 *
 * @ORM\Table(name="ft_tejidos_periodontales", indexes={@ORM\Index(name="i_tejidos_periodontal_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_tejidos_periodontal_clinica_or", columns={"ft_clinica_ortodoncia"}), @ORM\Index(name="i_tejidos_periodontal_solicitud_", columns={"ft_solicitud_cita"}), @ORM\Index(name="i_tejidos_periodontal_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtTejidosPeriodontales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_tejidos_periodontales", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftTejidosPeriodontales;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1009';

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
     * @var string
     *
     * @ORM\Column(name="caja_uno", type="string", length=255, nullable=true)
     */
    private $cajaUno;

    /**
     * @var string
     *
     * @ORM\Column(name="caja_dos", type="string", length=255, nullable=true)
     */
    private $cajaDos;

    /**
     * @var string
     *
     * @ORM\Column(name="caja_tres", type="string", length=255, nullable=true)
     */
    private $cajaTres;

    /**
     * @var string
     *
     * @ORM\Column(name="caja_cuatro", type="string", length=255, nullable=true)
     */
    private $cajaCuatro;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_cita", type="integer", nullable=false)
     */
    private $ftSolicitudCita;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clinica_ortodoncia", type="integer", nullable=false)
     */
    private $ftClinicaOrtodoncia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_periodontal", type="date", nullable=false)
     */
    private $fechaPeriodontal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
