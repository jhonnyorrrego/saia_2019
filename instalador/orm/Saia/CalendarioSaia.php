<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarioSaia
 *
 * @ORM\Table(name="calendario_saia")
 * @ORM\Entity
 */
class CalendarioSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcalendario_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcalendarioSaia;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="estilo", type="string", length=255, nullable=true)
     */
    private $estilo;

    /**
     * @var string
     *
     * @ORM\Column(name="datos", type="string", length=255, nullable=false)
     */
    private $datos;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_izquierda", type="string", length=255, nullable=false)
     */
    private $encabezadoIzquierda;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_centro", type="string", length=255, nullable=false)
     */
    private $encabezadoCentro;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado_derecho", type="string", length=255, nullable=false)
     */
    private $encabezadoDerecho;

    /**
     * @var string
     *
     * @ORM\Column(name="adicionar_evento", type="string", length=255, nullable=true)
     */
    private $adicionarEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="busqueda_avanzada", type="string", length=255, nullable=true)
     */
    private $busquedaAvanzada;



    /**
     * Get idcalendarioSaia
     *
     * @return integer
     */
    public function getIdcalendarioSaia()
    {
        return $this->idcalendarioSaia;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CalendarioSaia
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
     * @return CalendarioSaia
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return CalendarioSaia
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return CalendarioSaia
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
     * Set estilo
     *
     * @param string $estilo
     *
     * @return CalendarioSaia
     */
    public function setEstilo($estilo)
    {
        $this->estilo = $estilo;

        return $this;
    }

    /**
     * Get estilo
     *
     * @return string
     */
    public function getEstilo()
    {
        return $this->estilo;
    }

    /**
     * Set datos
     *
     * @param string $datos
     *
     * @return CalendarioSaia
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;

        return $this;
    }

    /**
     * Get datos
     *
     * @return string
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * Set encabezadoIzquierda
     *
     * @param string $encabezadoIzquierda
     *
     * @return CalendarioSaia
     */
    public function setEncabezadoIzquierda($encabezadoIzquierda)
    {
        $this->encabezadoIzquierda = $encabezadoIzquierda;

        return $this;
    }

    /**
     * Get encabezadoIzquierda
     *
     * @return string
     */
    public function getEncabezadoIzquierda()
    {
        return $this->encabezadoIzquierda;
    }

    /**
     * Set encabezadoCentro
     *
     * @param string $encabezadoCentro
     *
     * @return CalendarioSaia
     */
    public function setEncabezadoCentro($encabezadoCentro)
    {
        $this->encabezadoCentro = $encabezadoCentro;

        return $this;
    }

    /**
     * Get encabezadoCentro
     *
     * @return string
     */
    public function getEncabezadoCentro()
    {
        return $this->encabezadoCentro;
    }

    /**
     * Set encabezadoDerecho
     *
     * @param string $encabezadoDerecho
     *
     * @return CalendarioSaia
     */
    public function setEncabezadoDerecho($encabezadoDerecho)
    {
        $this->encabezadoDerecho = $encabezadoDerecho;

        return $this;
    }

    /**
     * Get encabezadoDerecho
     *
     * @return string
     */
    public function getEncabezadoDerecho()
    {
        return $this->encabezadoDerecho;
    }

    /**
     * Set adicionarEvento
     *
     * @param string $adicionarEvento
     *
     * @return CalendarioSaia
     */
    public function setAdicionarEvento($adicionarEvento)
    {
        $this->adicionarEvento = $adicionarEvento;

        return $this;
    }

    /**
     * Get adicionarEvento
     *
     * @return string
     */
    public function getAdicionarEvento()
    {
        return $this->adicionarEvento;
    }

    /**
     * Set busquedaAvanzada
     *
     * @param string $busquedaAvanzada
     *
     * @return CalendarioSaia
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
}
