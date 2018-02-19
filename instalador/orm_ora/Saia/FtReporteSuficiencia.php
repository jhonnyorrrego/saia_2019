<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReporteSuficiencia
 *
 * @ORM\Table(name="FT_REPORTE_SUFICIENCIA", indexes={@ORM\Index(name="ft_reporte_suficiencia_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_ft_examen_validez_sufici", columns={"FT_EXAMEN_VALIDEZ_SUFICI"})})
 * @ORM\Entity
 */
class FtReporteSuficiencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '329';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REPORTE_SUFICIENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REPORTE_SUFICIENCIA_IDFT_RE", allocationSize=1, initialValue=1)
     */
    private $idftReporteSuficiencia;

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
     * @ORM\Column(name="ENTRENAMIENTO_ESTRUC", type="integer", nullable=false)
     */
    private $entrenamientoEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACIONES_OTROS", type="integer", nullable=false)
     */
    private $relacionesOtros;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODO_INGRESO_ESTRUC", type="integer", nullable=false)
     */
    private $modoIngresoEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="TERRITORIO_OPERACION", type="integer", nullable=false)
     */
    private $territorioOperacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTREMANIENTO_FORMAS", type="integer", nullable=true)
     */
    private $entremanientoFormas;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOTACION_INGRESO", type="integer", nullable=false)
     */
    private $dotacionIngreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="REGLAMEN_ESTRUCTURA", type="integer", nullable=true)
     */
    private $reglamenEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="DINAMICA_GRUPO_ARMADO", type="integer", nullable=false)
     */
    private $dinamicaGrupoArmado;

    /**
     * @var integer
     *
     * @ORM\Column(name="HECHO_CONOCIDO_ESTRUC", type="integer", nullable=true)
     */
    private $hechoConocidoEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORGANIZA_ESTRUCTURA", type="integer", nullable=false)
     */
    private $organizaEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="MANDOS_COMPOSI_ESTRUC", type="integer", nullable=false)
     */
    private $mandosComposiEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="DONDE_OPERABA_ESTRUC", type="integer", nullable=false)
     */
    private $dondeOperabaEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="APORTA_ORIGEN_ESTRUC", type="integer", nullable=true)
     */
    private $aportaOrigenEstruc;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPERTOR_VIOLENCIA", type="integer", nullable=true)
     */
    private $repertorViolencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="HALLAZGO_VIOLENCIA", type="integer", nullable=false)
     */
    private $hallazgoViolencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="HALLAZGO_MECANISMO", type="integer", nullable=false)
     */
    private $hallazgoMecanismo;

    /**
     * @var integer
     *
     * @ORM\Column(name="HALLAZGO_TORTURA", type="integer", nullable=false)
     */
    private $hallazgoTortura;

    /**
     * @var integer
     *
     * @ORM\Column(name="VIOLENCIA_DIRIGIDA", type="integer", nullable=false)
     */
    private $violenciaDirigida;

    /**
     * @var integer
     *
     * @ORM\Column(name="RECLUTA_FORZADO", type="integer", nullable=false)
     */
    private $reclutaForzado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_BELICA_ARMADA", type="integer", nullable=true)
     */
    private $accionBelicaArmada;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_POLITICOS", type="integer", nullable=true)
     */
    private $relacionPoliticos;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACION_FUERZAS", type="integer", nullable=true)
     */
    private $relacionFuerzas;

    /**
     * @var integer
     *
     * @ORM\Column(name="RELACIONES_ACTORES", type="integer", nullable=true)
     */
    private $relacionesActores;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMAS_FINANCIACION", type="integer", nullable=true)
     */
    private $formasFinanciacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUTA_RECORRIDA", type="integer", nullable=false)
     */
    private $rutaRecorrida;

    /**
     * @var integer
     *
     * @ORM\Column(name="MECANISMO_ESTRUCTURA", type="integer", nullable=false)
     */
    private $mecanismoEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVIDAD_ESTRUCTURA", type="integer", nullable=false)
     */
    private $actividadEstructura;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMA_COERCION_ESTRUC", type="integer", nullable=false)
     */
    private $formaCoercionEstruc;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_SUFICIEN", type="string", length=3999, nullable=true)
     */
    private $observacionSuficien;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_EXAMEN_VALIDEZ_SUFICI", type="integer", nullable=false)
     */
    private $ftExamenValidezSufici;


}

