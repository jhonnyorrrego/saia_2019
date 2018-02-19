<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTablaGrupoIlegal
 *
 * @ORM\Table(name="FT_TABLA_GRUPO_ILEGAL")
 * @ORM\Entity
 */
class FtTablaGrupoIlegal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_TABLA_GRUPO_ILEGAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_TABLA_GRUPO_ILEGAL_IDFT_TAB", allocationSize=1, initialValue=1)
     */
    private $idftTablaGrupoIlegal;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ANTECEDEN_TRAYECTORIA", type="integer", nullable=false)
     */
    private $ftAntecedenTrayectoria;

    /**
     * @var string
     *
     * @ORM\Column(name="GRUPO_ARMADO_ILEGAL", type="string", length=255, nullable=false)
     */
    private $grupoArmadoIlegal;

    /**
     * @var string
     *
     * @ORM\Column(name="GRUPO_ARMADO_MES", type="string", length=255, nullable=true)
     */
    private $grupoArmadoMes;

    /**
     * @var string
     *
     * @ORM\Column(name="GRUPO_ARMADO_ANIO", type="string", length=255, nullable=true)
     */
    private $grupoArmadoAnio;

    /**
     * @var string
     *
     * @ORM\Column(name="EDAD_VINCULACION", type="string", length=255, nullable=true)
     */
    private $edadVinculacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS_PERSONA", type="string", length=255, nullable=true)
     */
    private $aliasPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="ROL_GRUPO_ARMADO", type="string", length=255, nullable=true)
     */
    private $rolGrupoArmado;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS_MANDO_GRUPO", type="string", length=255, nullable=true)
     */
    private $aliasMandoGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="ROL_PERSONA_GRUPO", type="string", length=255, nullable=true)
     */
    private $rolPersonaGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_SALIDA_GRUPO", type="string", length=255, nullable=true)
     */
    private $anioSalidaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="MES_SALIDA_GRUPO", type="string", length=255, nullable=true)
     */
    private $mesSalidaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_GRUPO_ARMADO", type="string", length=255, nullable=true)
     */
    private $nombreGrupoArmado;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

