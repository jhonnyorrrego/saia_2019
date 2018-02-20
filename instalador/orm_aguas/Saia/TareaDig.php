<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareaDig
 *
 * @ORM\Table(name="TAREA_DIG", indexes={@ORM\Index(name="i_tarea_dig_iddocumento", columns={"IDDOCUMENTO"}), @ORM\Index(name="i_tarea_dig_idfuncionari", columns={"IDFUNCIONARIO"})})
 * @ORM\Entity
 */
class TareaDig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREA_DIG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREA_DIG_IDTAREA_DIG_seq", allocationSize=1, initialValue=1)
     */
    private $idtareaDig;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $idfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO", type="integer", nullable=false)
     */
    private $iddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION_IP", type="string", length=20, nullable=true)
     */
    private $direccionIp;


}
