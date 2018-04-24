<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoEtiqueta
 *
 * @ORM\Table(name="documento_etiqueta", indexes={@ORM\Index(name="etiqueta_idetiqueta", columns={"etiqueta_idetiqueta"}), @ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoEtiqueta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_etiqueta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';


}
