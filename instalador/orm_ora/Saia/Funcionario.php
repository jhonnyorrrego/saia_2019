<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 *
 * @ORM\Table(name="funcionario", uniqueConstraints={@ORM\Index(name="i_funcionario_estado", columns={"estado"}), @ORM\UniqueConstraint(name="u_funcionario_codigo", columns={"funcionario_codigo"}), @ORM\UniqueConstraint(name="u_funcionario_login", columns={"login"})})
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
    private $login;

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
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=false)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=100, nullable=true)
     */
    private $nit;

    /**
     * @var integer
     *
     * @ORM\Column(name="debe_firmar", type="integer", nullable=true)
     */
    private $debeFirmar = '1';

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
     * @var integer
     *
     * @ORM\Column(name="sistema", type="integer", nullable=true)
     */
    private $sistema = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=1, nullable=false)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultimo_pwd", type="date", nullable=true)
     */
    private $ultimoPwd;

    /**
     * @var string
     *
     * @ORM\Column(name="acceso_web", type="string", length=10, nullable=true)
     */
    private $accesoWeb;

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
     * @var string
     *
     * @ORM\Column(name="clave_bk", type="string", length=255, nullable=true)
     */
    private $claveBk;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_clave", type="integer", nullable=true)
     */
    private $estadoClave;

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
     * @ORM\Column(name="foto_original", type="text", nullable=true)
     */
    private $fotoOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="foto_recorte", type="text", nullable=true)
     */
    private $fotoRecorte;

    /**
     * @var string
     *
     * @ORM\Column(name="foto_cordenadas", type="string", length=255, nullable=true)
     */
    private $fotoCordenadas;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_temporal", type="blob", nullable=true)
     */
    private $firmaTemporal;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_original", type="blob", nullable=true)
     */
    private $firmaOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="perfil", type="string", length=255, nullable=true)
     */
    private $perfil;

    /**
     * @var string
     *
     * @ORM\Column(name="login_bk", type="string", length=255, nullable=true)
     */
    private $loginBk;


}
