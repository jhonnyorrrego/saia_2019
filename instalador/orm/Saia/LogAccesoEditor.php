<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogAccesoEditor
 *
 * @ORM\Table(name="log_acceso_editor")
 * @ORM\Entity
 */
class LogAccesoEditor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlog_acceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idlogAcceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="exito", type="integer", nullable=false)
     */
    private $exito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

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
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=100, nullable=false)
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
