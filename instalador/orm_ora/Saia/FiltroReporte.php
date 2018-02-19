<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiltroReporte
 *
 * @ORM\Table(name="FILTRO_REPORTE")
 * @ORM\Entity
 */
class FiltroReporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFILTRO_REPORTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FILTRO_REPORTE_IDFILTRO_REPORT", allocationSize=1, initialValue=1)
     */
    private $idfiltroReporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPORTE_IDREPORTE", type="integer", nullable=true)
     */
    private $reporteIdreporte;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO", type="string", length=255, nullable=true)
     */
    private $campo;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA_HTML", type="string", length=255, nullable=true)
     */
    private $etiquetaHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_SQL", type="string", length=2000, nullable=true)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=255, nullable=true)
     */
    private $tipoDato = 'varchar';


}
