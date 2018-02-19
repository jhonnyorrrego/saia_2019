<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaUnion
 *
 * @ORM\Table(name="BUSQUEDA_UNION")
 * @ORM\Entity
 */
class BusquedaUnion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_UNION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_UNION_IDBUSQUEDA_UNIO", allocationSize=1, initialValue=1)
     */
    private $idbusquedaUnion;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=255, nullable=true)
     */
    private $tipoDato;

    /**
     * @var integer
     *
     * @ORM\Column(name="CAMPO_ORIGEN", type="integer", nullable=true)
     */
    private $campoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="CAMPO_DESTINO", type="integer", nullable=true)
     */
    private $campoDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA_ORIGEN", type="string", length=255, nullable=true)
     */
    private $tablaOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA_DESTINO", type="string", length=255, nullable=true)
     */
    private $tablaDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR_NULOS", type="string", length=1, nullable=true)
     */
    private $mostrarNulos;


}

