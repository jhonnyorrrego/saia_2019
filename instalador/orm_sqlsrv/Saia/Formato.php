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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idformato;

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
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=false)
     */
    private $codPadre = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="contador_idcontador", type="integer", nullable=true)
     */
    private $contadorIdcontador = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_tabla", type="string", length=255, nullable=false)
     */
    private $nombreTabla = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_mostrar", type="string", length=255, nullable=false)
     */
    private $rutaMostrar = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_editar", type="string", length=255, nullable=false)
     */
    private $rutaEditar = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_adicionar", type="string", length=255, nullable=false)
     */
    private $rutaAdicionar = '';

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
     * @ORM\Column(name="encabezado", type="text", length=65535, nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text", length=65535, nullable=true)
     */
    private $cuerpo;

    /**
     * @var string
     *
     * @ORM\Column(name="pie_pagina", type="text", length=65535, nullable=true)
     */
    private $piePagina;

    /**
     * @var string
     *
     * @ORM\Column(name="margenes", type="string", length=50, nullable=false)
     */
    private $margenes = '30,30,30,30';

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
    private $papel = 'letter';

    /**
     * @var string
     *
     * @ORM\Column(name="exportar", type="string", length=255, nullable=true)
     */
    private $exportar = 'pdf';

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="mostrar", type="string", length=1, nullable=false)
     */
    private $mostrar = '1';

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
    private $detalle = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_edicion", type="boolean", nullable=false)
     */
    private $tipoEdicion = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=1, nullable=false)
     */
    private $item = '0';

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
     * @ORM\Column(name="font_size", type="string", length=5, nullable=false)
     */
    private $fontSize = '12';

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
    private $tiempoAutoguardado = '300000';

    /**
     * @var integer
     *
     * @ORM\Column(name="mostrar_pdf", type="integer", nullable=false)
     */
    private $mostrarPdf = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enter2tab", type="boolean", nullable=false)
     */
    private $enter2tab = '0';

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
     * @ORM\Column(name="paginar", type="string", length=1, nullable=false)
     */
    private $paginar = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="pertenece_nucleo", type="integer", nullable=false)
     */
    private $perteneceNucleo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="permite_imprimir", type="integer", nullable=true)
     */
    private $permiteImprimir = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="firma_crt", type="string", length=255, nullable=true)
     */
    private $firmaCrt;

    /**
     * @var string
     *
     * @ORM\Column(name="pos_firma_crt", type="string", length=255, nullable=true)
     */
    private $posFirmaCrt;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_firma_crt", type="string", length=255, nullable=true)
     */
    private $logoFirmaCrt;

    /**
     * @var string
     *
     * @ORM\Column(name="pos_logo_firma_crt", type="string", length=255, nullable=true)
     */
    private $posLogoFirmaCrt;


}
