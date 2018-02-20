<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 *
 * @ORM\Table(name="FUNCIONARIO", indexes={@ORM\Index(name="i_funcionario_estado", columns={"ESTADO"}), @ORM\Index(name="i_funcionario_funcionario_", columns={"FUNCIONARIO_CODIGO"}), @ORM\Index(name="i_funcionario_login", columns={"LOGIN"})})
 * @ORM\Entity
 */
class Funcionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONARIO_IDFUNCIONARIO_seq", allocationSize=1, initialValue=1)
     */
    private $idfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="string", length=255, nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=255, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRES", type="string", length=255, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS", type="string", length=255, nullable=true)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA", type="blob", nullable=true)
     */
    private $firma;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(name="CLAVE", type="string", length=255, nullable=false)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="NIT", type="string", length=100, nullable=true)
     */
    private $nit;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEBE_FIRMAR", type="integer", nullable=true)
     */
    private $debeFirmar = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="MENSAJERIA", type="string", length=1, nullable=true)
     */
    private $mensajeria;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="SISTEMA", type="integer", nullable=true)
     */
    private $sistema = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=1, nullable=false)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ULTIMO_PWD", type="date", nullable=true)
     */
    private $ultimoPwd;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCESO_WEB", type="string", length=10, nullable=true)
     */
    private $accesoWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL_CONTRASENA", type="string", length=255, nullable=true)
     */
    private $emailContrasena;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="CLAVE_BK", type="string", length=255, nullable=true)
     */
    private $claveBk;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_CLAVE", type="integer", nullable=true)
     */
    private $estadoClave;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FIN_INACTIVO", type="date", nullable=true)
     */
    private $fechaFinInactivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="INTENTO_LOGIN", type="integer", nullable=true)
     */
    private $intentoLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="FOTO_ORIGINAL", type="text", nullable=true)
     */
    private $fotoOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="FOTO_RECORTE", type="text", nullable=true)
     */
    private $fotoRecorte;

    /**
     * @var string
     *
     * @ORM\Column(name="FOTO_CORDENADAS", type="string", length=255, nullable=true)
     */
    private $fotoCordenadas;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA_TEMPORAL", type="blob", nullable=true)
     */
    private $firmaTemporal;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA_ORIGINAL", type="blob", nullable=true)
     */
    private $firmaOriginal;

    /**
     * @var string
     *
     * @ORM\Column(name="PERFIL", type="string", length=255, nullable=true)
     */
    private $perfil;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN_BK", type="string", length=255, nullable=true)
     */
    private $loginBk;


}
