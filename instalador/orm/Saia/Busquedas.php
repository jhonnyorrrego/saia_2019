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
     * @var integer
     *
     * @ORM\Column(name="grafico", type="integer", nullable=false)
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



    /**
     * Get idbusquedas
     *
     * @return integer
     */
    public function getIdbusquedas()
    {
        return $this->idbusquedas;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Busquedas
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Busquedas
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set moduloIdmodulo
     *
     * @param integer $moduloIdmodulo
     *
     * @return Busquedas
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Busquedas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set grafico
     *
     * @param boolean $grafico
     *
     * @return Busquedas
     */
    public function setGrafico($grafico)
    {
        $this->grafico = $grafico;

        return $this;
    }

    /**
     * Get grafico
     *
     * @return boolean
     */
    public function getGrafico()
    {
        return $this->grafico;
    }

    /**
     * Set subtitulo
     *
     * @param string $subtitulo
     *
     * @return Busquedas
     */
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;

        return $this;
    }

    /**
     * Get subtitulo
     *
     * @return string
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * Set totales
     *
     * @param string $totales
     *
     * @return Busquedas
     */
    public function setTotales($totales)
    {
        $this->totales = $totales;

        return $this;
    }

    /**
     * Get totales
     *
     * @return string
     */
    public function getTotales()
    {
        return $this->totales;
    }

    /**
     * Set tablas
     *
     * @param string $tablas
     *
     * @return Busquedas
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
     * Set llave
     *
     * @param string $llave
     *
     * @return Busquedas
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
     * Set ordenado
     *
     * @param string $ordenado
     *
     * @return Busquedas
     */
    public function setOrdenado($ordenado)
    {
        $this->ordenado = $ordenado;

        return $this;
    }

    /**
     * Get ordenado
     *
     * @return string
     */
    public function getOrdenado()
    {
        return $this->ordenado;
    }

    /**
     * Set orden
     *
     * @param string $orden
     *
     * @return Busquedas
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return string
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set tipoB
     *
     * @param string $tipoB
     *
     * @return Busquedas
     */
    public function setTipoB($tipoB)
    {
        $this->tipoB = $tipoB;

        return $this;
    }

    /**
     * Get tipoB
     *
     * @return string
     */
    public function getTipoB()
    {
        return $this->tipoB;
    }
}
