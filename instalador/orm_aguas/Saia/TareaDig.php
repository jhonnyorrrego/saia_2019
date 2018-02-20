<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareaDig
 *
 * @ORM\Table(name="tarea_dig", indexes={@ORM\Index(name="i_tarea_dig_iddocumento", columns={"iddocumento"}), @ORM\Index(name="i_tarea_dig_idfuncionari", columns={"idfuncionario"})})
 * @ORM\Entity
 */
class TareaDig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtarea_dig", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareaDig;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario", type="integer", nullable=false)
     */
    private $idfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento", type="integer", nullable=false)
     */
    private $iddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_ip", type="string", length=20, nullable=true)
     */
    private $direccionIp;


}
