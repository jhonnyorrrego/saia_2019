<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDistribucionFisica
 *
 * @ORM\Table(name="ft_distribucion_fisica", indexes={@ORM\Index(name="i_ft_distribucion_fisica_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDistribucionFisica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_distribucion_fisica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDistribucionFisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '990';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_documento", type="date", nullable=false)
     */
    private $fechaDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_mensajero", type="string", length=255, nullable=false)
     */
    private $nombreMensajero;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;

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
     * @ORM\Column(name="ft_radicacion_entrada", type="integer", nullable=false)
     */
    private $ftRadicacionEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel_urgencia", type="string", length=10, nullable=false)
     */
    private $nivelUrgencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recibido", type="date", nullable=true)
     */
    private $fechaRecibido;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_recibido", type="string", length=255, nullable=true)
     */
    private $usuarioRecibido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entregado", type="date", nullable=true)
     */
    private $fechaEntregado;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_entregado", type="string", length=255, nullable=true)
     */
    private $usuarioEntregado;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftDistribucionFisica
     *
     * @return integer
     */
    public function getIdftDistribucionFisica()
    {
        return $this->idftDistribucionFisica;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDistribucionFisica
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
     * Set fechaDocumento
     *
     * @param \DateTime $fechaDocumento
     *
     * @return FtDistribucionFisica
     */
    public function setFechaDocumento($fechaDocumento)
    {
        $this->fechaDocumento = $fechaDocumento;

        return $this;
    }

    /**
     * Get fechaDocumento
     *
     * @return \DateTime
     */
    public function getFechaDocumento()
    {
        return $this->fechaDocumento;
    }

    /**
     * Set nombreMensajero
     *
     * @param string $nombreMensajero
     *
     * @return FtDistribucionFisica
     */
    public function setNombreMensajero($nombreMensajero)
    {
        $this->nombreMensajero = $nombreMensajero;

        return $this;
    }

    /**
     * Get nombreMensajero
     *
     * @return string
     */
    public function getNombreMensajero()
    {
        return $this->nombreMensajero;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return FtDistribucionFisica
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtDistribucionFisica
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
     * @return FtDistribucionFisica
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
     * @return FtDistribucionFisica
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
     * @return FtDistribucionFisica
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
     * @return FtDistribucionFisica
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
     * Set ftRadicacionEntrada
     *
     * @param integer $ftRadicacionEntrada
     *
     * @return FtDistribucionFisica
     */
    public function setFtRadicacionEntrada($ftRadicacionEntrada)
    {
        $this->ftRadicacionEntrada = $ftRadicacionEntrada;

        return $this;
    }

    /**
     * Get ftRadicacionEntrada
     *
     * @return integer
     */
    public function getFtRadicacionEntrada()
    {
        return $this->ftRadicacionEntrada;
    }

    /**
     * Set nivelUrgencia
     *
     * @param string $nivelUrgencia
     *
     * @return FtDistribucionFisica
     */
    public function setNivelUrgencia($nivelUrgencia)
    {
        $this->nivelUrgencia = $nivelUrgencia;

        return $this;
    }

    /**
     * Get nivelUrgencia
     *
     * @return string
     */
    public function getNivelUrgencia()
    {
        return $this->nivelUrgencia;
    }

    /**
     * Set fechaRecibido
     *
     * @param \DateTime $fechaRecibido
     *
     * @return FtDistribucionFisica
     */
    public function setFechaRecibido($fechaRecibido)
    {
        $this->fechaRecibido = $fechaRecibido;

        return $this;
    }

    /**
     * Get fechaRecibido
     *
     * @return \DateTime
     */
    public function getFechaRecibido()
    {
        return $this->fechaRecibido;
    }

    /**
     * Set usuarioRecibido
     *
     * @param string $usuarioRecibido
     *
     * @return FtDistribucionFisica
     */
    public function setUsuarioRecibido($usuarioRecibido)
    {
        $this->usuarioRecibido = $usuarioRecibido;

        return $this;
    }

    /**
     * Get usuarioRecibido
     *
     * @return string
     */
    public function getUsuarioRecibido()
    {
        return $this->usuarioRecibido;
    }

    /**
     * Set fechaEntregado
     *
     * @param \DateTime $fechaEntregado
     *
     * @return FtDistribucionFisica
     */
    public function setFechaEntregado($fechaEntregado)
    {
        $this->fechaEntregado = $fechaEntregado;

        return $this;
    }

    /**
     * Get fechaEntregado
     *
     * @return \DateTime
     */
    public function getFechaEntregado()
    {
        return $this->fechaEntregado;
    }

    /**
     * Set usuarioEntregado
     *
     * @param string $usuarioEntregado
     *
     * @return FtDistribucionFisica
     */
    public function setUsuarioEntregado($usuarioEntregado)
    {
        $this->usuarioEntregado = $usuarioEntregado;

        return $this;
    }

    /**
     * Get usuarioEntregado
     *
     * @return string
     */
    public function getUsuarioEntregado()
    {
        return $this->usuarioEntregado;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDistribucionFisica
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
