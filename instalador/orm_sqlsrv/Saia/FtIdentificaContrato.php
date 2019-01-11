<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIdentificaContrato
 *
 * @ORM\Table(name="ft_identifica_contrato")
 * @ORM\Entity
 */
class FtIdentificaContrato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_identifica_contrato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftIdentificaContrato;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_destino", type="string", length=255, nullable=false)
     */
    private $empresaDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_origen", type="string", length=255, nullable=false)
     */
    private $empresaOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_contrato", type="integer", nullable=false)
     */
    private $estadoContrato = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_acta", type="date", nullable=false)
     */
    private $fechaActa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final_contrato", type="date", nullable=false)
     */
    private $fechaFinalContrato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subscripcion", type="date", nullable=false)
     */
    private $fechaSubscripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="naturaleza_contrato", type="string", length=255, nullable=false)
     */
    private $naturalezaContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="objeto_contrato", type="text", length=65535, nullable=false)
     */
    private $objetoContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="otros_actores", type="string", length=255, nullable=false)
     */
    private $otrosActores;

    /**
     * @var string
     *
     * @ORM\Column(name="plazo_total", type="string", length=255, nullable=false)
     */
    private $plazoTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2628';

    /**
     * @var float
     *
     * @ORM\Column(name="valor_contrato", type="float", precision=10, scale=0, nullable=false)
     */
    private $valorContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_contrato_moned", type="string", length=255, nullable=false)
     */
    private $valorContratoMoned;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_iva", type="string", length=255, nullable=false)
     */
    private $valorIva;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_iva_moneda", type="string", length=255, nullable=false)
     */
    private $valorIvaMoneda;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_neto", type="string", length=255, nullable=false)
     */
    private $valorNeto;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_neto_moneda", type="string", length=255, nullable=false)
     */
    private $valorNetoMoneda;


}

