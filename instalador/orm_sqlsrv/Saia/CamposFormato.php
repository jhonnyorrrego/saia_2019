<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CamposFormato
 *
 * @ORM\Table(name="campos_formato", uniqueConstraints={@ORM\UniqueConstraint(name="ix_campos_formato_formato", columns={"formato_idformato", "nombre"})}, indexes={@ORM\Index(name="formato_idformato", columns={"formato_idformato"})})
 * @ORM\Entity
 */
class CamposFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcamposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dato", type="string", length=255, nullable=false)
     */
    private $tipoDato = '';

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=255, nullable=true)
     */
    private $longitud;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obligatoriedad", type="boolean", nullable=false)
     */
    private $obligatoriedad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="text", length=65535, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="acciones", type="string", length=10, nullable=true)
     */
    private $acciones = 'a,e,b';

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", length=65535, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="predeterminado", type="string", length=255, nullable=true)
     */
    private $predeterminado;

    /**
     * @var string
     *
     * @ORM\Column(name="banderas", type="string", length=50, nullable=true)
     */
    private $banderas;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_html", type="string", length=255, nullable=false)
     */
    private $etiquetaHtml = 'text';

    /**
     * @var boolean
     *
     * @ORM\Column(name="orden", type="boolean", nullable=false)
     */
    private $orden = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="mascara", type="string", length=255, nullable=true)
     */
    private $mascara;

    /**
     * @var string
     *
     * @ORM\Column(name="adicionales", type="string", length=255, nullable=true)
     */
    private $adicionales;

    /**
     * @var integer
     *
     * @ORM\Column(name="autoguardado", type="integer", nullable=false)
     */
    private $autoguardado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fila_visible", type="integer", nullable=true)
     */
    private $filaVisible = '1';


}
