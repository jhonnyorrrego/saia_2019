<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busqueda
 *
 * @ORM\Table(name="busqueda", uniqueConstraints={@ORM\UniqueConstraint(name="nombre", columns={"nombre"}), @ORM\UniqueConstraint(name="nombre_2", columns={"nombre"}), @ORM\UniqueConstraint(name="ui_busqueda_nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Busqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ancho", type="integer", nullable=true)
     */
    private $ancho = '200';

    /**
     * @var string
     *
     * @ORM\Column(name="campos", type="text", length=65535, nullable=true)
     */
    private $campos;

    /**
     * @var string
     *
     * @ORM\Column(name="llave", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @var string
     *
     * @ORM\Column(name="tablas", type="string", length=4000, nullable=true)
     */
    private $tablas;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_libreria", type="string", length=255, nullable=true)
     */
    private $rutaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_libreria_pantalla", type="string", length=255, nullable=true)
     */
    private $rutaLibreriaPantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_registros", type="integer", nullable=true)
     */
    private $cantidadRegistros = '30';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_refrescar", type="integer", nullable=true)
     */
    private $tiempoRefrescar = '500';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_visualizacion", type="string", length=255, nullable=true)
     */
    private $rutaVisualizacion = 'pantallas/busqueda/componentes_busqueda.php';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_busqueda", type="integer", nullable=true)
     */
    private $tipoBusqueda = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="badge_cantidades", type="integer", nullable=true)
     */
    private $badgeCantidades;


}

