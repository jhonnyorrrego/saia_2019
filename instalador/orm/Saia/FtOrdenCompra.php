<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOrdenCompra
 *
 * @ORM\Table(name="ft_orden_compra", indexes={@ORM\Index(name="i_ft_orden_compra_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtOrdenCompra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_orden_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftOrdenCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_evaluacion_proveedores", type="integer", nullable=false)
     */
    private $ftEvaluacionProveedores;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1020';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="date", nullable=false)
     */
    private $fechaEntrega;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_orden_compra", type="date", nullable=false)
     */
    private $fechaOrdenCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_entrega", type="string", length=255, nullable=false)
     */
    private $lugarEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="origen_recursos", type="string", length=255, nullable=true)
     */
    private $origenRecursos;

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
     * Get idftOrdenCompra
     *
     * @return integer
     */
    public function getIdftOrdenCompra()
    {
        return $this->idftOrdenCompra;
    }

    /**
     * Set ftEvaluacionProveedores
     *
     * @param integer $ftEvaluacionProveedores
     *
     * @return FtOrdenCompra
     */
    public function setFtEvaluacionProveedores($ftEvaluacionProveedores)
    {
        $this->ftEvaluacionProveedores = $ftEvaluacionProveedores;

        return $this;
    }

    /**
     * Get ftEvaluacionProveedores
     *
     * @return integer
     */
    public function getFtEvaluacionProveedores()
    {
        return $this->ftEvaluacionProveedores;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenCompra
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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return FtOrdenCompra
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
     * Set fechaOrdenCompra
     *
     * @param \DateTime $fechaOrdenCompra
     *
     * @return FtOrdenCompra
     */
    public function setFechaOrdenCompra($fechaOrdenCompra)
    {
        $this->fechaOrdenCompra = $fechaOrdenCompra;

        return $this;
    }

    /**
     * Get fechaOrdenCompra
     *
     * @return \DateTime
     */
    public function getFechaOrdenCompra()
    {
        return $this->fechaOrdenCompra;
    }

    /**
     * Set lugarEntrega
     *
     * @param string $lugarEntrega
     *
     * @return FtOrdenCompra
     */
    public function setLugarEntrega($lugarEntrega)
    {
        $this->lugarEntrega = $lugarEntrega;

        return $this;
    }

    /**
     * Get lugarEntrega
     *
     * @return string
     */
    public function getLugarEntrega()
    {
        return $this->lugarEntrega;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtOrdenCompra
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
     * Set origenRecursos
     *
     * @param string $origenRecursos
     *
     * @return FtOrdenCompra
     */
    public function setOrigenRecursos($origenRecursos)
    {
        $this->origenRecursos = $origenRecursos;

        return $this;
    }

    /**
     * Get origenRecursos
     *
     * @return string
     */
    public function getOrigenRecursos()
    {
        return $this->origenRecursos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
