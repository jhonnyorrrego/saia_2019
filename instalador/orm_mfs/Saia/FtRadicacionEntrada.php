<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionEntrada
 *
 * @ORM\Table(name="ft_radicacion_entrada")
 * @ORM\Entity
 */
class FtRadicacionEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_radicacion_entrada", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRadicacionEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_oficio", type="string", length=255, nullable=true)
     */
    private $numeroOficio;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_natural", type="string", length=255, nullable=true)
     */
    private $personaNatural;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_anexos", type="text", length=65535, nullable=true)
     */
    private $descripcionAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="text", length=65535, nullable=true)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_a", type="text", length=65535, nullable=true)
     */
    private $copiaA;

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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie = '1317';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radicacion_entrada", type="datetime", nullable=false)
     */
    private $fechaRadicacionEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_radicado", type="integer", nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_radicado", type="string", length=255, nullable=true)
     */
    private $estadoRadicado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_oficio_entrada", type="date", nullable=true)
     */
    private $fechaOficioEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="area_responsable", type="string", length=255, nullable=true)
     */
    private $areaResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=false)
     */
    private $tipoDestino = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="persona_natural_dest", type="string", length=255, nullable=true)
     */
    private $personaNaturalDest;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=true)
     */
    private $tipoMensajeria;

    /**
     * @var integer
     *
     * @ORM\Column(name="despachado", type="integer", nullable=false)
     */
    private $despachado;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_transportado", type="string", length=255, nullable=true)
     */
    private $empresaTransportado;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_guia", type="string", length=255, nullable=true)
     */
    private $numeroGuia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_respuesta", type="date", nullable=true)
     */
    private $tiempoRespuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_general", type="string", length=255, nullable=true)
     */
    private $descripcionGeneral;

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_recogida", type="integer", nullable=true)
     */
    private $requiereRecogida = '1';


}

