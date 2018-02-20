<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pantalla
 *
 * @ORM\Table(name="PANTALLA", indexes={@ORM\Index(name="i_pantalla_ayuda_ctx", columns={"AYUDA"}), @ORM\Index(name="i_pantalla_librerias_ctx", columns={"LIBRERIAS"})})
 * @ORM\Entity
 */
class Pantalla
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_IDPANTALLA_seq", allocationSize=1, initialValue=1)
     */
    private $idpantalla;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_PANTALLA", type="integer", nullable=false)
     */
    private $tipoPantalla = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIAS", type="text", nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="text", nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="BANDERAS", type="string", length=255, nullable=true)
     */
    private $banderas;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_AUTOGUARDADO", type="integer", nullable=false)
     */
    private $tiempoAutoguardado = '300000';

    /**
     * @var integer
     *
     * @ORM\Column(name="SUBMIT_FORMULARIO", type="integer", nullable=false)
     */
    private $submitFormulario = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="VERSION", type="integer", nullable=false)
     */
    private $version = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="VERSIONAR", type="integer", nullable=true)
     */
    private $versionar;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_PANTALLA", type="string", length=255, nullable=true)
     */
    private $rutaPantalla = 'pantallas';

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_ALMACENAMIENTO", type="string", length=255, nullable=true)
     */
    private $rutaAlmacenamiento = '{*fecha_ano*}/{*fecha_mes*}/{*idpantalla*}';

    /**
     * @var string
     *
     * @ORM\Column(name="PREFIJO", type="string", length=255, nullable=true)
     */
    private $prefijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_EDICION", type="integer", nullable=true)
     */
    private $tipoEdicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN_PANTALLA", type="integer", nullable=true)
     */
    private $ordenPantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTER2TAB", type="integer", nullable=true)
     */
    private $enter2tab;

    /**
     * @var string
     *
     * @ORM\Column(name="FK_IDPANTALLA_CATEGORIA", type="string", length=255, nullable=true)
     */
    private $fkIdpantallaCategoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="CLASE", type="integer", nullable=true)
     */
    private $clase;

    /**
     * @var integer
     *
     * @ORM\Column(name="APROBACION_AUTOMATICA", type="integer", nullable=true)
     */
    private $aprobacionAutomatica = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="AFECTA_DOCUMENTO", type="integer", nullable=true)
     */
    private $afectaDocumento;


}
