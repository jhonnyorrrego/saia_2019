<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CamposFormato
 *
 * @ORM\Table(name="CAMPOS_FORMATO")
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
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=true)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta = '';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DATO", type="string", length=255, nullable=true)
     */
    private $tipoDato = '';

    /**
     * @var string
     *
     * @ORM\Column(name="LONGITUD", type="string", length=255, nullable=true)
     */
    private $longitud;

    /**
     * @var boolean
     *
     * @ORM\Column(name="OBLIGATORIEDAD", type="boolean", nullable=true)
     */
    private $obligatoriedad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=2000, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES", type="string", length=11, nullable=true)
     */
    private $acciones = 'a,e';

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="string", length=1000, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA_HTML", type="string", length=255, nullable=true)
     */
    private $etiquetaHtml = 'text';

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
     * @var boolean
     *
     * @ORM\Column(name="AUTOGUARDADO", type="boolean", nullable=true)
     */
    private $autoguardado = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="FILA_VISIBLE", type="boolean", nullable=true)
     */
    private $filaVisible = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVA_OTRO", type="integer", nullable=true)
     */
    private $activaOtro;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR_OTRO", type="string", length=255, nullable=true)
     */
    private $valorOtro;

    /**
     * @var integer
     *
     * @ORM\Column(name="OTRO_CUAL", type="integer", nullable=false)
     */
    private $otroCual = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="PADRE_OTRO", type="integer", nullable=false)
     */
    private $padreOtro = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="HIJO_OTRO", type="integer", nullable=false)
     */
    private $hijoOtro = '0';


}
