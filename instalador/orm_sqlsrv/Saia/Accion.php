<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accion
 *
 * @ORM\Table(name="accion")
 * @ORM\Entity
 */
class Accion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idaccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="funcion", type="string", length=255, nullable=true)
     */
    private $funcion;

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="boton", type="string", length=255, nullable=true)
     */
    private $boton;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo;


}
