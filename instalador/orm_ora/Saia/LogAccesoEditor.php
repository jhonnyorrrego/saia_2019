<?php

namespace Saia;

/**
 * LogAccesoEditor
 */
class LogAccesoEditor
{
    /**
     * @var integer
     */
    private $idlogAcceso;

    /**
     * @var integer
     */
    private $exito;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $iplocal;

    /**
     * @var string
     */
    private $ipremota;

    /**
     * @var string
     */
    private $login;


    /**
     * Get idlogAcceso
     *
     * @return integer
     */
    public function getIdlogAcceso()
    {
        return $this->idlogAcceso;
    }

    /**
     * Set exito
     *
     * @param integer $exito
     *
     * @return LogAccesoEditor
     */
    public function setExito($exito)
    {
        $this->exito = $exito;

        return $this;
    }

    /**
     * Get exito
     *
     * @return integer
     */
    public function getExito()
    {
        return $this->exito;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return LogAccesoEditor
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
     * Set iplocal
     *
     * @param string $iplocal
     *
     * @return LogAccesoEditor
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
     * @return LogAccesoEditor
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
     * Set login
     *
     * @param string $login
     *
     * @return LogAccesoEditor
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
}

