<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntornoSocioecono
 *
 * @ORM\Table(name="FT_ENTORNO_SOCIOECONO", indexes={@ORM\Index(name="ft_entorno_socioecono_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_entorno_soci", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtEntornoSocioecono
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
    private $serieIdserie = '102';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ENTORNO_SOCIOECONO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ENTORNO_SOCIOECONO_IDFT_ENT", allocationSize=1, initialValue=1)
     */
    private $idftEntornoSocioecono;

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
     * @ORM\Column(name="INSTITUCION_FUERZA_PU", type="string", length=255, nullable=false)
     */
    private $institucionFuerzaPu;

    /**
     * @var string
     *
     * @ORM\Column(name="ORGANIZACION_CUAL", type="text", nullable=true)
     */
    private $organizacionCual = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PRESENCIA_ORGANIZACI", type="string", length=255, nullable=false)
     */
    private $presenciaOrganizaci;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRESENCIA_ORGANIZACI", type="string", length=255, nullable=true)
     */
    private $otroPresenciaOrganizaci;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_CATOLICA", type="integer", nullable=true)
     */
    private $pertenecioCatolica = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_CRISTIANA", type="integer", nullable=true)
     */
    private $pertenecioCristiana = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENE_ACCION_COMUNA", type="integer", nullable=true)
     */
    private $perteneAccionComuna = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_SOCIAL", type="integer", nullable=true)
     */
    private $pertenecioSocial = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_CAMPESINO", type="integer", nullable=true)
     */
    private $pertenecioCampesino = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_SINDICATO", type="integer", nullable=true)
     */
    private $pertenecioSindicato = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_DERECHOS", type="integer", nullable=true)
     */
    private $pertenecioDerechos = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECIO_OTRA", type="integer", nullable=true)
     */
    private $pertenecioOtra = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="ACCESO_SERVICIOS", type="string", length=255, nullable=false)
     */
    private $accesoServicios;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_INSTITUCION_FUERZA_PU", type="string", length=255, nullable=true)
     */
    private $otroInstitucionFuerzaPu;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

