<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReporteEntrevista
 *
 * @ORM\Table(name="FT_REPORTE_ENTREVISTA", indexes={@ORM\Index(name="ft_reporte_entrevista_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_reporte_entr", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_audios_grabados", columns={"FT_AUDIOS_GRABADOS"})})
 * @ORM\Entity
 */
class FtReporteEntrevista
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
    private $serieIdserie = '281';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_CIU", type="string", length=255, nullable=true)
     */
    private $codigoCiu;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMENTO_REPORTE", type="string", length=255, nullable=true)
     */
    private $departamentoReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="MUNICIPIO_REPORTE", type="string", length=255, nullable=false)
     */
    private $municipioReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_INICIO_ENTREVIS", type="string", length=255, nullable=false)
     */
    private $fechaInicioEntrevis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REPORTE", type="date", nullable=false)
     */
    private $fechaReporte = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ENTREVISTADOR", type="string", length=255, nullable=true)
     */
    private $nombreEntrevistador;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_ENTREVISTADOR", type="string", length=255, nullable=true)
     */
    private $cargoEntrevistador;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_REGIONAL_REPORTE", type="string", length=255, nullable=true)
     */
    private $sedeRegionalReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="SEDE_SUBREGIONAL", type="string", length=255, nullable=true)
     */
    private $sedeSubregional;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_REALIZA_ENTREVI", type="string", length=255, nullable=true)
     */
    private $lugarRealizaEntrevi;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REPORTE_ENTREVISTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REPORTE_ENTREVISTA_IDFT_REP", allocationSize=1, initialValue=1)
     */
    private $idftReporteEntrevista;

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
     * @ORM\Column(name="FT_AUDIOS_GRABADOS", type="integer", nullable=false)
     */
    private $ftAudiosGrabados;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

