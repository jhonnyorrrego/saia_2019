<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReporteFiabilidad
 *
 * @ORM\Table(name="FT_REPORTE_FIABILIDAD", indexes={@ORM\Index(name="ft_reporte_fiabilidad_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_reporte_fiab", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtReporteFiabilidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '328';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REPORTE_FIABILIDAD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REPORTE_FIABILIDAD_IDFT_REP", allocationSize=1, initialValue=1)
     */
    private $idftReporteFiabilidad;

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
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REPORTE_FIABI", type="date", nullable=false)
     */
    private $fechaReporteFiabi = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASIGNACION_VALORADOR", type="integer", nullable=false)
     */
    private $ftAsignacionValorador;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ENTREVISTA", type="string", length=3999, nullable=true)
     */
    private $observacionEntrevista;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_PROFUNDI", type="string", length=3999, nullable=true)
     */
    private $observacionProfundi;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

