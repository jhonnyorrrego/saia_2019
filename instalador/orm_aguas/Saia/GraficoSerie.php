<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraficoSerie
 *
 * @ORM\Table(name="GRAFICO_SERIE")
 * @ORM\Entity
 */
class GraficoSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDGRAFICO_SERIE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="GRAFICO_SERIE_IDGRAFICO_SERIE_", allocationSize=1, initialValue=1)
     */
    private $idgraficoSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_SQL", type="text", nullable=false)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="GRAFICO_IDGRAFICO", type="integer", nullable=false)
     */
    private $graficoIdgrafico;


}
