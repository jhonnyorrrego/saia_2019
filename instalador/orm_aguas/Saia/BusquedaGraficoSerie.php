<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaGraficoSerie
 *
 * @ORM\Table(name="BUSQUEDA_GRAFICO_SERIE")
 * @ORM\Entity
 */
class BusquedaGraficoSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_GRAFICO_SERIE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_GRAFICO_SERIE_IDBUSQU", allocationSize=1, initialValue=1)
     */
    private $idbusquedaGraficoSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDA_GRAFICO_IDBUSQUEDA_GR", type="integer", nullable=false)
     */
    private $busquedaGraficoIdbusquedaGr;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="DATO", type="string", length=255, nullable=false)
     */
    private $dato;

    /**
     * @var string
     *
     * @ORM\Column(name="CONDICION_ADICIONAL", type="text", nullable=true)
     */
    private $condicionAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="MASCARA_DATO", type="string", length=255, nullable=true)
     */
    private $mascaraDato;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;


}
