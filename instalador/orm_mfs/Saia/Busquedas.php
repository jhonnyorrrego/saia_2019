<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busquedas
 *
 * @ORM\Table(name="busquedas")
 * @ORM\Entity
 */
class Busquedas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusquedas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusquedas;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=100, nullable=false)
     */
    private $etiqueta = '';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="text", length=16777215, nullable=false)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=50, nullable=true)
     */
    private $tipo = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="grafico", type="boolean", nullable=false)
     */
    private $grafico = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="subtitulo", type="string", length=50, nullable=true)
     */
    private $subtitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="totales", type="text", length=16777215, nullable=true)
     */
    private $totales;

    /**
     * @var string
     *
     * @ORM\Column(name="tablas", type="string", length=255, nullable=true)
     */
    private $tablas;

    /**
     * @var string
     *
     * @ORM\Column(name="llave", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @var string
     *
     * @ORM\Column(name="ordenado", type="string", length=50, nullable=true)
     */
    private $ordenado;

    /**
     * @var string
     *
     * @ORM\Column(name="orden", type="string", nullable=false)
     */
    private $orden = 'asc';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_b", type="string", length=255, nullable=false)
     */
    private $tipoB = 'listado';


}

