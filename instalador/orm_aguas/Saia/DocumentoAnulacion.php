<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoAnulacion
 *
 * @ORM\Table(name="DOCUMENTO_ANULACION", indexes={@ORM\Index(name="i_documento_an_funcionario", columns={"FUNCIONARIO"}), @ORM\Index(name="i_documento_anulacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DocumentoAnulacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_ANULACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_ANULACION_IDDOCUMENT", allocationSize=1, initialValue=1)
     */
    private $iddocumentoAnulacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_SOLICITUD", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ANULACION", type="date", nullable=true)
     */
    private $fechaAnulacion;


}
