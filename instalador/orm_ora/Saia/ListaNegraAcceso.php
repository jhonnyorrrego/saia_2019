<?php

namespace Saia;

/**
 * ListaNegraAcceso
 */
class ListaNegraAcceso
{
    /**
     * @var integer
     */
    private $idlistaNegraAcceso;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $iplocal;

    /**
     * @var string
     */
    private $ipremota;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $estado;


    /**
     * Get idlistaNegraAcceso
     *
     * @return integer
     */
    public function getIdlistaNegraAcceso()
    {
        return $this->idlistaNegraAcceso;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return ListaNegraAcceso
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set iplocal
     *
     * @param string $iplocal
     *
     * @return ListaNegraAcceso
     */
    public function setIplocal($iplocal)
    {
        $this->iplocal = $iplocal;

        return $this;
    }

    /**
     * Get iplocal
     *
     * @return string
     */
    public function getIplocal()
    {
        return $this->iplocal;
    }

    /**
     * Set ipremota
     *
     * @param string $ipremota
     *
     * @return ListaNegraAcceso
     */
    public function setIpremota($ipremota)
    {
        $this->ipremota = $ipremota;

        return $this;
    }

    /**
     * Get ipremota
     *
     * @return string
     */
    public function getIpremota()
    {
        return $this->ipremota;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return ListaNegraAcceso
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return ListaNegraAcceso
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
}

