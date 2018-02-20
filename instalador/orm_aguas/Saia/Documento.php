<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table(name="DOCUMENTO", indexes={@ORM\Index(name="i_documento_ejecutor", columns={"EJECUTOR"}), @ORM\Index(name="i_documento_plantilla", columns={"PLANTILLA"}), @ORM\Index(name="doc_desc_ctx_ix", columns={"DESCRIPCION"}), @ORM\Index(name="i_documento_fecha", columns={"FECHA"}), @ORM\Index(name="nls_desc_index", columns={"SYS_NC00032$"}), @ORM\Index(name="i_documento_estado", columns={"ESTADO"})})
 * @ORM\Entity
 */
class Documento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_IDDOCUMENTO_seq", allocationSize=1, initialValue=1)
     */
    private $iddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO", type="string", length=50, nullable=false)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE", type="integer", nullable=false)
     */
    private $serie = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="EJECUTOR", type="string", length=255, nullable=false)
     */
    private $ejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion = 'empty_clob()';

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINAS", type="integer", nullable=true)
     */
    private $paginas = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="MUNICIPIO_IDMUNICIPIO", type="integer", nullable=false)
     */
    private $municipioIdmunicipio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PDF", type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_RADICADO", type="integer", nullable=false)
     */
    private $tipoRadicado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_OFICIO", type="date", nullable=true)
     */
    private $fechaOficio;

    /**
     * @var string
     *
     * @ORM\Column(name="OFICIO", type="string", length=20, nullable=true)
     */
    private $oficio;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_ANEXO", type="text", nullable=true)
     */
    private $descripcionAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ALMACENADO", type="integer", nullable=false)
     */
    private $almacenado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PLANTILLA", type="string", length=255, nullable=true)
     */
    private $plantilla;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPONSABLE", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DESPACHO", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var string
     *
     * @ORM\Column(name="GUIA", type="string", length=50, nullable=true)
     */
    private $guia;

    /**
     * @var integer
     *
     * @ORM\Column(name="GUIA_EMPRESA", type="integer", nullable=true)
     */
    private $guiaEmpresa = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_EJECUTOR", type="integer", nullable=true)
     */
    private $tipoEjecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVA_ADMIN", type="string", length=255, nullable=true)
     */
    private $activaAdmin = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PDF_HASH", type="string", length=255, nullable=true)
     */
    private $pdfHash;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=true)
     */
    private $formatoIdformato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_ANTIGUO", type="integer", nullable=true)
     */
    private $documentoAntiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDVERSION_DOCUMENTO", type="integer", nullable=true)
     */
    private $fkIdversionDocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="VERSION", type="integer", nullable=true)
     */
    private $version = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_LIMITE", type="date", nullable=true)
     */
    private $fechaLimite;

    /**
     * @var string
     *
     * @ORM\Column(name="DIAS", type="string", length=255, nullable=true)
     */
    private $dias;


}
