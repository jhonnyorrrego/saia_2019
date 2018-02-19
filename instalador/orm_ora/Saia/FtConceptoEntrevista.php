<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConceptoEntrevista
 *
 * @ORM\Table(name="FT_CONCEPTO_ENTREVISTA", indexes={@ORM\Index(name="ft_concepto_entrevista_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_concepto_ent", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_reporte_entrevista", columns={"FT_REPORTE_ENTREVISTA"})})
 * @ORM\Entity
 */
class FtConceptoEntrevista
{
    /**
     * @var integer
     *
     * @ORM\Column(name="DIA_ENCUESTA_DIFEREN", type="integer", nullable=false)
     */
    private $diaEncuestaDiferen;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_REPORTE_ENTREVISTA", type="integer", nullable=false)
     */
    private $ftReporteEntrevista;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '301';

    /**
     * @var integer
     *
     * @ORM\Column(name="DILIGENCIA_ENTREVISTA", type="integer", nullable=true)
     */
    private $diligenciaEntrevista;

    /**
     * @var string
     *
     * @ORM\Column(name="DIALOGO_PERSONA", type="text", nullable=true)
     */
    private $dialogoPersona = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONCEPTO_ENTREVISTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONCEPTO_ENTREVISTA_IDFT_CO", allocationSize=1, initialValue=1)
     */
    private $idftConceptoEntrevista;

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
     * @ORM\Column(name="INCONSITENCIAS_INFO", type="text", nullable=true)
     */
    private $inconsitenciasInfo = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CANTIDAD_SESIONES", type="integer", nullable=true)
     */
    private $cantidadSesiones;


}

