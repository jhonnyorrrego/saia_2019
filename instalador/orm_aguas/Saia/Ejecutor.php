<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ejecutor
 *
 * @ORM\Table(name="EJECUTOR", indexes={@ORM\Index(name="i_ejecutor_identificaci", columns={"IDENTIFICACION"})})
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
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="IDENTIFICACION", type="string", length=50, nullable=true)
     */
    private $identificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=false)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_EJECUTOR", type="integer", nullable=true)
     */
    private $tipoEjecutor = '1';


}
