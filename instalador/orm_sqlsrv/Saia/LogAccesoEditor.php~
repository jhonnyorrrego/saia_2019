<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogAccesoEditor
 *
 * @ORM\Table(name="log_acceso_editor")
 * @ORM\Entity
 */
class LogAccesoEditor
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
     * @var integer
     *
     * @ORM\Column(name="exito", type="integer", nullable=false)
     */
    private $exito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

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
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=100, nullable=false)
     */
    private $login;


}

