<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grafico
 *
 * @ORM\Table(name="GRAFICO")
 * @ORM\Entity
 */
class Grafico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDGRAFICO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="GRAFICO_IDGRAFICO_seq", allocationSize=1, initialValue=1)
     */
    private $idgrafico;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETAX", type="string", length=255, nullable=true)
     */
    private $etiquetax;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETAY", type="string", length=255, nullable=true)
     */
    private $etiquetay;

    /**
     * @var string
     *
     * @ORM\Column(name="SQL_GRAFICO", type="text", nullable=true)
     */
    private $sqlGrafico = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_GRAFICO", type="string", length=255, nullable=true)
     */
    private $tipoGrafico = 'barra';

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=true)
     */
    private $ancho = '300';

    /**
     * @var integer
     *
     * @ORM\Column(name="ALTO", type="integer", nullable=true)
     */
    private $alto = '400';

    /**
     * @var string
     *
     * @ORM\Column(name="PREFIJO", type="string", length=255, nullable=true)
     */
    private $prefijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="MASCARAS", type="string", length=4000, nullable=true)
     */
    private $mascaras;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRESICION_DATO", type="integer", nullable=true)
     */
    private $presicionDato = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIRECCION_TITULO", type="integer", nullable=true)
     */
    private $direccionTitulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETAY2", type="string", length=255, nullable=true)
     */
    private $etiquetay2;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESPACIO_INFERIOR", type="integer", nullable=true)
     */
    private $espacioInferior = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR_VALORES", type="string", length=5, nullable=true)
     */
    private $mostrarValores = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIA", type="string", length=20, nullable=true)
     */
    private $libreria;


}

