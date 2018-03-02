<?php

namespace Saia;

/**
 * PruebaPantallas1
 */
class PruebaPantallas1
{
    /**
     * @var integer
     */
    private $idpruebaPantallas1;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var string
     */
    private $eMail;


    /**
     * Get idpruebaPantallas1
     *
     * @return integer
     */
    public function getIdpruebaPantallas1()
    {
        return $this->idpruebaPantallas1;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PruebaPantallas1
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return PruebaPantallas1
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set eMail
     *
     * @param string $eMail
     *
     * @return PruebaPantallas1
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;

        return $this;
    }

    /**
     * Get eMail
     *
     * @return string
     */
    public function getEMail()
    {
        return $this->eMail;
    }
}

