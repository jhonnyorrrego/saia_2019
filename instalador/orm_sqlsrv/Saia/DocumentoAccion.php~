<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoAccion
 *
 * @ORM\Table(name="documento_accion", indexes={@ORM\Index(name="i_documento_accion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_idaccion", type="integer", nullable=true)
     */
    private $accionIdaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;


}

