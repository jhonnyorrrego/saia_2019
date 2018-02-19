<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRevisionJuridica
 *
 * @ORM\Table(name="FT_REVISION_JURIDICA", indexes={@ORM\Index(name="ft_revision_juridica_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_revision_jur", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_asignacion_abogado", columns={"FT_ASIGNACION_ABOGADO"})})
 * @ORM\Entity
 */
class FtRevisionJuridica
{
    /**
     * @var string
     *
     * @ORM\Column(name="DURACION_AUDIO_EP", type="string", length=255, nullable=false)
     */
    private $duracionAudioEp;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_CEDULA", type="string", length=255, nullable=false)
     */
    private $numeroCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_ACUERDO", type="text", nullable=true)
     */
    private $observacionesAcuerdo = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_ASISTENCIA", type="text", nullable=true)
     */
    private $observacionesAsistencia = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CITACION", type="text", nullable=true)
     */
    private $observacionesCitacion = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_EE", type="text", nullable=true)
     */
    private $observacionesEe = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_VALORACION", type="text", nullable=true)
     */
    private $observacionesValoracion = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL", type="string", length=255, nullable=false)
     */
    private $regional;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASIGNACION_ABOGADO", type="integer", nullable=false)
     */
    private $ftAsignacionAbogado;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '501';

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS", type="string", length=255, nullable=false)
     */
    private $apellidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUDIO_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $audioEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPORTE_PROFUNDIDAD", type="integer", nullable=false)
     */
    private $reporteProfundidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_ASISTENCIA", type="integer", nullable=false)
     */
    private $documentoAsistencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_CITACION", type="integer", nullable=false)
     */
    private $documentoCitacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_CONSENTIMIENTO", type="integer", nullable=false)
     */
    private $documentoConsentimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_CONTRIBUCION", type="integer", nullable=false)
     */
    private $documentoContribucion;

    /**
     * @var string
     *
     * @ORM\Column(name="DURACION_AUDIO", type="string", length=11, nullable=false)
     */
    private $duracionAudio;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_EXPEDICION", type="text", nullable=false)
     */
    private $lugarExpedicion = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_AUDIO", type="text", nullable=true)
     */
    private $observacionesAudio = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="ARCHIVO_ANEXO", type="integer", nullable=false)
     */
    private $archivoAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ARCHIVO_VERDAD", type="integer", nullable=false)
     */
    private $archivoVerdad;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUDIO_ENTREVISTA", type="integer", nullable=false)
     */
    private $audioEntrevista;

    /**
     * @var string
     *
     * @ORM\Column(name="CIU", type="string", length=255, nullable=false)
     */
    private $ciu;

    /**
     * @var integer
     *
     * @ORM\Column(name="FOTOCOPIA_CEDULA", type="integer", nullable=false)
     */
    private $fotocopiaCedula;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REVISION_JURIDICA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REVISION_JURIDICA_IDFT_REVI", allocationSize=1, initialValue=1)
     */
    private $idftRevisionJuridica;

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
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_EP", type="text", nullable=true)
     */
    private $observacionesEp = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="CONCEPTO_REGIONAL", type="integer", nullable=false)
     */
    private $conceptoRegional;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTAL_VALORACION", type="integer", nullable=false)
     */
    private $documentalValoracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SENTIDO_CERTIFICACION", type="integer", nullable=true)
     */
    private $sentidoCertificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESULTADO_REVISION", type="integer", nullable=false)
     */
    private $resultadoRevision;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE_REVISION", type="string", length=255, nullable=false)
     */
    private $responsableRevision;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_ESTRUCTURADO", type="integer", nullable=false)
     */
    private $documentoEstructurado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REVISION", type="date", nullable=false)
     */
    private $fechaRevision = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRES", type="string", length=255, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CONCEPTO", type="text", nullable=true)
     */
    private $observacionesConcepto = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CONSENTIMIENTO", type="text", nullable=true)
     */
    private $observacionesConsentimiento = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_ESTRUCTURADO", type="text", nullable=true)
     */
    private $observacionesEstructurado = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_RECEPCION", type="text", nullable=true)
     */
    private $observacionesRecepcion = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_AUDIO_EP", type="text", nullable=true)
     */
    private $observacionesAudioEp = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="REPORTE_ESTRUCTURADO", type="integer", nullable=false)
     */
    private $reporteEstructurado;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CONTRIBUCION", type="text", nullable=true)
     */
    private $observacionesContribucion = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CARGA_PROYECTO_CERTI", type="string", length=255, nullable=true)
     */
    private $cargaProyectoCerti;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_PROYECTO", type="string", length=255, nullable=true)
     */
    private $nombreProyecto;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_SENTIDO", type="string", length=255, nullable=true)
     */
    private $otroSentido;


}

