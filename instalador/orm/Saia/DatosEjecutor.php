<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosEjecutor
 *
 * @ORM\Table(name="datos_ejecutor", indexes={@ORM\Index(name="i_datos_ejecut_ejecutor_ide", columns={"ejecutor_idejecutor"}), @ORM\Index(name="i_datos_ejecut_ciudad", columns={"ciudad"})})
 * @ORM\Entity
 */
class DatosEjecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddatos_ejecutor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddatosEjecutor;

    /**
     * @var integer
     *
     * @ORM\Column(name="ejecutor_idejecutor", type="integer", nullable=false)
     */
    private $ejecutorIdejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ciudad", type="integer", nullable=true)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=50, nullable=true)
     */
    private $titulo = 'Se&ntilde;or';

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=255, nullable=true)
     */
    private $empresa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;



    /**
     * Get iddatosEjecutor
     *
     * @return integer
     */
    public function getIddatosEjecutor()
    {
        return $this->iddatosEjecutor;
    }

    /**
     * Set ejecutorIdejecutor
     *
     * @param integer $ejecutorIdejecutor
     *
     * @return DatosEjecutor
     */
    public function setEjecutorIdejecutor($ejecutorIdejecutor)
    {
        $this->ejecutorIdejecutor = $ejecutorIdejecutor;

        return $this;
    }

    /**
     * Get ejecutorIdejecutor
     *
     * @return integer
     */
    public function getEjecutorIdejecutor()
    {
        return $this->ejecutorIdejecutor;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return DatosEjecutor
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return DatosEjecutor
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     *
     * @return DatosEjecutor
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set ciudad
     *
     * @param integer $ciudad
     *
     * @return DatosEjecutor
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return integer
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return DatosEjecutor
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     *
     * @return DatosEjecutor
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return DatosEjecutor
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
     * Set email
     *
     * @param string $email
     *
     * @return DatosEjecutor
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return DatosEjecutor
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }
}
