<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pantalla
 *
 * @ORM\Table(name="pantalla")
 * @ORM\Entity
 */
class Pantalla
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantalla;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_pantalla", type="integer", nullable=false)
     */
    private $tipoPantalla = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="text", length=65535, nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", length=65535, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="banderas", type="string", length=255, nullable=true)
     */
    private $banderas;

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_autoguardado", type="integer", nullable=false)
     */
    private $tiempoAutoguardado = '300000';

    /**
     * @var integer
     *
     * @ORM\Column(name="submit_formulario", type="integer", nullable=false)
     */
    private $submitFormulario = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="versionar", type="integer", nullable=true)
     */
    private $versionar;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_pantalla", type="string", length=255, nullable=true)
     */
    private $rutaPantalla = 'pantallas';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_almacenamiento", type="string", length=255, nullable=true)
     */
    private $rutaAlmacenamiento = '{*fecha_ano*}/{*fecha_mes*}/{*idpantalla*}';

    /**
     * @var string
     *
     * @ORM\Column(name="prefijo", type="string", length=255, nullable=true)
     */
    private $prefijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_edicion", type="integer", nullable=true)
     */
    private $tipoEdicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_pantalla", type="integer", nullable=true)
     */
    private $ordenPantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="enter2tab", type="integer", nullable=true)
     */
    private $enter2tab;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_idpantalla_categoria", type="string", length=255, nullable=true)
     */
    private $fkIdpantallaCategoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase", type="integer", nullable=true)
     */
    private $clase;

    /**
     * @var integer
     *
     * @ORM\Column(name="aprobacion_automatica", type="integer", nullable=true)
     */
    private $aprobacionAutomatica = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="afecta_documento", type="integer", nullable=true)
     */
    private $afectaDocumento;


}

