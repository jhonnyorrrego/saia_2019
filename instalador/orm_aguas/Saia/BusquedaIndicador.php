<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaIndicador
 *
 * @ORM\Table(name="BUSQUEDA_INDICADOR")
 * @ORM\Entity
 */
class BusquedaIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_INDICADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_INDICADOR_IDBUSQUEDA_", allocationSize=1, initialValue=1)
     */
    private $idbusquedaIndicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDA_IDBUSQUEDA_COMPONENTE", type="integer", nullable=false)
     */
    private $busquedaIdbusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="INDICADOR_IDINDICADOR", type="integer", nullable=false)
     */
    private $indicadorIdindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=false)
     */
    private $ancho;

    /**
     * @var integer
     *
     * @ORM\Column(name="ALTO", type="integer", nullable=false)
     */
    private $alto;


}
