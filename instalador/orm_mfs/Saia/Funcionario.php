<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 *
 * @ORM\Table(name="funcionario", uniqueConstraints={@ORM\UniqueConstraint(name="funcionario_codigo", columns={"funcionario_codigo"}), @ORM\UniqueConstraint(name="login", columns={"login"}), @ORM\UniqueConstraint(name="funcionario_codigo_2", columns={"funcionario_codigo"}), @ORM\UniqueConstraint(name="login_2", columns={"login"})})
 * @ORM\Entity
 */
class Funcionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo = '0';

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
     * @ORM\Column(name="firma", type="blob", length=16777215, nullable=true)
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
    private $estado = '1';

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
     * @var integer
     *
     * @ORM\Column(name="pertenece_nucleo", type="integer", nullable=false)
     */
    private $perteneceNucleo = '0';


}

