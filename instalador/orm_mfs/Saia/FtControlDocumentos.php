<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtControlDocumentos
 *
 * @ORM\Table(name="ft_control_documentos")
 * @ORM\Entity
 */
class FtControlDocumentos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_control_documentos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftControlDocumentos;

    /**
     * @var string
     *
     * @ORM\Column(name="almacenamiento", type="string", length=255, nullable=true)
     */
    private $almacenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado", type="string", length=255, nullable=false)
     */
    private $aprobado;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_calidad", type="string", length=255, nullable=true)
     */
    private $documentoCalidad;

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
     * @ORM\Column(name="fecha_confirmacion", type="date", nullable=true)
     */
    private $fechaConfirmacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_calidad", type="integer", nullable=true)
     */
    private $iddocumentoCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idformato_calidad", type="integer", nullable=true)
     */
    private $idformatoCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=false)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="listado_procesos", type="string", length=255, nullable=false)
     */
    private $listadoProcesos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_documento", type="string", length=255, nullable=true)
     */
    private $nombreDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="otros_documentos", type="integer", nullable=true)
     */
    private $otrosDocumentos;

    /**
     * @var string
     *
     * @ORM\Column(name="propuesta", type="text", length=65535, nullable=true)
     */
    private $propuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="revisado", type="string", length=255, nullable=false)
     */
    private $revisado;

    /**
     * @var string
     *
     * @ORM\Column(name="secretaria", type="string", length=255, nullable=true)
     */
    private $secretaria;

    /**
     * @var string
     *
     * @ORM\Column(name="serie_doc_control", type="string", length=255, nullable=true)
     */
    private $serieDocControl;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1247';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_documento", type="integer", nullable=false)
     */
    private $tipoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_solicitud", type="integer", nullable=false)
     */
    private $tipoSolicitud = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=true)
     */
    private $version;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_doc_calidad", type="integer", nullable=true)
     */
    private $estadoDocCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_version", type="integer", nullable=true)
     */
    private $iddocumentoVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfunc_fecha_confir", type="integer", nullable=true)
     */
    private $idfuncFechaConfir;


}

