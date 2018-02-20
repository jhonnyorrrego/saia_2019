<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modulo
 *
 * @ORM\Table(name="modulo", uniqueConstraints={@ORM\UniqueConstraint(name="u_modulo_nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Modulo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmodulo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo = 'secundario';

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=false)
     */
    private $imagen = 'botones/configuracion/default.gif';

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="enlace", type="string", length=255, nullable=false)
     */
    private $enlace;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino = 'centro';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", nullable=true)
     */
    private $ayuda = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var integer
     *
     * @ORM\Column(name="permiso_admin", type="integer", nullable=false)
     */
    private $permisoAdmin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="pertenece_nucleo", type="integer", nullable=true)
     */
    private $perteneceNucleo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="busqueda", type="string", length=5, nullable=true)
     */
    private $busqueda = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="enlace_pantalla", type="integer", nullable=true)
     */
    private $enlacePantalla = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="enlace_mobil", type="string", length=255, nullable=true)
     */
    private $enlaceMobil;


}
