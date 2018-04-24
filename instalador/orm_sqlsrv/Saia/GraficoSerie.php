<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * GraficoSerie
 *
 * @ORM\Table(name="grafico_serie")
 * @ORM\Entity
 */
class GraficoSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idgrafico_serie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgraficoSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_sql", type="text", length=16777215, nullable=false)
     */
    private $codigoSql;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="grafico_idgrafico", type="integer", nullable=false)
     */
    private $graficoIdgrafico;


}
