<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaComponente
 *
 * @ORM\Table(name="BUSQUEDA_COMPONENTE")
 * @ORM\Entity
 */
class BusquedaComponente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_COMPONENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_COMPONENTE_IDBUSQUEDA", allocationSize=1, initialValue=1)
     */
    private $idbusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDA_IDBUSQUEDA", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONECTOR", type="integer", nullable=true)
     */
    private $conector;

    /**
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="INFO", type="text", nullable=true)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO_COMPONENTE", type="string", length=255, nullable=true)
     */
    private $encabezadoComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=true)
     */
    private $ancho = '320';

    /**
     * @var boolean
     *
     * @ORM\Column(name="CARGAR", type="boolean", nullable=true)
     */
    private $cargar = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_ADICIONALES", type="string", length=3000, nullable=true)
     */
    private $camposAdicionales;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLAS_ADICIONALES", type="string", length=255, nullable=true)
     */
    private $tablasAdicionales;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDENADO_POR", type="string", length=255, nullable=true)
     */
    private $ordenadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="AGRUPADO_POR", type="string", length=255, nullable=true)
     */
    private $agrupadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="BUSQUEDA_AVANZADA", type="string", length=255, nullable=true)
     */
    private $busquedaAvanzada;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_SELECCIONADOS", type="string", length=255, nullable=true)
     */
    private $accionesSeleccionados;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=5, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="MENU_BUSQUEDA_SUPERIOR", type="string", length=255, nullable=true)
     */
    private $menuBusquedaSuperior;

    /**
     * @var string
     *
     * @ORM\Column(name="EXPORTAR", type="text", nullable=true)
     */
    private $exportar;

    /**
     * @var string
     *
     * @ORM\Column(name="EXPORTAR_ENCABEZADO", type="text", nullable=true)
     */
    private $exportarEncabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="ENLACE_ADICIONAR", type="string", length=255, nullable=true)
     */
    private $enlaceAdicionar;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_EXPORTAR", type="string", length=20, nullable=true)
     */
    private $tipoExportar;


}

