<?php

namespace Saia;

/**
 * Distribucion
 */
class Distribucion
{
    /**
     * @var integer
     */
    private $iddistribucion;

    /**
     * @var integer
     */
    private $origen;

    /**
     * @var integer
     */
    private $tipoOrigen;

    /**
     * @var integer
     */
    private $rutaOrigen;

    /**
     * @var integer
     */
    private $mensajeroOrigen;

    /**
     * @var integer
     */
    private $destino;

    /**
     * @var integer
     */
    private $tipoDestino;

    /**
     * @var integer
     */
    private $rutaDestino;

    /**
     * @var integer
     */
    private $mensajeroDestino;

    /**
     * @var integer
     */
    private $mensajeroEmpresad;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $numeroDistribucion;

    /**
     * @var integer
     */
    private $estadoDistribucion;

    /**
     * @var integer
     */
    private $estadoRecogida;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var integer
     */
    private $finalizaRol;

    /**
     * @var \DateTime
     */
    private $finalizaFecha;


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

    /**
     * Set finalizaRol
     *
     * @param integer $finalizaRol
     *
     * @return Distribucion
     */
    public function setFinalizaRol($finalizaRol)
    {
        $this->finalizaRol = $finalizaRol;

        return $this;
    }

    /**
     * Get finalizaRol
     *
     * @return integer
     */
    public function getFinalizaRol()
    {
        return $this->finalizaRol;
    }

    /**
     * Set finalizaFecha
     *
     * @param \DateTime $finalizaFecha
     *
     * @return Distribucion
     */
    public function setFinalizaFecha($finalizaFecha)
    {
        $this->finalizaFecha = $finalizaFecha;

        return $this;
    }

    /**
     * Get finalizaFecha
     *
     * @return \DateTime
     */
    public function getFinalizaFecha()
    {
        return $this->finalizaFecha;
    }
}

