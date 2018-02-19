<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPerfilEntrevista
 *
 * @ORM\Table(name="FT_PERFIL_ENTREVISTA", indexes={@ORM\Index(name="ft_perfil_entrevista_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_perfil_entre", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtPerfilEntrevista
{
    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XV_OTRAOPCION", type="string", length=255, nullable=true)
     */
    private $otroPreXvOtraopcion;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_IX_DEPARMUNICIPIO", type="string", length=255, nullable=false)
     */
    private $preIxDeparmunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_IX_SITIO", type="integer", nullable=true)
     */
    private $preIxSitio;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_IX_CUAL", type="string", length=255, nullable=true)
     */
    private $preIxCual;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_VIII_MES", type="string", length=255, nullable=false)
     */
    private $preViiiMes;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_PERFIL_ENTREVISTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_PERFIL_ENTREVISTA_IDFT_PERF", allocationSize=1, initialValue=1)
     */
    private $idftPerfilEntrevista;

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
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '62';

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_X_DONDEVIVIA", type="integer", nullable=false)
     */
    private $preXDondevivia;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_X_DEPARMUNICIPIO", type="string", length=255, nullable=true)
     */
    private $preXDeparmunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_X_SITIO", type="integer", nullable=true)
     */
    private $preXSitio;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_X_CUAL", type="string", length=255, nullable=true)
     */
    private $preXCual;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XI_MOTIVACION", type="integer", nullable=false)
     */
    private $preXiMotivacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XII_ESTADOCIVIL", type="integer", nullable=false)
     */
    private $preXiiEstadocivil;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XIII_NUMEROHIJOS", type="integer", nullable=false)
     */
    private $preXiiiNumerohijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XIV_GRADO", type="integer", nullable=false)
     */
    private $preXivGrado;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIV_ULTIMOGRADO", type="string", length=255, nullable=true)
     */
    private $preXivUltimogrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XIV_COMPLETA", type="integer", nullable=true)
     */
    private $preXivCompleta;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_TRABAJO", type="string", length=255, nullable=true)
     */
    private $preXvTrabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_TIEMPO", type="string", length=255, nullable=true)
     */
    private $preXvTiempo;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_CUAL", type="string", length=255, nullable=true)
     */
    private $preXvCual;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XVI_TIPOTRABAJO", type="integer", nullable=true)
     */
    private $preXviTipotrabajo;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XVII_INSTITUCION", type="integer", nullable=true)
     */
    private $preXviiInstitucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XVIII_PARTICIPA", type="integer", nullable=true)
     */
    private $preXviiiParticipa;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XVIII_CARGO", type="string", length=255, nullable=true)
     */
    private $preXviiiCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIX_RANGO", type="string", length=255, nullable=true)
     */
    private $preXixRango;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIX_DURAANIOS", type="string", length=255, nullable=true)
     */
    private $preXixDuraanios;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XIX_DURAMESES", type="string", length=255, nullable=true)
     */
    private $preXixDurameses;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XX_NOPERTENECE", type="integer", nullable=true)
     */
    private $preXxNopertenece;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXI_RAZONRETIRO", type="integer", nullable=true)
     */
    private $preXxiRazonretiro;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XVI_TIPOTRABAJO", type="string", length=255, nullable=true)
     */
    private $otroPreXviTipotrabajo;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXII_RETIRO", type="integer", nullable=true)
     */
    private $preXxiiRetiro;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_ACTIVIDAD", type="string", length=255, nullable=true)
     */
    private $preXxiiiActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_CUALGRUPO", type="string", length=255, nullable=true)
     */
    private $preXxiiiCualgrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_TIPOINFO", type="text", nullable=true)
     */
    private $preXxiiiTipoinfo = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXIII_CUALACCION", type="text", nullable=true)
     */
    private $preXxiiiCualaccion = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXIII_NINGUNA", type="integer", nullable=true)
     */
    private $preXxiiiNinguna;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XV_ACTIVIDAD", type="string", length=255, nullable=true)
     */
    private $preXvActividad;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ESTUDIO", type="string", length=255, nullable=true)
     */
    private $tipoEstudio;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XVIII_PARTICIPA", type="string", length=255, nullable=true)
     */
    private $otroPreXviiiParticipa;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XI_MOTIVACION", type="string", length=255, nullable=true)
     */
    private $otroPreXiMotivacion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XVII_INSTITUCION", type="string", length=255, nullable=true)
     */
    private $otroPreXviiInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XXI_RAZONRETIRO", type="string", length=255, nullable=true)
     */
    private $otroPreXxiRazonretiro;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_VIII_ANIO", type="string", length=255, nullable=false)
     */
    private $preViiiAnio;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

