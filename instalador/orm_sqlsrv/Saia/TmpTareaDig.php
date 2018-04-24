<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TmpTareaDig
 *
 * @ORM\Table(name="tmp_tarea_dig")
 * @ORM\Entity
 */
class TmpTareaDig
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtarea_dig", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';


}
