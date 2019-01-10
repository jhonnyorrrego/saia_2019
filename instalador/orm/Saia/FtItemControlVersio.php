<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemControlVersio
 *
 * @ORM\Table(name="ft_item_control_versio")
 * @ORM\Entity
 */
class FtItemControlVersio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_control_versio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemControlVersio;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_control_documentos", type="integer", nullable=false)
     */
    private $ftControlDocumentos;

    /**
     * @var string
     *
     * @ORM\Column(name="almacenamiento_i", type="string", length=255, nullable=true)
     */
    private $almacenamientoI;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato_i", type="string", length=255, nullable=false)
     */
    private $anexoFormatoI;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_calidad_i", type="string", length=255, nullable=false)
     */
    private $documentoCalidadI;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_confirmacion_i", type="datetime", nullable=true)
     */
    private $fechaConfirmacionI;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_calidad_i", type="integer", nullable=false)
     */
    private $iddocumentoCalidadI;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_documento_i", type="string", length=255, nullable=true)
     */
    private $nombreDocumentoI;

    /**
     * @var integer
     *
     * @ORM\Column(name="origen_documento_i", type="integer", nullable=false)
     */
    private $origenDocumentoI = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="otros_documentos_i", type="integer", nullable=true)
     */
    private $otrosDocumentosI;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_doc_control_i", type="integer", nullable=true)
     */
    private $serieDocControlI;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_documento_i", type="integer", nullable=true)
     */
    private $tipoDocumentoI = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="version_i", type="integer", nullable=true)
     */
    private $versionI;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vigencia_i", type="date", nullable=true)
     */
    private $vigenciaI;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_doc_calidad_i", type="integer", nullable=true)
     */
    private $estadoDocCalidadI;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_version_i", type="integer", nullable=true)
     */
    private $iddocumentoVersionI;


}

