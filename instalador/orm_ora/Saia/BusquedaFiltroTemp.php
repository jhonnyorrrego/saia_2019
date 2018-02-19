<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaFiltroTemp
 *
 * @ORM\Table(name="BUSQUEDA_FILTRO_TEMP", indexes={@ORM\Index(name="i_busqueda_filtro_temp1", columns={"FK_BUSQUEDA_COMPONENTE"}), @ORM\Index(name="filtro_temp_funcionario", columns={"FUNCIONARIO_IDFUNCIONARIO"})})
 * @ORM\Entity
 */
class BusquedaFiltroTemp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_FILTRO_TEMP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_FILTRO_TEMP_IDBUSQUED", allocationSize=1, initialValue=1)
     */
    private $idbusquedaFiltroTemp;

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
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="DETALLE", type="text", nullable=true)
     */
    private $detalle = 'empty_clob()';


}

