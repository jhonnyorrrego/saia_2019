<?php

namespace Saia;

/**
 * BusquedaGraficoSerie
 */
class BusquedaGraficoSerie
{
    /**
     * @var integer
     */
    private $idbusquedaGraficoSerie;

    /**
     * @var integer
     */
    private $busquedaGraficoIdbusquedaGrafico;

    /**
     * @var integer
     */
    private $tipo;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var string
     */
    private $dato;

    /**
     * @var string
     */
    private $condicionAdicional;

    /**
     * @var string
     */
    private $mascaraDato;

    /**
     * @var string
     */
    private $nombre;


    /**
     * Get idbusquedaGraficoSerie
     *
     * @return integer
     */
    public function getIdbusquedaGraficoSerie()
    {
        return $this->idbusquedaGraficoSerie;
    }

    /**
     * Set busquedaGraficoIdbusquedaGrafico
     *
     * @param integer $busquedaGraficoIdbusquedaGrafico
     *
     * @return BusquedaGraficoSerie
     */
    public function setBusquedaGraficoIdbusquedaGrafico($busquedaGraficoIdbusquedaGrafico)
    {
        $this->busquedaGraficoIdbusquedaGrafico = $busquedaGraficoIdbusquedaGrafico;

        return $this;
    }

    /**
     * Get busquedaGraficoIdbusquedaGrafico
     *
     * @return integer
     */
    public function getBusquedaGraficoIdbusquedaGrafico()
    {
        return $this->busquedaGraficoIdbusquedaGrafico;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return BusquedaGraficoSerie
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
     * Set valor
     *
     * @param string $valor
     *
     * @return BusquedaGraficoSerie
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set dato
     *
     * @param string $dato
     *
     * @return BusquedaGraficoSerie
     */
    public function setDato($dato)
    {
        $this->dato = $dato;

        return $this;
    }

    /**
     * Get dato
     *
     * @return string
     */
    public function getDato()
    {
        return $this->dato;
    }

    /**
     * Set condicionAdicional
     *
     * @param string $condicionAdicional
     *
     * @return BusquedaGraficoSerie
     */
    public function setCondicionAdicional($condicionAdicional)
    {
        $this->condicionAdicional = $condicionAdicional;

        return $this;
    }

    /**
     * Get condicionAdicional
     *
     * @return string
     */
    public function getCondicionAdicional()
    {
        return $this->condicionAdicional;
    }

    /**
     * Set mascaraDato
     *
     * @param string $mascaraDato
     *
     * @return BusquedaGraficoSerie
     */
    public function setMascaraDato($mascaraDato)
    {
        $this->mascaraDato = $mascaraDato;

        return $this;
    }

    /**
     * Get mascaraDato
     *
     * @return string
     */
    public function getMascaraDato()
    {
        return $this->mascaraDato;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return BusquedaGraficoSerie
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
}

