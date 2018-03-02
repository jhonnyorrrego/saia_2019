<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoExpediente
 *
 * @ORM\Table(name="reemplazo_expediente")
 * @ORM\Entity
 */
class ReemplazoExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_expediente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazoExpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_identidad_expediente", type="string", length=255, nullable=false)
     */
    private $fkIdentidadExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idreemplazo_saia", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;


}
