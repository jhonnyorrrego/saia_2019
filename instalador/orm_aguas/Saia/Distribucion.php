<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distribucion
 *
 * @ORM\Table(name="DISTRIBUCION", indexes={@ORM\Index(name="i_distribucion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class Distribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDISTRIBUCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DISTRIBUCION_IDDISTRIBUCION_se", allocationSize=1, initialValue=1)
     */
    private $iddistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ORIGEN", type="integer", nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUTA_ORIGEN", type="integer", nullable=true)
     */
    private $rutaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="MENSAJERO_ORIGEN", type="integer", nullable=true)
     */
    private $mensajeroOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESTINO", type="integer", nullable=false)
     */
    private $tipoDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUTA_DESTINO", type="integer", nullable=true)
     */
    private $rutaDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="MENSAJERO_DESTINO", type="integer", nullable=true)
     */
    private $mensajeroDestino = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="MENSAJERO_EMPRESAD", type="integer", nullable=true)
     */
    private $mensajeroEmpresad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_DISTRIBUCION", type="string", length=255, nullable=false)
     */
    private $numeroDistribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_DISTRIBUCION", type="integer", nullable=false)
     */
    private $estadoDistribucion = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_RECOGIDA", type="integer", nullable=false)
     */
    private $estadoRecogida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=false)
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_DISTRIBUCION", type="date", nullable=true)
     */
    private $fechaDistribucion;


}
