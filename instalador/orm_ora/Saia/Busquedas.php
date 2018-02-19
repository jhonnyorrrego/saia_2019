<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busquedas
 *
 * @ORM\Table(name="BUSQUEDAS")
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
     * @ORM\Column(name="ETIQUETA", type="string", length=100, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=1000, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_B", type="string", length=50, nullable=true)
     */
    private $tipoB;

    /**
     * @var string
     *
     * @ORM\Column(name="GRAFICO", type="string", length=1, nullable=true)
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
     * @ORM\Column(name="TOTALES", type="string", length=100, nullable=true)
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
     * @ORM\Column(name="LLAVE", type="string", length=50, nullable=true)
     */
    private $llave;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDEN", type="string", length=10, nullable=true)
     */
    private $orden = 'asc';

    /**
     * @var string
     *
     * @ORM\Column(name="ORDENADO", type="string", length=255, nullable=true)
     */
    private $ordenado;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=50, nullable=true)
     */
    private $tipo = '';


}

