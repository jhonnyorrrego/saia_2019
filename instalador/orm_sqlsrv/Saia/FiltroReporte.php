<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FiltroReporte
 *
 * @ORM\Table(name="filtro_reporte")
 * @ORM\Entity
 */
class FiltroReporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfiltro_reporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfiltroReporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="reporte_idreporte", type="integer", nullable=false)
     */
    private $reporteIdreporte;

    /**
     * @var string
     *
     * @ORM\Column(name="campo", type="string", length=255, nullable=false)
     */
    private $campo;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_html", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_sql", type="string", length=2000, nullable=true)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=255, nullable=false)
     */
    private $tipoDato = 'varchar';


}
