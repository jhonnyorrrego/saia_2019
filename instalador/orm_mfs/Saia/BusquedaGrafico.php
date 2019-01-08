<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaGrafico
 *
 * @ORM\Table(name="busqueda_grafico")
 * @ORM\Entity
 */
class BusquedaGrafico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_grafico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusquedaGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda_componente", type="integer", nullable=false)
     */
    private $busquedaIdbusquedaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquetax", type="string", length=255, nullable=false)
     */
    private $etiquetax;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquetay", type="string", length=255, nullable=false)
     */
    private $etiquetay;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_grafico", type="integer", nullable=false)
     */
    private $tipoGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ancho", type="integer", nullable=false)
     */
    private $ancho = '300';

    /**
     * @var integer
     *
     * @ORM\Column(name="alto", type="integer", nullable=false)
     */
    private $alto = '400';

    /**
     * @var integer
     *
     * @ORM\Column(name="direccion_titulo", type="integer", nullable=false)
     */
    private $direccionTitulo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

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


}

