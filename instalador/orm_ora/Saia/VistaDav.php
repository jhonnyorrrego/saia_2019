<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VistaDav
 *
 * @ORM\Table(name="VISTA_DAV")
 * @ORM\Entity
 */
class VistaDav
{
    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RADICADO", type="string", length=3999, nullable=true)
     */
    private $fechaRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFT_RECEPCION_ACUERDOS", type="string", length=3999, nullable=false)
     */
    private $idftRecepcionAcuerdos;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RECEPCION_ACUER", type="string", length=3999, nullable=true)
     */
    private $fechaRecepcionAcuer;

    /**
     * @var string
     *
     * @ORM\Column(name="CODA", type="string", length=3999, nullable=true)
     */
    private $coda;

    /**
     * @var string
     *
     * @ORM\Column(name="CEDULA_CIUDADANIA", type="string", length=3999, nullable=true)
     */
    private $cedulaCiudadania;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=3999, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS", type="string", length=3999, nullable=true)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIORIZADO", type="string", length=3999, nullable=true)
     */
    private $priorizado;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_REGIONAL", type="string", length=3999, nullable=true)
     */
    private $sedeRegional;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMENTO", type="string", length=3999, nullable=true)
     */
    private $departamento;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_DIGITALES", type="string", length=3999, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="CONSECUTIVO_CIU", type="string", length=3999, nullable=true)
     */
    private $consecutivoCiu;

    /**
     * @var string
     *
     * @ORM\Column(name="ULTIMO_PASO", type="string", length=3999, nullable=true)
     */
    private $ultimoPaso;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_CENTRO_S", type="string", length=3999, nullable=true)
     */
    private $adicionalCentroS;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_NO_ASISTENCIA", type="string", length=3999, nullable=true)
     */
    private $adicionalNoAsistencia;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_SEXO", type="string", length=3999, nullable=true)
     */
    private $adicionalSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_ETNIA", type="string", length=3999, nullable=true)
     */
    private $adicionalEtnia;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_MUNICIPIO", type="string", length=3999, nullable=true)
     */
    private $adicionalMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_ESTADO", type="string", length=3999, nullable=true)
     */
    private $adicionalEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_DOCU_CITADO", type="string", length=3999, nullable=true)
     */
    private $adicionalDocuCitado;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_ESTADO_1", type="string", length=3999, nullable=true)
     */
    private $adicionalEstado1;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_ESTADO_3", type="string", length=3999, nullable=true)
     */
    private $adicionalEstado3;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_ESTADO_2", type="string", length=3999, nullable=true)
     */
    private $adicionalEstado2;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_ESTADO_4", type="string", length=3999, nullable=true)
     */
    private $adicionalEstado4;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_OTRO_SEXO", type="string", length=3999, nullable=true)
     */
    private $adicionalOtroSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_RECEPCION", type="text", nullable=true)
     */
    private $observacionRecepcion = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONAL_DOC_CERTIFI", type="string", length=3999, nullable=true)
     */
    private $adicionalDocCertifi;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_CONSOLIDADO", type="string", length=3999, nullable=true)
     */
    private $estadoConsolidado;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_TERRITO_26", type="text", nullable=true)
     */
    private $observacionTerrito26 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CONSULTA_ESTADO_SIR_26", type="string", length=3999, nullable=true)
     */
    private $consultaEstadoSir26;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_NACIMIENTO_26", type="string", length=3999, nullable=true)
     */
    private $fechaNacimiento26;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_DESMOVILIZACION_26", type="string", length=3999, nullable=true)
     */
    private $fechaDesmovilizacion26;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO_CONTACTO_26", type="string", length=3999, nullable=true)
     */
    private $telefonoContacto26;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION_CONTACTO_26", type="string", length=3999, nullable=true)
     */
    private $direccionContacto26;

    /**
     * @var string
     *
     * @ORM\Column(name="CENTRO_SERVICIO_26", type="string", length=3999, nullable=true)
     */
    private $centroServicio26;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_REINTEGRADOR_26", type="string", length=3999, nullable=true)
     */
    private $nombreReintegrador26;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTRUCTURA_ARMADA_26", type="string", length=3999, nullable=true)
     */
    private $estructuraArmada26;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCION_DESEMPENIADA_26", type="string", length=3999, nullable=true)
     */
    private $funcionDesempeniada26;

    /**
     * @var string
     *
     * @ORM\Column(name="ESPECIALIDAD_FUNCION_26", type="string", length=3999, nullable=true)
     */
    private $especialidadFuncion26;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTABLECI_CARCELARIO_26", type="string", length=3999, nullable=true)
     */
    private $estableciCarcelario26;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_FORMATO_26", type="string", length=3999, nullable=true)
     */
    private $fechaFormato26;

    /**
     * @var string
     *
     * @ORM\Column(name="VALIDAR_FECHAS_26", type="string", length=3999, nullable=true)
     */
    private $validarFechas26;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_26", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento26;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_RESIDENCIA_28", type="string", length=3999, nullable=true)
     */
    private $municipioResidencia28;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_VERIFICA_28", type="text", nullable=true)
     */
    private $observacionVerifica28 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_HORA_28", type="string", length=3999, nullable=true)
     */
    private $fechaHora28;

    /**
     * @var string
     *
     * @ORM\Column(name="CEDULA_28", type="string", length=3999, nullable=true)
     */
    private $cedula28;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_28", type="string", length=3999, nullable=true)
     */
    private $nombre28;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS_28", type="string", length=3999, nullable=true)
     */
    private $apellidos28;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION_CONTACTO_28", type="string", length=3999, nullable=true)
     */
    private $direccionContacto28;

    /**
     * @var string
     *
     * @ORM\Column(name="TELEFONO_CONTACTO_28", type="string", length=3999, nullable=true)
     */
    private $telefonoContacto28;

    /**
     * @var string
     *
     * @ORM\Column(name="DATOS_CONTACTO_28", type="string", length=3999, nullable=true)
     */
    private $datosContacto28;

    /**
     * @var string
     *
     * @ORM\Column(name="VERIFICA_EN_PROCESO_28", type="string", length=3999, nullable=true)
     */
    private $verificaEnProceso28;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_28", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento28;

    /**
     * @var string
     *
     * @ORM\Column(name="HORA_CITACION_30", type="string", length=3999, nullable=true)
     */
    private $horaCitacion30;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_CITACION_30", type="string", length=3999, nullable=true)
     */
    private $lugarCitacion30;

    /**
     * @var string
     *
     * @ORM\Column(name="CITACION_30", type="string", length=3999, nullable=true)
     */
    private $citacion30;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_CITACION_30", type="string", length=3999, nullable=true)
     */
    private $fechaCitacion30;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_CITACION_30", type="string", length=3999, nullable=true)
     */
    private $ciudadCitacion30;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_DILIGENCIA_30", type="string", length=3999, nullable=true)
     */
    private $ciudadDiligencia30;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_30", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento30;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_ASIGNACION_31", type="string", length=3999, nullable=true)
     */
    private $fechaAsignacion31;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ENTREVISTADOR_31", type="string", length=3999, nullable=true)
     */
    private $nombreEntrevistador31;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_31", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento31;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_CITADO_45", type="string", length=3999, nullable=true)
     */
    private $nombreCitado45;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_LLAMADA_45", type="string", length=3999, nullable=true)
     */
    private $fechaLlamada45;

    /**
     * @var string
     *
     * @ORM\Column(name="RESULTADO_LLAMADA_45", type="string", length=3999, nullable=true)
     */
    private $resultadoLlamada45;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACOINES_LLAMADA_45", type="text", nullable=true)
     */
    private $observacoinesLlamada45 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="MEDIO_CONTACTO_45", type="string", length=3999, nullable=true)
     */
    private $medioContacto45;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_45", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento45;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_CONFIRMACION_32", type="string", length=3999, nullable=true)
     */
    private $fechaConfirmacion32;

    /**
     * @var string
     *
     * @ORM\Column(name="ASISTIO_32", type="string", length=3999, nullable=true)
     */
    private $asistio32;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_SOPORTE_32", type="string", length=3999, nullable=true)
     */
    private $documentoSoporte32;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ASISTEN_32", type="string", length=3999, nullable=true)
     */
    private $observacionAsisten32;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_32", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento32;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_REALIZACION_36", type="string", length=3999, nullable=true)
     */
    private $fechaRealizacion36;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_REALIZACION_36", type="string", length=3999, nullable=true)
     */
    private $lugarRealizacion36;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ENTREVISTADOR_36", type="string", length=3999, nullable=true)
     */
    private $nombreEntrevistador36;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_ENTREVISTADOR_36", type="string", length=3999, nullable=true)
     */
    private $cargoEntrevistador36;

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL_DAV_36", type="string", length=3999, nullable=true)
     */
    private $regionalDav36;

    /**
     * @var string
     *
     * @ORM\Column(name="HORA_INICIO_36", type="string", length=3999, nullable=true)
     */
    private $horaInicio36;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_IDENTIFICACION_36", type="string", length=3999, nullable=true)
     */
    private $codigoIdentificacion36;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_36", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento36;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_2_37", type="string", length=3999, nullable=true)
     */
    private $pregunta237;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_3_37", type="string", length=3999, nullable=true)
     */
    private $pregunta337;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_4_37", type="string", length=3999, nullable=true)
     */
    private $pregunta437;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_5_37", type="string", length=3999, nullable=true)
     */
    private $otroPregunta537;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_6_37", type="string", length=3999, nullable=true)
     */
    private $pregunta637;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_7_37", type="string", length=3999, nullable=true)
     */
    private $pregunta737;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_5_37", type="string", length=3999, nullable=true)
     */
    private $pregunta537;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_1_37", type="string", length=3999, nullable=true)
     */
    private $pregunta137;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_1_37", type="string", length=3999, nullable=true)
     */
    private $otroPregunta137;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_4_37", type="string", length=3999, nullable=true)
     */
    private $otroPregunta437;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_37", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento37;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_VIII_ANIO_39", type="string", length=3999, nullable=true)
     */
    private $preViiiAnio39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_IX_DEPARMUNICIPIO_39", type="string", length=3999, nullable=true)
     */
    private $preIxDeparmunicipio39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_IX_SITIO_39", type="string", length=3999, nullable=true)
     */
    private $preIxSitio39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_IX_CUAL_39", type="string", length=3999, nullable=true)
     */
    private $preIxCual39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_X_DONDEVIVIA_39", type="string", length=3999, nullable=true)
     */
    private $preXDondevivia39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_X_DEPARMUNICIPIO_39", type="string", length=3999, nullable=true)
     */
    private $preXDeparmunicipio39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_X_SITIO_39", type="string", length=3999, nullable=true)
     */
    private $preXSitio39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_VIII_MES_39", type="string", length=3999, nullable=true)
     */
    private $preViiiMes39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_X_CUAL_39", type="string", length=3999, nullable=true)
     */
    private $preXCual39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XII_ESTADOCIVIL_39", type="string", length=3999, nullable=true)
     */
    private $preXiiEstadocivil39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIII_NUMEROHIJOS_39", type="string", length=3999, nullable=true)
     */
    private $preXiiiNumerohijos39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIV_GRADO_39", type="string", length=3999, nullable=true)
     */
    private $preXivGrado39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIV_ULTIMOGRADO_39", type="string", length=3999, nullable=true)
     */
    private $preXivUltimogrado39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIV_COMPLETA_39", type="string", length=3999, nullable=true)
     */
    private $preXivCompleta39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_TRABAJO_39", type="string", length=3999, nullable=true)
     */
    private $preXvTrabajo39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_TIEMPO_39", type="string", length=3999, nullable=true)
     */
    private $preXvTiempo39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_CUAL_39", type="string", length=3999, nullable=true)
     */
    private $preXvCual39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XVI_TIPOTRABAJO_39", type="string", length=3999, nullable=true)
     */
    private $preXviTipotrabajo39;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XVI_TIPOTRABAJO_39", type="string", length=3999, nullable=true)
     */
    private $otroPreXviTipotrabajo39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_ACTIVIDAD_39", type="string", length=3999, nullable=true)
     */
    private $preXvActividad39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XI_MOTIVACION_39", type="string", length=3999, nullable=true)
     */
    private $preXiMotivacion39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XVII_INSTITUCION_39", type="string", length=3999, nullable=true)
     */
    private $preXviiInstitucion39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XVIII_CARGO_39", type="string", length=3999, nullable=true)
     */
    private $preXviiiCargo39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIX_RANGO_39", type="string", length=3999, nullable=true)
     */
    private $preXixRango39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIX_DURAANIOS_39", type="string", length=3999, nullable=true)
     */
    private $preXixDuraanios39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIX_DURAMESES_39", type="string", length=3999, nullable=true)
     */
    private $preXixDurameses39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XX_NOPERTENECE_39", type="string", length=3999, nullable=true)
     */
    private $preXxNopertenece39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXI_RAZONRETIRO_39", type="string", length=3999, nullable=true)
     */
    private $preXxiRazonretiro39;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XXI_RAZONRETIRO_39", type="string", length=3999, nullable=true)
     */
    private $otroPreXxiRazonretiro39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXII_RETIRO_39", type="string", length=3999, nullable=true)
     */
    private $preXxiiRetiro39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_ACTIVIDAD_39", type="string", length=3999, nullable=true)
     */
    private $preXxiiiActividad39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_CUALGRUPO_39", type="string", length=3999, nullable=true)
     */
    private $preXxiiiCualgrupo39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_TIPOINFO_39", type="text", nullable=true)
     */
    private $preXxiiiTipoinfo39 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_CUALACCION_39", type="text", nullable=true)
     */
    private $preXxiiiCualaccion39 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_NINGUNA_39", type="string", length=3999, nullable=true)
     */
    private $preXxiiiNinguna39;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XI_MOTIVACION_39", type="string", length=3999, nullable=true)
     */
    private $otroPreXiMotivacion39;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XV_OTRAOPCION_39", type="string", length=3999, nullable=true)
     */
    private $otroPreXvOtraopcion39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XVIII_PARTICIPA_39", type="string", length=3999, nullable=true)
     */
    private $preXviiiParticipa39;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XVIII_PARTICIPA_39", type="string", length=3999, nullable=true)
     */
    private $otroPreXviiiParticipa39;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ESTUDIO_39", type="string", length=3999, nullable=true)
     */
    private $tipoEstudio39;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_39", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento39;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIV_VIVIACON_43", type="string", length=3999, nullable=true)
     */
    private $preXxivViviacon43;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XXIV_VIVIACON_43", type="string", length=3999, nullable=true)
     */
    private $otroPreXxivViviacon43;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXV_INGRESOS_43", type="string", length=3999, nullable=true)
     */
    private $preXxvIngresos43;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXVI_VICTIMA_43", type="string", length=3999, nullable=true)
     */
    private $preXxviVictima43;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXVII_CAMPOITEM_43", type="string", length=3999, nullable=true)
     */
    private $preXxviiCampoitem43;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_43", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento43;

    /**
     * @var string
     *
     * @ORM\Column(name="INSTITUCION_FUERZA_PU_46", type="string", length=3999, nullable=true)
     */
    private $institucionFuerzaPu46;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_INSTITUCION_FUERZA_PU_46", type="string", length=3999, nullable=true)
     */
    private $otroInstitucionFuerzaPu46;

    /**
     * @var string
     *
     * @ORM\Column(name="ORGANIZACION_CUAL_46", type="text", nullable=true)
     */
    private $organizacionCual46 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCIA_ORGANIZACI_46", type="string", length=3999, nullable=true)
     */
    private $presenciaOrganizaci46;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRESENCIA_ORGANIZACI_46", type="string", length=3999, nullable=true)
     */
    private $otroPresenciaOrganizaci46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_CATOLICA_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioCatolica46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_CRISTIANA_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioCristiana46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENE_ACCION_COMUNA_46", type="string", length=3999, nullable=true)
     */
    private $perteneAccionComuna46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_SOCIAL_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioSocial46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_CAMPESINO_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioCampesino46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_SINDICATO_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioSindicato46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_DERECHOS_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioDerechos46;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_OTRA_46", type="string", length=3999, nullable=true)
     */
    private $pertenecioOtra46;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCESO_SERVICIOS_46", type="string", length=3999, nullable=true)
     */
    private $accesoServicios46;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_46", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento46;

    /**
     * @var string
     *
     * @ORM\Column(name="ENTIDAD_RESOLUCION_53", type="string", length=3999, nullable=true)
     */
    private $entidadResolucion53;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ENTIDAD_RESOLUCION_53", type="string", length=3999, nullable=true)
     */
    private $otroEntidadResolucion53;

    /**
     * @var string
     *
     * @ORM\Column(name="VICTIMA_ACCION_53", type="string", length=3999, nullable=true)
     */
    private $victimaAccion53;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_53", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento53;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFORMATO_ITEM1_48", type="string", length=3999, nullable=true)
     */
    private $idformatoItem148;

    /**
     * @var string
     *
     * @ORM\Column(name="IDFORMATO_ITEM2_48", type="string", length=3999, nullable=true)
     */
    private $idformatoItem248;

    /**
     * @var string
     *
     * @ORM\Column(name="PERTENECIO_GRUPO_48", type="string", length=3999, nullable=true)
     */
    private $pertenecioGrupo48;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PERTENECIO_GRUPO_48", type="string", length=3999, nullable=true)
     */
    private $otroPertenecioGrupo48;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_48", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento48;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_GRUPO_ARMADO_56", type="string", length=3999, nullable=true)
     */
    private $nombreGrupoArmado56;

    /**
     * @var string
     *
     * @ORM\Column(name="NRO_INTEGRANTES_GRUPO_56", type="string", length=3999, nullable=true)
     */
    private $nroIntegrantesGrupo56;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_INGRESO_GRUPO_56", type="string", length=3999, nullable=true)
     */
    private $anioIngresoGrupo56;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_SALIDA_GRUPO_56", type="string", length=3999, nullable=true)
     */
    private $anioSalidaGrupo56;

    /**
     * @var string
     *
     * @ORM\Column(name="ROL_PRINCIPAL_GRUPO_56", type="string", length=3999, nullable=true)
     */
    private $rolPrincipalGrupo56;

    /**
     * @var string
     *
     * @ORM\Column(name="ESPECIALIDAD_ROL_56", type="string", length=3999, nullable=true)
     */
    private $especialidadRol56;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS_PERSONA_56", type="string", length=3999, nullable=true)
     */
    private $aliasPersona56;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTOS_PERMANENCIA_56", type="string", length=3999, nullable=true)
     */
    private $deptosPermanencia56;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTOS_PERMANENCIA1_56", type="string", length=3999, nullable=true)
     */
    private $deptosPermanencia156;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTOS_PERMANENCIA2_56", type="string", length=3999, nullable=true)
     */
    private $deptosPermanencia256;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_MAS_PERMANCENCIA_56", type="string", length=3999, nullable=true)
     */
    private $lugarMasPermancencia56;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_LUGARES_56", type="string", length=3999, nullable=true)
     */
    private $nombreLugares56;

    /**
     * @var string
     *
     * @ORM\Column(name="ESCUELAS_ENTRENAMIENTO_56", type="string", length=3999, nullable=true)
     */
    private $escuelasEntrenamiento56;

    /**
     * @var string
     *
     * @ORM\Column(name="CENTROS_MANDO_56", type="string", length=3999, nullable=true)
     */
    private $centrosMando56;

    /**
     * @var string
     *
     * @ORM\Column(name="BASES_MILITARES_56", type="string", length=3999, nullable=true)
     */
    private $basesMilitares56;

    /**
     * @var string
     *
     * @ORM\Column(name="BLOQUE_MAYOR_DURACION_55", type="string", length=3999, nullable=true)
     */
    private $bloqueMayorDuracion55;

    /**
     * @var string
     *
     * @ORM\Column(name="DOTACION_ENTREGADA_55", type="string", length=3999, nullable=true)
     */
    private $dotacionEntregada55;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_DOTACION_ENTREGADA_55", type="string", length=3999, nullable=true)
     */
    private $otroDotacionEntregada55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_MUJERES_55", type="string", length=3999, nullable=true)
     */
    private $integrantesMujeres55;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ENTRENAMIENTO_55", type="string", length=3999, nullable=true)
     */
    private $tipoEntrenamiento55;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_ENTRENAMIENTO_55", type="string", length=3999, nullable=true)
     */
    private $otroTipoEntrenamiento55;

    /**
     * @var string
     *
     * @ORM\Column(name="NINIOS_NINIAS_ADOLES_55", type="string", length=3999, nullable=true)
     */
    private $niniosNiniasAdoles55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_INDIGENAS_55", type="string", length=3999, nullable=true)
     */
    private $integrantesIndigenas55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_NEGROS_55", type="string", length=3999, nullable=true)
     */
    private $integrantesNegros55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_GITANOS_55", type="string", length=3999, nullable=true)
     */
    private $integrantesGitanos55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_LGBTI_55", type="string", length=3999, nullable=true)
     */
    private $integrantesLgbti55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_DISCAPACI_55", type="string", length=3999, nullable=true)
     */
    private $integrantesDiscapaci55;

    /**
     * @var string
     *
     * @ORM\Column(name="INTEGRANTES_EXTRANJE_55", type="string", length=3999, nullable=true)
     */
    private $integrantesExtranje55;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_DISCIPLINA_55", type="string", length=3999, nullable=true)
     */
    private $codigoDisciplina55;

    /**
     * @var string
     *
     * @ORM\Column(name="RECIBIO_ENTRENAMIENTO_55", type="string", length=3999, nullable=true)
     */
    private $recibioEntrenamiento55;

    /**
     * @var string
     *
     * @ORM\Column(name="CONOCIO_ESTATUTO_GRUPO_55", type="string", length=3999, nullable=true)
     */
    private $conocioEstatutoGrupo55;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_CONOCIO_ESTATUTO_GRUPO_55", type="string", length=3999, nullable=true)
     */
    private $otroConocioEstatutoGrupo55;

    /**
     * @var string
     *
     * @ORM\Column(name="QUIEN_EXPLICO_ESTATU_55", type="string", length=3999, nullable=true)
     */
    private $quienExplicoEstatu55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMO_PAGABAN_55", type="string", length=3999, nullable=true)
     */
    private $comoPagaban55;

    /**
     * @var string
     *
     * @ORM\Column(name="DINERO_MENSUAL_GRUPO_55", type="string", length=3999, nullable=true)
     */
    private $dineroMensualGrupo55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_GENERAL_55", type="string", length=3999, nullable=true)
     */
    private $comandanteGeneral55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_MILITAR_55", type="string", length=3999, nullable=true)
     */
    private $comandanteMilitar55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANTANTE_URBANO_55", type="string", length=3999, nullable=true)
     */
    private $comantanteUrbano55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_POLITICO_55", type="string", length=3999, nullable=true)
     */
    private $comandantePolitico55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_FINANCIE_55", type="string", length=3999, nullable=true)
     */
    private $comandanteFinancie55;

    /**
     * @var string
     *
     * @ORM\Column(name="COMANDANTE_OTROS_55", type="string", length=3999, nullable=true)
     */
    private $comandanteOtros55;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_COORDINADOR_55", type="string", length=3999, nullable=true)
     */
    private $jefeCoordinador55;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_ESCUADRA_55", type="string", length=3999, nullable=true)
     */
    private $jefeEscuadra55;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_SEGUNDO_55", type="string", length=3999, nullable=true)
     */
    private $jefeSegundo55;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_SEGUNDO_ESCUADRA_55", type="string", length=3999, nullable=true)
     */
    private $jefeSegundoEscuadra55;

    /**
     * @var string
     *
     * @ORM\Column(name="JEFE_ALIAS_OTROS_55", type="text", nullable=true)
     */
    private $jefeAliasOtros55 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="GRUPOS_ESPECIALES_55", type="string", length=3999, nullable=true)
     */
    private $gruposEspeciales55;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_GRUPOS_ESPECIALES_55", type="string", length=3999, nullable=true)
     */
    private $otroGruposEspeciales55;

    /**
     * @var string
     *
     * @ORM\Column(name="PRIMER_GRUPO_PARAMI_55", type="string", length=3999, nullable=true)
     */
    private $primerGrupoParami55;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_RECIBIO_ENTRENA_55", type="string", length=3999, nullable=true)
     */
    private $noRecibioEntrena55;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_NO_RECIBIO_ENTRENA_55", type="string", length=3999, nullable=true)
     */
    private $otroNoRecibioEntrena55;

    /**
     * @var string
     *
     * @ORM\Column(name="DIAS_ENTRENAMIENTO_55", type="string", length=3999, nullable=true)
     */
    private $diasEntrenamiento55;

    /**
     * @var string
     *
     * @ORM\Column(name="MESES_ENTRENAMIENTO_55", type="string", length=3999, nullable=true)
     */
    private $mesesEntrenamiento55;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_INSTRUCTURES_55", type="string", length=3999, nullable=true)
     */
    private $tipoInstructures55;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_INSTRUCTURES_55", type="string", length=3999, nullable=true)
     */
    private $otroTipoInstructures55;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_BLOQUE_DOS_55", type="string", length=3999, nullable=true)
     */
    private $nombreBloqueDos55;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_BLOQUE_UNO_55", type="string", length=3999, nullable=true)
     */
    private $nombreBloqueUno55;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_55", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento55;

    /**
     * @var string
     *
     * @ORM\Column(name="BLOQUE_NARCOTRAFICO_58", type="string", length=3999, nullable=true)
     */
    private $bloqueNarcotrafico58;

    /**
     * @var string
     *
     * @ORM\Column(name="RES_RECURSOS_ECONOMICOS_58", type="string", length=3999, nullable=true)
     */
    private $resRecursosEconomicos58;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RES_RECURSOS_ECONOMICOS", type="string", length=3999, nullable=true)
     */
    private $otroResRecursosEconomicos;

    /**
     * @var string
     *
     * @ORM\Column(name="RES_INVETIGACION_58", type="string", length=3999, nullable=true)
     */
    private $resInvetigacion58;

    /**
     * @var string
     *
     * @ORM\Column(name="SUMINISTRO_ARMAS_58", type="string", length=3999, nullable=true)
     */
    private $suministroArmas58;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_SUMINISTRO_ARMAS_58", type="string", length=3999, nullable=true)
     */
    private $otroSuministroArmas58;

    /**
     * @var string
     *
     * @ORM\Column(name="TRAFICANTE_INTER_PAIS_58", type="string", length=3999, nullable=true)
     */
    private $traficanteInterPais58;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_ARMADA_58", type="string", length=3999, nullable=true)
     */
    private $anioAproxArmada58;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_DAS_58", type="string", length=3999, nullable=true)
     */
    private $undDas58;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_DAS_58", type="string", length=3999, nullable=true)
     */
    private $anioDas58;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_FUERZA_AEREA_58", type="string", length=3999, nullable=true)
     */
    private $undFuerzaAerea58;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_ARMADA_58", type="string", length=3999, nullable=true)
     */
    private $undArmada58;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_BLOQUE_ACC_58", type="string", length=3999, nullable=true)
     */
    private $nombreBloqueAcc58;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_FUERZA_AEREA_58", type="string", length=3999, nullable=true)
     */
    private $anioAproxFuerzaAerea58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_HOMICIDIO_58", type="string", length=3999, nullable=true)
     */
    private $califHomicidio58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_DESAPARECION_58", type="string", length=3999, nullable=true)
     */
    private $califDesaparecion58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_LIMPIEZA_58", type="string", length=3999, nullable=true)
     */
    private $califLimpieza58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_DESPLAZAMIENTO_58", type="string", length=3999, nullable=true)
     */
    private $califDesplazamiento58;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_POLICIA_58", type="string", length=3999, nullable=true)
     */
    private $undPolicia58;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_POLICIA_58", type="string", length=3999, nullable=true)
     */
    private $anioAproxPolicia58;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_EJERCITO_58", type="string", length=3999, nullable=true)
     */
    private $undEjercito58;

    /**
     * @var string
     *
     * @ORM\Column(name="INST_FUERZA_PUBLICA_58", type="string", length=3999, nullable=true)
     */
    private $instFuerzaPublica58;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_INST_FUERZA_PUBLICA_58", type="string", length=3999, nullable=true)
     */
    private $otroInstFuerzaPublica58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_DESPOJO_58", type="string", length=3999, nullable=true)
     */
    private $califDespojo58;

    /**
     * @var string
     *
     * @ORM\Column(name="RECURSOS_BLOQUE_58", type="string", length=3999, nullable=true)
     */
    private $recursosBloque58;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RECURSOS_BLOQUE_58", type="string", length=3999, nullable=true)
     */
    private $otroRecursosBloque58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_VIOLENCIA_58", type="string", length=3999, nullable=true)
     */
    private $califViolencia58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_TORTURA_58", type="string", length=3999, nullable=true)
     */
    private $califTortura58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_SECUESTRO_58", type="string", length=3999, nullable=true)
     */
    private $califSecuestro58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_MASACRES_58", type="string", length=3999, nullable=true)
     */
    private $califMasacres58;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_LESIONES_58", type="string", length=3999, nullable=true)
     */
    private $califLesiones58;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_EJERCITO_58", type="string", length=3999, nullable=true)
     */
    private $anioAproxEjercito58;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_58", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento58;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ACTUACION_GRUPO_ARMA_61", type="string", length=3999, nullable=true)
     */
    private $otroActuacionGrupoArma61;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_PERMANENCIA_61", type="string", length=3999, nullable=true)
     */
    private $tiempoPermanencia61;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_GRUPO_PARA_61", type="string", length=3999, nullable=true)
     */
    private $accionesGrupoPara61;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTUACION_GRUPO_ARMA_61", type="string", length=3999, nullable=true)
     */
    private $actuacionGrupoArma61;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSIGUIO_COMUNIDAD_61", type="string", length=3999, nullable=true)
     */
    private $persiguioComunidad61;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVIDADES_GRUPO_61", type="string", length=3999, nullable=true)
     */
    private $actividadesGrupo61;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_COMUNIDAD_61", type="string", length=3999, nullable=true)
     */
    private $accionesComunidad61;

    /**
     * @var string
     *
     * @ORM\Column(name="DENUNCIA_COMUNIDAD_61", type="string", length=3999, nullable=true)
     */
    private $denunciaComunidad61;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_BARRIO_61", type="string", length=3999, nullable=true)
     */
    private $municipioBarrio61;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_61", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento61;

    /**
     * @var string
     *
     * @ORM\Column(name="DESMOVILIZADO_GRUPO_62", type="string", length=3999, nullable=true)
     */
    private $desmovilizadoGrupo62;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMUNICI_DESMOVI_62", type="string", length=3999, nullable=true)
     */
    private $departamuniciDesmovi62;

    /**
     * @var string
     *
     * @ORM\Column(name="BARRIO_CASERIO_DESMOVI_62", type="string", length=3999, nullable=true)
     */
    private $barrioCaserioDesmovi62;

    /**
     * @var string
     *
     * @ORM\Column(name="BARRIO_CASERIO_CUAL_62", type="string", length=3999, nullable=true)
     */
    private $barrioCaserioCual62;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DESMOVILIZACION_62", type="string", length=3999, nullable=true)
     */
    private $tipoDesmovilizacion62;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_DESMOVILIZA_62", type="string", length=3999, nullable=true)
     */
    private $motivoDesmoviliza62;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_MOTIVO_DESMOVILIZA_62", type="string", length=3999, nullable=true)
     */
    private $otroMotivoDesmoviliza62;

    /**
     * @var string
     *
     * @ORM\Column(name="TRASLADO_LUGAR_HABITU_62", type="string", length=3999, nullable=true)
     */
    private $trasladoLugarHabitu62;

    /**
     * @var string
     *
     * @ORM\Column(name="IBA_DESMOVILIZAR_62", type="string", length=3999, nullable=true)
     */
    private $ibaDesmovilizar62;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_IBA_DESMOVILIZAR_62", type="string", length=3999, nullable=true)
     */
    private $otroIbaDesmovilizar62;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTUVO_ACUERDO_62", type="string", length=3999, nullable=true)
     */
    private $estuvoAcuerdo62;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTUVO_ACUERDO_PORQUE_62", type="text", nullable=true)
     */
    private $estuvoAcuerdoPorque62 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PERIODO_DIAS_DESMOVI_62", type="string", length=3999, nullable=true)
     */
    private $periodoDiasDesmovi62;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_MESES_DESMOVI_62", type="string", length=3999, nullable=true)
     */
    private $tiempoMesesDesmovi62;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_DIAS_DESMOVI_62", type="string", length=3999, nullable=true)
     */
    private $tiempoDiasDesmovi62;

    /**
     * @var string
     *
     * @ORM\Column(name="PERIODO_MESES_DESMO_62", type="string", length=3999, nullable=true)
     */
    private $periodoMesesDesmo62;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_62", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento62;

    /**
     * @var string
     *
     * @ORM\Column(name="REUBICACION_ESTRUCTU_67", type="string", length=3999, nullable=true)
     */
    private $reubicacionEstructu67;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_REUBICACION_ESTRUCTU_67", type="string", length=3999, nullable=true)
     */
    private $otroReubicacionEstructu67;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONA_NO_DESMOVI_67", type="string", length=3999, nullable=true)
     */
    private $personaNoDesmovi67;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PERSONA_NO_DESMOVI_67", type="string", length=3999, nullable=true)
     */
    private $otroPersonaNoDesmovi67;

    /**
     * @var string
     *
     * @ORM\Column(name="NODESMOVILIZA_PORQUE_67", type="string", length=3999, nullable=true)
     */
    private $nodesmovilizaPorque67;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_NODESMOVILIZA_PORQUE_67", type="string", length=3999, nullable=true)
     */
    private $otroNodesmovilizaPorque67;

    /**
     * @var string
     *
     * @ORM\Column(name="POBLACION_DESMOVILIZA_67", type="string", length=3999, nullable=true)
     */
    private $poblacionDesmoviliza67;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_POBLACION_DESMOVILIZA_67", type="string", length=3999, nullable=true)
     */
    private $otroPoblacionDesmoviliza67;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_67", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento67;

    /**
     * @var string
     *
     * @ORM\Column(name="VINCULACION_PERSONAS_64", type="string", length=3999, nullable=true)
     */
    private $vinculacionPersonas64;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $preguntaEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $otroPreguntaEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="OPINION_VINCULA_PERS_64", type="string", length=3999, nullable=true)
     */
    private $opinionVinculaPers64;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OPINION_VINCULA_PERS_64", type="string", length=3999, nullable=true)
     */
    private $otroOpinionVinculaPers64;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONAS_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $personasDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="INGRESO_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $ingresoDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_INGRESO_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $otroIngresoDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_MATERIAL_INTEND_64", type="string", length=3999, nullable=true)
     */
    private $descMaterialIntend64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_MATERIAL_COMUN_64", type="string", length=3999, nullable=true)
     */
    private $descMaterialComun64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_VEHICULOS_64", type="string", length=3999, nullable=true)
     */
    private $descVehiculos64;

    /**
     * @var string
     *
     * @ORM\Column(name="ENTREGA_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $entregaDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ENTREGA_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $otroEntregaDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_ARMAS_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $descArmasEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_UNIFORM_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $descUniformEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_INTEND_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $descIntendEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_COMUN_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $descComunEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="DESC_VEHICULO_ENTREGA_64", type="string", length=3999, nullable=true)
     */
    private $descVehiculoEntrega64;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_ARMA_64", type="string", length=3999, nullable=true)
     */
    private $preguntaArma64;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_ARMA_64", type="string", length=3999, nullable=true)
     */
    private $otroPreguntaArma64;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTO_MUNIC_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $deptoMunicDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="CUAL_LUGAR_RESIDENCIA_64", type="string", length=3999, nullable=true)
     */
    private $cualLugarResidencia64;

    /**
     * @var string
     *
     * @ORM\Column(name="SITIO_RESIDENCIA_64", type="string", length=3999, nullable=true)
     */
    private $sitioResidencia64;

    /**
     * @var string
     *
     * @ORM\Column(name="VIVIENDA_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $viviendaDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_VIVIENDA_DESMOVIL_64", type="string", length=3999, nullable=true)
     */
    private $otroViviendaDesmovil64;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_64", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento64;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_MANDOS_65", type="string", length=3999, nullable=true)
     */
    private $relacionMandos65;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RELACION_MANDOS_65", type="string", length=3999, nullable=true)
     */
    private $otroRelacionMandos65;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_COMPANIEROS_65", type="string", length=3999, nullable=true)
     */
    private $relacionCompanieros65;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RELACION_COMPANIEROS_65", type="string", length=3999, nullable=true)
     */
    private $otroRelacionCompanieros65;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_INGRESO_PROGRAMA_65", type="string", length=3999, nullable=true)
     */
    private $anioIngresoPrograma65;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_FUERZA_PUBLI_65", type="string", length=3999, nullable=true)
     */
    private $accionesFuerzaPubli65;

    /**
     * @var string
     *
     * @ORM\Column(name="SUMINISTRO_INFORMACI_65", type="string", length=3999, nullable=true)
     */
    private $suministroInformaci65;

    /**
     * @var string
     *
     * @ORM\Column(name="RECOMPENSA_CUANTO_65", type="string", length=3999, nullable=true)
     */
    private $recompensaCuanto65;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ACCIONES_FUERZA_PUBLI_65", type="string", length=3999, nullable=true)
     */
    private $otroAccionesFuerzaPubli65;

    /**
     * @var string
     *
     * @ORM\Column(name="TRASLADO_RESIDENCIA_65", type="string", length=3999, nullable=true)
     */
    private $trasladoResidencia65;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_65", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento65;

    /**
     * @var string
     *
     * @ORM\Column(name="PROGRAMA_SALUD_ACR_68", type="string", length=3999, nullable=true)
     */
    private $programaSaludAcr68;

    /**
     * @var string
     *
     * @ORM\Column(name="EDUCACION_ACR_68", type="string", length=3999, nullable=true)
     */
    private $educacionAcr68;

    /**
     * @var string
     *
     * @ORM\Column(name="ATENCION_PSICOLOGICA_68", type="string", length=3999, nullable=true)
     */
    private $atencionPsicologica68;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMACION_TRABAJO_ACR_68", type="string", length=3999, nullable=true)
     */
    private $formacionTrabajoAcr68;

    /**
     * @var string
     *
     * @ORM\Column(name="SER_SOCIAL_ACR_68", type="string", length=3999, nullable=true)
     */
    private $serSocialAcr68;

    /**
     * @var string
     *
     * @ORM\Column(name="GENERACION_INGRESOS_68", type="string", length=3999, nullable=true)
     */
    private $generacionIngresos68;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIFICA_PSICOSOCIAL_68", type="string", length=3999, nullable=true)
     */
    private $calificaPsicosocial68;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIFICACION_FORMACION_68", type="string", length=3999, nullable=true)
     */
    private $calificacionFormacion68;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIFICACION_SOCIAL_68", type="string", length=3999, nullable=true)
     */
    private $calificacionSocial68;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIFICACION_INGRESOS_68", type="string", length=3999, nullable=true)
     */
    private $calificacionIngresos68;

    /**
     * @var string
     *
     * @ORM\Column(name="OFRECIMIENTO_VINCULA_68", type="string", length=3999, nullable=true)
     */
    private $ofrecimientoVincula68;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OFRECIMIENTO_VINCULA_68", type="string", length=3999, nullable=true)
     */
    private $otroOfrecimientoVincula68;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_TRASLADO_68", type="string", length=3999, nullable=true)
     */
    private $motivoTraslado68;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_MOTIVO_TRASLADO_68", type="string", length=3999, nullable=true)
     */
    private $otroMotivoTraslado68;

    /**
     * @var string
     *
     * @ORM\Column(name="PROBLEMA_SEGURIDAD_68", type="string", length=3999, nullable=true)
     */
    private $problemaSeguridad68;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PROBLEMA_SEGURIDAD_68", type="string", length=3999, nullable=true)
     */
    private $otroProblemaSeguridad68;

    /**
     * @var string
     *
     * @ORM\Column(name="SITUACION_ACTUAL_68", type="string", length=3999, nullable=true)
     */
    private $situacionActual68;

    /**
     * @var string
     *
     * @ORM\Column(name="TRABAJO_ACTUAL_68", type="text", nullable=true)
     */
    private $trabajoActual68 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="INGRESO_ECONOMICO_68", type="string", length=3999, nullable=true)
     */
    private $ingresoEconomico68;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_CIVIL_ACTUAL_68", type="string", length=3999, nullable=true)
     */
    private $estadoCivilActual68;

    /**
     * @var string
     *
     * @ORM\Column(name="CABEZA_FAMILIA_68", type="string", length=3999, nullable=true)
     */
    private $cabezaFamilia68;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONAS_A_CARGO_68", type="string", length=3999, nullable=true)
     */
    private $personasACargo68;

    /**
     * @var string
     *
     * @ORM\Column(name="CUANTOS_HIJOS_TIENE_68", type="string", length=3999, nullable=true)
     */
    private $cuantosHijosTiene68;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_COMUNIDAD_68", type="string", length=3999, nullable=true)
     */
    private $relacionComunidad68;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RELACION_COMUNIDAD_68", type="string", length=3999, nullable=true)
     */
    private $otroRelacionComunidad68;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIFICACION_SALUD_68", type="string", length=3999, nullable=true)
     */
    private $calificacionSalud68;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIFICACION_EDUCACION_68", type="string", length=3999, nullable=true)
     */
    private $calificacionEducacion68;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_68", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento68;

    /**
     * @var string
     *
     * @ORM\Column(name="VIDA_GRUPO_PARA_71", type="string", length=3999, nullable=true)
     */
    private $vidaGrupoPara71;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_VIDA_GRUPO_PARA_71", type="string", length=3999, nullable=true)
     */
    private $otroVidaGrupoPara71;

    /**
     * @var string
     *
     * @ORM\Column(name="HORA_FINALIZACION_71", type="string", length=3999, nullable=true)
     */
    private $horaFinalizacion71;

    /**
     * @var string
     *
     * @ORM\Column(name="OPINION_GRUPO_PARA_71", type="string", length=3999, nullable=true)
     */
    private $opinionGrupoPara71;

    /**
     * @var string
     *
     * @ORM\Column(name="OPINION_DESMOV_PAZ_71", type="string", length=3999, nullable=true)
     */
    private $opinionDesmovPaz71;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_ESTADO_71", type="string", length=3999, nullable=true)
     */
    private $accionesEstado71;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ACCIONES_ESTADO_71", type="string", length=3999, nullable=true)
     */
    private $otroAccionesEstado71;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_71", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento71;

    /**
     * @var string
     *
     * @ORM\Column(name="REGISTRO_ASISTENCIA_73", type="string", length=3999, nullable=true)
     */
    private $registroAsistencia73;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_CONSENTIMIENTO_73", type="string", length=3999, nullable=true)
     */
    private $fechaConsentimiento73;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_ANEXO_73", type="string", length=3999, nullable=true)
     */
    private $documentoAnexo73;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_73", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento73;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_AUDIOS_75", type="string", length=3999, nullable=true)
     */
    private $fechaAudios75;

    /**
     * @var string
     *
     * @ORM\Column(name="AUDIOS_ANEXOS_75", type="text", nullable=true)
     */
    private $audiosAnexos75 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_75", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento75;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_CIU_78", type="string", length=3999, nullable=true)
     */
    private $codigoCiu78;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_REPORTE_78", type="string", length=3999, nullable=true)
     */
    private $municipioReporte78;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_INICIO_ENTREVIS_78", type="string", length=3999, nullable=true)
     */
    private $fechaInicioEntrevis78;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_REPORTE_78", type="string", length=3999, nullable=true)
     */
    private $fechaReporte78;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ENTREVISTADOR_78", type="string", length=3999, nullable=true)
     */
    private $nombreEntrevistador78;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_ENTREVISTADOR_78", type="string", length=3999, nullable=true)
     */
    private $cargoEntrevistador78;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_REGIONAL_REPORTE_78", type="string", length=3999, nullable=true)
     */
    private $sedeRegionalReporte78;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_SUBREGIONAL_78", type="string", length=3999, nullable=true)
     */
    private $sedeSubregional78;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_REALIZA_ENTREVI_78", type="string", length=3999, nullable=true)
     */
    private $lugarRealizaEntrevi78;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_78", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento78;

    /**
     * @var string
     *
     * @ORM\Column(name="INCONSITENCIAS_INFO_80", type="text", nullable=true)
     */
    private $inconsitenciasInfo80 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DIA_ENCUESTA_DIFEREN_80", type="string", length=3999, nullable=true)
     */
    private $diaEncuestaDiferen80;

    /**
     * @var string
     *
     * @ORM\Column(name="DILIGENCIA_ENTREVISTA_80", type="string", length=3999, nullable=true)
     */
    private $diligenciaEntrevista80;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGO_PERSONA_80", type="text", nullable=true)
     */
    private $dialogoPersona80 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_80", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento80;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_TRANSCRIP_81", type="text", nullable=true)
     */
    private $observacionTranscrip81 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="RELATO_TRANSCRIPCION_81", type="string", length=3999, nullable=true)
     */
    private $relatoTranscripcion81;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_81", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento81;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ENTREVISTA_87", type="text", nullable=true)
     */
    private $observacionEntrevista87 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="ENCUESTA_ADECUADA_87", type="string", length=3999, nullable=true)
     */
    private $encuestaAdecuada87;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_REALIZACION_87", type="string", length=3999, nullable=true)
     */
    private $lugarRealizacion87;

    /**
     * @var string
     *
     * @ORM\Column(name="DISTRACTOR_AUDITIVO_87", type="string", length=3999, nullable=true)
     */
    private $distractorAuditivo87;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_ADECUADA_87", type="string", length=3999, nullable=true)
     */
    private $condicionAdecuada87;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACTO_PREVIO_87", type="string", length=3999, nullable=true)
     */
    private $contactoPrevio87;

    /**
     * @var string
     *
     * @ORM\Column(name="EQUIPO_SISTEMA_INFO_87", type="string", length=3999, nullable=true)
     */
    private $equipoSistemaInfo87;

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCIA_COMPUTADOR_87", type="string", length=3999, nullable=true)
     */
    private $presenciaComputador87;

    /**
     * @var string
     *
     * @ORM\Column(name="SATISFACCION_ENTREVIS_87", type="string", length=3999, nullable=true)
     */
    private $satisfaccionEntrevis87;

    /**
     * @var string
     *
     * @ORM\Column(name="EQUIPO_GRABACION_87", type="string", length=3999, nullable=true)
     */
    private $equipoGrabacion87;

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCIA_GRABADORA_87", type="string", length=3999, nullable=true)
     */
    private $presenciaGrabadora87;

    /**
     * @var string
     *
     * @ORM\Column(name="MANEJO_PROTOCOLOS_87", type="string", length=3999, nullable=true)
     */
    private $manejoProtocolos87;

    /**
     * @var string
     *
     * @ORM\Column(name="DESARROLLO_PROTOCOLO_87", type="string", length=3999, nullable=true)
     */
    private $desarrolloProtocolo87;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTOS_APOYO_87", type="string", length=3999, nullable=true)
     */
    private $documentosApoyo87;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTABLECIO_RELACION_87", type="string", length=3999, nullable=true)
     */
    private $establecioRelacion87;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_CONFIANZA_87", type="string", length=3999, nullable=true)
     */
    private $condicionConfianza87;

    /**
     * @var string
     *
     * @ORM\Column(name="METODOLOGIA_ENTREVIS_87", type="string", length=3999, nullable=true)
     */
    private $metodologiaEntrevis87;

    /**
     * @var string
     *
     * @ORM\Column(name="SATISFACCION_METODO_87", type="string", length=3999, nullable=true)
     */
    private $satisfaccionMetodo87;

    /**
     * @var string
     *
     * @ORM\Column(name="VARIABLES_DESARROLLO_87", type="string", length=3999, nullable=true)
     */
    private $variablesDesarrollo87;

    /**
     * @var string
     *
     * @ORM\Column(name="LENGUAJE_ENTREVISTA_87", type="string", length=3999, nullable=true)
     */
    private $lenguajeEntrevista87;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_HABLAR_87", type="string", length=3999, nullable=true)
     */
    private $formaHablar87;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTITUD_DISPOSICION_87", type="string", length=3999, nullable=true)
     */
    private $actitudDisposicion87;

    /**
     * @var string
     *
     * @ORM\Column(name="CONSTRUCCION_RELATO_87", type="string", length=3999, nullable=true)
     */
    private $construccionRelato87;

    /**
     * @var string
     *
     * @ORM\Column(name="ASPECTO_EMOCIONAL_87", type="string", length=3999, nullable=true)
     */
    private $aspectoEmocional87;

    /**
     * @var string
     *
     * @ORM\Column(name="RELATO_LIBRETO_87", type="string", length=3999, nullable=true)
     */
    private $relatoLibreto87;

    /**
     * @var string
     *
     * @ORM\Column(name="RELATO_PROBLEMAS_87", type="string", length=3999, nullable=true)
     */
    private $relatoProblemas87;

    /**
     * @var string
     *
     * @ORM\Column(name="FACTOR_MENTAL_87", type="string", length=3999, nullable=true)
     */
    private $factorMental87;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_RELACION_87", type="string", length=3999, nullable=true)
     */
    private $condicionRelacion87;

    /**
     * @var string
     *
     * @ORM\Column(name="SITUACION_PSICOLOGICA_87", type="string", length=3999, nullable=true)
     */
    private $situacionPsicologica87;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_87", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento87;

    /**
     * @var string
     *
     * @ORM\Column(name="TEMAS_ABORDAR_FUTURO_84", type="text", nullable=true)
     */
    private $temasAbordarFuturo84 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="INCONSISTENCIAS_INFO_84", type="text", nullable=true)
     */
    private $inconsistenciasInfo84 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_84", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento84;

    /**
     * @var string
     *
     * @ORM\Column(name="LENGUAJE_ENTREVISTA_85", type="string", length=3999, nullable=true)
     */
    private $lenguajeEntrevista85;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_HABLAR_85", type="string", length=3999, nullable=true)
     */
    private $formaHablar85;

    /**
     * @var string
     *
     * @ORM\Column(name="ASPECTO_EMOCIONAL_85", type="string", length=3999, nullable=true)
     */
    private $aspectoEmocional85;

    /**
     * @var string
     *
     * @ORM\Column(name="RELATO_LIBRETO_85", type="string", length=3999, nullable=true)
     */
    private $relatoLibreto85;

    /**
     * @var string
     *
     * @ORM\Column(name="RELATO_PROBLEMAS_85", type="string", length=3999, nullable=true)
     */
    private $relatoProblemas85;

    /**
     * @var string
     *
     * @ORM\Column(name="FACTOR_MENTAL_85", type="string", length=3999, nullable=true)
     */
    private $factorMental85;

    /**
     * @var string
     *
     * @ORM\Column(name="SITUACION_PSICOLOGICA_85", type="string", length=3999, nullable=true)
     */
    private $situacionPsicologica85;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_PROFUN_85", type="text", nullable=true)
     */
    private $observacionesProfun85 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_REALIZACION_85", type="string", length=3999, nullable=true)
     */
    private $lugarRealizacion85;

    /**
     * @var string
     *
     * @ORM\Column(name="DISTRACTOR_AUDITIVO_85", type="string", length=3999, nullable=true)
     */
    private $distractorAuditivo85;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_ADECUADA_85", type="string", length=3999, nullable=true)
     */
    private $condicionAdecuada85;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTACTO_PREVIO_85", type="string", length=3999, nullable=true)
     */
    private $contactoPrevio85;

    /**
     * @var string
     *
     * @ORM\Column(name="SATISFACCION_ENTREVIS_85", type="string", length=3999, nullable=true)
     */
    private $satisfaccionEntrevis85;

    /**
     * @var string
     *
     * @ORM\Column(name="EQUIPO_SISTEMA_INFO_85", type="string", length=3999, nullable=true)
     */
    private $equipoSistemaInfo85;

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCIA_COMPUTADOR_85", type="string", length=3999, nullable=true)
     */
    private $presenciaComputador85;

    /**
     * @var string
     *
     * @ORM\Column(name="EQUIPO_GRABACION_85", type="string", length=3999, nullable=true)
     */
    private $equipoGrabacion85;

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCIA_GRABADORA_85", type="string", length=3999, nullable=true)
     */
    private $presenciaGrabadora85;

    /**
     * @var string
     *
     * @ORM\Column(name="METODOLOGIA_ENTREVIS_85", type="string", length=3999, nullable=true)
     */
    private $metodologiaEntrevis85;

    /**
     * @var string
     *
     * @ORM\Column(name="MANEJO_PROTOCOLOS_85", type="string", length=3999, nullable=true)
     */
    private $manejoProtocolos85;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_RELACION_85", type="string", length=3999, nullable=true)
     */
    private $condicionRelacion85;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTITUD_DISPOSICION_85", type="string", length=3999, nullable=true)
     */
    private $actitudDisposicion85;

    /**
     * @var string
     *
     * @ORM\Column(name="CONSTRUCCION_RELATO_85", type="string", length=3999, nullable=true)
     */
    private $construccionRelato85;

    /**
     * @var string
     *
     * @ORM\Column(name="DESARROLLO_PROTOCOLO_85", type="string", length=3999, nullable=true)
     */
    private $desarrolloProtocolo85;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCUESTA_ADECUADA_85", type="string", length=3999, nullable=true)
     */
    private $encuestaAdecuada85;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTOS_APOYO_85", type="string", length=3999, nullable=true)
     */
    private $documentosApoyo85;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTABLECIO_RELACION_85", type="string", length=3999, nullable=true)
     */
    private $establecioRelacion85;

    /**
     * @var string
     *
     * @ORM\Column(name="SATISFACCION_METODO_85", type="string", length=3999, nullable=true)
     */
    private $satisfaccionMetodo85;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_CONFIANZA_85", type="string", length=3999, nullable=true)
     */
    private $condicionConfianza85;

    /**
     * @var string
     *
     * @ORM\Column(name="VARIABLES_DESARROLLO_85", type="string", length=3999, nullable=true)
     */
    private $variablesDesarrollo85;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_85", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento85;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_VALORACION_88", type="string", length=3999, nullable=true)
     */
    private $fechaValoracion88;

    /**
     * @var string
     *
     * @ORM\Column(name="VALORADOR_ASIGNADO_88", type="string", length=3999, nullable=true)
     */
    private $valoradorAsignado88;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_ESTIMADA_VALORA_88", type="string", length=3999, nullable=true)
     */
    private $fechaEstimadaValora88;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_88", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento88;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ENTREVISTA_98", type="text", nullable=true)
     */
    private $observacionEntrevista98 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_PROFUNDI_98", type="text", nullable=true)
     */
    private $observacionProfundi98 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_REPORTE_FIABI_98", type="string", length=3999, nullable=true)
     */
    private $fechaReporteFiabi98;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_98", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento98;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_VALORACION_89", type="string", length=3999, nullable=true)
     */
    private $fechaValoracion89;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_VALORADOR_89", type="string", length=3999, nullable=true)
     */
    private $nombreValorador89;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_89", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento89;

    /**
     * @var string
     *
     * @ORM\Column(name="INFORMACION_ROL_93", type="string", length=3999, nullable=true)
     */
    private $informacionRol93;

    /**
     * @var string
     *
     * @ORM\Column(name="NUEVAS_ESTRUCTURAS_93", type="string", length=3999, nullable=true)
     */
    private $nuevasEstructuras93;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTRUCTURA_ARMADA_93", type="string", length=3999, nullable=true)
     */
    private $estructuraArmada93;

    /**
     * @var string
     *
     * @ORM\Column(name="POSICION_MANDO_93", type="string", length=3999, nullable=true)
     */
    private $posicionMando93;

    /**
     * @var string
     *
     * @ORM\Column(name="TUVO_ROL_MILITAR_93", type="string", length=3999, nullable=true)
     */
    private $tuvoRolMilitar93;

    /**
     * @var string
     *
     * @ORM\Column(name="TUVO_ROL_POLITICO_93", type="string", length=3999, nullable=true)
     */
    private $tuvoRolPolitico93;

    /**
     * @var string
     *
     * @ORM\Column(name="TUVO_ROL_FINANCIERO_93", type="string", length=3999, nullable=true)
     */
    private $tuvoRolFinanciero93;

    /**
     * @var string
     *
     * @ORM\Column(name="TUVO_ROL_LOGISTICO_93", type="string", length=3999, nullable=true)
     */
    private $tuvoRolLogistico93;

    /**
     * @var string
     *
     * @ORM\Column(name="POSICION_CONFIANZA_93", type="string", length=3999, nullable=true)
     */
    private $posicionConfianza93;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGARES_VIOLENCIA_93", type="string", length=3999, nullable=true)
     */
    private $lugaresViolencia93;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_INGRESO_ESTRUCTU_93", type="string", length=3999, nullable=true)
     */
    private $anioIngresoEstructu93;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RETIRO_ESTRUCTU_93", type="string", length=3999, nullable=true)
     */
    private $fechaRetiroEstructu93;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONA_DESMOVILI_GAI_93", type="string", length=3999, nullable=true)
     */
    private $personaDesmoviliGai93;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_INFO_93", type="text", nullable=true)
     */
    private $observacionesInfo93 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_TREL_93", type="text", nullable=true)
     */
    private $observacionesTrel93 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_93", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento93;

    /**
     * @var string
     *
     * @ORM\Column(name="MECANISMO_DESAPARICI_90", type="string", length=3999, nullable=true)
     */
    private $mecanismoDesaparici90;

    /**
     * @var string
     *
     * @ORM\Column(name="MECANISMO_TORTURA_90", type="string", length=3999, nullable=true)
     */
    private $mecanismoTortura90;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_DESPOJO_TIERRA_90", type="string", length=3999, nullable=true)
     */
    private $formaDespojoTierra90;

    /**
     * @var string
     *
     * @ORM\Column(name="PATRONES_VIOLENCIA_90", type="string", length=3999, nullable=true)
     */
    private $patronesViolencia90;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_RECLUTAMIENTO_90", type="string", length=3999, nullable=true)
     */
    private $formaReclutamiento90;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION_BELICA_ESTRUC_90", type="string", length=3999, nullable=true)
     */
    private $accionBelicaEstruc90;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_POLITICOS_90", type="string", length=3999, nullable=true)
     */
    private $relacionPoliticos90;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_EXAMEN_90", type="text", nullable=true)
     */
    private $observacionesExamen90 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONFORMA_90", type="text", nullable=true)
     */
    private $observacionConforma90 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONTEXTO_90", type="text", nullable=true)
     */
    private $observacionContexto90 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTOS_ESTABLECIDOS_90", type="string", length=3999, nullable=true)
     */
    private $eventosEstablecidos90;

    /**
     * @var string
     *
     * @ORM\Column(name="HECHOS_VIOLENCIA_90", type="string", length=3999, nullable=true)
     */
    private $hechosViolencia90;

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTOS_INFORMACION_90", type="string", length=3999, nullable=true)
     */
    private $eventosInformacion90;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMA_REGULA_ESTRUC_90", type="string", length=3999, nullable=true)
     */
    private $formaRegulaEstruc90;

    /**
     * @var string
     *
     * @ORM\Column(name="REPERTORIO_UTILIZADO_90", type="string", length=3999, nullable=true)
     */
    private $repertorioUtilizado90;

    /**
     * @var string
     *
     * @ORM\Column(name="HALLAZGO_RELACIONADO_90", type="string", length=3999, nullable=true)
     */
    private $hallazgoRelacionado90;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_FUERZA_PUBLI_90", type="string", length=3999, nullable=true)
     */
    private $relacionFuerzaPubli90;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_EXAMEN_VALIDEZ_90", type="string", length=3999, nullable=true)
     */
    private $fechaExamenValidez90;

    /**
     * @var string
     *
     * @ORM\Column(name="ORGANIZACION_ESTRUCTU_90", type="string", length=3999, nullable=true)
     */
    private $organizacionEstructu90;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPOSI_ESTRUCTURA_90", type="string", length=3999, nullable=true)
     */
    private $composiEstructura90;

    /**
     * @var string
     *
     * @ORM\Column(name="OPERABA_ESTRUCTURA_90", type="string", length=3999, nullable=true)
     */
    private $operabaEstructura90;

    /**
     * @var string
     *
     * @ORM\Column(name="ORIGEN_ESTRUCTURA_90", type="string", length=3999, nullable=true)
     */
    private $origenEstructura90;

    /**
     * @var string
     *
     * @ORM\Column(name="UBICAR_LUGARES_90", type="string", length=3999, nullable=true)
     */
    private $ubicarLugares90;

    /**
     * @var string
     *
     * @ORM\Column(name="CONJUNTO_INFORMACION_90", type="string", length=3999, nullable=true)
     */
    private $conjuntoInformacion90;

    /**
     * @var string
     *
     * @ORM\Column(name="CORRESPONDE_TIEMPO_90", type="string", length=3999, nullable=true)
     */
    private $correspondeTiempo90;

    /**
     * @var string
     *
     * @ORM\Column(name="COINCIDE_TIEMPO_LUGAR_90", type="string", length=3999, nullable=true)
     */
    private $coincideTiempoLugar90;

    /**
     * @var string
     *
     * @ORM\Column(name="CONJUNTO_EVENTOS_DAV_90", type="string", length=3999, nullable=true)
     */
    private $conjuntoEventosDav90;

    /**
     * @var string
     *
     * @ORM\Column(name="MODO_INGRESO_ESTRUC_90", type="string", length=3999, nullable=true)
     */
    private $modoIngresoEstruc90;

    /**
     * @var string
     *
     * @ORM\Column(name="TERRITORIO_OPERACIONES_90", type="string", length=3999, nullable=true)
     */
    private $territorioOperaciones90;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVIDAD_ESTRUCTURA_90", type="string", length=3999, nullable=true)
     */
    private $actividadEstructura90;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMAS_ENTRENAMIENTO_90", type="string", length=3999, nullable=true)
     */
    private $formasEntrenamiento90;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DOTACION_GRUPO_90", type="string", length=3999, nullable=true)
     */
    private $tipoDotacionGrupo90;

    /**
     * @var string
     *
     * @ORM\Column(name="REGLAMENTOS_ESTRUCTU_90", type="string", length=3999, nullable=true)
     */
    private $reglamentosEstructu90;

    /**
     * @var string
     *
     * @ORM\Column(name="DINAMICA_GRUPO_90", type="string", length=3999, nullable=true)
     */
    private $dinamicaGrupo90;

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_ESTABLECIDA_90", type="string", length=3999, nullable=true)
     */
    private $infoEstablecida90;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_PERMANENCIA_90", type="string", length=3999, nullable=true)
     */
    private $tiempoPermanencia90;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_ACTOR_ECONO_90", type="string", length=3999, nullable=true)
     */
    private $relacionActorEcono90;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_OTROS_ACTORES_90", type="string", length=3999, nullable=true)
     */
    private $relacionOtrosActores90;

    /**
     * @var string
     *
     * @ORM\Column(name="FINANCIACION_RELACION_90", type="string", length=3999, nullable=true)
     */
    private $financiacionRelacion90;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_RECORRIDA_ESTRUC_90", type="string", length=3999, nullable=true)
     */
    private $rutaRecorridaEstruc90;

    /**
     * @var string
     *
     * @ORM\Column(name="MECANISMO_RECLUTAMI_90", type="string", length=3999, nullable=true)
     */
    private $mecanismoReclutami90;

    /**
     * @var string
     *
     * @ORM\Column(name="INFORMACION_BASE_DAV_90", type="string", length=3999, nullable=true)
     */
    private $informacionBaseDav90;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_VINCULACION_90", type="string", length=3999, nullable=true)
     */
    private $tiempoVinculacion90;

    /**
     * @var string
     *
     * @ORM\Column(name="DESARROLLO_EVENTOS_90", type="string", length=3999, nullable=true)
     */
    private $desarrolloEventos90;

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTO_ESTABLECIDO_90", type="string", length=3999, nullable=true)
     */
    private $eventoEstablecido90;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_90", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento90;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_REPORTE_100", type="string", length=3999, nullable=true)
     */
    private $fechaReporte100;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_100", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento100;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RECOMENDACION_91", type="string", length=3999, nullable=true)
     */
    private $fechaRecomendacion91;

    /**
     * @var string
     *
     * @ORM\Column(name="CONCEPTO_VALORACION_91", type="string", length=3999, nullable=true)
     */
    private $conceptoValoracion91;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSFITICA_RECOMENDA_91", type="text", nullable=true)
     */
    private $jusfiticaRecomenda91 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_91", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento91;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_CONCEPTO_94", type="string", length=3999, nullable=true)
     */
    private $ciudadConcepto94;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_FIRMA_CONTRATO_94", type="string", length=3999, nullable=true)
     */
    private $fechaFirmaContrato94;

    /**
     * @var string
     *
     * @ORM\Column(name="VIGENCIA_HASTA_94", type="string", length=3999, nullable=true)
     */
    private $vigenciaHasta94;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_EXPEDI_CEDULA_94", type="string", length=3999, nullable=true)
     */
    private $ciudadExpediCedula94;

    /**
     * @var string
     *
     * @ORM\Column(name="EXAMEN_VALIDEZ_94", type="text", nullable=true)
     */
    private $examenValidez94 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EXAMEN_FIABILIDAD_94", type="text", nullable=true)
     */
    private $examenFiabilidad94 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CONFORMACION_GRUPO_94", type="string", length=3999, nullable=true)
     */
    private $conformacionGrupo94;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONFORMA_94", type="text", nullable=true)
     */
    private $observacionConforma94 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CONTEXTO_PARTICIPACION_94", type="string", length=3999, nullable=true)
     */
    private $contextoParticipacion94;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CONTEXTO_94", type="text", nullable=true)
     */
    private $observacionContexto94 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="HECHOS_CONOCIMIENTO_94", type="string", length=3999, nullable=true)
     */
    private $hechosConocimiento94;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_HECHOS_94", type="text", nullable=true)
     */
    private $observacionesHechos94 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL_ASIGNADA_94", type="string", length=3999, nullable=true)
     */
    private $regionalAsignada94;

    /**
     * @var string
     *
     * @ORM\Column(name="INCONSISTENCIA_TREL_94", type="string", length=3999, nullable=true)
     */
    private $inconsistenciaTrel94;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION_INCONSI_94", type="text", nullable=true)
     */
    private $justificacionInconsi94 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="AVAL_94", type="string", length=3999, nullable=true)
     */
    private $aval94;

    /**
     * @var string
     *
     * @ORM\Column(name="CERTIFICACION_94", type="string", length=3999, nullable=true)
     */
    private $certificacion94;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_RESOLUCION_94", type="string", length=3999, nullable=true)
     */
    private $numeroResolucion94;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RESOLUCION_94", type="string", length=3999, nullable=true)
     */
    private $fechaResolucion94;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTRATO_PRESTACION_94", type="string", length=3999, nullable=true)
     */
    private $contratoPrestacion94;

    /**
     * @var string
     *
     * @ORM\Column(name="RECOMENDACION_SENTIDO_94", type="string", length=3999, nullable=true)
     */
    private $recomendacionSentido94;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_CONCEPTO_COORDI_94", type="string", length=3999, nullable=true)
     */
    private $fechaConceptoCoordi94;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGUE_ACTA_COORDINA_94", type="string", length=3999, nullable=true)
     */
    private $cargueActaCoordina94;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_94", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento94;

    /**
     * @var string
     *
     * @ORM\Column(name="ABOGADO_ASIGNADO_110", type="string", length=3999, nullable=true)
     */
    private $abogadoAsignado110;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_ESTIMADA_110", type="string", length=3999, nullable=true)
     */
    private $fechaEstimada110;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_ASIGNACION_110", type="string", length=3999, nullable=true)
     */
    private $fechaAsignacion110;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_110", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento110;

    /**
     * @var string
     *
     * @ORM\Column(name="DURACION_AUDIO_EP_111", type="string", length=3999, nullable=true)
     */
    private $duracionAudioEp111;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_CEDULA_111", type="string", length=3999, nullable=true)
     */
    private $numeroCedula111;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_ACUERDO_111", type="text", nullable=true)
     */
    private $observacionesAcuerdo111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_ASISTENCIA_111", type="text", nullable=true)
     */
    private $observacionesAsistencia111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CITACION_111", type="text", nullable=true)
     */
    private $observacionesCitacion111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CONTRIBUCION_111", type="text", nullable=true)
     */
    private $observacionesContribucion111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_EE_111", type="text", nullable=true)
     */
    private $observacionesEe111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_VALORACION_111", type="text", nullable=true)
     */
    private $observacionesValoracion111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL_111", type="string", length=3999, nullable=true)
     */
    private $regional111;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS_111", type="string", length=3999, nullable=true)
     */
    private $apellidos111;

    /**
     * @var string
     *
     * @ORM\Column(name="AUDIO_ESTRUCTURADA_111", type="string", length=3999, nullable=true)
     */
    private $audioEstructurada111;

    /**
     * @var string
     *
     * @ORM\Column(name="REPORTE_PROFUNDIDAD_111", type="string", length=3999, nullable=true)
     */
    private $reporteProfundidad111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_ASISTENCIA_111", type="string", length=3999, nullable=true)
     */
    private $documentoAsistencia111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_CITACION_111", type="string", length=3999, nullable=true)
     */
    private $documentoCitacion111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_CONSENTIMIENTO_111", type="string", length=3999, nullable=true)
     */
    private $documentoConsentimiento111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_CONTRIBUCION_111", type="string", length=3999, nullable=true)
     */
    private $documentoContribucion111;

    /**
     * @var string
     *
     * @ORM\Column(name="DURACION_AUDIO_111", type="string", length=3999, nullable=true)
     */
    private $duracionAudio111;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_EXPEDICION_111", type="text", nullable=true)
     */
    private $lugarExpedicion111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_AUDIO_111", type="text", nullable=true)
     */
    private $observacionesAudio111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="ARCHIVO_ANEXO_111", type="string", length=3999, nullable=true)
     */
    private $archivoAnexo111;

    /**
     * @var string
     *
     * @ORM\Column(name="ARCHIVO_VERDAD_111", type="string", length=3999, nullable=true)
     */
    private $archivoVerdad111;

    /**
     * @var string
     *
     * @ORM\Column(name="AUDIO_ENTREVISTA_111", type="string", length=3999, nullable=true)
     */
    private $audioEntrevista111;

    /**
     * @var string
     *
     * @ORM\Column(name="CIU_111", type="string", length=3999, nullable=true)
     */
    private $ciu111;

    /**
     * @var string
     *
     * @ORM\Column(name="FOTOCOPIA_CEDULA_111", type="string", length=3999, nullable=true)
     */
    private $fotocopiaCedula111;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_EP_111", type="text", nullable=true)
     */
    private $observacionesEp111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CARGA_PROYECTO_CERTI_111", type="string", length=3999, nullable=true)
     */
    private $cargaProyectoCerti111;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_PROYECTO_111", type="string", length=3999, nullable=true)
     */
    private $nombreProyecto111;

    /**
     * @var string
     *
     * @ORM\Column(name="CONCEPTO_REGIONAL_111", type="string", length=3999, nullable=true)
     */
    private $conceptoRegional111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTAL_VALORACION_111", type="string", length=3999, nullable=true)
     */
    private $documentalValoracion111;

    /**
     * @var string
     *
     * @ORM\Column(name="SENTIDO_CERTIFICACION_111", type="string", length=3999, nullable=true)
     */
    private $sentidoCertificacion111;

    /**
     * @var string
     *
     * @ORM\Column(name="RESULTADO_REVISION_111", type="string", length=3999, nullable=true)
     */
    private $resultadoRevision111;

    /**
     * @var string
     *
     * @ORM\Column(name="RESPONSABLE_REVISION_111", type="string", length=3999, nullable=true)
     */
    private $responsableRevision111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_ESTRUCTURADO_111", type="string", length=3999, nullable=true)
     */
    private $documentoEstructurado111;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_REVISION_111", type="string", length=3999, nullable=true)
     */
    private $fechaRevision111;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRES_111", type="string", length=3999, nullable=true)
     */
    private $nombres111;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CONCEPTO_111", type="text", nullable=true)
     */
    private $observacionesConcepto111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CONSENTIMIENTO", type="text", nullable=true)
     */
    private $observacionesConsentimiento = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_ESTRUCTURADO_111", type="text", nullable=true)
     */
    private $observacionesEstructurado111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_RECEPCION_111", type="text", nullable=true)
     */
    private $observacionesRecepcion111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_AUDIO_EP_111", type="text", nullable=true)
     */
    private $observacionesAudioEp111 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="REPORTE_ESTRUCTURADO_111", type="string", length=3999, nullable=true)
     */
    private $reporteEstructurado111;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_111", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento111;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_CERTIFICACION_95", type="string", length=3999, nullable=true)
     */
    private $fechaCertificacion95;

    /**
     * @var string
     *
     * @ORM\Column(name="CERTIFICACION_FIRMADA_95", type="string", length=3999, nullable=true)
     */
    private $certificacionFirmada95;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RESOLUCION_95", type="string", length=3999, nullable=true)
     */
    private $fechaResolucion95;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_RESOLUCION_95", type="string", length=3999, nullable=true)
     */
    private $numeroResolucion95;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_95", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento95;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_ACTA_96", type="string", length=3999, nullable=true)
     */
    private $fechaActa96;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_ACTA_96", type="string", length=3999, nullable=true)
     */
    private $numeroActa96;

    /**
     * @var string
     *
     * @ORM\Column(name="ADJUNTAR_ACTA_96", type="string", length=3999, nullable=true)
     */
    private $adjuntarActa96;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_PRIMER_NOTI_96", type="string", length=3999, nullable=true)
     */
    private $fechaPrimerNoti96;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMANTE_PRESENTO_96", type="string", length=3999, nullable=true)
     */
    private $firmantePresento96;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_96", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento96;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_ACTA_ENTREGA_97", type="string", length=3999, nullable=true)
     */
    private $fechaActaEntrega97;

    /**
     * @var string
     *
     * @ORM\Column(name="ACTA_ENTREGA_FIRMADA_97", type="string", length=3999, nullable=true)
     */
    private $actaEntregaFirmada97;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_97", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento97;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_REPROGRAMACION_76", type="string", length=3999, nullable=true)
     */
    private $motivoReprogramacion76;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_CITACION_AMPLIA_76", type="string", length=3999, nullable=true)
     */
    private $fechaCitacionAmplia76;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_CITACION_AMPLIA_76", type="string", length=3999, nullable=true)
     */
    private $lugarCitacionAmplia76;

    /**
     * @var string
     *
     * @ORM\Column(name="HORA_CITACION_76", type="string", length=3999, nullable=true)
     */
    private $horaCitacion76;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_CITACION_76", type="string", length=3999, nullable=true)
     */
    private $numeroCitacion76;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_REPROGRAMACION_76", type="string", length=3999, nullable=true)
     */
    private $ciudadReprogramacion76;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_DILIGEN_REPROG_76", type="string", length=3999, nullable=true)
     */
    private $ciudadDiligenReprog76;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_76", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento76;

    /**
     * @var string
     *
     * @ORM\Column(name="CONSECUTIVO_CIU_PROCE_109", type="string", length=3999, nullable=true)
     */
    private $consecutivoCiuProce109;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIBA_SITUACION_109", type="text", nullable=true)
     */
    private $describaSituacion109 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RADICA_PROCESO_109", type="string", length=3999, nullable=true)
     */
    private $fechaRadicaProceso109;

    /**
     * @var string
     *
     * @ORM\Column(name="SOPORTE_ENTIDAD_109", type="string", length=3999, nullable=true)
     */
    private $soporteEntidad109;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_PROCESO_ATIPI_109", type="string", length=3999, nullable=true)
     */
    private $motivoProcesoAtipi109;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_PROCESO_109", type="text", nullable=true)
     */
    private $descripcionProceso109 = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_109", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento109;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_TRANSCRIPCION_33", type="string", length=3999, nullable=true)
     */
    private $fechaTranscripcion33;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO_TRANSCRIPCION_33", type="string", length=3999, nullable=true)
     */
    private $anexoTranscripcion33;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO_33", type="string", length=3999, nullable=true)
     */
    private $documentoIddocumento33;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_RECEP_TERRITO_ACUERDO_26", type="string", length=3999, nullable=true)
     */
    private $ftRecepTerritoAcuerdo26;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_VERIFICACION_INFO_28", type="string", length=3999, nullable=true)
     */
    private $ftVerificacionInfo28;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_GESTION_CITACION_30", type="string", length=3999, nullable=true)
     */
    private $ftGestionCitacion30;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ASINGA_ENTREVISTADOR_31", type="string", length=3999, nullable=true)
     */
    private $ftAsingaEntrevistador31;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONVOCA_TELEFONICA_45", type="string", length=3999, nullable=true)
     */
    private $ftConvocaTelefonica45;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONFIRMA_ASISTENCIA_32", type="string", length=3999, nullable=true)
     */
    private $ftConfirmaAsistencia32;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA_36", type="string", length=3999, nullable=true)
     */
    private $ftEntrevistaEstructurada36;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ANTECEDEN_TRAYECTORIA_48", type="string", length=3999, nullable=true)
     */
    private $ftAntecedenTrayectoria48;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_IDENTIFICA_ENTREVISTA_37", type="string", length=3999, nullable=true)
     */
    private $ftIdentificaEntrevista37;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_PERFIL_ENTREVISTA_39", type="string", length=3999, nullable=true)
     */
    private $ftPerfilEntrevista39;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ENTORNO_FAMILIAR_43", type="string", length=3999, nullable=true)
     */
    private $ftEntornoFamiliar43;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ENTORNO_SOCIOECONO_46", type="string", length=3999, nullable=true)
     */
    private $ftEntornoSocioecono46;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ENTORNO_SOCIOECO_DOS_53", type="string", length=3999, nullable=true)
     */
    private $ftEntornoSocioecoDos53;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_UBIC_ESPACIAL_TEMPORAL_56", type="string", length=3999, nullable=true)
     */
    private $ftUbicEspacialTemporal56;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CARACTERIZA_INTRAFILA_55", type="string", length=3999, nullable=true)
     */
    private $ftCaracterizaIntrafila55;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ACTUALIZ_GRUPO_ARMADO_58", type="string", length=3999, nullable=true)
     */
    private $ftActualizGrupoArmado58;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_INTERACCION_MUNICIPIO_61", type="string", length=3999, nullable=true)
     */
    private $ftInteraccionMunicipio61;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_DESMOVI_DESARMEUNO_62", type="string", length=3999, nullable=true)
     */
    private $ftDesmoviDesarmeuno62;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_DESMOVILI_DESARMEDOS_67", type="string", length=3999, nullable=true)
     */
    private $ftDesmoviliDesarmedos67;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_DESMOVI_DESARMETRES_64", type="string", length=3999, nullable=true)
     */
    private $ftDesmoviDesarmetres64;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_DESMOVI_DESARMECUATRO_65", type="string", length=3999, nullable=true)
     */
    private $ftDesmoviDesarmecuatro65;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_PERFIL_ACTUAL_68", type="string", length=3999, nullable=true)
     */
    private $ftPerfilActual68;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_REINTEGRACION_71", type="string", length=3999, nullable=true)
     */
    private $ftReintegracion71;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONSENTIMIENTO_FIRMA_73", type="string", length=3999, nullable=true)
     */
    private $ftConsentimientoFirma73;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_AUDIOS_GRABADOS_75", type="string", length=3999, nullable=true)
     */
    private $ftAudiosGrabados75;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_REPORTE_ENTREVISTA_78", type="string", length=3999, nullable=true)
     */
    private $ftReporteEntrevista78;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONCEPTO_ENTREVISTA_80", type="string", length=3999, nullable=true)
     */
    private $ftConceptoEntrevista80;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_INFO_PROCESO_TRANSCRIP_81", type="string", length=3999, nullable=true)
     */
    private $ftInfoProcesoTranscrip81;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ELEMENTOS_ENTREVISTA_87", type="string", length=3999, nullable=true)
     */
    private $ftElementosEntrevista87;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONCEPTO_GENERAL_84", type="string", length=3999, nullable=true)
     */
    private $ftConceptoGeneral84;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ELEMENTOS_EXAMEN_85", type="string", length=3999, nullable=true)
     */
    private $ftElementosExamen85;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ASIGNACION_VALORADOR_88", type="string", length=3999, nullable=true)
     */
    private $ftAsignacionValorador88;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_REPORTE_FIABILIDAD_98", type="string", length=3999, nullable=true)
     */
    private $ftReporteFiabilidad98;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_VALORACION_ASIGNADO_89", type="string", length=3999, nullable=true)
     */
    private $ftValoracionAsignado89;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONFIRMACION_INFO_ROL_93", type="string", length=3999, nullable=true)
     */
    private $ftConfirmacionInfoRol93;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_EXAMEN_VALIDEZ_SUFICI_90", type="string", length=3999, nullable=true)
     */
    private $ftExamenValidezSufici90;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_REPORTE_VALIDEZ_100", type="string", length=3999, nullable=true)
     */
    private $ftReporteValidez100;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_RECOMENDACION_CERTIFI_91", type="string", length=3999, nullable=true)
     */
    private $ftRecomendacionCertifi91;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_ASIGNACION_ABOGADO_110", type="string", length=3999, nullable=true)
     */
    private $ftAsignacionAbogado110;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CONCEPTO_COORDINADOR_94", type="string", length=3999, nullable=true)
     */
    private $ftConceptoCoordinador94;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CERTIFICA_CONTRIBUCION_95", type="string", length=3999, nullable=true)
     */
    private $ftCertificaContribucion95;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_NOTIFICA_RESOLUCION_96", type="string", length=3999, nullable=true)
     */
    private $ftNotificaResolucion96;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_REPORTE_PROCESO_ATIPI_109", type="string", length=3999, nullable=true)
     */
    private $ftReporteProcesoAtipi109;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_TRANSCRIPCION_33", type="string", length=3999, nullable=true)
     */
    private $ftTranscripcion33;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_REVISION_JURIDICA_111", type="string", length=3999, nullable=true)
     */
    private $ftRevisionJuridica111;

    /**
     * @var string
     *
     * @ORM\Column(name="FT_CITACION_AMPLIACION_76", type="string", length=3999, nullable=true)
     */
    private $ftCitacionAmpliacion76;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDVISTA_DAV", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="VISTA_DAV_IDVISTA_DAV_seq", allocationSize=1, initialValue=1)
     */
    private $idvistaDav;


}

