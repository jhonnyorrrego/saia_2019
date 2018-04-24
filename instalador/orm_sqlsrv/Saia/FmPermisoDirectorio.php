<?php

namespace Saia;

/**
 * FmPermisoDirectorio
 */
class FmPermisoDirectorio
{
    /**
     * @var integer
     */
    private $idpermisoDirectorio;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $directorioIddirectorio;

    /**
     * @var integer
     */
    private $lectura;

    /**
     * @var integer
     */
    private $escritura;


    /**
     * Get idpermisoDirectorio
     *
     * @return integer
     */
    public function getIdpermisoDirectorio()
    {
        return $this->idpermisoDirectorio;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmPermisoDirectorio
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
     * Set directorioIddirectorio
     *
     * @param integer $directorioIddirectorio
     *
     * @return FmPermisoDirectorio
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
     * Set lectura
     *
     * @param integer $lectura
     *
     * @return FmPermisoDirectorio
     */
    public function setLectura($lectura)
    {
        $this->lectura = $lectura;

        return $this;
    }

    /**
     * Get lectura
     *
     * @return integer
     */
    public function getLectura()
    {
        return $this->lectura;
    }

    /**
     * Set escritura
     *
     * @param integer $escritura
     *
     * @return FmPermisoDirectorio
     */
    public function setEscritura($escritura)
    {
        $this->escritura = $escritura;

        return $this;
    }

    /**
     * Get escritura
     *
     * @return integer
     */
    public function getEscritura()
    {
        return $this->escritura;
    }
}

