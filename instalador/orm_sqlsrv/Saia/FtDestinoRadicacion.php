<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDestinoRadicacion
 *
 * @ORM\Table(name="ft_destino_radicacion")
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


}
