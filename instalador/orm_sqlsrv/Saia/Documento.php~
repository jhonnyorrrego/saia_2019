<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table(name="documento", indexes={@ORM\Index(name="serie", columns={"serie", "fecha", "tipo_radicado", "estado"}), @ORM\Index(name="fecha", columns={"fecha"}), @ORM\Index(name="estado", columns={"estado"}), @ORM\Index(name="ejecutor", columns={"ejecutor"}), @ORM\Index(name="pantalla_idpantalla", columns={"pantalla_idpantalla"})})
 * @ORM\Entity
 */
class Documento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255, nullable=false)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie", type="integer", nullable=false)
     */
    private $serie = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="ejecutor", type="string", length=255, nullable=false)
     */
    private $ejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_radicado", type="integer", nullable=false)
     */
    private $tipoRadicado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="dias", type="string", length=255, nullable=true)
     */
    private $dias;

    /**
     * @var string
     *
     * @ORM\Column(name="plantilla", type="string", length=255, nullable=false)
     */
    private $plantilla;

    /**
     * @var string
     *
     * @ORM\Column(name="activa_admin", type="string", length=255, nullable=false)
     */
    private $activaAdmin = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ejecutor", type="string", length=255, nullable=true)
     */
    private $tipoEjecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="pantalla_idpantalla", type="string", length=255, nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="paginas", type="integer", nullable=true)
     */
    private $paginas = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="municipio_idmunicipio", type="integer", nullable=false)
     */
    private $municipioIdmunicipio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=600, nullable=true)
     */
    private $pdf;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf_hash", type="string", length=255, nullable=true)
     */
    private $pdfHash;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_oficio", type="date", nullable=true)
     */
    private $fechaOficio;

    /**
     * @var string
     *
     * @ORM\Column(name="oficio", type="string", length=20, nullable=true)
     */
    private $oficio;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_anexo", type="text", length=16777215, nullable=true)
     */
    private $descripcionAnexo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="almacenado", type="boolean", nullable=false)
     */
    private $almacenado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="guia", type="string", length=50, nullable=true)
     */
    private $guia;

    /**
     * @var integer
     *
     * @ORM\Column(name="guia_empresa", type="integer", nullable=true)
     */
    private $guiaEmpresa = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_despacho", type="string", length=255, nullable=true)
     */
    private $tipoDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=true)
     */
    private $formatoIdformato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_antiguo", type="integer", nullable=true)
     */
    private $documentoAntiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=true)
     */
    private $fkIdversionDocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=true)
     */
    private $version = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=true)
     */
    private $fechaLimite;

    /**
     * @var integer
     *
     * @ORM\Column(name="ventanilla_radicacion", type="integer", nullable=true)
     */
    private $ventanillaRadicacion = '0';


}

