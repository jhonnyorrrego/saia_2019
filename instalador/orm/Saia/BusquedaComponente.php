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
     * @ORM\Column(name="info", type="text", length=65535, nullable=true)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="exportar", type="text", length=65535, nullable=true)
     */
    private $exportar;

    /**
     * @var string
     *
     * @ORM\Column(name="exportar_encabezado", type="text", length=65535, nullable=true)
     */
    private $exportarEncabezado;

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
     * @ORM\Column(name="campos_adicionales", type="text", length=65535, nullable=true)
     */
    private $camposAdicionales;

    /**
     * @var string
     *
     * @ORM\Column(name="tablas_adicionales", type="string", length=2000, nullable=true)
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
     * @ORM\Column(name="agrupado_por", type="string", length=255, nullable=true)
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
     * Get idbusquedaComponente
     *
     * @return integer
     */
    public function getIdbusquedaComponente()
    {
        return $this->idbusquedaComponente;
    }

    /**
     * Set busquedaIdbusqueda
     *
     * @param integer $busquedaIdbusqueda
     *
     * @return BusquedaComponente
     */
    public function setBusquedaIdbusqueda($busquedaIdbusqueda)
    {
        $this->busquedaIdbusqueda = $busquedaIdbusqueda;

        return $this;
    }

    /**
     * Get busquedaIdbusqueda
     *
     * @return integer
     */
    public function getBusquedaIdbusqueda()
    {
        return $this->busquedaIdbusqueda;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return BusquedaComponente
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set conector
     *
     * @param integer $conector
     *
     * @return BusquedaComponente
     */
    public function setConector($conector)
    {
        $this->conector = $conector;

        return $this;
    }

    /**
     * Get conector
     *
     * @return integer
     */
    public function getConector()
    {
        return $this->conector;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return BusquedaComponente
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return BusquedaComponente
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return BusquedaComponente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return BusquedaComponente
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return BusquedaComponente
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set exportar
     *
     * @param string $exportar
     *
     * @return BusquedaComponente
     */
    public function setExportar($exportar)
    {
        $this->exportar = $exportar;

        return $this;
    }

    /**
     * Get exportar
     *
     * @return string
     */
    public function getExportar()
    {
        return $this->exportar;
    }

    /**
     * Set exportarEncabezado
     *
     * @param string $exportarEncabezado
     *
     * @return BusquedaComponente
     */
    public function setExportarEncabezado($exportarEncabezado)
    {
        $this->exportarEncabezado = $exportarEncabezado;

        return $this;
    }

    /**
     * Get exportarEncabezado
     *
     * @return string
     */
    public function getExportarEncabezado()
    {
        return $this->exportarEncabezado;
    }

    /**
     * Set encabezadoComponente
     *
     * @param string $encabezadoComponente
     *
     * @return BusquedaComponente
     */
    public function setEncabezadoComponente($encabezadoComponente)
    {
        $this->encabezadoComponente = $encabezadoComponente;

        return $this;
    }

    /**
     * Get encabezadoComponente
     *
     * @return string
     */
    public function getEncabezadoComponente()
    {
        return $this->encabezadoComponente;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return BusquedaComponente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set ancho
     *
     * @param integer $ancho
     *
     * @return BusquedaComponente
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;

        return $this;
    }

    /**
     * Get ancho
     *
     * @return integer
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set cargar
     *
     * @param integer $cargar
     *
     * @return BusquedaComponente
     */
    public function setCargar($cargar)
    {
        $this->cargar = $cargar;

        return $this;
    }

    /**
     * Get cargar
     *
     * @return integer
     */
    public function getCargar()
    {
        return $this->cargar;
    }

    /**
     * Set camposAdicionales
     *
     * @param string $camposAdicionales
     *
     * @return BusquedaComponente
     */
    public function setCamposAdicionales($camposAdicionales)
    {
        $this->camposAdicionales = $camposAdicionales;

        return $this;
    }

    /**
     * Get camposAdicionales
     *
     * @return string
     */
    public function getCamposAdicionales()
    {
        return $this->camposAdicionales;
    }

    /**
     * Set tablasAdicionales
     *
     * @param string $tablasAdicionales
     *
     * @return BusquedaComponente
     */
    public function setTablasAdicionales($tablasAdicionales)
    {
        $this->tablasAdicionales = $tablasAdicionales;

        return $this;
    }

    /**
     * Get tablasAdicionales
     *
     * @return string
     */
    public function getTablasAdicionales()
    {
        return $this->tablasAdicionales;
    }

    /**
     * Set ordenadoPor
     *
     * @param string $ordenadoPor
     *
     * @return BusquedaComponente
     */
    public function setOrdenadoPor($ordenadoPor)
    {
        $this->ordenadoPor = $ordenadoPor;

        return $this;
    }

    /**
     * Get ordenadoPor
     *
     * @return string
     */
    public function getOrdenadoPor()
    {
        return $this->ordenadoPor;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return BusquedaComponente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set agrupadoPor
     *
     * @param string $agrupadoPor
     *
     * @return BusquedaComponente
     */
    public function setAgrupadoPor($agrupadoPor)
    {
        $this->agrupadoPor = $agrupadoPor;

        return $this;
    }

    /**
     * Get agrupadoPor
     *
     * @return string
     */
    public function getAgrupadoPor()
    {
        return $this->agrupadoPor;
    }

    /**
     * Set busquedaAvanzada
     *
     * @param string $busquedaAvanzada
     *
     * @return BusquedaComponente
     */
    public function setBusquedaAvanzada($busquedaAvanzada)
    {
        $this->busquedaAvanzada = $busquedaAvanzada;

        return $this;
    }

    /**
     * Get busquedaAvanzada
     *
     * @return string
     */
    public function getBusquedaAvanzada()
    {
        return $this->busquedaAvanzada;
    }

    /**
     * Set accionesSeleccionados
     *
     * @param string $accionesSeleccionados
     *
     * @return BusquedaComponente
     */
    public function setAccionesSeleccionados($accionesSeleccionados)
    {
        $this->accionesSeleccionados = $accionesSeleccionados;

        return $this;
    }

    /**
     * Get accionesSeleccionados
     *
     * @return string
     */
    public function getAccionesSeleccionados()
    {
        return $this->accionesSeleccionados;
    }

    /**
     * Set moduloIdmodulo
     *
     * @param integer $moduloIdmodulo
     *
     * @return BusquedaComponente
     */
    public function setModuloIdmodulo($moduloIdmodulo)
    {
        $this->moduloIdmodulo = $moduloIdmodulo;

        return $this;
    }

    /**
     * Get moduloIdmodulo
     *
     * @return integer
     */
    public function getModuloIdmodulo()
    {
        return $this->moduloIdmodulo;
    }

    /**
     * Set menuBusquedaSuperior
     *
     * @param string $menuBusquedaSuperior
     *
     * @return BusquedaComponente
     */
    public function setMenuBusquedaSuperior($menuBusquedaSuperior)
    {
        $this->menuBusquedaSuperior = $menuBusquedaSuperior;

        return $this;
    }

    /**
     * Get menuBusquedaSuperior
     *
     * @return string
     */
    public function getMenuBusquedaSuperior()
    {
        return $this->menuBusquedaSuperior;
    }

    /**
     * Set enlaceAdicionar
     *
     * @param string $enlaceAdicionar
     *
     * @return BusquedaComponente
     */
    public function setEnlaceAdicionar($enlaceAdicionar)
    {
        $this->enlaceAdicionar = $enlaceAdicionar;

        return $this;
    }

    /**
     * Get enlaceAdicionar
     *
     * @return string
     */
    public function getEnlaceAdicionar()
    {
        return $this->enlaceAdicionar;
    }

    /**
     * Set encabezadoGrillas
     *
     * @param string $encabezadoGrillas
     *
     * @return BusquedaComponente
     */
    public function setEncabezadoGrillas($encabezadoGrillas)
    {
        $this->encabezadoGrillas = $encabezadoGrillas;

        return $this;
    }

    /**
     * Get encabezadoGrillas
     *
     * @return string
     */
    public function getEncabezadoGrillas()
    {
        return $this->encabezadoGrillas;
    }
}
