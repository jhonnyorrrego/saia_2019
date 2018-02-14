<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReservarDocumento
 *
 * @ORM\Table(name="ft_reservar_documento")
 * @ORM\Entity
 */
class FtReservarDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_reservar_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftReservarDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1108';

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="desde", type="datetime", nullable=false)
     */
    private $desde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hasta", type="datetime", nullable=false)
     */
    private $hasta;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitar_a", type="integer", nullable=false)
     */
    private $solicitarA;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="doc_relacionado", type="integer", nullable=true)
     */
    private $docRelacionado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="datetime", nullable=true)
     */
    private $fechaEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_entrega", type="integer", nullable=true)
     */
    private $usuarioEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_entrega", type="string", length=255, nullable=true)
     */
    private $observacionEntrega;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolver", type="datetime", nullable=true)
     */
    private $fechaDevolver;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario_devolver", type="integer", nullable=true)
     */
    private $usuarioDevolver;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_devolver", type="string", length=255, nullable=true)
     */
    private $observacionDevolver;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_doc", type="integer", nullable=true)
     */
    private $estadoDoc = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftReservarDocumento
     *
     * @return integer
     */
    public function getIdftReservarDocumento()
    {
        return $this->idftReservarDocumento;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReservarDocumento
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
     * @return FtReservarDocumento
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
     * @return FtReservarDocumento
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
     * @return FtReservarDocumento
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
     * @return FtReservarDocumento
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
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     *
     * @return FtReservarDocumento
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set desde
     *
     * @param \DateTime $desde
     *
     * @return FtReservarDocumento
     */
    public function setDesde($desde)
    {
        $this->desde = $desde;

        return $this;
    }

    /**
     * Get desde
     *
     * @return \DateTime
     */
    public function getDesde()
    {
        return $this->desde;
    }

    /**
     * Set hasta
     *
     * @param \DateTime $hasta
     *
     * @return FtReservarDocumento
     */
    public function setHasta($hasta)
    {
        $this->hasta = $hasta;

        return $this;
    }

    /**
     * Get hasta
     *
     * @return \DateTime
     */
    public function getHasta()
    {
        return $this->hasta;
    }

    /**
     * Set solicitarA
     *
     * @param integer $solicitarA
     *
     * @return FtReservarDocumento
     */
    public function setSolicitarA($solicitarA)
    {
        $this->solicitarA = $solicitarA;

        return $this;
    }

    /**
     * Get solicitarA
     *
     * @return integer
     */
    public function getSolicitarA()
    {
        return $this->solicitarA;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtReservarDocumento
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
     * Set docRelacionado
     *
     * @param integer $docRelacionado
     *
     * @return FtReservarDocumento
     */
    public function setDocRelacionado($docRelacionado)
    {
        $this->docRelacionado = $docRelacionado;

        return $this;
    }

    /**
     * Get docRelacionado
     *
     * @return integer
     */
    public function getDocRelacionado()
    {
        return $this->docRelacionado;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return FtReservarDocumento
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

    /**
     * Set usuarioEntrega
     *
     * @param integer $usuarioEntrega
     *
     * @return FtReservarDocumento
     */
    public function setUsuarioEntrega($usuarioEntrega)
    {
        $this->usuarioEntrega = $usuarioEntrega;

        return $this;
    }

    /**
     * Get usuarioEntrega
     *
     * @return integer
     */
    public function getUsuarioEntrega()
    {
        return $this->usuarioEntrega;
    }

    /**
     * Set observacionEntrega
     *
     * @param string $observacionEntrega
     *
     * @return FtReservarDocumento
     */
    public function setObservacionEntrega($observacionEntrega)
    {
        $this->observacionEntrega = $observacionEntrega;

        return $this;
    }

    /**
     * Get observacionEntrega
     *
     * @return string
     */
    public function getObservacionEntrega()
    {
        return $this->observacionEntrega;
    }

    /**
     * Set fechaDevolver
     *
     * @param \DateTime $fechaDevolver
     *
     * @return FtReservarDocumento
     */
    public function setFechaDevolver($fechaDevolver)
    {
        $this->fechaDevolver = $fechaDevolver;

        return $this;
    }

    /**
     * Get fechaDevolver
     *
     * @return \DateTime
     */
    public function getFechaDevolver()
    {
        return $this->fechaDevolver;
    }

    /**
     * Set usuarioDevolver
     *
     * @param integer $usuarioDevolver
     *
     * @return FtReservarDocumento
     */
    public function setUsuarioDevolver($usuarioDevolver)
    {
        $this->usuarioDevolver = $usuarioDevolver;

        return $this;
    }

    /**
     * Get usuarioDevolver
     *
     * @return integer
     */
    public function getUsuarioDevolver()
    {
        return $this->usuarioDevolver;
    }

    /**
     * Set observacionDevolver
     *
     * @param string $observacionDevolver
     *
     * @return FtReservarDocumento
     */
    public function setObservacionDevolver($observacionDevolver)
    {
        $this->observacionDevolver = $observacionDevolver;

        return $this;
    }

    /**
     * Get observacionDevolver
     *
     * @return string
     */
    public function getObservacionDevolver()
    {
        return $this->observacionDevolver;
    }

    /**
     * Set estadoDoc
     *
     * @param integer $estadoDoc
     *
     * @return FtReservarDocumento
     */
    public function setEstadoDoc($estadoDoc)
    {
        $this->estadoDoc = $estadoDoc;

        return $this;
    }

    /**
     * Get estadoDoc
     *
     * @return integer
     */
    public function getEstadoDoc()
    {
        return $this->estadoDoc;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtReservarDocumento
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
