<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaCampos
 *
 * @ORM\Table(name="PANTALLA_CAMPOS", indexes={@ORM\Index(name="i_pantalla_c_ayuda_ctx", columns={"AYUDA"}), @ORM\Index(name="i_pantalla_c_valor_ctx", columns={"VALOR"})})
 * @ORM\Entity
 */
class PantallaCampos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_CAMPOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_CAMPOS_IDPANTALLA_CAM", allocationSize=1, initialValue=1)
     */
    private $idpantallaCampos;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA", type="string", length=255, nullable=false)
     */
    private $tabla;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=255, nullable=false)
     */
    private $tipoDato;

    /**
     * @var string
     *
     * @ORM\Column(name="LONGITUD", type="string", length=255, nullable=true)
     */
    private $longitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="OBLIGATORIEDAD", type="integer", nullable=false)
     */
    private $obligatoriedad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="text", nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES", type="string", length=10, nullable=true)
     */
    private $acciones = 'a,e,b';

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="text", nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="PREDETERMINADO", type="string", length=255, nullable=true)
     */
    private $predeterminado;

    /**
     * @var string
     *
     * @ORM\Column(name="BANDERAS", type="string", length=50, nullable=true)
     */
    private $banderas;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA_HTML", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml = 'text';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="MASCARA", type="string", length=255, nullable=true)
     */
    private $mascara;

    /**
     * @var string
     *
     * @ORM\Column(name="ADICIONALES", type="string", length=255, nullable=true)
     */
    private $adicionales;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTOGUARDADO", type="integer", nullable=false)
     */
    private $autoguardado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FILA_VISIBLE", type="integer", nullable=true)
     */
    private $filaVisible = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="PLACEHOLDER", type="string", length=255, nullable=true)
     */
    private $placeholder;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;


}
