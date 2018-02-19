<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaFiltro
 *
 * @ORM\Table(name="BUSQUEDA_FILTRO", indexes={@ORM\Index(name="i_fk_busqueda_componente", columns={"FK_BUSQUEDA_COMPONENTE"}), @ORM\Index(name="i_busqueda_filtro_funcionario", columns={"FUNCIONARIO_IDFUNCIONARIO"})})
 * @ORM\Entity
 */
class BusquedaFiltro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_FILTRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_FILTRO_IDBUSQUEDA_FIL", allocationSize=1, initialValue=1)
     */
    private $idbusquedaFiltro;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_BUSQUEDA_COMPONENTE", type="integer", nullable=true)
     */
    private $fkBusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA_ADICIONAL", type="string", length=255, nullable=true)
     */
    private $tablaAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="WHERE_ADICIONAL", type="string", length=255, nullable=true)
     */
    private $whereAdicional;


}

