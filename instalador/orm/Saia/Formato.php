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



    /**
     * Get idformato
     *
     * @return integer
     */
    public function getIdformato()
    {
        return $this->idformato;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Formato
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Formato
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return Formato
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return integer
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set contadorIdcontador
     *
     * @param integer $contadorIdcontador
     *
     * @return Formato
     */
    public function setContadorIdcontador($contadorIdcontador)
    {
        $this->contadorIdcontador = $contadorIdcontador;

        return $this;
    }

    /**
     * Get contadorIdcontador
     *
     * @return integer
     */
    public function getContadorIdcontador()
    {
        return $this->contadorIdcontador;
    }

    /**
     * Set nombreTabla
     *
     * @param string $nombreTabla
     *
     * @return Formato
     */
    public function setNombreTabla($nombreTabla)
    {
        $this->nombreTabla = $nombreTabla;

        return $this;
    }

    /**
     * Get nombreTabla
     *
     * @return string
     */
    public function getNombreTabla()
    {
        return $this->nombreTabla;
    }

    /**
     * Set rutaMostrar
     *
     * @param string $rutaMostrar
     *
     * @return Formato
     */
    public function setRutaMostrar($rutaMostrar)
    {
        $this->rutaMostrar = $rutaMostrar;

        return $this;
    }

    /**
     * Get rutaMostrar
     *
     * @return string
     */
    public function getRutaMostrar()
    {
        return $this->rutaMostrar;
    }

    /**
     * Set rutaEditar
     *
     * @param string $rutaEditar
     *
     * @return Formato
     */
    public function setRutaEditar($rutaEditar)
    {
        $this->rutaEditar = $rutaEditar;

        return $this;
    }

    /**
     * Get rutaEditar
     *
     * @return string
     */
    public function getRutaEditar()
    {
        return $this->rutaEditar;
    }

    /**
     * Set rutaAdicionar
     *
     * @param string $rutaAdicionar
     *
     * @return Formato
     */
    public function setRutaAdicionar($rutaAdicionar)
    {
        $this->rutaAdicionar = $rutaAdicionar;

        return $this;
    }

    /**
     * Get rutaAdicionar
     *
     * @return string
     */
    public function getRutaAdicionar()
    {
        return $this->rutaAdicionar;
    }

    /**
     * Set librerias
     *
     * @param string $librerias
     *
     * @return Formato
     */
    public function setLibrerias($librerias)
    {
        $this->librerias = $librerias;

        return $this;
    }

    /**
     * Get librerias
     *
     * @return string
     */
    public function getLibrerias()
    {
        return $this->librerias;
    }

    /**
     * Set estilos
     *
     * @param string $estilos
     *
     * @return Formato
     */
    public function setEstilos($estilos)
    {
        $this->estilos = $estilos;

        return $this;
    }

    /**
     * Get estilos
     *
     * @return string
     */
    public function getEstilos()
    {
        return $this->estilos;
    }

    /**
     * Set javascript
     *
     * @param string $javascript
     *
     * @return Formato
     */
    public function setJavascript($javascript)
    {
        $this->javascript = $javascript;

        return $this;
    }

    /**
     * Get javascript
     *
     * @return string
     */
    public function getJavascript()
    {
        return $this->javascript;
    }

    /**
     * Set encabezado
     *
     * @param string $encabezado
     *
     * @return Formato
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return string
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     *
     * @return Formato
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set piePagina
     *
     * @param string $piePagina
     *
     * @return Formato
     */
    public function setPiePagina($piePagina)
    {
        $this->piePagina = $piePagina;

        return $this;
    }

    /**
     * Get piePagina
     *
     * @return string
     */
    public function getPiePagina()
    {
        return $this->piePagina;
    }

    /**
     * Set margenes
     *
     * @param string $margenes
     *
     * @return Formato
     */
    public function setMargenes($margenes)
    {
        $this->margenes = $margenes;

        return $this;
    }

    /**
     * Get margenes
     *
     * @return string
     */
    public function getMargenes()
    {
        return $this->margenes;
    }

    /**
     * Set orientacion
     *
     * @param string $orientacion
     *
     * @return Formato
     */
    public function setOrientacion($orientacion)
    {
        $this->orientacion = $orientacion;

        return $this;
    }

    /**
     * Get orientacion
     *
     * @return string
     */
    public function getOrientacion()
    {
        return $this->orientacion;
    }

    /**
     * Set papel
     *
     * @param string $papel
     *
     * @return Formato
     */
    public function setPapel($papel)
    {
        $this->papel = $papel;

        return $this;
    }

    /**
     * Get papel
     *
     * @return string
     */
    public function getPapel()
    {
        return $this->papel;
    }

    /**
     * Set exportar
     *
     * @param string $exportar
     *
     * @return Formato
     */
    public function setExportar($exportar)
    {
        $this->exportar = $exportar;

        return $this;
    }

    /**
     * Get exportar
     *
     * @return string
     */
    public function getExportar()
    {
        return $this->exportar;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return Formato
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Formato
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set mostrar
     *
     * @param string $mostrar
     *
     * @return Formato
     */
    public function setMostrar($mostrar)
    {
        $this->mostrar = $mostrar;

        return $this;
    }

    /**
     * Get mostrar
     *
     * @return string
     */
    public function getMostrar()
    {
        return $this->mostrar;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Formato
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Formato
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set tipoEdicion
     *
     * @param boolean $tipoEdicion
     *
     * @return Formato
     */
    public function setTipoEdicion($tipoEdicion)
    {
        $this->tipoEdicion = $tipoEdicion;

        return $this;
    }

    /**
     * Get tipoEdicion
     *
     * @return boolean
     */
    public function getTipoEdicion()
    {
        return $this->tipoEdicion;
    }

    /**
     * Set item
     *
     * @param string $item
     *
     * @return Formato
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return string
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return Formato
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return Formato
     */
    public function setAyuda($ayuda)
    {
        $this->ayuda = $ayuda;

        return $this;
    }

    /**
     * Get ayuda
     *
     * @return string
     */
    public function getAyuda()
    {
        return $this->ayuda;
    }

    /**
     * Set fontSize
     *
     * @param string $fontSize
     *
     * @return Formato
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * Get fontSize
     *
     * @return string
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * Set banderas
     *
     * @param string $banderas
     *
     * @return Formato
     */
    public function setBanderas($banderas)
    {
        $this->banderas = $banderas;

        return $this;
    }

    /**
     * Get banderas
     *
     * @return string
     */
    public function getBanderas()
    {
        return $this->banderas;
    }

    /**
     * Set tiempoAutoguardado
     *
     * @param string $tiempoAutoguardado
     *
     * @return Formato
     */
    public function setTiempoAutoguardado($tiempoAutoguardado)
    {
        $this->tiempoAutoguardado = $tiempoAutoguardado;

        return $this;
    }

    /**
     * Get tiempoAutoguardado
     *
     * @return string
     */
    public function getTiempoAutoguardado()
    {
        return $this->tiempoAutoguardado;
    }

    /**
     * Set mostrarPdf
     *
     * @param integer $mostrarPdf
     *
     * @return Formato
     */
    public function setMostrarPdf($mostrarPdf)
    {
        $this->mostrarPdf = $mostrarPdf;

        return $this;
    }

    /**
     * Get mostrarPdf
     *
     * @return integer
     */
    public function getMostrarPdf()
    {
        return $this->mostrarPdf;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return Formato
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set enter2tab
     *
     * @param boolean $enter2tab
     *
     * @return Formato
     */
    public function setEnter2tab($enter2tab)
    {
        $this->enter2tab = $enter2tab;

        return $this;
    }

    /**
     * Get enter2tab
     *
     * @return boolean
     */
    public function getEnter2tab()
    {
        return $this->enter2tab;
    }

    /**
     * Set firmaDigital
     *
     * @param integer $firmaDigital
     *
     * @return Formato
     */
    public function setFirmaDigital($firmaDigital)
    {
        $this->firmaDigital = $firmaDigital;

        return $this;
    }

    /**
     * Get firmaDigital
     *
     * @return integer
     */
    public function getFirmaDigital()
    {
        return $this->firmaDigital;
    }

    /**
     * Set fkCategoriaFormato
     *
     * @param string $fkCategoriaFormato
     *
     * @return Formato
     */
    public function setFkCategoriaFormato($fkCategoriaFormato)
    {
        $this->fkCategoriaFormato = $fkCategoriaFormato;

        return $this;
    }

    /**
     * Get fkCategoriaFormato
     *
     * @return string
     */
    public function getFkCategoriaFormato()
    {
        return $this->fkCategoriaFormato;
    }

    /**
     * Set flujoIdflujo
     *
     * @param integer $flujoIdflujo
     *
     * @return Formato
     */
    public function setFlujoIdflujo($flujoIdflujo)
    {
        $this->flujoIdflujo = $flujoIdflujo;

        return $this;
    }

    /**
     * Get flujoIdflujo
     *
     * @return integer
     */
    public function getFlujoIdflujo()
    {
        return $this->flujoIdflujo;
    }

    /**
     * Set funcionPredeterminada
     *
     * @param string $funcionPredeterminada
     *
     * @return Formato
     */
    public function setFuncionPredeterminada($funcionPredeterminada)
    {
        $this->funcionPredeterminada = $funcionPredeterminada;

        return $this;
    }

    /**
     * Get funcionPredeterminada
     *
     * @return string
     */
    public function getFuncionPredeterminada()
    {
        return $this->funcionPredeterminada;
    }

    /**
     * Set paginar
     *
     * @param string $paginar
     *
     * @return Formato
     */
    public function setPaginar($paginar)
    {
        $this->paginar = $paginar;

        return $this;
    }

    /**
     * Get paginar
     *
     * @return string
     */
    public function getPaginar()
    {
        return $this->paginar;
    }

    /**
     * Set perteneceNucleo
     *
     * @param integer $perteneceNucleo
     *
     * @return Formato
     */
    public function setPerteneceNucleo($perteneceNucleo)
    {
        $this->perteneceNucleo = $perteneceNucleo;

        return $this;
    }

    /**
     * Get perteneceNucleo
     *
     * @return integer
     */
    public function getPerteneceNucleo()
    {
        return $this->perteneceNucleo;
    }

    /**
     * Set permiteImprimir
     *
     * @param integer $permiteImprimir
     *
     * @return Formato
     */
    public function setPermiteImprimir($permiteImprimir)
    {
        $this->permiteImprimir = $permiteImprimir;

        return $this;
    }

    /**
     * Get permiteImprimir
     *
     * @return integer
     */
    public function getPermiteImprimir()
    {
        return $this->permiteImprimir;
    }

    /**
     * Set firmaCrt
     *
     * @param string $firmaCrt
     *
     * @return Formato
     */
    public function setFirmaCrt($firmaCrt)
    {
        $this->firmaCrt = $firmaCrt;

        return $this;
    }

    /**
     * Get firmaCrt
     *
     * @return string
     */
    public function getFirmaCrt()
    {
        return $this->firmaCrt;
    }

    /**
     * Set posFirmaCrt
     *
     * @param string $posFirmaCrt
     *
     * @return Formato
     */
    public function setPosFirmaCrt($posFirmaCrt)
    {
        $this->posFirmaCrt = $posFirmaCrt;

        return $this;
    }

    /**
     * Get posFirmaCrt
     *
     * @return string
     */
    public function getPosFirmaCrt()
    {
        return $this->posFirmaCrt;
    }

    /**
     * Set logoFirmaCrt
     *
     * @param string $logoFirmaCrt
     *
     * @return Formato
     */
    public function setLogoFirmaCrt($logoFirmaCrt)
    {
        $this->logoFirmaCrt = $logoFirmaCrt;

        return $this;
    }

    /**
     * Get logoFirmaCrt
     *
     * @return string
     */
    public function getLogoFirmaCrt()
    {
        return $this->logoFirmaCrt;
    }

    /**
     * Set posLogoFirmaCrt
     *
     * @param string $posLogoFirmaCrt
     *
     * @return Formato
     */
    public function setPosLogoFirmaCrt($posLogoFirmaCrt)
    {
        $this->posLogoFirmaCrt = $posLogoFirmaCrt;

        return $this;
    }

    /**
     * Get posLogoFirmaCrt
     *
     * @return string
     */
    public function getPosLogoFirmaCrt()
    {
        return $this->posLogoFirmaCrt;
    }
}
