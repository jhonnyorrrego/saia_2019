<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoEtiqueta
 *
 * @ORM\Table(name="documento_etiqueta", indexes={@ORM\Index(name="i_doc_etiq_etiq_idetiqueta", columns={"etiqueta_idetiqueta"}), @ORM\Index(name="i_documento_etiqueta_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoEtiqueta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_etiqueta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoEtiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="etiqueta_idetiqueta", type="integer", nullable=false)
     */
    private $etiquetaIdetiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
