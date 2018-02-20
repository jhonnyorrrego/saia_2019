<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaComponente
 *
 * @ORM\Table(name="busqueda_componente", uniqueConstraints={@ORM\UniqueConstraint(name="ui_busqueda_componente_nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class BusquedaComponente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_componente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="conector", type="integer", nullable=true)
     */
    private $conector;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="text", nullable=true)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_componente", type="string", length=255, nullable=true)
     */
    private $encabezadoComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ancho", type="integer", nullable=true)
     */
    private $ancho = '320';

    /**
     * @var integer
     *
     * @ORM\Column(name="cargar", type="integer", nullable=true)
     */
    private $cargar = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tablas_adicionales", type="string", length=4000, nullable=true)
     */
    private $tablasAdicionales;

    /**
     * @var string
     *
     * @ORM\Column(name="ordenado_por", type="string", length=255, nullable=true)
     */
    private $ordenadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=5, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="agrupado_por", type="string", length=300, nullable=true)
     */
    private $agrupadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="busqueda_avanzada", type="string", length=255, nullable=true)
     */
    private $busquedaAvanzada;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_seleccionados", type="string", length=255, nullable=true)
     */
    private $accionesSeleccionados;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=true)
     */
    private $moduloIdmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="menu_busqueda_superior", type="string", length=255, nullable=true)
     */
    private $menuBusquedaSuperior;

    /**
     * @var string
     *
     * @ORM\Column(name="exportar", type="text", nullable=true)
     */
    private $exportar;

    /**
     * @var string
     *
     * @ORM\Column(name="exportar_encabezado", type="text", nullable=true)
     */
    private $exportarEncabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="enlace_adicionar", type="string", length=255, nullable=true)
     */
    private $enlaceAdicionar;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_grillas", type="string", length=255, nullable=true)
     */
    private $encabezadoGrillas;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_adicionales", type="text", nullable=true)
     */
    private $camposAdicionales;


}
