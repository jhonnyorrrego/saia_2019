<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaFiltroTemp
 *
 * @ORM\Table(name="busqueda_filtro_temp")
 * @ORM\Entity
 */
class BusquedaFiltroTemp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_filtro_temp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusquedaFiltroTemp;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_busqueda_componente", type="integer", nullable=true)
     */
    private $fkBusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", length=65535, nullable=true)
     */
    private $detalle;


}

