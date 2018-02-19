<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ejecutor
 *
 * @ORM\Table(name="EJECUTOR", indexes={@ORM\Index(name="ejecutor_nombre", columns={"NOMBRE"}), @ORM\Index(name="ejecutor_identificacion", columns={"IDENTIFICACION"})})
 * @ORM\Entity
 */
class Ejecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDEJECUTOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="EJECUTOR_IDEJECUTOR_seq", allocationSize=1, initialValue=1)
     */
    private $idejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="IDENTIFICACION", type="string", length=50, nullable=true)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=true)
     */
    private $fechaIngreso = 'SYSDATE';


}
