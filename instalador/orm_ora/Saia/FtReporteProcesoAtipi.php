<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReporteProcesoAtipi
 *
 * @ORM\Table(name="FT_REPORTE_PROCESO_ATIPI", indexes={@ORM\Index(name="ft_reporte_proceso_atipi_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_reporte_proc", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtReporteProcesoAtipi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="MOTIVO_PROCESO_ATIPI", type="integer", nullable=false)
     */
    private $motivoProcesoAtipi;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REPORTE_PROCESO_ATIPI", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REPORTE_PROCESO_ATIPI_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftReporteProcesoAtipi;

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
    private $serieIdserie = '484';

    /**
     * @var string
     *
     * @ORM\Column(name="CONSECUTIVO_CIU_PROCE", type="string", length=255, nullable=false)
     */
    private $consecutivoCiuProce;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIBA_SITUACION", type="text", nullable=true)
     */
    private $describaSituacion = 'EMPTY_CLOB()';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RADICA_PROCESO", type="date", nullable=false)
     */
    private $fechaRadicaProceso = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="SOPORTE_ENTIDAD", type="string", length=255, nullable=true)
     */
    private $soporteEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_PROCESO", type="text", nullable=true)
     */
    private $descripcionProceso = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEPCION_ACUERDOS", type="integer", nullable=false)
     */
    private $ftRecepcionAcuerdos;


}

