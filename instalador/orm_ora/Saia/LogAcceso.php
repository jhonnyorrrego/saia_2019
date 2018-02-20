<?php

namespace Saia;

/**
 * LogAcceso
 */
class LogAcceso
{
    /**
     * @var integer
     */
    private $idlogAcceso;

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
     * @var boolean
     */
    private $exito;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var \DateTime
     */
    private $fechaCierre;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $idsesionPhp;

    /**
     * @var string
     */
    private $sesionPhp;


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
     * Set login
     *
     * @param string $login
     *
     * @return LogAcceso
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
     * @return LogAcceso
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
     * @return LogAcceso
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
     * Set exito
     *
     * @param boolean $exito
     *
     * @return LogAcceso
     */
    public function setExito($exito)
    {
        $this->exito = $exito;

        return $this;
    }

    /**
     * Get exito
     *
     * @return boolean
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
     * @return LogAcceso
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
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     *
     * @return LogAcceso
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return LogAcceso
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
     * Set idsesionPhp
     *
     * @param string $idsesionPhp
     *
     * @return LogAcceso
     */
    public function setIdsesionPhp($idsesionPhp)
    {
        $this->idsesionPhp = $idsesionPhp;

        return $this;
    }

    /**
     * Get idsesionPhp
     *
     * @return string
     */
    public function getIdsesionPhp()
    {
        return $this->idsesionPhp;
    }

    /**
     * Set sesionPhp
     *
     * @param string $sesionPhp
     *
     * @return LogAcceso
     */
    public function setSesionPhp($sesionPhp)
    {
        $this->sesionPhp = $sesionPhp;

        return $this;
    }

    /**
     * Get sesionPhp
     *
     * @return string
     */
    public function getSesionPhp()
    {
        return $this->sesionPhp;
    }
}

