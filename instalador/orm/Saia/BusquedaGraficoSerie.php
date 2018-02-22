<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaGraficoSerie
 *
 * @ORM\Table(name="busqueda_grafico_serie", indexes={@ORM\Index(name="i_busqueda_gr_idbusqueda_gr", columns={"busqueda_gr_idbusqueda_grafico"})})
 * @ORM\Entity
 */
class BusquedaGraficoSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_grafico_serie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaGraficoSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_gr_idbusqueda_grafico", type="integer", nullable=false)
     */
    private $busquedaGraficoIdbusquedaGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="dato", type="string", length=255, nullable=false)
     */
    private $dato;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion_adicional", type="text", nullable=true)
     */
    private $condicionAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="mascara_dato", type="string", length=255, nullable=true)
     */
    private $mascaraDato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
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
     * @param integer $busquedaGraficoIdbusquedaGr
     *
     * @return BusquedaGraficoSerie
     */
    public function setBusquedaGraficoIdbusquedaGr($busquedaGraficoIdbusquedaGrafico)
    {
        $this->busquedaGraficoIdbusquedaGr = $busquedaGraficoIdbusquedaGrafico;

        return $this;
    }

    /**
     * Get busquedaGraficoIdbusquedaGrafico
     *
     * @return integer
     */
    public function getBusquedaGraficoIdbusquedaGr()
    {
        return $this->busquedaGraficoIdbusquedaGr;
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
