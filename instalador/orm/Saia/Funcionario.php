<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 *
 * @ORM\Table(name="funcionario", indexes={@ORM\Index(name="i_funcionario_estado", columns={"estado"})}, uniqueConstraints={@ORM\UniqueConstraint(name="u_funcionario_codigo", columns={"funcionario_codigo"}), @ORM\UniqueConstraint(name="u_funcionario_login", columns={"login"})})
 * @ORM\Entity
 */
class Funcionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=true)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="firma", type="blob", nullable=true)
     */
    private $firma;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_temporal", type="blob", length=16777215, nullable=true)
     */
    private $firmaTemporal;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_original", type="blob", length=16777215, nullable=true)
     */
    private $firmaOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = 1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime", nullable=true)
     */
    private $fechaIngreso = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=false)
     */
    private $clave = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=100, nullable=false)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="perfil", type="string", length=255, nullable=false)
     */
    private $perfil = '6';

    /**
     * @var boolean
     *
     * @ORM\Column(name="debe_firmar", type="boolean", nullable=false)
     */
    private $debeFirmar = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=1, nullable=false)
     */
    private $tipo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultimo_pwd", type="datetime", nullable=true)
     */
    private $ultimoPwd;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajeria", type="string", length=1, nullable=true)
     */
    private $mensajeria;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sistema", type="boolean", nullable=false)
     */
    private $sistema = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="email_contrasena", type="string", length=255, nullable=true)
     */
    private $emailContrasena;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin_inactivo", type="date", nullable=true)
     */
    private $fechaFinInactivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="intento_login", type="integer", nullable=true)
     */
    private $intentoLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="foto_original", type="text", length=65535, nullable=true)
     */
    private $fotoOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="foto_recorte", type="text", length=65535, nullable=true)
     */
    private $fotoRecorte;

    /**
     * @var string
     *
     * @ORM\Column(name="foto_cordenadas", type="string", length=255, nullable=true)
     */
    private $fotoCordenadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ventanilla_radicacion", type="integer", nullable=true)
     */
    private $ventanillaRadicacion;



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
     * Set funcionarioCodigo
     *
     * @param integer $funcionarioCodigo
     *
     * @return Funcionario
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
     * @return Funcionario
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
     * @return Funcionario
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Funcionario
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
     * Set firma
     *
     * @param string $firma
     *
     * @return Funcionario
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return string
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set firmaTemporal
     *
     * @param string $firmaTemporal
     *
     * @return Funcionario
     */
    public function setFirmaTemporal($firmaTemporal)
    {
        $this->firmaTemporal = $firmaTemporal;

        return $this;
    }

    /**
     * Get firmaTemporal
     *
     * @return string
     */
    public function getFirmaTemporal()
    {
        return $this->firmaTemporal;
    }

    /**
     * Set firmaOriginal
     *
     * @param string $firmaOriginal
     *
     * @return Funcionario
     */
    public function setFirmaOriginal($firmaOriginal)
    {
        $this->firmaOriginal = $firmaOriginal;

        return $this;
    }

    /**
     * Get firmaOriginal
     *
     * @return string
     */
    public function getFirmaOriginal()
    {
        return $this->firmaOriginal;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Funcionario
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
     * @return Funcionario
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
     * Set clave
     *
     * @param string $clave
     *
     * @return Funcionario
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
     * Set nit
     *
     * @param string $nit
     *
     * @return Funcionario
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set perfil
     *
     * @param string $perfil
     *
     * @return Funcionario
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get perfil
     *
     * @return string
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set debeFirmar
     *
     * @param boolean $debeFirmar
     *
     * @return Funcionario
     */
    public function setDebeFirmar($debeFirmar)
    {
        $this->debeFirmar = $debeFirmar;

        return $this;
    }

    /**
     * Get debeFirmar
     *
     * @return boolean
     */
    public function getDebeFirmar()
    {
        return $this->debeFirmar;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Funcionario
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
     * @return Funcionario
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

    /**
     * Set mensajeria
     *
     * @param string $mensajeria
     *
     * @return Funcionario
     */
    public function setMensajeria($mensajeria)
    {
        $this->mensajeria = $mensajeria;

        return $this;
    }

    /**
     * Get mensajeria
     *
     * @return string
     */
    public function getMensajeria()
    {
        return $this->mensajeria;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Funcionario
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
     * Set sistema
     *
     * @param boolean $sistema
     *
     * @return Funcionario
     */
    public function setSistema($sistema)
    {
        $this->sistema = $sistema;

        return $this;
    }

    /**
     * Get sistema
     *
     * @return boolean
     */
    public function getSistema()
    {
        return $this->sistema;
    }

    /**
     * Set emailContrasena
     *
     * @param string $emailContrasena
     *
     * @return Funcionario
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Funcionario
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
     * @return Funcionario
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
     * Set fechaFinInactivo
     *
     * @param \DateTime $fechaFinInactivo
     *
     * @return Funcionario
     */
    public function setFechaFinInactivo($fechaFinInactivo)
    {
        $this->fechaFinInactivo = $fechaFinInactivo;

        return $this;
    }

    /**
     * Get fechaFinInactivo
     *
     * @return \DateTime
     */
    public function getFechaFinInactivo()
    {
        return $this->fechaFinInactivo;
    }

    /**
     * Set intentoLogin
     *
     * @param integer $intentoLogin
     *
     * @return Funcionario
     */
    public function setIntentoLogin($intentoLogin)
    {
        $this->intentoLogin = $intentoLogin;

        return $this;
    }

    /**
     * Get intentoLogin
     *
     * @return integer
     */
    public function getIntentoLogin()
    {
        return $this->intentoLogin;
    }

    /**
     * Set fotoOriginal
     *
     * @param string $fotoOriginal
     *
     * @return Funcionario
     */
    public function setFotoOriginal($fotoOriginal)
    {
        $this->fotoOriginal = $fotoOriginal;

        return $this;
    }

    /**
     * Get fotoOriginal
     *
     * @return string
     */
    public function getFotoOriginal()
    {
        return $this->fotoOriginal;
    }

    /**
     * Set fotoRecorte
     *
     * @param string $fotoRecorte
     *
     * @return Funcionario
     */
    public function setFotoRecorte($fotoRecorte)
    {
        $this->fotoRecorte = $fotoRecorte;

        return $this;
    }

    /**
     * Get fotoRecorte
     *
     * @return string
     */
    public function getFotoRecorte()
    {
        return $this->fotoRecorte;
    }

    /**
     * Set fotoCordenadas
     *
     * @param string $fotoCordenadas
     *
     * @return Funcionario
     */
    public function setFotoCordenadas($fotoCordenadas)
    {
        $this->fotoCordenadas = $fotoCordenadas;

        return $this;
    }

    /**
     * Get fotoCordenadas
     *
     * @return string
     */
    public function getFotoCordenadas()
    {
        return $this->fotoCordenadas;
    }

    /**
     * Set ventanillaRadicacion
     *
     * @param integer $ventanillaRadicacion
     *
     * @return Funcionario
     */
    public function setVentanillaRadicacion($ventanillaRadicacion)
    {
        $this->ventanillaRadicacion = $ventanillaRadicacion;

        return $this;
    }

    /**
     * Get ventanillaRadicacion
     *
     * @return integer
     */
    public function getVentanillaRadicacion()
    {
        return $this->ventanillaRadicacion;
    }
}
