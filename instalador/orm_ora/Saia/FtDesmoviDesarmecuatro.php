<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDesmoviDesarmecuatro
 *
 * @ORM\Table(name="FT_DESMOVI_DESARMECUATRO")
 * @ORM\Entity
 */
class FtDesmoviDesarmecuatro
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
    private $serieIdserie = '212';

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_INGRESO_PROGRAMA", type="string", length=255, nullable=false)
     */
    private $anioIngresoPrograma;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_DESMOVI_DESARMECUATRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_DESMOVI_DESARMECUATRO_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftDesmoviDesarmecuatro;

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
     * @ORM\Column(name="RELACION_MANDOS", type="string", length=255, nullable=false)
     */
    private $relacionMandos;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RELACION_MANDOS", type="string", length=255, nullable=true)
     */
    private $otroRelacionMandos;

    /**
     * @var string
     *
     * @ORM\Column(name="RELACION_COMPANIEROS", type="string", length=255, nullable=false)
     */
    private $relacionCompanieros;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_RELACION_COMPANIEROS", type="string", length=255, nullable=true)
     */
    private $otroRelacionCompanieros;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCIONES_FUERZA_PUBLI", type="integer", nullable=true)
     */
    private $accionesFuerzaPubli;

    /**
     * @var integer
     *
     * @ORM\Column(name="SUMINISTRO_INFORMACI", type="integer", nullable=false)
     */
    private $suministroInformaci;

    /**
     * @var integer
     *
     * @ORM\Column(name="RECOMPENSA_CUANTO", type="integer", nullable=true)
     */
    private $recompensaCuanto;

    /**
     * @var integer
     *
     * @ORM\Column(name="TRASLADO_RESIDENCIA", type="integer", nullable=false)
     */
    private $trasladoResidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ACCIONES_FUERZA_PUBLI", type="string", length=255, nullable=true)
     */
    private $otroAccionesFuerzaPubli;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

