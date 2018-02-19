<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVerificacion
 *
 * @ORM\Table(name="DOCUMENTO_VERIFICACION", indexes={@ORM\Index(name="documento_verificacion_fecha", columns={"FECHA"}), @ORM\Index(name="documento_verificacion_fun", columns={"FUNCIONARIO_IDFUNCIONARIO"}), @ORM\Index(name="documento_verificacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DocumentoVerificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_VERIFICACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_VERIFICACION_IDDOCUM", allocationSize=1, initialValue=1)
     */
    private $iddocumentoVerificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="VERIFICACION", type="string", length=255, nullable=true)
     */
    private $verificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_QR", type="string", length=255, nullable=false)
     */
    private $rutaQr;


}

