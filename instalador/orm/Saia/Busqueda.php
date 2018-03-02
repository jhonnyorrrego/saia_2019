<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busqueda
 *
 * @ORM\Table(name="busqueda", uniqueConstraints={@ORM\UniqueConstraint(name="ui_busqueda_nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Busqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

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
    private $ancho = '200';

    /**
     * @var string
     *
     * @ORM\Column(name="campos", type="text", length=65535, nullable=true)
     */
    private $campos;

    /**
     * @var string
     *
     * @ORM\Column(name="llave", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @var string
     *
     * @ORM\Column(name="tablas", type="string", length=255, nullable=true)
     */
    private $tablas;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_libreria", type="string", length=255, nullable=true)
     */
    private $rutaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_libreria_pantalla", type="string", length=255, nullable=true)
     */
    private $rutaLibreriaPantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_registros", type="integer", nullable=true)
     */
    private $cantidadRegistros = '30';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_refrescar", type="integer", nullable=true)
     */
    private $tiempoRefrescar = '500';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_visualizacion", type="string", length=255, nullable=true)
     */
    private $rutaVisualizacion = 'pantallas/busqueda/componentes_busqueda.php';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_busqueda", type="integer", nullable=true)
     */
    private $tipoBusqueda = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="badge_cantidades", type="integer", nullable=true)
     */
    private $badgeCantidades;



    /**
     * Get idbusqueda
     *
     * @return integer
     */
    public function getIdbusqueda()
    {
        return $this->idbusqueda;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Busqueda
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Busqueda
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return Busqueda
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
     * @return Busqueda
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
     * Set campos
     *
     * @param string $campos
     *
     * @return Busqueda
     */
    public function setCampos($campos)
    {
        $this->campos = $campos;

        return $this;
    }

    /**
     * Get campos
     *
     * @return string
     */
    public function getCampos()
    {
        return $this->campos;
    }

    /**
     * Set llave
     *
     * @param string $llave
     *
     * @return Busqueda
     */
    public function setLlave($llave)
    {
        $this->llave = $llave;

        return $this;
    }

    /**
     * Get llave
     *
     * @return string
     */
    public function getLlave()
    {
        return $this->llave;
    }

    /**
     * Set tablas
     *
     * @param string $tablas
     *
     * @return Busqueda
     */
    public function setTablas($tablas)
    {
        $this->tablas = $tablas;

        return $this;
    }

    /**
     * Get tablas
     *
     * @return string
     */
    public function getTablas()
    {
        return $this->tablas;
    }

    /**
     * Set rutaLibreria
     *
     * @param string $rutaLibreria
     *
     * @return Busqueda
     */
    public function setRutaLibreria($rutaLibreria)
    {
        $this->rutaLibreria = $rutaLibreria;

        return $this;
    }

    /**
     * Get rutaLibreria
     *
     * @return string
     */
    public function getRutaLibreria()
    {
        return $this->rutaLibreria;
    }

    /**
     * Set rutaLibreriaPantalla
     *
     * @param string $rutaLibreriaPantalla
     *
     * @return Busqueda
     */
    public function setRutaLibreriaPantalla($rutaLibreriaPantalla)
    {
        $this->rutaLibreriaPantalla = $rutaLibreriaPantalla;

        return $this;
    }

    /**
     * Get rutaLibreriaPantalla
     *
     * @return string
     */
    public function getRutaLibreriaPantalla()
    {
        return $this->rutaLibreriaPantalla;
    }

    /**
     * Set cantidadRegistros
     *
     * @param integer $cantidadRegistros
     *
     * @return Busqueda
     */
    public function setCantidadRegistros($cantidadRegistros)
    {
        $this->cantidadRegistros = $cantidadRegistros;

        return $this;
    }

    /**
     * Get cantidadRegistros
     *
     * @return integer
     */
    public function getCantidadRegistros()
    {
        return $this->cantidadRegistros;
    }

    /**
     * Set tiempoRefrescar
     *
     * @param integer $tiempoRefrescar
     *
     * @return Busqueda
     */
    public function setTiempoRefrescar($tiempoRefrescar)
    {
        $this->tiempoRefrescar = $tiempoRefrescar;

        return $this;
    }

    /**
     * Get tiempoRefrescar
     *
     * @return integer
     */
    public function getTiempoRefrescar()
    {
        return $this->tiempoRefrescar;
    }

    /**
     * Set rutaVisualizacion
     *
     * @param string $rutaVisualizacion
     *
     * @return Busqueda
     */
    public function setRutaVisualizacion($rutaVisualizacion)
    {
        $this->rutaVisualizacion = $rutaVisualizacion;

        return $this;
    }

    /**
     * Get rutaVisualizacion
     *
     * @return string
     */
    public function getRutaVisualizacion()
    {
        return $this->rutaVisualizacion;
    }

    /**
     * Set tipoBusqueda
     *
     * @param integer $tipoBusqueda
     *
     * @return Busqueda
     */
    public function setTipoBusqueda($tipoBusqueda)
    {
        $this->tipoBusqueda = $tipoBusqueda;

        return $this;
    }

    /**
     * Get tipoBusqueda
     *
     * @return integer
     */
    public function getTipoBusqueda()
    {
        return $this->tipoBusqueda;
    }

    /**
     * Set badgeCantidades
     *
     * @param integer $badgeCantidades
     *
     * @return Busqueda
     */
    public function setBadgeCantidades($badgeCantidades)
    {
        $this->badgeCantidades = $badgeCantidades;

        return $this;
    }

    /**
     * Get badgeCantidades
     *
     * @return integer
     */
    public function getBadgeCantidades()
    {
        return $this->badgeCantidades;
    }
}
