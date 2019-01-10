<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntregaPrestamo
 *
 * @ORM\Table(name="ft_entrega_prestamo", indexes={@ORM\Index(name="i_ft_entrega_prestamo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_entrega_prestamo_solicitud_", columns={"ft_solicitud_prestamo"}), @ORM\Index(name="i_entrega_prestamo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtEntregaPrestamo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_entrega_prestamo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEntregaPrestamo;

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
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1320';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_prestamo", type="integer", nullable=false)
     */
    private $ftSolicitudPrestamo;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_devolucion", type="string", length=255, nullable=true)
     */
    private $usuarioDevolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_devolu", type="string", length=255, nullable=true)
     */
    private $observacionesDevolu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolucion", type="datetime", nullable=true)
     */
    private $fechaDevolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_devolucion", type="integer", nullable=false)
     */
    private $estadoDevolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_folios", type="integer", nullable=false)
     */
    private $numeroFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="no_caja", type="string", length=255, nullable=true)
     */
    private $noCaja;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_expediente", type="string", length=255, nullable=true)
     */
    private $numeroExpediente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="datetime", nullable=false)
     */
    private $fechaEntrega;



    /**
     * Get idftEntregaPrestamo
     *
     * @return integer
     */
    public function getIdftEntregaPrestamo()
    {
        return $this->idftEntregaPrestamo;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtEntregaPrestamo
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
     * @return FtEntregaPrestamo
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
     * @return FtEntregaPrestamo
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtEntregaPrestamo
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtEntregaPrestamo
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtEntregaPrestamo
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set ftSolicitudPrestamo
     *
     * @param integer $ftSolicitudPrestamo
     *
     * @return FtEntregaPrestamo
     */
    public function setFtSolicitudPrestamo($ftSolicitudPrestamo)
    {
        $this->ftSolicitudPrestamo = $ftSolicitudPrestamo;

        return $this;
    }

    /**
     * Get ftSolicitudPrestamo
     *
     * @return integer
     */
    public function getFtSolicitudPrestamo()
    {
        return $this->ftSolicitudPrestamo;
    }

    /**
     * Set usuarioDevolucion
     *
     * @param string $usuarioDevolucion
     *
     * @return FtEntregaPrestamo
     */
    public function setUsuarioDevolucion($usuarioDevolucion)
    {
        $this->usuarioDevolucion = $usuarioDevolucion;

        return $this;
    }

    /**
     * Get usuarioDevolucion
     *
     * @return string
     */
    public function getUsuarioDevolucion()
    {
        return $this->usuarioDevolucion;
    }

    /**
     * Set observacionesDevolu
     *
     * @param string $observacionesDevolu
     *
     * @return FtEntregaPrestamo
     */
    public function setObservacionesDevolu($observacionesDevolu)
    {
        $this->observacionesDevolu = $observacionesDevolu;

        return $this;
    }

    /**
     * Get observacionesDevolu
     *
     * @return string
     */
    public function getObservacionesDevolu()
    {
        return $this->observacionesDevolu;
    }

    /**
     * Set fechaDevolucion
     *
     * @param \DateTime $fechaDevolucion
     *
     * @return FtEntregaPrestamo
     */
    public function setFechaDevolucion($fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;

        return $this;
    }

    /**
     * Get fechaDevolucion
     *
     * @return \DateTime
     */
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    /**
     * Set estadoDevolucion
     *
     * @param integer $estadoDevolucion
     *
     * @return FtEntregaPrestamo
     */
    public function setEstadoDevolucion($estadoDevolucion)
    {
        $this->estadoDevolucion = $estadoDevolucion;

        return $this;
    }

    /**
     * Get estadoDevolucion
     *
     * @return integer
     */
    public function getEstadoDevolucion()
    {
        return $this->estadoDevolucion;
    }

    /**
     * Set numeroFolios
     *
     * @param integer $numeroFolios
     *
     * @return FtEntregaPrestamo
     */
    public function setNumeroFolios($numeroFolios)
    {
        $this->numeroFolios = $numeroFolios;

        return $this;
    }

    /**
     * Get numeroFolios
     *
     * @return integer
     */
    public function getNumeroFolios()
    {
        return $this->numeroFolios;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtEntregaPrestamo
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
     * Set noCaja
     *
     * @param string $noCaja
     *
     * @return FtEntregaPrestamo
     */
    public function setNoCaja($noCaja)
    {
        $this->noCaja = $noCaja;

        return $this;
    }

    /**
     * Get noCaja
     *
     * @return string
     */
    public function getNoCaja()
    {
        return $this->noCaja;
    }

    /**
     * Set numeroExpediente
     *
     * @param string $numeroExpediente
     *
     * @return FtEntregaPrestamo
     */
    public function setNumeroExpediente($numeroExpediente)
    {
        $this->numeroExpediente = $numeroExpediente;

        return $this;
    }

    /**
     * Get numeroExpediente
     *
     * @return string
     */
    public function getNumeroExpediente()
    {
        return $this->numeroExpediente;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return FtEntregaPrestamo
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }
}
