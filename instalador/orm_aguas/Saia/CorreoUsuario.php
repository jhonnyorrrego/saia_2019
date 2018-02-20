<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CorreoUsuario
 *
 * @ORM\Table(name="CORREO_USUARIO", indexes={@ORM\Index(name="i_correo_usuar_idcorreo", columns={"IDCORREO"}), @ORM\Index(name="i_correo_usu_asunto_ctx", columns={"ASUNTO"}), @ORM\Index(name="i_correo_usu_de_ctx", columns={"DE"}), @ORM\Index(name="i_correo_usu_para_ctx", columns={"PARA"})})
 * @ORM\Entity
 */
class CorreoUsuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCORREO_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CORREO_USUARIO_IDCORREO_USUARI", allocationSize=1, initialValue=1)
     */
    private $idcorreoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="PARA", type="text", nullable=false)
     */
    private $para;

    /**
     * @var string
     *
     * @ORM\Column(name="DE", type="text", nullable=false)
     */
    private $de;

    /**
     * @var string
     *
     * @ORM\Column(name="ASUNTO", type="text", nullable=true)
     */
    private $asunto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDCORREO", type="integer", nullable=false)
     */
    private $idcorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIFICACION", type="string", length=255, nullable=false)
     */
    private $codificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado;


}

