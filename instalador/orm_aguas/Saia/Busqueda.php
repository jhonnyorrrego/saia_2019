<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busqueda
 *
 * @ORM\Table(name="BUSQUEDA", indexes={@ORM\Index(name="i_busqueda_campos_ctx", columns={"CAMPOS"}), @ORM\Index(name="i_busqueda_tablas_ctx", columns={"TABLAS"})})
 * @ORM\Entity
 */
class Busqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_IDBUSQUEDA_seq", allocationSize=1, initialValue=1)
     */
    private $idbusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ANCHO", type="integer", nullable=true)
     */
    private $ancho = '200';

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS", type="text", nullable=true)
     */
    private $campos;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE", type="string", length=255, nullable=true)
     */
    private $llave;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLAS", type="string", length=4000, nullable=true)
     */
    private $tablas;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_LIBRERIA", type="string", length=255, nullable=true)
     */
    private $rutaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_LIBRERIA_PANTALLA", type="string", length=255, nullable=true)
     */
    private $rutaLibreriaPantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="CANTIDAD_REGISTROS", type="integer", nullable=true)
     */
    private $cantidadRegistros = '30';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_REFRESCAR", type="integer", nullable=true)
     */
    private $tiempoRefrescar = '500';

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_VISUALIZACION", type="string", length=255, nullable=true)
     */
    private $rutaVisualizacion = 'pantallas/busqueda/componentes_busqueda.php';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_BUSQUEDA", type="integer", nullable=true)
     */
    private $tipoBusqueda = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="BADGE_CANTIDADES", type="integer", nullable=true)
     */
    private $badgeCantidades;


}
