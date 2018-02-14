<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distribucion
 *
 * @ORM\Table(name="distribucion")
 * @ORM\Entity
 */
class Distribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddistribucion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=true)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=true)
     */
    private $tipoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_origen", type="integer", nullable=false)
     */
    private $rutaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero_origen", type="integer", nullable=false)
     */
    private $mensajeroOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=true)
     */
    private $tipoDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_destino", type="integer", nullable=false)
     */
    private $rutaDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero_destino", type="integer", nullable=false)
     */
    private $mensajeroDestino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero_empresad", type="integer", nullable=false)
     */
    private $mensajeroEmpresad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_distribucion", type="string", length=255, nullable=true)
     */
    private $numeroDistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_distribucion", type="integer", nullable=true)
     */
    private $estadoDistribucion = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_recogida", type="integer", nullable=true)
     */
    private $estadoRecogida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;



    /**
     * Get iddistribucion
     *
     * @return integer
     */
    public function getIddistribucion()
    {
        return $this->iddistribucion;
    }

    /**
     * Set origen
     *
     * @param integer $origen
     *
     * @return Distribucion
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return integer
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     *
     * @return Distribucion
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return integer
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set rutaOrigen
     *
     * @param integer $rutaOrigen
     *
     * @return Distribucion
     */
    public function setRutaOrigen($rutaOrigen)
    {
        $this->rutaOrigen = $rutaOrigen;

        return $this;
    }

    /**
     * Get rutaOrigen
     *
     * @return integer
     */
    public function getRutaOrigen()
    {
        return $this->rutaOrigen;
    }

    /**
     * Set mensajeroOrigen
     *
     * @param integer $mensajeroOrigen
     *
     * @return Distribucion
     */
    public function setMensajeroOrigen($mensajeroOrigen)
    {
        $this->mensajeroOrigen = $mensajeroOrigen;

        return $this;
    }

    /**
     * Get mensajeroOrigen
     *
     * @return integer
     */
    public function getMensajeroOrigen()
    {
        return $this->mensajeroOrigen;
    }

    /**
     * Set destino
     *
     * @param integer $destino
     *
     * @return Distribucion
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return integer
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set tipoDestino
     *
     * @param integer $tipoDestino
     *
     * @return Distribucion
     */
    public function setTipoDestino($tipoDestino)
    {
        $this->tipoDestino = $tipoDestino;

        return $this;
    }

    /**
     * Get tipoDestino
     *
     * @return integer
     */
    public function getTipoDestino()
    {
        return $this->tipoDestino;
    }

    /**
     * Set rutaDestino
     *
     * @param integer $rutaDestino
     *
     * @return Distribucion
     */
    public function setRutaDestino($rutaDestino)
    {
        $this->rutaDestino = $rutaDestino;

        return $this;
    }

    /**
     * Get rutaDestino
     *
     * @return integer
     */
    public function getRutaDestino()
    {
        return $this->rutaDestino;
    }

    /**
     * Set mensajeroDestino
     *
     * @param integer $mensajeroDestino
     *
     * @return Distribucion
     */
    public function setMensajeroDestino($mensajeroDestino)
    {
        $this->mensajeroDestino = $mensajeroDestino;

        return $this;
    }

    /**
     * Get mensajeroDestino
     *
     * @return integer
     */
    public function getMensajeroDestino()
    {
        return $this->mensajeroDestino;
    }

    /**
     * Set mensajeroEmpresad
     *
     * @param integer $mensajeroEmpresad
     *
     * @return Distribucion
     */
    public function setMensajeroEmpresad($mensajeroEmpresad)
    {
        $this->mensajeroEmpresad = $mensajeroEmpresad;

        return $this;
    }

    /**
     * Get mensajeroEmpresad
     *
     * @return integer
     */
    public function getMensajeroEmpresad()
    {
        return $this->mensajeroEmpresad;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Distribucion
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
     * Set numeroDistribucion
     *
     * @param string $numeroDistribucion
     *
     * @return Distribucion
     */
    public function setNumeroDistribucion($numeroDistribucion)
    {
        $this->numeroDistribucion = $numeroDistribucion;

        return $this;
    }

    /**
     * Get numeroDistribucion
     *
     * @return string
     */
    public function getNumeroDistribucion()
    {
        return $this->numeroDistribucion;
    }

    /**
     * Set estadoDistribucion
     *
     * @param integer $estadoDistribucion
     *
     * @return Distribucion
     */
    public function setEstadoDistribucion($estadoDistribucion)
    {
        $this->estadoDistribucion = $estadoDistribucion;

        return $this;
    }

    /**
     * Get estadoDistribucion
     *
     * @return integer
     */
    public function getEstadoDistribucion()
    {
        return $this->estadoDistribucion;
    }

    /**
     * Set estadoRecogida
     *
     * @param integer $estadoRecogida
     *
     * @return Distribucion
     */
    public function setEstadoRecogida($estadoRecogida)
    {
        $this->estadoRecogida = $estadoRecogida;

        return $this;
    }

    /**
     * Get estadoRecogida
     *
     * @return integer
     */
    public function getEstadoRecogida()
    {
        return $this->estadoRecogida;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Distribucion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
}
