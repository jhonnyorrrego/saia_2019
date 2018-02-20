<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaEncabezado
 *
 * @ORM\Table(name="busqueda_encabezado")
 * @ORM\Entity
 */
class BusquedaEncabezado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_encabezado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaEncabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="pie", type="text", nullable=true)
     */
    private $pie;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbusqueda_componente", type="integer", nullable=false)
     */
    private $fkIdbusquedaComponente;


}
