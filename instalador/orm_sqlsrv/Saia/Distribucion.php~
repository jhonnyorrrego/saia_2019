<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distribucion
 *
 * @ORM\Table(name="distribucion", indexes={@ORM\Index(name="i_distribucion_doc", columns={"documento_iddocumento"})})
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
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_origen", type="integer", nullable=true)
     */
    private $rutaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero_origen", type="integer", nullable=true)
     */
    private $mensajeroOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=false)
     */
    private $tipoDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_destino", type="integer", nullable=true)
     */
    private $rutaDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero_destino", type="integer", nullable=true)
     */
    private $mensajeroDestino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero_empresad", type="integer", nullable=true)
     */
    private $mensajeroEmpresad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_distribucion", type="string", length=255, nullable=false)
     */
    private $numeroDistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_distribucion", type="integer", nullable=false)
     */
    private $estadoDistribucion = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_recogida", type="integer", nullable=false)
     */
    private $estadoRecogida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="finaliza_rol", type="integer", nullable=true)
     */
    private $finalizaRol;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finaliza_fecha", type="datetime", nullable=true)
     */
    private $finalizaFecha;


}

