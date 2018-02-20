<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoDocumento
 *
 * @ORM\Table(name="reemplazo_documento", indexes={@ORM\Index(name="i_reemplazo_documento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class ReemplazoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idreemplazo_saia", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_reemplazo_doc", type="integer", nullable=false)
     */
    private $tipoReemplazoDoc;


}
