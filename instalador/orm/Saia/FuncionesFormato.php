<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesFormato
 *
 * @ORM\Table(name="funciones_formato")
 * @ORM\Entity
 */
class FuncionesFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfuncionesFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_funcion", type="string", length=255, nullable=false)
     */
    private $nombreFuncion;

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="text", length=65535, nullable=false)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones", type="string", length=10, nullable=true)
     */
    private $acciones = 'm';



    /**
     * Get idfuncionesFormato
     *
     * @return integer
     */
    public function getIdfuncionesFormato()
    {
        return $this->idfuncionesFormato;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FuncionesFormato
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
     * Set nombreFuncion
     *
     * @param string $nombreFuncion
     *
     * @return FuncionesFormato
     */
    public function setNombreFuncion($nombreFuncion)
    {
        $this->nombreFuncion = $nombreFuncion;

        return $this;
    }

    /**
     * Get nombreFuncion
     *
     * @return string
     */
    public function getNombreFuncion()
    {
        return $this->nombreFuncion;
    }

    /**
     * Set parametros
     *
     * @param string $parametros
     *
     * @return FuncionesFormato
     */
    public function setParametros($parametros)
    {
        $this->parametros = $parametros;

        return $this;
    }

    /**
     * Get parametros
     *
     * @return string
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return FuncionesFormato
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FuncionesFormato
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return FuncionesFormato
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set formato
     *
     * @param string $formato
     *
     * @return FuncionesFormato
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;

        return $this;
    }

    /**
     * Get formato
     *
     * @return string
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set acciones
     *
     * @param string $acciones
     *
     * @return FuncionesFormato
     */
    public function setAcciones($acciones)
    {
        $this->acciones = $acciones;

        return $this;
    }

    /**
     * Get acciones
     *
     * @return string
     */
    public function getAcciones()
    {
        return $this->acciones;
    }
}
