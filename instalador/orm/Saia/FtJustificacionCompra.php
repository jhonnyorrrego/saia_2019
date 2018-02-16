<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtJustificacionCompra
 *
 * @ORM\Table(name="ft_justificacion_compra", indexes={@ORM\Index(name="i_ft_justificacion_compra_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtJustificacionCompra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_justificacion_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftJustificacionCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1015';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_justificacion", type="text", length=65535, nullable=false)
     */
    private $descripcionJustificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_solicitante", type="string", length=255, nullable=false)
     */
    private $nombreSolicitante;

    /**
     * @var string
     *
     * @ORM\Column(name="primera_aprobacion", type="string", length=255, nullable=false)
     */
    private $primeraAprobacion;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_compra", type="text", length=65535, nullable=false)
     */
    private $justificacionCompra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_justificacion_compra", type="date", nullable=false)
     */
    private $fechaJustificacionCompra;

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
     * Get idftJustificacionCompra
     *
     * @return integer
     */
    public function getIdftJustificacionCompra()
    {
        return $this->idftJustificacionCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtJustificacionCompra
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
     * Set descripcionJustificacion
     *
     * @param string $descripcionJustificacion
     *
     * @return FtJustificacionCompra
     */
    public function setDescripcionJustificacion($descripcionJustificacion)
    {
        $this->descripcionJustificacion = $descripcionJustificacion;

        return $this;
    }

    /**
     * Get descripcionJustificacion
     *
     * @return string
     */
    public function getDescripcionJustificacion()
    {
        return $this->descripcionJustificacion;
    }

    /**
     * Set nombreSolicitante
     *
     * @param string $nombreSolicitante
     *
     * @return FtJustificacionCompra
     */
    public function setNombreSolicitante($nombreSolicitante)
    {
        $this->nombreSolicitante = $nombreSolicitante;

        return $this;
    }

    /**
     * Get nombreSolicitante
     *
     * @return string
     */
    public function getNombreSolicitante()
    {
        return $this->nombreSolicitante;
    }

    /**
     * Set primeraAprobacion
     *
     * @param string $primeraAprobacion
     *
     * @return FtJustificacionCompra
     */
    public function setPrimeraAprobacion($primeraAprobacion)
    {
        $this->primeraAprobacion = $primeraAprobacion;

        return $this;
    }

    /**
     * Get primeraAprobacion
     *
     * @return string
     */
    public function getPrimeraAprobacion()
    {
        return $this->primeraAprobacion;
    }

    /**
     * Set justificacionCompra
     *
     * @param string $justificacionCompra
     *
     * @return FtJustificacionCompra
     */
    public function setJustificacionCompra($justificacionCompra)
    {
        $this->justificacionCompra = $justificacionCompra;

        return $this;
    }

    /**
     * Get justificacionCompra
     *
     * @return string
     */
    public function getJustificacionCompra()
    {
        return $this->justificacionCompra;
    }

    /**
     * Set fechaJustificacionCompra
     *
     * @param \DateTime $fechaJustificacionCompra
     *
     * @return FtJustificacionCompra
     */
    public function setFechaJustificacionCompra($fechaJustificacionCompra)
    {
        $this->fechaJustificacionCompra = $fechaJustificacionCompra;

        return $this;
    }

    /**
     * Get fechaJustificacionCompra
     *
     * @return \DateTime
     */
    public function getFechaJustificacionCompra()
    {
        return $this->fechaJustificacionCompra;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
     * @return FtJustificacionCompra
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
