<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaEncabezado
 *
 * @ORM\Table(name="BUSQUEDA_ENCABEZADO", indexes={@ORM\Index(name="i_busqueda_e_pie_ctx", columns={"PIE"})})
 * @ORM\Entity
 */
class BusquedaEncabezado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_ENCABEZADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_ENCABEZADO_IDBUSQUEDA", allocationSize=1, initialValue=1)
     */
    private $idbusquedaEncabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="PIE", type="text", nullable=true)
     */
    private $pie;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDBUSQUEDA_COMPONENTE", type="integer", nullable=false)
     */
    private $fkIdbusquedaComponente;


}
