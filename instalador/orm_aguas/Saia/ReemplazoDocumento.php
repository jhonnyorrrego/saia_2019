<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoDocumento
 *
 * @ORM\Table(name="REEMPLAZO_DOCUMENTO", indexes={@ORM\Index(name="i_reemplazo_documento_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class ReemplazoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREEMPLAZO_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REEMPLAZO_DOCUMENTO_IDREEMPLAZ", allocationSize=1, initialValue=1)
     */
    private $idreemplazoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDREEMPLAZO_SAIA", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_REEMPLAZO_DOC", type="integer", nullable=false)
     */
    private $tipoReemplazoDoc;


}
