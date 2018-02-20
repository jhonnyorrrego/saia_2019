<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grafico
 *
 * @ORM\Table(name="GRAFICO", indexes={@ORM\Index(name="i_grafico_mascaras_ctx", columns={"MASCARAS"}), @ORM\Index(name="i_grafico_sql_grafic_ctx", columns={"SQL_GRAFICO"})})
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
     * @ORM\Column(name="SQL_GRAFICO", type="text", nullable=false)
     */
    private $sqlGrafico;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_GRAFICO", type="string", length=255, nullable=false)
     */
    private $tipoGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=false)
     */
    private $ancho;

    /**
     * @var integer
     *
     * @ORM\Column(name="ALTO", type="integer", nullable=false)
     */
    private $alto;

    /**
     * @var integer
     *
     * @ORM\Column(name="PLANTILLA_IDPLANTILLA", type="integer", nullable=true)
     */
    private $plantillaIdplantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="REMPLAZO", type="string", length=255, nullable=true)
     */
    private $remplazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRESICION_DATO", type="integer", nullable=false)
     */
    private $presicionDato;

    /**
     * @var string
     *
     * @ORM\Column(name="PREFIJO", type="string", length=1, nullable=true)
     */
    private $prefijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIRECCION_TITULO", type="integer", nullable=false)
     */
    private $direccionTitulo;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="MASCARAS", type="text", nullable=false)
     */
    private $mascaras;

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
    private $espacioInferior;

    /**
     * @var integer
     *
     * @ORM\Column(name="MOSTRAR_VALORES", type="integer", nullable=true)
     */
    private $mostrarValores;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIA", type="string", length=20, nullable=true)
     */
    private $libreria;


}

