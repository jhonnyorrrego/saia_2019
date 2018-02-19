<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 *
 * @ORM\Table(name="FUNCIONARIO", indexes={@ORM\Index(name="funcionario_cod", columns={"FUNCIONARIO_CODIGO"})})
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
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=true)
     */
    private $funcionarioCodigo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=255, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=true)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="CLAVE", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="PERFIL", type="integer", nullable=true)
     */
    private $perfil = '6';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEBE_FIRMAR", type="integer", nullable=true)
     */
    private $debeFirmar = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=1, nullable=true)
     */
    private $tipo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA", type="blob", nullable=true)
     */
    private $firma = 'EMPTY_BLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="MENSAJERIA", type="string", length=1, nullable=true)
     */
    private $mensajeria;

    /**
     * @var integer
     *
     * @ORM\Column(name="SISTEMA", type="integer", nullable=true)
     */
    private $sistema = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL_CONTRASENA", type="string", length=255, nullable=true)
     */
    private $emailContrasena;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ULTIMO_PWD", type="date", nullable=true)
     */
    private $ultimoPwd;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCESO_WEB", type="string", length=255, nullable=true)
     */
    private $accesoWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="CLAVE_BK", type="string", length=255, nullable=true)
     */
    private $claveBk;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTUALIZAR_CLAVE", type="integer", nullable=true)
     */
    private $actualizarClave = '1';


}

