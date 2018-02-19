<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formato
 *
 * @ORM\Table(name="FORMATO", indexes={@ORM\Index(name="formato_nombre", columns={"NOMBRE"})})
 * @ORM\Entity
 */
class Formato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FORMATO_IDFORMATO_seq", allocationSize=1, initialValue=1)
     */
    private $idformato;

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
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="CONTADOR_IDCONTADOR", type="integer", nullable=true)
     */
    private $contadorIdcontador = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_TABLA", type="string", length=255, nullable=true)
     */
    private $nombreTabla;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_MOSTRAR", type="string", length=255, nullable=true)
     */
    private $rutaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_EDITAR", type="string", length=255, nullable=true)
     */
    private $rutaEditar;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_ADICIONAR", type="string", length=255, nullable=true)
     */
    private $rutaAdicionar;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIAS", type="string", length=255, nullable=true)
     */
    private $librerias = 'null';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTILOS", type="string", length=255, nullable=true)
     */
    private $estilos = 'null';

    /**
     * @var string
     *
     * @ORM\Column(name="JAVASCRIPT", type="string", length=255, nullable=true)
     */
    private $javascript = 'null';

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="string", length=4000, nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="PIE_PAGINA", type="string", length=4000, nullable=true)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="MARGENES", type="string", length=50, nullable=true)
     */
    private $margenes = '30,30,30,30';

    /**
     * @var string
     *
     * @ORM\Column(name="ORIENTACION", type="string", length=50, nullable=true)
     */
    private $orientacion;

    /**
     * @var string
     *
     * @ORM\Column(name="PAPEL", type="string", length=50, nullable=true)
     */
    private $papel = 'letter';

    /**
     * @var string
     *
     * @ORM\Column(name="EXPORTAR", type="string", length=255, nullable=true)
     */
    private $exportar = 'pdf';

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'sysdate';

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR", type="string", length=1, nullable=true)
     */
    private $mostrar = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=1, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="DETALLE", type="string", length=1, nullable=true)
     */
    private $detalle = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_EDICION", type="string", length=1, nullable=true)
     */
    private $tipoEdicion = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ITEM", type="string", length=1, nullable=true)
     */
    private $item = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="string", length=400, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="CUERPO", type="text", nullable=true)
     */
    private $cuerpo = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="FONT_SIZE", type="string", length=5, nullable=true)
     */
    private $fontSize = '12';

    /**
     * @var string
     *
     * @ORM\Column(name="BANDERAS", type="string", length=255, nullable=true)
     */
    private $banderas = 'm';

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_AUTOGUARDADO", type="string", length=255, nullable=true)
     */
    private $tiempoAutoguardado = '300000';

    /**
     * @var integer
     *
     * @ORM\Column(name="MOSTRAR_PDF", type="integer", nullable=true)
     */
    private $mostrarPdf = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="FK_CATEGORIA_FORMATO", type="string", length=255, nullable=true)
     */
    private $fkCategoriaFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="FLUJO_IDFLUJO", type="string", length=255, nullable=true)
     */
    private $flujoIdflujo;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCION_PREDETERMINADA", type="string", length=255, nullable=true)
     */
    private $funcionPredeterminada;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTER2TAB", type="integer", nullable=true)
     */
    private $enter2tab;

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA_DIGITAL", type="integer", nullable=true)
     */
    private $firmaDigital;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERMITE_IMPRIMIR", type="integer", nullable=true)
     */
    private $permiteImprimir = '0';


}
