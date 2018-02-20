<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaUnion
 *
 * @ORM\Table(name="busqueda_union")
 * @ORM\Entity
 */
class BusquedaUnion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_union", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_UNION_IDBUSQUEDA_UNIO", allocationSize=1, initialValue=1)
     */
    private $idbusquedaUnion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=255, nullable=true)
     */
    private $tipoDato;

    /**
     * @var integer
     *
     * @ORM\Column(name="campo_origen", type="integer", nullable=false)
     */
    private $campoOrigen = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="campo_destino", type="integer", nullable=false)
     */
    private $campoDestino = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_destino", type="string", length=255, nullable=false)
     */
    private $tablaDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_origen", type="string", length=255, nullable=false)
     */
    private $tablaOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar_nulos", type="string", length=255, nullable=true)
     */
    private $mostrarNulos;


}

