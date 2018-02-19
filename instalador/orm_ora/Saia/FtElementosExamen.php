<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtElementosExamen
 *
 * @ORM\Table(name="FT_ELEMENTOS_EXAMEN", indexes={@ORM\Index(name="ft_elementos_examen_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_elementos_ex", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_concepto_general", columns={"FT_CONCEPTO_GENERAL"})})
 * @ORM\Entity
 */
class FtElementosExamen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONCEPTO_GENERAL", type="integer", nullable=false)
     */
    private $ftConceptoGeneral;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '309';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ELEMENTOS_EXAMEN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ELEMENTOS_EXAMEN_IDFT_ELEME", allocationSize=1, initialValue=1)
     */
    private $idftElementosExamen;

    /**
     * @var integer
     *
     * @ORM\Column(name="LENGUAJE_ENTREVISTA", type="integer", nullable=false)
     */
    private $lenguajeEntrevista;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMA_HABLAR", type="integer", nullable=false)
     */
    private $formaHablar;

    /**
     * @var integer
     *
     * @ORM\Column(name="ASPECTO_EMOCIONAL", type="integer", nullable=false)
     */
    private $aspectoEmocional;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELATO_LIBRETO", type="integer", nullable=false)
     */
    private $relatoLibreto;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELATO_PROBLEMAS", type="integer", nullable=false)
     */
    private $relatoProblemas;

    /**
     * @var integer
     *
     * @ORM\Column(name="FACTOR_MENTAL", type="integer", nullable=false)
     */
    private $factorMental;

    /**
     * @var integer
     *
     * @ORM\Column(name="SITUACION_PSICOLOGICA", type="integer", nullable=false)
     */
    private $situacionPsicologica;

    /**
     * @var integer
     *
     * @ORM\Column(name="LUGAR_REALIZACION", type="integer", nullable=false)
     */
    private $lugarRealizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DISTRACTOR_AUDITIVO", type="integer", nullable=false)
     */
    private $distractorAuditivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONDICION_ADECUADA", type="integer", nullable=false)
     */
    private $condicionAdecuada;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONTACTO_PREVIO", type="integer", nullable=false)
     */
    private $contactoPrevio;

    /**
     * @var integer
     *
     * @ORM\Column(name="SATISFACCION_ENTREVIS", type="integer", nullable=false)
     */
    private $satisfaccionEntrevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="EQUIPO_SISTEMA_INFO", type="integer", nullable=false)
     */
    private $equipoSistemaInfo;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRESENCIA_COMPUTADOR", type="integer", nullable=false)
     */
    private $presenciaComputador;

    /**
     * @var integer
     *
     * @ORM\Column(name="EQUIPO_GRABACION", type="integer", nullable=false)
     */
    private $equipoGrabacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRESENCIA_GRABADORA", type="integer", nullable=false)
     */
    private $presenciaGrabadora;

    /**
     * @var integer
     *
     * @ORM\Column(name="METODOLOGIA_ENTREVIS", type="integer", nullable=false)
     */
    private $metodologiaEntrevis;

    /**
     * @var integer
     *
     * @ORM\Column(name="MANEJO_PROTOCOLOS", type="integer", nullable=false)
     */
    private $manejoProtocolos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

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
     * @var integer
     *
     * @ORM\Column(name="CONDICION_RELACION", type="integer", nullable=false)
     */
    private $condicionRelacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTITUD_DISPOSICION", type="integer", nullable=false)
     */
    private $actitudDisposicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONSTRUCCION_RELATO", type="integer", nullable=false)
     */
    private $construccionRelato;

    /**
     * @var integer
     *
     * @ORM\Column(name="DESARROLLO_PROTOCOLO", type="integer", nullable=false)
     */
    private $desarrolloProtocolo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCUESTA_ADECUADA", type="integer", nullable=false)
     */
    private $encuestaAdecuada;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTOS_APOYO", type="integer", nullable=false)
     */
    private $documentosApoyo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTABLECIO_RELACION", type="integer", nullable=false)
     */
    private $establecioRelacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SATISFACCION_METODO", type="integer", nullable=false)
     */
    private $satisfaccionMetodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONDICION_CONFIANZA", type="integer", nullable=false)
     */
    private $condicionConfianza;

    /**
     * @var integer
     *
     * @ORM\Column(name="VARIABLES_DESARROLLO", type="integer", nullable=false)
     */
    private $variablesDesarrollo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_PROFUN", type="string", length=3999, nullable=true)
     */
    private $observacionesProfun;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

