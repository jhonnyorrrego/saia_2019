<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoDocumento
 *
 * @ORM\Table(name="estado_documento", uniqueConstraints={@ORM\UniqueConstraint(name="u_estado_doc", columns={"estado"})})
 * @ORM\Entity
 */
class EstadoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idestado_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idestadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="en_uso", type="integer", nullable=false)
     */
    private $enUso = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;


}
