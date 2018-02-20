<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoAccion
 *
 * @ORM\Table(name="DOCUMENTO_ACCION", indexes={@ORM\Index(name="i_documento_accion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DocumentoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_ACCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_ACCION_IDDOCUMENTO_A", allocationSize=1, initialValue=1)
     */
    private $iddocumentoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_IDACCION", type="integer", nullable=true)
     */
    private $accionIdaccion;

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


}
