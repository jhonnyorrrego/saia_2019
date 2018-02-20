<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoExpediente
 *
 * @ORM\Table(name="REEMPLAZO_EXPEDIENTE")
 * @ORM\Entity
 */
class ReemplazoExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREEMPLAZO_EXPEDIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REEMPLAZO_EXPEDIENTE_IDREEMPLA", allocationSize=1, initialValue=1)
     */
    private $idreemplazoExpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="FK_IDENTIDAD_EXPEDIENTE", type="string", length=255, nullable=false)
     */
    private $fkIdentidadExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDREEMPLAZO_SAIA", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;


}
