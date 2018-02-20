<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modulo
 *
 * @ORM\Table(name="MODULO", indexes={@ORM\Index(name="i_modulo_ayuda_ctx", columns={"AYUDA"})})
 * @ORM\Entity
 */
class Modulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDMODULO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="MODULO_IDMODULO_seq", allocationSize=1, initialValue=1)
     */
    private $idmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo = 'secundario';

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=false)
     */
    private $imagen = 'botones/configuracion/default.gif';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ENLACE", type="string", length=255, nullable=false)
     */
    private $enlace;

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINO", type="string", length=255, nullable=false)
     */
    private $destino = 'centro';

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="text", nullable=true)
     */
    private $ayuda = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="PARAMETROS", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDA_IDBUSQUEDA", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERMISO_ADMIN", type="integer", nullable=false)
     */
    private $permisoAdmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECE_NUCLEO", type="integer", nullable=true)
     */
    private $perteneceNucleo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="BUSQUEDA", type="string", length=5, nullable=true)
     */
    private $busqueda = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENLACE_PANTALLA", type="integer", nullable=true)
     */
    private $enlacePantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ENLACE_MOBIL", type="string", length=255, nullable=true)
     */
    private $enlaceMobil;


}
