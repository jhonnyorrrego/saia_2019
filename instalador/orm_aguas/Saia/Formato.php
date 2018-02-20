<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formato
 *
 * @ORM\Table(name="FORMATO", indexes={@ORM\Index(name="i_formato_encabezado_ctx", columns={"ENCABEZADO"}), @ORM\Index(name="i_formato_pie_pagina_ctx", columns={"PIE_PAGINA"}), @ORM\Index(name="i_formato_cuerpo_ctx", columns={"CUERPO"})})
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
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONTADOR_IDCONTADOR", type="integer", nullable=true)
     */
    private $contadorIdcontador;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_TABLA", type="string", length=255, nullable=false)
     */
    private $nombreTabla;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_MOSTRAR", type="string", length=255, nullable=false)
     */
    private $rutaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_EDITAR", type="string", length=255, nullable=false)
     */
    private $rutaEditar;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_ADICIONAR", type="string", length=255, nullable=false)
     */
    private $rutaAdicionar;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIAS", type="string", length=255, nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTILOS", type="string", length=255, nullable=true)
     */
    private $estilos;

    /**
     * @var string
     *
     * @ORM\Column(name="JAVASCRIPT", type="string", length=255, nullable=true)
     */
    private $javascript;

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="CUERPO", type="text", nullable=true)
     */
    private $cuerpo;

    /**
     * @var string
     *
     * @ORM\Column(name="PIE_PAGINA", type="text", nullable=true)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="MARGENES", type="string", length=50, nullable=false)
     */
    private $margenes;

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
    private $papel;

    /**
     * @var string
     *
     * @ORM\Column(name="EXPORTAR", type="string", length=255, nullable=true)
     */
    private $exportar;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="MOSTRAR", type="string", length=1, nullable=false)
     */
    private $mostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="DETALLE", type="string", length=1, nullable=false)
     */
    private $detalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_EDICION", type="integer", nullable=false)
     */
    private $tipoEdicion;

    /**
     * @var string
     *
     * @ORM\Column(name="ITEM", type="string", length=1, nullable=false)
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="AYUDA", type="string", length=400, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="FONT_SIZE", type="string", length=4, nullable=false)
     */
    private $fontSize;

    /**
     * @var string
     *
     * @ORM\Column(name="BANDERAS", type="string", length=255, nullable=false)
     */
    private $banderas = 'm';

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_AUTOGUARDADO", type="string", length=20, nullable=false)
     */
    private $tiempoAutoguardado;

    /**
     * @var integer
     *
     * @ORM\Column(name="MOSTRAR_PDF", type="integer", nullable=false)
     */
    private $mostrarPdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTER2TAB", type="integer", nullable=false)
     */
    private $enter2tab;

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA_DIGITAL", type="integer", nullable=false)
     */
    private $firmaDigital;

    /**
     * @var string
     *
     * @ORM\Column(name="FK_CATEGORIA_FORMATO", type="string", length=255, nullable=true)
     */
    private $fkCategoriaFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="FLUJO_IDFLUJO", type="integer", nullable=true)
     */
    private $flujoIdflujo;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCION_PREDETERMINADA", type="string", length=255, nullable=true)
     */
    private $funcionPredeterminada;

    /**
     * @var string
     *
     * @ORM\Column(name="PAGINAR", type="string", length=1, nullable=true)
     */
    private $paginar = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERTENECE_NUCLEO", type="integer", nullable=true)
     */
    private $perteneceNucleo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERMITE_IMPRIMIR", type="integer", nullable=true)
     */
    private $permiteImprimir = '1';


}
