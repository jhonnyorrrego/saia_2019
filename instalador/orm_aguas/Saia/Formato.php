<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formato
 *
 * @ORM\Table(name="formato")
 * @ORM\Entity
 */
class Formato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idformato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idformato;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=false)
     */
    private $codPadre = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="contador_idcontador", type="integer", nullable=true)
     */
    private $contadorIdcontador = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tabla", type="string", length=255, nullable=false)
     */
    private $nombreTabla;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_mostrar", type="string", length=255, nullable=false)
     */
    private $rutaMostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_editar", type="string", length=255, nullable=false)
     */
    private $rutaEditar;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_adicionar", type="string", length=255, nullable=false)
     */
    private $rutaAdicionar;

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="string", length=255, nullable=true)
     */
    private $librerias;

    /**
     * @var string
     *
     * @ORM\Column(name="estilos", type="string", length=255, nullable=true)
     */
    private $estilos;

    /**
     * @var string
     *
     * @ORM\Column(name="javascript", type="string", length=255, nullable=true)
     */
    private $javascript;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text", nullable=true)
     */
    private $cuerpo;

    /**
     * @var string
     *
     * @ORM\Column(name="pie_pagina", type="text", nullable=true)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="margenes", type="string", length=50, nullable=false)
     */
    private $margenes;

    /**
     * @var string
     *
     * @ORM\Column(name="orientacion", type="string", length=50, nullable=true)
     */
    private $orientacion;

    /**
     * @var string
     *
     * @ORM\Column(name="papel", type="string", length=50, nullable=true)
     */
    private $papel;

    /**
     * @var string
     *
     * @ORM\Column(name="exportar", type="string", length=255, nullable=true)
     */
    private $exportar;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar", type="string", length=1, nullable=false)
     */
    private $mostrar;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=1, nullable=false)
     */
    private $detalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_edicion", type="integer", nullable=false)
     */
    private $tipoEdicion;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=1, nullable=false)
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="string", length=400, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="font_size", type="string", length=4, nullable=false)
     */
    private $fontSize;

    /**
     * @var string
     *
     * @ORM\Column(name="banderas", type="string", length=255, nullable=false)
     */
    private $banderas = 'm';

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_autoguardado", type="string", length=20, nullable=false)
     */
    private $tiempoAutoguardado;

    /**
     * @var integer
     *
     * @ORM\Column(name="mostrar_pdf", type="integer", nullable=false)
     */
    private $mostrarPdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="enter2tab", type="integer", nullable=false)
     */
    private $enter2tab;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma_digital", type="integer", nullable=false)
     */
    private $firmaDigital;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_categoria_formato", type="string", length=255, nullable=true)
     */
    private $fkCategoriaFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="flujo_idflujo", type="integer", nullable=true)
     */
    private $flujoIdflujo;

    /**
     * @var string
     *
     * @ORM\Column(name="funcion_predeterminada", type="string", length=255, nullable=true)
     */
    private $funcionPredeterminada;

    /**
     * @var string
     *
     * @ORM\Column(name="paginar", type="string", length=1, nullable=true)
     */
    private $paginar = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="pertenece_nucleo", type="integer", nullable=true)
     */
    private $perteneceNucleo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="permite_imprimir", type="integer", nullable=true)
     */
    private $permiteImprimir = '1';


}
