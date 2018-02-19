<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActualizGrupoArmado
 *
 * @ORM\Table(name="FT_ACTUALIZ_GRUPO_ARMADO", indexes={@ORM\Index(name="ft_actualiz_grupo_armado_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_actualiz_gru", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtActualizGrupoArmado
{
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
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '142';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ACTUALIZ_GRUPO_ARMADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ACTUALIZ_GRUPO_ARMADO_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftActualizGrupoArmado;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var string
     *
     * @ORM\Column(name="PAISES_TRAFICANTES", type="string", length=255, nullable=true)
     */
    private $paisesTraficantes;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_GRUPO", type="string", length=255, nullable=true)
     */
    private $accionesGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIF_HOMICIDIO", type="integer", nullable=true)
     */
    private $califHomicidio;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIF_DESAPARICION", type="integer", nullable=true)
     */
    private $califDesaparicion;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_DESPOJO", type="string", length=10, nullable=true)
     */
    private $califDespojo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIF_VIOLENCIA_SEX", type="integer", nullable=true)
     */
    private $califViolenciaSex;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIF_LESIONES_PER", type="integer", nullable=true)
     */
    private $califLesionesPer;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_DESPLAZAMIENTO", type="string", length=10, nullable=true)
     */
    private $califDesplazamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_TORTURA", type="string", length=10, nullable=true)
     */
    private $califTortura;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_SECUESTRO", type="string", length=10, nullable=true)
     */
    private $califSecuestro;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_MASACRES", type="string", length=10, nullable=true)
     */
    private $califMasacres;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_LIMPIEZA", type="string", length=10, nullable=true)
     */
    private $califLimpieza;

    /**
     * @var string
     *
     * @ORM\Column(name="RECURSOS_BLOQUE", type="string", length=255, nullable=false)
     */
    private $recursosBloque;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RECURSOS_BLOQUE", type="string", length=255, nullable=true)
     */
    private $otroRecursosBloque;

    /**
     * @var string
     *
     * @ORM\Column(name="BLOQUE_NARCOTRAFICO", type="string", length=255, nullable=true)
     */
    private $bloqueNarcotrafico;

    /**
     * @var string
     *
     * @ORM\Column(name="RES_RECURSOS_ECONOMICOS", type="string", length=255, nullable=false)
     */
    private $resRecursosEconomicos;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RES_RECURSOS_ECONOMICOS", type="string", length=255, nullable=true)
     */
    private $otroResRecursosEconomicos;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_QUIEN_SUMINISTRA_ARMA", type="string", length=255, nullable=true)
     */
    private $otroQuienSuministraArma;

    /**
     * @var string
     *
     * @ORM\Column(name="RES_INVETIGACION", type="string", length=255, nullable=false)
     */
    private $resInvetigacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_DESAPARECION", type="string", length=10, nullable=true)
     */
    private $califDesaparecion;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_VIOLENCIA", type="string", length=10, nullable=true)
     */
    private $califViolencia;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIF_LESIONES", type="string", length=10, nullable=true)
     */
    private $califLesiones;

    /**
     * @var string
     *
     * @ORM\Column(name="SUMINISTRO_ARMAS", type="string", length=255, nullable=false)
     */
    private $suministroArmas;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_SUMINISTRO_ARMAS", type="string", length=255, nullable=true)
     */
    private $otroSuministroArmas;

    /**
     * @var string
     *
     * @ORM\Column(name="TRAFICANTE_INTER_PAIS", type="string", length=255, nullable=true)
     */
    private $traficanteInterPais;

    /**
     * @var string
     *
     * @ORM\Column(name="INST_FUERZA_PUBLICA", type="string", length=255, nullable=false)
     */
    private $instFuerzaPublica;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_FUERZA_AEREA", type="string", length=255, nullable=true)
     */
    private $undFuerzaAerea;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_POLICIA", type="string", length=255, nullable=true)
     */
    private $undPolicia;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_POLICIA", type="string", length=255, nullable=true)
     */
    private $anioAproxPolicia;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_EJERCITO", type="string", length=255, nullable=true)
     */
    private $undEjercito;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_EJERCITO", type="string", length=255, nullable=true)
     */
    private $anioAproxEjercito;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_ARMADA", type="string", length=255, nullable=true)
     */
    private $anioAproxArmada;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_DAS", type="string", length=255, nullable=true)
     */
    private $undDas;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_DAS", type="string", length=255, nullable=true)
     */
    private $anioDas;

    /**
     * @var string
     *
     * @ORM\Column(name="UND_ARMADA", type="string", length=255, nullable=true)
     */
    private $undArmada;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_APROX_FUERZA_AEREA", type="string", length=255, nullable=true)
     */
    private $anioAproxFuerzaAerea;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_BLOQUE_ACC", type="string", length=255, nullable=false)
     */
    private $nombreBloqueAcc;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_INST_FUERZA_PUBLICA", type="string", length=255, nullable=true)
     */
    private $otroInstFuerzaPublica;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

