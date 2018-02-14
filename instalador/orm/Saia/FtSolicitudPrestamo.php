<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPrestamo
 *
 * @ORM\Table(name="ft_solicitud_prestamo")
 * @ORM\Entity
 */
class FtSolicitudPrestamo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_prestamo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPrestamo;

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
    private $serieIdserie = '1319';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_devolucion", type="integer", nullable=true)
     */
    private $estadoDevolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_archivo", type="integer", nullable=false)
     */
    private $documentoArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_solicita", type="string", length=255, nullable=true)
     */
    private $nombreSolicita;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_prestamo", type="string", length=255, nullable=true)
     */
    private $funcionarioPrestamo;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_devoluci", type="string", length=255, nullable=true)
     */
    private $funcionarioDevoluci;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_prestamo_rep", type="datetime", nullable=true)
     */
    private $fechaPrestamoRep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolucion_rep", type="datetime", nullable=true)
     */
    private $fechaDevolucionRep;



    /**
     * Get idftSolicitudPrestamo
     *
     * @return integer
     */
    public function getIdftSolicitudPrestamo()
    {
        return $this->idftSolicitudPrestamo;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtSolicitudPrestamo
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
     * @return FtSolicitudPrestamo
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
     * @return FtSolicitudPrestamo
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
     * @return FtSolicitudPrestamo
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
     * @return FtSolicitudPrestamo
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
     * @return FtSolicitudPrestamo
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtSolicitudPrestamo
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set estadoDevolucion
     *
     * @param integer $estadoDevolucion
     *
     * @return FtSolicitudPrestamo
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
     * Set documentoArchivo
     *
     * @param integer $documentoArchivo
     *
     * @return FtSolicitudPrestamo
     */
    public function setDocumentoArchivo($documentoArchivo)
    {
        $this->documentoArchivo = $documentoArchivo;

        return $this;
    }

    /**
     * Get documentoArchivo
     *
     * @return integer
     */
    public function getDocumentoArchivo()
    {
        return $this->documentoArchivo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSolicitudPrestamo
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
     * Set nombreSolicita
     *
     * @param string $nombreSolicita
     *
     * @return FtSolicitudPrestamo
     */
    public function setNombreSolicita($nombreSolicita)
    {
        $this->nombreSolicita = $nombreSolicita;

        return $this;
    }

    /**
     * Get nombreSolicita
     *
     * @return string
     */
    public function getNombreSolicita()
    {
        return $this->nombreSolicita;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtSolicitudPrestamo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set funcionarioPrestamo
     *
     * @param string $funcionarioPrestamo
     *
     * @return FtSolicitudPrestamo
     */
    public function setFuncionarioPrestamo($funcionarioPrestamo)
    {
        $this->funcionarioPrestamo = $funcionarioPrestamo;

        return $this;
    }

    /**
     * Get funcionarioPrestamo
     *
     * @return string
     */
    public function getFuncionarioPrestamo()
    {
        return $this->funcionarioPrestamo;
    }

    /**
     * Set funcionarioDevoluci
     *
     * @param string $funcionarioDevoluci
     *
     * @return FtSolicitudPrestamo
     */
    public function setFuncionarioDevoluci($funcionarioDevoluci)
    {
        $this->funcionarioDevoluci = $funcionarioDevoluci;

        return $this;
    }

    /**
     * Get funcionarioDevoluci
     *
     * @return string
     */
    public function getFuncionarioDevoluci()
    {
        return $this->funcionarioDevoluci;
    }

    /**
     * Set fechaPrestamoRep
     *
     * @param \DateTime $fechaPrestamoRep
     *
     * @return FtSolicitudPrestamo
     */
    public function setFechaPrestamoRep($fechaPrestamoRep)
    {
        $this->fechaPrestamoRep = $fechaPrestamoRep;

        return $this;
    }

    /**
     * Get fechaPrestamoRep
     *
     * @return \DateTime
     */
    public function getFechaPrestamoRep()
    {
        return $this->fechaPrestamoRep;
    }

    /**
     * Set fechaDevolucionRep
     *
     * @param \DateTime $fechaDevolucionRep
     *
     * @return FtSolicitudPrestamo
     */
    public function setFechaDevolucionRep($fechaDevolucionRep)
    {
        $this->fechaDevolucionRep = $fechaDevolucionRep;

        return $this;
    }

    /**
     * Get fechaDevolucionRep
     *
     * @return \DateTime
     */
    public function getFechaDevolucionRep()
    {
        return $this->fechaDevolucionRep;
    }
}
