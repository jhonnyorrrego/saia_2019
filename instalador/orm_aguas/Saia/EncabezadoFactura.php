<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncabezadoFactura
 *
 * @ORM\Table(name="ENCABEZADO_FACTURA", indexes={@ORM\Index(name="i_encabezado_concepto_ctx", columns={"CONCEPTO"}), @ORM\Index(name="i_encabezado_factura_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class EncabezadoFactura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENCABEZADO_FACTURA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENCABEZADO_FACTURA_IDENCABEZAD", allocationSize=1, initialValue=1)
     */
    private $idencabezadoFactura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=100, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="NIT", type="string", length=50, nullable=false)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_FACTURA", type="string", length=30, nullable=false)
     */
    private $numeroFactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="CAUSA", type="integer", nullable=false)
     */
    private $causa;

    /**
     * @var integer
     *
     * @ORM\Column(name="REVISA", type="integer", nullable=true)
     */
    private $revisa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CAUSA", type="date", nullable=true)
     */
    private $fechaCausa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REVISA", type="date", nullable=true)
     */
    private $fechaRevisa;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_ASOCIADO", type="integer", nullable=true)
     */
    private $documentoAsociado;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODIFICADO", type="integer", nullable=true)
     */
    private $modificado;

    /**
     * @var binary
     *
     * @ORM\Column(name="TERMINADO", type="binary", nullable=false)
     */
    private $terminado;

    /**
     * @var string
     *
     * @ORM\Column(name="CONCEPTO", type="text", nullable=false)
     */
    private $concepto;

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma;

    /**
     * @var integer
     *
     * @ORM\Column(name="PLANO", type="integer", nullable=false)
     */
    private $plano;


}

