<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaIndicador
 *
 * @ORM\Table(name="busqueda_indicador")
 * @ORM\Entity
 */
class BusquedaIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_indicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusquedaIndicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda_componente", type="integer", nullable=false)
     */
    private $busquedaIdbusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_idindicador", type="integer", nullable=false)
     */
    private $indicadorIdindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ancho", type="integer", nullable=false)
     */
    private $ancho;

    /**
     * @var integer
     *
     * @ORM\Column(name="alto", type="integer", nullable=false)
     */
    private $alto;


}
