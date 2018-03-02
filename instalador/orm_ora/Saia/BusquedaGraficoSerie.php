<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaGraficoSerie
 *
 * @ORM\Table(name="busqueda_grafico_serie")
 * @ORM\Entity
 */
class BusquedaGraficoSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_grafico_serie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaGraficoSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_grafico_idbusqueda_gr", type="integer", nullable=false)
     */
    private $busquedaGraficoIdbusquedaGr;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="dato", type="string", length=255, nullable=false)
     */
    private $dato;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion_adicional", type="text", nullable=true)
     */
    private $condicionAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="mascara_dato", type="string", length=255, nullable=true)
     */
    private $mascaraDato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;


}
