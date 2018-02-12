<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDestinoRadicacion
 *
 * @ORM\Table(name="ft_destino_radicacion", indexes={@ORM\Index(name="i_destino_radicacion_destino_ex", columns={"destino_externo"}), @ORM\Index(name="i_destino_radicacion_radicacion", columns={"ft_radicacion_entrada"}), @ORM\Index(name="i_destino_radicacion_nombre_des", columns={"nombre_destino"}), @ORM\Index(name="i_destino_radicacion_ruta_desti", columns={"ruta_destino"}), @ORM\Index(name="i_destino_radicacion_serie_idse", columns={"serie_idserie"}), @ORM\Index(name="i_destino_radicacion_tipo_desti", columns={"tipo_destino"})})
 * @ORM\Entity
 */
class FtDestinoRadicacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_destino_radicacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDestinoRadicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_destino", type="text", length=65535, nullable=true)
     */
    private $observacionDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_destino", type="string", length=255, nullable=true)
     */
    private $nombreDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_entrada", type="integer", nullable=false)
     */
    private $ftRadicacionEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=false)
     */
    private $tipoDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_origen", type="string", length=255, nullable=true)
     */
    private $nombreOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajero_encargado", type="string", length=255, nullable=true)
     */
    private $mensajeroEncargado;

    /**
     * @var string
     *
     * @ORM\Column(name="recepcion", type="string", length=255, nullable=true)
     */
    private $recepcion;

    /**
     * @var string
     *
     * @ORM\Column(name="destino_externo", type="string", length=255, nullable=true)
     */
    private $destinoExterno;

    /**
     * @var string
     *
     * @ORM\Column(name="origen_externo", type="string", length=255, nullable=true)
     */
    private $origenExterno;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_item", type="string", length=255, nullable=false)
     */
    private $numeroItem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recepcion_fecha", type="datetime", nullable=true)
     */
    private $recepcionFecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_item", type="integer", nullable=true)
     */
    private $estadoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos", type="integer", nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="finalizacion_observa", type="string", length=255, nullable=true)
     */
    private $finalizacionObserva;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_recogida", type="integer", nullable=true)
     */
    private $estadoRecogida;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_mensajero", type="string", length=255, nullable=true)
     */
    private $tipoMensajero = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_origen", type="integer", nullable=true)
     */
    private $rutaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_destino", type="integer", nullable=true)
     */
    private $rutaDestino;



    /**
     * Get idftDestinoRadicacion
     *
     * @return integer
     */
    public function getIdftDestinoRadicacion()
    {
        return $this->idftDestinoRadicacion;
    }

    /**
     * Set observacionDestino
     *
     * @param string $observacionDestino
     *
     * @return FtDestinoRadicacion
     */
    public function setObservacionDestino($observacionDestino)
    {
        $this->observacionDestino = $observacionDestino;

        return $this;
    }

    /**
     * Get observacionDestino
     *
     * @return string
     */
    public function getObservacionDestino()
    {
        return $this->observacionDestino;
    }

    /**
     * Set nombreDestino
     *
     * @param string $nombreDestino
     *
     * @return FtDestinoRadicacion
     */
    public function setNombreDestino($nombreDestino)
    {
        $this->nombreDestino = $nombreDestino;

        return $this;
    }

    /**
     * Get nombreDestino
     *
     * @return string
     */
    public function getNombreDestino()
    {
        return $this->nombreDestino;
    }

    /**
     * Set ftRadicacionEntrada
     *
     * @param integer $ftRadicacionEntrada
     *
     * @return FtDestinoRadicacion
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
     * Set tipoDestino
     *
     * @param integer $tipoDestino
     *
     * @return FtDestinoRadicacion
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
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     *
     * @return FtDestinoRadicacion
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
     * Set nombreOrigen
     *
     * @param string $nombreOrigen
     *
     * @return FtDestinoRadicacion
     */
    public function setNombreOrigen($nombreOrigen)
    {
        $this->nombreOrigen = $nombreOrigen;

        return $this;
    }

    /**
     * Get nombreOrigen
     *
     * @return string
     */
    public function getNombreOrigen()
    {
        return $this->nombreOrigen;
    }

    /**
     * Set mensajeroEncargado
     *
     * @param string $mensajeroEncargado
     *
     * @return FtDestinoRadicacion
     */
    public function setMensajeroEncargado($mensajeroEncargado)
    {
        $this->mensajeroEncargado = $mensajeroEncargado;

        return $this;
    }

    /**
     * Get mensajeroEncargado
     *
     * @return string
     */
    public function getMensajeroEncargado()
    {
        return $this->mensajeroEncargado;
    }

    /**
     * Set recepcion
     *
     * @param string $recepcion
     *
     * @return FtDestinoRadicacion
     */
    public function setRecepcion($recepcion)
    {
        $this->recepcion = $recepcion;

        return $this;
    }

    /**
     * Get recepcion
     *
     * @return string
     */
    public function getRecepcion()
    {
        return $this->recepcion;
    }

    /**
     * Set destinoExterno
     *
     * @param string $destinoExterno
     *
     * @return FtDestinoRadicacion
     */
    public function setDestinoExterno($destinoExterno)
    {
        $this->destinoExterno = $destinoExterno;

        return $this;
    }

    /**
     * Get destinoExterno
     *
     * @return string
     */
    public function getDestinoExterno()
    {
        return $this->destinoExterno;
    }

    /**
     * Set origenExterno
     *
     * @param string $origenExterno
     *
     * @return FtDestinoRadicacion
     */
    public function setOrigenExterno($origenExterno)
    {
        $this->origenExterno = $origenExterno;

        return $this;
    }

    /**
     * Get origenExterno
     *
     * @return string
     */
    public function getOrigenExterno()
    {
        return $this->origenExterno;
    }

    /**
     * Set numeroItem
     *
     * @param string $numeroItem
     *
     * @return FtDestinoRadicacion
     */
    public function setNumeroItem($numeroItem)
    {
        $this->numeroItem = $numeroItem;

        return $this;
    }

    /**
     * Get numeroItem
     *
     * @return string
     */
    public function getNumeroItem()
    {
        return $this->numeroItem;
    }

    /**
     * Set recepcionFecha
     *
     * @param \DateTime $recepcionFecha
     *
     * @return FtDestinoRadicacion
     */
    public function setRecepcionFecha($recepcionFecha)
    {
        $this->recepcionFecha = $recepcionFecha;

        return $this;
    }

    /**
     * Get recepcionFecha
     *
     * @return \DateTime
     */
    public function getRecepcionFecha()
    {
        return $this->recepcionFecha;
    }

    /**
     * Set estadoItem
     *
     * @param integer $estadoItem
     *
     * @return FtDestinoRadicacion
     */
    public function setEstadoItem($estadoItem)
    {
        $this->estadoItem = $estadoItem;

        return $this;
    }

    /**
     * Get estadoItem
     *
     * @return integer
     */
    public function getEstadoItem()
    {
        return $this->estadoItem;
    }

    /**
     * Set anexos
     *
     * @param integer $anexos
     *
     * @return FtDestinoRadicacion
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return integer
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set finalizacionObserva
     *
     * @param string $finalizacionObserva
     *
     * @return FtDestinoRadicacion
     */
    public function setFinalizacionObserva($finalizacionObserva)
    {
        $this->finalizacionObserva = $finalizacionObserva;

        return $this;
    }

    /**
     * Get finalizacionObserva
     *
     * @return string
     */
    public function getFinalizacionObserva()
    {
        return $this->finalizacionObserva;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDestinoRadicacion
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
     * Set estadoRecogida
     *
     * @param integer $estadoRecogida
     *
     * @return FtDestinoRadicacion
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
     * Set tipoMensajero
     *
     * @param string $tipoMensajero
     *
     * @return FtDestinoRadicacion
     */
    public function setTipoMensajero($tipoMensajero)
    {
        $this->tipoMensajero = $tipoMensajero;

        return $this;
    }

    /**
     * Get tipoMensajero
     *
     * @return string
     */
    public function getTipoMensajero()
    {
        return $this->tipoMensajero;
    }

    /**
     * Set rutaOrigen
     *
     * @param integer $rutaOrigen
     *
     * @return FtDestinoRadicacion
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
     * Set rutaDestino
     *
     * @param integer $rutaDestino
     *
     * @return FtDestinoRadicacion
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
}
