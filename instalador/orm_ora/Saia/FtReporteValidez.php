<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReporteValidez
 *
 * @ORM\Table(name="FT_REPORTE_VALIDEZ", indexes={@ORM\Index(name="ft_reporte_validez_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_reporte_vali", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_reporte_suficiencia", columns={"FT_REPORTE_SUFICIENCIA"})})
 * @ORM\Entity
 */
class FtReporteValidez
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '341';

    /**
     * @var integer
     *
     * @ORM\Column(name="INFO_CONFORMACION", type="integer", nullable=true)
     */
    private $infoConformacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_CONFORMA", type="integer", nullable=true)
     */
    private $tiempoConforma;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENTOS_CONFORMA", type="integer", nullable=true)
     */
    private $eventosConforma;

    /**
     * @var integer
     *
     * @ORM\Column(name="BASE_CONFORMACION", type="integer", nullable=true)
     */
    private $baseConformacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="INFO_CONTEXTO", type="integer", nullable=true)
     */
    private $infoContexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_CONTEXTO", type="integer", nullable=true)
     */
    private $tiempoContexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENTOS_CONTEXTO", type="integer", nullable=true)
     */
    private $eventosContexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="BASE_CONTEXTO", type="integer", nullable=true)
     */
    private $baseContexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="INFORMACION_HECHOS", type="integer", nullable=true)
     */
    private $informacionHechos;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_HECHOS", type="integer", nullable=true)
     */
    private $tiempoHechos;

    /**
     * @var integer
     *
     * @ORM\Column(name="EVENTOS_HECHOS", type="integer", nullable=true)
     */
    private $eventosHechos;

    /**
     * @var integer
     *
     * @ORM\Column(name="LINEA_BASE_HECHOS", type="integer", nullable=true)
     */
    private $lineaBaseHechos;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REPORTE_VALIDEZ", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REPORTE_VALIDEZ_IDFT_REPORT", allocationSize=1, initialValue=1)
     */
    private $idftReporteValidez;

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
     * @ORM\Column(name="FT_REPORTE_SUFICIENCIA", type="integer", nullable=true)
     */
    private $ftReporteSuficiencia;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_VALIDEZ", type="string", length=3999, nullable=true)
     */
    private $observacionValidez;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_EXAMEN_VALIDEZ_SUFICI", type="integer", nullable=false)
     */
    private $ftExamenValidezSufici;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REPORTE", type="date", nullable=false)
     */
    private $fechaReporte = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_CONFORMA_ETIQ", type="text", nullable=true)
     */
    private $tiempoConformaEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTOS_CONFORMA_ETIQ", type="text", nullable=true)
     */
    private $eventosConformaEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="BASE_CONFORMACION_ETIQ", type="text", nullable=true)
     */
    private $baseConformacionEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_CONTEXTO_ETIQ", type="text", nullable=true)
     */
    private $infoContextoEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_CONTEXTO_ETIQ", type="text", nullable=true)
     */
    private $tiempoContextoEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTOS_CONTEXTO_ETIQ", type="text", nullable=true)
     */
    private $eventosContextoEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ETIQUE", type="text", nullable=true)
     */
    private $observacionEtique = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="INFORMACION_HECHO_ETIQ", type="text", nullable=true)
     */
    private $informacionHechoEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_HECHOS_ETIQ", type="text", nullable=true)
     */
    private $tiempoHechosEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTOS_HECHOS_ETIQ", type="text", nullable=true)
     */
    private $eventosHechosEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="LINEA_BASE_HECHOS_ETIQ", type="text", nullable=true)
     */
    private $lineaBaseHechosEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CONFORMACION_ETIQUETA", type="text", nullable=true)
     */
    private $conformacionEtiqueta = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CONTEXTO_ETIQUETA", type="text", nullable=true)
     */
    private $contextoEtiqueta = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="HECHOS_ETIQUETA", type="text", nullable=true)
     */
    private $hechosEtiqueta = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="INFO_CONFORMACION_ETIQ", type="text", nullable=true)
     */
    private $infoConformacionEtiq = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="BASE_CONTEXTO_ETIQ", type="text", nullable=true)
     */
    private $baseContextoEtiq = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

