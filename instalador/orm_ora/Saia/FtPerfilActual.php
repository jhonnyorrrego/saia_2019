<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPerfilActual
 *
 * @ORM\Table(name="FT_PERFIL_ACTUAL", indexes={@ORM\Index(name="ft_perfil_actual_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_perfil_actua", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtPerfilActual
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
    private $serieIdserie = '216';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_PERFIL_ACTUAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_PERFIL_ACTUAL_IDFT_PERFIL_A", allocationSize=1, initialValue=1)
     */
    private $idftPerfilActual;

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
     * @ORM\Column(name="OFRECIMIENTO_VINCULA", type="integer", nullable=true)
     */
    private $ofrecimientoVincula;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OFRECIMIENTO_VINCULA", type="string", length=255, nullable=true)
     */
    private $otroOfrecimientoVincula;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_TRASLADO", type="string", length=255, nullable=true)
     */
    private $motivoTraslado;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_MOTIVO_TRASLADO", type="string", length=255, nullable=true)
     */
    private $otroMotivoTraslado;

    /**
     * @var integer
     *
     * @ORM\Column(name="PROBLEMA_SEGURIDAD", type="integer", nullable=true)
     */
    private $problemaSeguridad;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PROBLEMA_SEGURIDAD", type="string", length=255, nullable=true)
     */
    private $otroProblemaSeguridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="SITUACION_ACTUAL", type="integer", nullable=false)
     */
    private $situacionActual;

    /**
     * @var string
     *
     * @ORM\Column(name="TRABAJO_ACTUAL", type="text", nullable=true)
     */
    private $trabajoActual = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="INGRESO_ECONOMICO", type="integer", nullable=false)
     */
    private $ingresoEconomico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_CIVIL_ACTUAL", type="integer", nullable=false)
     */
    private $estadoCivilActual;

    /**
     * @var integer
     *
     * @ORM\Column(name="CABEZA_FAMILIA", type="integer", nullable=false)
     */
    private $cabezaFamilia;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERSONAS_A_CARGO", type="integer", nullable=true)
     */
    private $personasACargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CUANTOS_HIJOS_TIENE", type="integer", nullable=true)
     */
    private $cuantosHijosTiene;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_COMUNIDAD", type="integer", nullable=false)
     */
    private $relacionComunidad;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RELACION_COMUNIDAD", type="string", length=255, nullable=true)
     */
    private $otroRelacionComunidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="PROGRAMA_SALUD_ACR", type="integer", nullable=false)
     */
    private $programaSaludAcr;

    /**
     * @var integer
     *
     * @ORM\Column(name="EDUCACION_ACR", type="integer", nullable=false)
     */
    private $educacionAcr;

    /**
     * @var integer
     *
     * @ORM\Column(name="ATENCION_PSICOLOGICA", type="integer", nullable=false)
     */
    private $atencionPsicologica;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMACION_TRABAJO_ACR", type="integer", nullable=false)
     */
    private $formacionTrabajoAcr;

    /**
     * @var integer
     *
     * @ORM\Column(name="SER_SOCIAL_ACR", type="integer", nullable=false)
     */
    private $serSocialAcr;

    /**
     * @var integer
     *
     * @ORM\Column(name="GENERACION_INGRESOS", type="integer", nullable=false)
     */
    private $generacionIngresos;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICA_PSICOSOCIAL", type="integer", nullable=true)
     */
    private $calificaPsicosocial = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_FORMACION", type="integer", nullable=true)
     */
    private $calificacionFormacion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_SOCIAL", type="integer", nullable=true)
     */
    private $calificacionSocial = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_INGRESOS", type="integer", nullable=true)
     */
    private $calificacionIngresos = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_SALUD", type="integer", nullable=true)
     */
    private $calificacionSalud = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_EDUCACION", type="integer", nullable=true)
     */
    private $calificacionEducacion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

