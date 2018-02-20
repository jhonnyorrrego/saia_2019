<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CamposFormato
 *
 * @ORM\Table(name="CAMPOS_FORMATO", indexes={@ORM\Index(name="i_campos_for_ayuda_ctx", columns={"AYUDA"}), @ORM\Index(name="i_campos_for_valor_ctx", columns={"VALOR"}), @ORM\Index(name="i_campos_forma_formato_idfo", columns={"FORMATO_IDFORMATO"})})
 * @ORM\Entity
 */
class CamposFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCAMPOS_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CAMPOS_FORMATO_IDCAMPOS_FORMAT", allocationSize=1, initialValue=1)
     */
    private $idcamposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=false)
     */
    private $formatoIdformato = '0';

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


}
