<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtExamenValidezSufici
 *
 * @ORM\Table(name="FT_EXAMEN_VALIDEZ_SUFICI", indexes={@ORM\Index(name="ft_examen_validez_sufici_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_examen_valid", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_confirmacion_info_rol", columns={"FT_CONFIRMACION_INFO_ROL"})})
 * @ORM\Entity
 */
class FtExamenValidezSufici
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_VALORACION_ASIGNADO", type="integer", nullable=false)
     */
    private $ftValoracionAsignado;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '312';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_EXAMEN_VALIDEZ", type="date", nullable=false)
     */
    private $fechaExamenValidez = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_EXAMEN_VALIDEZ_SUFICI", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_EXAMEN_VALIDEZ_SUFICI_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftExamenValidezSufici;

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
     * @ORM\Column(name="MECANISMO_DESAPARICI", type="integer", nullable=false)
     */
    private $mecanismoDesaparici;

    /**
     * @var integer
     *
     * @ORM\Column(name="MECANISMO_TORTURA", type="integer", nullable=false)
     */
    private $mecanismoTortura;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMA_DESPOJO_TIERRA", type="integer", nullable=false)
     */
    private $formaDespojoTierra;

    /**
     * @var integer
     *
     * @ORM\Column(name="PATRONES_VIOLENCIA", type="integer", nullable=false)
     */
    private $patronesViolencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMA_RECLUTAMIENTO", type="integer", nullable=false)
     */
    private $formaReclutamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_BELICA_ESTRUC", type="integer", nullable=false)
     */
    private $accionBelicaEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_POLITICOS", type="integer", nullable=false)
     */
    private $relacionPoliticos;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENTOS_ESTABLECIDOS", type="integer", nullable=false)
     */
    private $eventosEstablecidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="HECHOS_VIOLENCIA", type="integer", nullable=false)
     */
    private $hechosViolencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENTOS_INFORMACION", type="integer", nullable=false)
     */
    private $eventosInformacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMA_REGULA_ESTRUC", type="integer", nullable=false)
     */
    private $formaRegulaEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPERTORIO_UTILIZADO", type="integer", nullable=false)
     */
    private $repertorioUtilizado;

    /**
     * @var integer
     *
     * @ORM\Column(name="HALLAZGO_RELACIONADO", type="integer", nullable=false)
     */
    private $hallazgoRelacionado;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_FUERZA_PUBLI", type="integer", nullable=false)
     */
    private $relacionFuerzaPubli;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORGANIZACION_ESTRUCTU", type="integer", nullable=false)
     */
    private $organizacionEstructu;

    /**
     * @var integer
     *
     * @ORM\Column(name="COMPOSI_ESTRUCTURA", type="integer", nullable=false)
     */
    private $composiEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="OPERABA_ESTRUCTURA", type="integer", nullable=false)
     */
    private $operabaEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN_ESTRUCTURA", type="integer", nullable=false)
     */
    private $origenEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="UBICAR_LUGARES", type="integer", nullable=false)
     */
    private $ubicarLugares;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONJUNTO_INFORMACION", type="integer", nullable=false)
     */
    private $conjuntoInformacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="CORRESPONDE_TIEMPO", type="integer", nullable=false)
     */
    private $correspondeTiempo;

    /**
     * @var integer
     *
     * @ORM\Column(name="COINCIDE_TIEMPO_LUGAR", type="integer", nullable=false)
     */
    private $coincideTiempoLugar;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONJUNTO_EVENTOS_DAV", type="integer", nullable=false)
     */
    private $conjuntoEventosDav;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODO_INGRESO_ESTRUC", type="integer", nullable=false)
     */
    private $modoIngresoEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="TERRITORIO_OPERACIONES", type="integer", nullable=false)
     */
    private $territorioOperaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_ESTRUCTURA", type="integer", nullable=false)
     */
    private $actividadEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMAS_ENTRENAMIENTO", type="integer", nullable=false)
     */
    private $formasEntrenamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DOTACION_GRUPO", type="integer", nullable=false)
     */
    private $tipoDotacionGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="REGLAMENTOS_ESTRUCTU", type="integer", nullable=false)
     */
    private $reglamentosEstructu;

    /**
     * @var integer
     *
     * @ORM\Column(name="DINAMICA_GRUPO", type="integer", nullable=false)
     */
    private $dinamicaGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="INFO_ESTABLECIDA", type="integer", nullable=false)
     */
    private $infoEstablecida;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_PERMANENCIA", type="integer", nullable=false)
     */
    private $tiempoPermanencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_ACTOR_ECONO", type="integer", nullable=false)
     */
    private $relacionActorEcono;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_OTROS_ACTORES", type="integer", nullable=false)
     */
    private $relacionOtrosActores;

    /**
     * @var integer
     *
     * @ORM\Column(name="FINANCIACION_RELACION", type="integer", nullable=false)
     */
    private $financiacionRelacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUTA_RECORRIDA_ESTRUC", type="integer", nullable=false)
     */
    private $rutaRecorridaEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="MECANISMO_RECLUTAMI", type="integer", nullable=false)
     */
    private $mecanismoReclutami;

    /**
     * @var integer
     *
     * @ORM\Column(name="INFORMACION_BASE_DAV", type="integer", nullable=false)
     */
    private $informacionBaseDav;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_VINCULACION", type="integer", nullable=false)
     */
    private $tiempoVinculacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DESARROLLO_EVENTOS", type="integer", nullable=false)
     */
    private $desarrolloEventos;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENTO_ESTABLECIDO", type="integer", nullable=false)
     */
    private $eventoEstablecido;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONFIRMACION_INFO_ROL", type="integer", nullable=false)
     */
    private $ftConfirmacionInfoRol;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_EXAMEN", type="text", nullable=true)
     */
    private $observacionesExamen = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONFORMA", type="text", nullable=true)
     */
    private $observacionConforma = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONTEXTO", type="text", nullable=true)
     */
    private $observacionContexto = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

