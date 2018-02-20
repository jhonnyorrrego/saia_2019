<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoEtiqueta
 *
 * @ORM\Table(name="DOCUMENTO_ETIQUETA", indexes={@ORM\Index(name="i_documento_etiqueta_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DocumentoEtiqueta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_ETIQUETA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_ETIQUETA_IDDOCUMENTO", allocationSize=1, initialValue=1)
     */
    private $iddocumentoEtiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ETIQUETA_IDETIQUETA", type="integer", nullable=false)
     */
    private $etiquetaIdetiqueta;

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
    private $fecha = 'SYSDATE';


}
