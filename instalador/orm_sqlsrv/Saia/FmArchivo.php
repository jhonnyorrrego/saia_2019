<?php

namespace Saia;

/**
 * FmArchivo
 */
class FmArchivo
{
    /**
     * @var integer
     */
    private $idarchivo;

    /**
     * @var integer
     */
    private $directorioIddirectorio;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $formato;

    /**
     * @var integer
     */
    private $peso;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get idarchivo
     *
     * @return integer
     */
    public function getIdarchivo()
    {
        return $this->idarchivo;
    }

    /**
     * Set directorioIddirectorio
     *
     * @param integer $directorioIddirectorio
     *
     * @return FmArchivo
     */
    public function setDirectorioIddirectorio($directorioIddirectorio)
    {
        $this->directorioIddirectorio = $directorioIddirectorio;

        return $this;
    }

    /**
     * Get directorioIddirectorio
     *
     * @return integer
     */
    public function getDirectorioIddirectorio()
    {
        return $this->directorioIddirectorio;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmArchivo
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FmArchivo
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
     * Set formato
     *
     * @param string $formato
     *
     * @return FmArchivo
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
     * Set peso
     *
     * @param integer $peso
     *
     * @return FmArchivo
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return integer
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FmArchivo
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
}

