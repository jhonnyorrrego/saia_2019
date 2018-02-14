<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudVaciones
 *
 * @ORM\Table(name="ft_solicitud_vaciones")
 * @ORM\Entity
 */
class FtSolicitudVaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_vaciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudVaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="gestio_humana", type="text", length=65535, nullable=false)
     */
    private $gestioHumana;

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
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin_vaciones", type="date", nullable=false)
     */
    private $fechaFinVaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ini_labores", type="date", nullable=false)
     */
    private $fechaIniLabores;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ini_vacaciones", type="date", nullable=false)
     */
    private $fechaIniVacaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_doc", type="date", nullable=false)
     */
    private $fechaDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSolicitudVaciones
     *
     * @return integer
     */
    public function getIdftSolicitudVaciones()
    {
        return $this->idftSolicitudVaciones;
    }

    /**
     * Set gestioHumana
     *
     * @param string $gestioHumana
     *
     * @return FtSolicitudVaciones
     */
    public function setGestioHumana($gestioHumana)
    {
        $this->gestioHumana = $gestioHumana;

        return $this;
    }

    /**
     * Get gestioHumana
     *
     * @return string
     */
    public function getGestioHumana()
    {
        return $this->gestioHumana;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudVaciones
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
     * @return FtSolicitudVaciones
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
     * @return FtSolicitudVaciones
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSolicitudVaciones
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
     * Set fechaFinVaciones
     *
     * @param \DateTime $fechaFinVaciones
     *
     * @return FtSolicitudVaciones
     */
    public function setFechaFinVaciones($fechaFinVaciones)
    {
        $this->fechaFinVaciones = $fechaFinVaciones;

        return $this;
    }

    /**
     * Get fechaFinVaciones
     *
     * @return \DateTime
     */
    public function getFechaFinVaciones()
    {
        return $this->fechaFinVaciones;
    }

    /**
     * Set fechaIniLabores
     *
     * @param \DateTime $fechaIniLabores
     *
     * @return FtSolicitudVaciones
     */
    public function setFechaIniLabores($fechaIniLabores)
    {
        $this->fechaIniLabores = $fechaIniLabores;

        return $this;
    }

    /**
     * Get fechaIniLabores
     *
     * @return \DateTime
     */
    public function getFechaIniLabores()
    {
        return $this->fechaIniLabores;
    }

    /**
     * Set fechaIniVacaciones
     *
     * @param \DateTime $fechaIniVacaciones
     *
     * @return FtSolicitudVaciones
     */
    public function setFechaIniVacaciones($fechaIniVacaciones)
    {
        $this->fechaIniVacaciones = $fechaIniVacaciones;

        return $this;
    }

    /**
     * Get fechaIniVacaciones
     *
     * @return \DateTime
     */
    public function getFechaIniVacaciones()
    {
        return $this->fechaIniVacaciones;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudVaciones
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
     * Set fechaDoc
     *
     * @param \DateTime $fechaDoc
     *
     * @return FtSolicitudVaciones
     */
    public function setFechaDoc($fechaDoc)
    {
        $this->fechaDoc = $fechaDoc;

        return $this;
    }

    /**
     * Get fechaDoc
     *
     * @return \DateTime
     */
    public function getFechaDoc()
    {
        return $this->fechaDoc;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolicitudVaciones
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
