<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaFiltro
 *
 * @ORM\Table(name="busqueda_filtro")
 * @ORM\Entity
 */
class BusquedaFiltro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_filtro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusquedaFiltro;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_busqueda_componente", type="integer", nullable=false)
     */
    private $fkBusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_adicional", type="string", length=255, nullable=false)
     */
    private $tablaAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="where_adicional", type="string", length=255, nullable=false)
     */
    private $whereAdicional;


}
