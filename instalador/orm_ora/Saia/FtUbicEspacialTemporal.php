<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtUbicEspacialTemporal
 *
 * @ORM\Table(name="FT_UBIC_ESPACIAL_TEMPORAL", indexes={@ORM\Index(name="i_ft_anteceden_trayectoria", columns={"FT_ANTECEDEN_TRAYECTORIA"})})
 * @ORM\Entity
 */
class FtUbicEspacialTemporal
{
    /**
     * @var string
     *
     * @ORM\Column(name="LUGARES_PERMANENCIA", type="string", length=255, nullable=true)
     */
    private $lugaresPermanencia;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_MAS_PERMANCENCIA", type="string", length=255, nullable=true)
     */
    private $lugarMasPermancencia;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_LUGARES", type="string", length=255, nullable=true)
     */
    private $nombreLugares;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ANTECEDEN_TRAYECTORIA", type="integer", nullable=false)
     */
    private $ftAntecedenTrayectoria;

    /**
     * @var string
     *
     * @ORM\Column(name="ESCUELAS_ENTRENAMIENTO", type="string", length=255, nullable=true)
     */
    private $escuelasEntrenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="CENTROS_MANDO", type="string", length=255, nullable=true)
     */
    private $centrosMando;

    /**
     * @var string
     *
     * @ORM\Column(name="BASES_MILITARES", type="string", length=255, nullable=true)
     */
    private $basesMilitares;

    /**
     * @var string
     *
     * @ORM\Column(name="NRO_INTEGRANTES_GRUPO", type="string", length=255, nullable=true)
     */
    private $nroIntegrantesGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS_PERSONA", type="string", length=255, nullable=true)
     */
    private $aliasPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTOS_PERMANENCIA", type="string", length=255, nullable=true)
     */
    private $deptosPermanencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_UBIC_ESPACIAL_TEMPORAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_UBIC_ESPACIAL_TEMPORAL_IDFT", allocationSize=1, initialValue=1)
     */
    private $idftUbicEspacialTemporal;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '130';

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_INGRESO_GRUPO", type="string", length=255, nullable=false)
     */
    private $anioIngresoGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_SALIDA_GRUPO", type="string", length=255, nullable=false)
     */
    private $anioSalidaGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NOMBRE_GRUPO_ARMADO", type="integer", nullable=true)
     */
    private $nombreGrupoArmado;

    /**
     * @var string
     *
     * @ORM\Column(name="ESPECIALIDAD_ROL", type="string", length=255, nullable=true)
     */
    private $especialidadRol;

    /**
     * @var integer
     *
     * @ORM\Column(name="ROL_PRINCIPAL_GRUPO", type="integer", nullable=true)
     */
    private $rolPrincipalGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTOS_PERMANENCIA1", type="string", length=255, nullable=true)
     */
    private $deptosPermanencia1;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPTOS_PERMANENCIA2", type="string", length=255, nullable=true)
     */
    private $deptosPermanencia2;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_MAS_PERMANCENCIA1", type="string", length=255, nullable=true)
     */
    private $lugarMasPermancencia1;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_MAS_PERMANCENCIA2", type="string", length=255, nullable=true)
     */
    private $lugarMasPermancencia2;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXPORT_DATO", type="integer", nullable=false)
     */
    private $exportDato = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="POSTERIOR_EDITAR", type="string", length=255, nullable=true)
     */
    private $posteriorEditar = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="POSTERIOR_ADICIONAR", type="string", length=255, nullable=true)
     */
    private $posteriorAdicionar = '0';


}

