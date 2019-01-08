<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogAcceso
 *
 * @ORM\Table(name="log_acceso")
 * @ORM\Entity
 */
class LogAcceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlog_acceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlogAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=100, nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="iplocal", type="string", length=30, nullable=false)
     */
    private $iplocal;

    /**
     * @var string
     *
     * @ORM\Column(name="ipremota", type="string", length=50, nullable=true)
     */
    private $ipremota;

    /**
     * @var boolean
     *
     * @ORM\Column(name="exito", type="boolean", nullable=false)
     */
    private $exito = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="datetime", nullable=true)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="idsesion_php", type="string", length=255, nullable=false)
     */
    private $idsesionPhp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sesion_php", type="text", length=65535, nullable=false)
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
