<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table(name="DOCUMENTO", indexes={@ORM\Index(name="documento_fecha", columns={"FECHA"}), @ORM\Index(name="documento_ejecutor", columns={"EJECUTOR"}), @ORM\Index(name="documento_municipio", columns={"MUNICIPIO_IDMUNICIPIO"}), @ORM\Index(name="documento_numero", columns={"NUMERO"}), @ORM\Index(name="documento_responsable", columns={"RESPONSABLE"}), @ORM\Index(name="documento_serie", columns={"SERIE"}), @ORM\Index(name="documento_tipo_radicado", columns={"TIPO_RADICADO"}), @ORM\Index(name="documento_plantilla", columns={"PLANTILLA"})})
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
     * @ORM\Column(name="NUMERO", type="string", length=50, nullable=true)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE", type="integer", nullable=true)
     */
    private $serie = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'TO_DATE(\'01-01-70 00:00:00\', \'dd-mm-yy hh24:mi:ss\')';

    /**
     * @var integer
     *
     * @ORM\Column(name="EJECUTOR", type="integer", nullable=true)
     */
    private $ejecutor = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=4000, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINAS", type="integer", nullable=true)
     */
    private $paginas = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="MUNICIPIO_IDMUNICIPIO", type="integer", nullable=true)
     */
    private $municipioIdmunicipio = '658';

    /**
     * @var string
     *
     * @ORM\Column(name="PDF", type="string", length=255, nullable=true)
     */
    private $pdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_RADICADO", type="integer", nullable=true)
     */
    private $tipoRadicado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=4000, nullable=true)
     */
    private $estado = 'INICIADO';

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
     * @ORM\Column(name="ANEXO", type="string", length=4000, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_ANEXO", type="string", length=4000, nullable=true)
     */
    private $descripcionAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DIAS", type="integer", nullable=true)
     */
    private $dias;

    /**
     * @var integer
     *
     * @ORM\Column(name="ALMACENADO", type="integer", nullable=true)
     */
    private $almacenado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="PLANTILLA", type="string", length=30, nullable=true)
     */
    private $plantilla;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPONSABLE", type="integer", nullable=true)
     */
    private $responsable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CREACION", type="date", nullable=true)
     */
    private $fechaCreacion = 'sysdate';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVA_ADMIN", type="integer", nullable=true)
     */
    private $activaAdmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESPACHO", type="integer", nullable=true)
     */
    private $tipoDespacho = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_EJECUTOR", type="string", length=1, nullable=true)
     */
    private $tipoEjecutor = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_ANTIGUO", type="integer", nullable=true)
     */
    private $documentoAntiguo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_RESPUESTA", type="string", length=255, nullable=true)
     */
    private $tipoRespuesta;


}
