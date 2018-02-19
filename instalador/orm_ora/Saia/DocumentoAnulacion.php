<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoAnulacion
 *
 * @ORM\Table(name="DOCUMENTO_ANULACION", indexes={@ORM\Index(name="documento_anulacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=true)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_SOLICITUD", type="date", nullable=true)
     */
    private $fechaSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=3000, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ANULACION", type="date", nullable=true)
     */
    private $fechaAnulacion;


}
