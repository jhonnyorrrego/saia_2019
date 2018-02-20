<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busquedas
 *
 * @ORM\Table(name="BUSQUEDAS", indexes={@ORM\Index(name="i_busquedas_codigo_ctx", columns={"CODIGO"}), @ORM\Index(name="i_busquedas_orden_ctx", columns={"ORDEN"}), @ORM\Index(name="i_busquedas_totales_ctx", columns={"TOTALES"})})
 * @ORM\Entity
 */
class Busquedas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDAS_IDBUSQUEDAS_seq", allocationSize=1, initialValue=1)
     */
    private $idbusquedas;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=100, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="text", nullable=false)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=50, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="GRAFICO", type="integer", nullable=false)
     */
    private $grafico = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="SUBTITULO", type="string", length=50, nullable=true)
     */
    private $subtitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="TOTALES", type="text", nullable=true)
     */
    private $totales;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLAS", type="string", length=255, nullable=true)
     */
    private $tablas;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDENADO", type="string", length=80, nullable=true)
     */
    private $ordenado;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDEN", type="string", length=4000, nullable=false)
     */
    private $orden = 'asc';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_B", type="string", length=255, nullable=false)
     */
    private $tipoB = 'listado';


}

