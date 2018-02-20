<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoDocumento
 *
 * @ORM\Table(name="ESTADO_DOCUMENTO")
 * @ORM\Entity
 */
class EstadoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDESTADO_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ESTADO_DOCUMENTO_IDESTADO_DOCU", allocationSize=1, initialValue=1)
     */
    private $idestadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="EN_USO", type="integer", nullable=false)
     */
    private $enUso = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;


}
