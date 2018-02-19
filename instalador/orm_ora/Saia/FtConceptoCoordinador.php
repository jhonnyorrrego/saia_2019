<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConceptoCoordinador
 *
 * @ORM\Table(name="FT_CONCEPTO_COORDINADOR", indexes={@ORM\Index(name="i_concepto_coo", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_recomendacion_certifi", columns={"FT_RECOMENDACION_CERTIFI"})})
 * @ORM\Entity
 */
class FtConceptoCoordinador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '324';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL_ASIGNADA", type="string", length=255, nullable=true)
     */
    private $regionalAsignada;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONCEPTO_COORDINADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONCEPTO_COORDINADOR_IDFT_C", allocationSize=1, initialValue=1)
     */
    private $idftConceptoCoordinador;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="CONTRATO_PRESTACION", type="string", length=255, nullable=true)
     */
    private $contratoPrestacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CONCEPTO_NUMERO", type="string", length=255, nullable=true)
     */
    private $conceptoNumero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FIRMA_CONTRATO", type="date", nullable=true)
     */
    private $fechaFirmaContrato = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VIGENCIA_HASTA", type="date", nullable=true)
     */
    private $vigenciaHasta = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_EXPEDI_CEDULA", type="string", length=255, nullable=true)
     */
    private $ciudadExpediCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="EXAMEN_VALIDEZ", type="text", nullable=true)
     */
    private $examenValidez = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EXAMEN_FIABILIDAD", type="text", nullable=true)
     */
    private $examenFiabilidad = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="CONFORMACION_GRUPO", type="integer", nullable=true)
     */
    private $conformacionGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONFORMA", type="text", nullable=true)
     */
    private $observacionConforma = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="CONTEXTO_PARTICIPACION", type="integer", nullable=true)
     */
    private $contextoParticipacion;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONTEXTO", type="text", nullable=true)
     */
    private $observacionContexto = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="HECHOS_CONOCIMIENTO", type="integer", nullable=true)
     */
    private $hechosConocimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_HECHOS", type="text", nullable=true)
     */
    private $observacionesHechos = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_CERTIFICA", type="integer", nullable=true)
     */
    private $calificacionCertifica;

    /**
     * @var integer
     *
     * @ORM\Column(name="INCONSISTENCIA_TREL", type="integer", nullable=true)
     */
    private $inconsistenciaTrel;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_CONCEPTO", type="string", length=255, nullable=true)
     */
    private $ciudadConcepto;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECOMENDACION_CERTIFI", type="integer", nullable=false)
     */
    private $ftRecomendacionCertifi;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION_INCONSI", type="text", nullable=true)
     */
    private $justificacionInconsi = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGO", type="integer", nullable=true)
     */
    private $cargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="AVAL", type="integer", nullable=true)
     */
    private $aval;

    /**
     * @var integer
     *
     * @ORM\Column(name="CERTIFICACION", type="integer", nullable=true)
     */
    private $certificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_RESOLUCION", type="string", length=255, nullable=true)
     */
    private $numeroResolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RESOLUCION", type="date", nullable=true)
     */
    private $fechaResolucion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="RECOMENDACION_SENTIDO", type="integer", nullable=true)
     */
    private $recomendacionSentido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONCEPTO_COORDI", type="date", nullable=false)
     */
    private $fechaConceptoCoordi = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="CARGUE_ACTA_COORDINA", type="string", length=255, nullable=true)
     */
    private $cargueActaCoordina;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

