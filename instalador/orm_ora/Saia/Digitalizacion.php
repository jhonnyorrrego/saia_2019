<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Digitalizacion
 *
 * @ORM\Table(name="DIGITALIZACION", indexes={@ORM\Index(name="digitalizacion_funcionario", columns={"FUNCIONARIO"}), @ORM\Index(name="digitalizacion_fecha", columns={"FECHA"}), @ORM\Index(name="digitalizacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="string", length=255, nullable=true)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=true)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION", type="text", nullable=true)
     */
    private $justificacion = 'empty_clob()';


}

