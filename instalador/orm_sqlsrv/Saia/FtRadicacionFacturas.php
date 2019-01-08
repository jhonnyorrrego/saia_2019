<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionFacturas
 *
 * @ORM\Table(name="ft_radicacion_facturas")
 * @ORM\Entity
 */
class FtRadicacionFacturas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_radicacion_facturas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRadicacionFacturas;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="text", length=65535, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_electronica", type="string", length=255, nullable=true)
     */
    private $copiaElectronica;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_emision", type="date", nullable=true)
     */
    private $fechaEmision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago", type="datetime", nullable=true)
     */
    private $fechaPago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radicado", type="datetime", nullable=false)
     */
    private $fechaRadicado;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="natural_juridica", type="string", length=255, nullable=false)
     */
    private $naturalJuridica;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_radicado", type="integer", nullable=false)
     */
    private $numeroRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="num_factura", type="string", length=255, nullable=true)
     */
    private $numFactura;

    /**
     * @var string
     *
     * @ORM\Column(name="num_folios", type="string", length=255, nullable=true)
     */
    private $numFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_check", type="text", length=65535, nullable=true)
     */
    private $observacionesCheck;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '18696';


}
