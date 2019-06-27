<?php

class Formato extends Model
{
    protected $idformato;
    protected $nombre;
    protected $etiqueta;
    protected $cod_padre;
    protected $contador_idcontador;
    protected $nombre_tabla;
    protected $ruta_mostrar;
    protected $ruta_editar;
    protected $ruta_adicionar;
    protected $librerias;
    protected $estilos;
    protected $javascript;
    protected $encabezado;
    protected $cuerpo;
    protected $pie_pagina;
    protected $margenes;
    protected $orientacion;
    protected $papel;
    protected $exportar;
    protected $funcionario_idfuncionario;
    protected $fecha;
    protected $mostrar;
    protected $imagen;
    protected $detalle;
    protected $tipo_edicion;
    protected $item;
    protected $serie_idserie;
    protected $ayuda;
    protected $font_size;
    protected $banderas;
    protected $tiempo_autoguardado;
    protected $mostrar_pdf;
    protected $orden;
    protected $enter2tab;
    protected $firma_digital;
    protected $fk_categoria_formato;
    protected $flujo_idflujo;
    protected $funcion_predeterminada;
    protected $paginar;
    protected $pertenece_nucleo;
    protected $permite_imprimir;
    protected $firma_crt;
    protected $pos_firma_crt;
    protected $logo_firma_crt;
    protected $pos_logo_firma_crt;
    protected $descripcion_formato;
    protected $proceso_pertenece;
    protected $version;
    protected $documentacion;
    protected $mostrar_tipodoc_pdf;
    protected $publicar;


    /**
     * @param int $id value for idfuncionario attribute
     * @author jhon.valencia@cerok.com
     */
    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'nombre',
            'etiqueta',
            'cod_padre',
            'contador_idcontador',
            'nombre_tabla',
            'ruta_mostrar',
            'ruta_editar',
            'ruta_adicionar',
            'librerias',
            'estilos',
            'javascript',
            'encabezado',
            'cuerpo',
            'pie_pagina',
            'margenes',
            'orientacion',
            'papel',
            'exportar',
            'funcionario_idfuncionario',
            'fecha',
            'mostrar',
            'imagen',
            'detalle',
            'tipo_edicion',
            'item',
            'serie_idserie',
            'ayuda',
            'font_size',
            'banderas',
            'tiempo_autoguardado',
            'mostrar_pdf',
            'orden',
            'enter2tab',
            'firma_digital',
            'fk_categoria_formato',
            'flujo_idflujo',
            'funcion_predeterminada',
            'paginar',
            'pertenece_nucleo',
            'permite_imprimir',
            'firma_crt',
            'pos_firma_crt',
            'logo_firma_crt',
            'pos_logo_firma_crt',
            'descripcion_formato',
            'proceso_pertenece',
            'version',
            'documentacion',
            'mostrar_tipodoc_pdf',
            'publicar',
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
