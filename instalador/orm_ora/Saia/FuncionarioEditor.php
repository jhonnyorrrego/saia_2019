<?php

namespace Saia;

/**
 * FuncionarioEditor
 */
class FuncionarioEditor
{
    /**
     * @var integer
     */
    private $idfuncionario;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $clave;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $emailContrasena;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $fechaIngreso;

    /**
     * @var integer
     */
    private $funcionarioCodigo;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $nombres;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \DateTime
     */
    private $ultimoPwd;


    /**
     * Get idfuncionario
     *
     * @return integer
     */
    public function getIdfuncionario()
    {
        return $this->idfuncionario;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return FuncionarioEditor
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return FuncionarioEditor
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return FuncionarioEditor
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
     * Set emailContrasena
     *
     * @param string $emailContrasena
     *
     * @return FuncionarioEditor
     */
    public function setEmailContrasena($emailContrasena)
    {
        $this->emailContrasena = $emailContrasena;

        return $this;
    }

    /**
     * Get emailContrasena
     *
     * @return string
     */
    public function getEmailContrasena()
    {
        return $this->emailContrasena;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return FuncionarioEditor
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

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return FuncionarioEditor
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set funcionarioCodigo
     *
     * @param integer $funcionarioCodigo
     *
     * @return FuncionarioEditor
     */
    public function setFuncionarioCodigo($funcionarioCodigo)
    {
        $this->funcionarioCodigo = $funcionarioCodigo;

        return $this;
    }

    /**
     * Get funcionarioCodigo
     *
     * @return integer
     */
    public function getFuncionarioCodigo()
    {
        return $this->funcionarioCodigo;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return FuncionarioEditor
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
     * Set nombres
     *
     * @param string $nombres
     *
     * @return FuncionarioEditor
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FuncionarioEditor
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set ultimoPwd
     *
     * @param \DateTime $ultimoPwd
     *
     * @return FuncionarioEditor
     */
    public function setUltimoPwd($ultimoPwd)
    {
        $this->ultimoPwd = $ultimoPwd;

        return $this;
    }

    /**
     * Get ultimoPwd
     *
     * @return \DateTime
     */
    public function getUltimoPwd()
    {
        return $this->ultimoPwd;
    }
}

