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


}

