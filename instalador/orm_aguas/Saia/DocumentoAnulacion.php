<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoAnulacion
 *
 * @ORM\Table(name="documento_anulacion", indexes={@ORM\Index(name="i_documento_an_funcionario", columns={"funcionario"}), @ORM\Index(name="i_documento_anulacion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoAnulacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_anulacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoAnulacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anulacion", type="date", nullable=true)
     */
    private $fechaAnulacion;


}
