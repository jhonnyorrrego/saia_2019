<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteAbce
 *
 * @ORM\Table(name="expediente_abce")
 * @ORM\Entity
 */
class ExpedienteAbce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idexpediente_abce", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexpedienteAbce;

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_cierre", type="integer", nullable=false)
     */
    private $estadoCierre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="date", nullable=false)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_cierre", type="integer", nullable=false)
     */
    private $funcionarioCierre;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;


}
