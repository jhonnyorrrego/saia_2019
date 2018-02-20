<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesFormato
 *
 * @ORM\Table(name="FUNCIONES_FORMATO")
 * @ORM\Entity
 */
class FuncionesFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONES_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONES_FORMATO_IDFUNCIONES_", allocationSize=1, initialValue=1)
     */
    private $idfuncionesFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_FUNCION", type="string", length=255, nullable=false)
     */
    private $nombreFuncion;

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMATO", type="string", length=500, nullable=true)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES", type="string", length=10, nullable=true)
     */
    private $acciones = 'm';


}
