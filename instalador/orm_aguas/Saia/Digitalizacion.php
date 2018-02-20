<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Digitalizacion
 *
 * @ORM\Table(name="DIGITALIZACION", indexes={@ORM\Index(name="i_digitalizacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_digitalizaci_funcionario", columns={"FUNCIONARIO"})})
 * @ORM\Entity
 */
class Digitalizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDIGITALIZACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DIGITALIZACION_IDDIGITALIZACIO", allocationSize=1, initialValue=1)
     */
    private $iddigitalizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="string", length=255, nullable=false)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION", type="text", nullable=true)
     */
    private $justificacion;


}
