<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtValoracionAsignado
 *
 * @ORM\Table(name="FT_VALORACION_ASIGNADO", indexes={@ORM\Index(name="ft_valoracion_asignado_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_valoracion_a", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_reporte_fiabilidad", columns={"FT_REPORTE_FIABILIDAD"}), @ORM\Index(name="i_ft_asignacion_valorador", columns={"FT_ASIGNACION_VALORADOR"})})
 * @ORM\Entity
 */
class FtValoracionAsignado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASIGNACION_VALORADOR", type="integer", nullable=false)
     */
    private $ftAsignacionValorador;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '311';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_VALORACION", type="date", nullable=false)
     */
    private $fechaValoracion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_VALORADOR", type="string", length=255, nullable=false)
     */
    private $nombreValorador;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_VALORACION_ASIGNADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_VALORACION_ASIGNADO_IDFT_VA", allocationSize=1, initialValue=1)
     */
    private $idftValoracionAsignado;

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
     * @ORM\Column(name="FT_REPORTE_FIABILIDAD", type="integer", nullable=false)
     */
    private $ftReporteFiabilidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

