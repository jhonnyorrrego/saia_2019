<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaGrafico
 *
 * @ORM\Table(name="BUSQUEDA_GRAFICO")
 * @ORM\Entity
 */
class BusquedaGrafico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_GRAFICO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_GRAFICO_IDBUSQUEDA_GR", allocationSize=1, initialValue=1)
     */
    private $idbusquedaGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDA_IDBUSQUEDA_COMPONENTE", type="integer", nullable=false)
     */
    private $busquedaIdbusquedaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETAX", type="string", length=255, nullable=false)
     */
    private $etiquetax;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETAY", type="string", length=255, nullable=false)
     */
    private $etiquetay;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_GRAFICO", type="integer", nullable=false)
     */
    private $tipoGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=false)
     */
    private $ancho = '300';

    /**
     * @var integer
     *
     * @ORM\Column(name="ALTO", type="integer", nullable=false)
     */
    private $alto = '400';

    /**
     * @var integer
     *
     * @ORM\Column(name="DIRECCION_TITULO", type="integer", nullable=false)
     */
    private $direccionTitulo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="INDICADOR_IDINDICADOR", type="integer", nullable=false)
     */
    private $indicadorIdindicador;


}
