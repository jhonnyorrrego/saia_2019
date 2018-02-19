<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntregaDocumentos
 *
 * @ORM\Table(name="FT_ENTREGA_DOCUMENTOS", indexes={@ORM\Index(name="ft_entrega_documentos_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_ft_radicacion_salida", columns={"FT_RADICACION_SALIDA"})})
 * @ORM\Entity
 */
class FtEntregaDocumentos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RADICACION_SALIDA", type="integer", nullable=true)
     */
    private $ftRadicacionSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '423';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ENTREGA_DOCUMENTOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ENTREGA_DOCUMENTOS_IDFT_ENT", allocationSize=1, initialValue=1)
     */
    private $idftEntregaDocumentos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=true)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=true)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=true)
     */
    private $firma = '1';


}

