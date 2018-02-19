<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogAcceso
 *
 * @ORM\Table(name="LOG_ACCESO")
 * @ORM\Entity
 */
class LogAcceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDLOG_ACCESO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="LOG_ACCESO_IDLOG_ACCESO_seq", allocationSize=1, initialValue=1)
     */
    private $idlogAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=100, nullable=true)
     */
    private $login = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="EXITO", type="integer", nullable=true)
     */
    private $exito = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="IDSESION_PHP", type="string", length=255, nullable=true)
     */
    private $idsesionPhp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="SESION_PHP", type="string", length=2000, nullable=true)
     */
    private $sesionPhp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="IPLOCAL", type="string", length=30, nullable=true)
     */
    private $iplocal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CIERRE", type="date", nullable=true)
     */
    private $fechaCierre;

    /**
     * @var string
     *
     * @ORM\Column(name="IPREMOTA", type="string", length=50, nullable=true)
     */
    private $ipremota;


}

