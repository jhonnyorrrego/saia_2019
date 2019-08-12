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

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * encuentra la instancia del primer formato
     * en el proceso
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-16
     */
    public function findFirstParent()
    {
        return $this->cod_padre ? (new self($this->cod_padre))->findFirstParent() : $this;
    }

    /**
     * crea los campos predeterminados para el formato
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-12
     */
    public function createDefaultFields()
    {
        $sql = <<<SQL
			SELECT 
				nombre 
			FROM
				campos_formato
			WHERE 
				formato_idformato= {$this->getPK()} AND
				nombre IN (
					'id{$this->nombre_tabla}',
					'documento_iddocumento',
					'dependencia',
					'encabezado',
					'firma'
				)
SQL;
        $records = CamposFormato::findBySql($sql);

        $fields = [];
        foreach ($records as $row) {
            $fields[] = $row[0]['nombre'];
        }

        if (!in_array('id{$formato[0]["nombre_tabla"]}', $fields)) {
            CamposFormato::newRecord([
                'formato_idformato' => $this->getPK(),
                'nombre' => 'id{$this->nombre_tabla}',
                'etiqueta' => strtoupper($this->nombre),
                'tipo_dato' => 'INT',
                'longitud' => '11',
                'obligatoriedad' => '1',
                'banderas' => 'ai,pk',
                'acciones' => 'a,e',
                'etiqueta_html' => 'hidden'
            ]);
        }

        if (!in_array('documento_iddocumento', $fields) && !$this->item) {
            CamposFormato::newRecord([
                'formato_idformato' => $this->getPK(),
                'nombre' => 'documento_iddocumento',
                'etiqueta' => 'DOCUMENTO ASOCIADO',
                'tipo_dato' => 'INT',
                'longitud' => '11',
                'obligatoriedad' => '1',
                'banderas' => 'i',
                'acciones' => 'a,e',
                'etiqueta_html' => 'hidden'
            ]);
        }

        if (!in_array('dependencia', $fields) && !$this->item) {
            CamposFormato::newRecord([
                'formato_idformato' => $this->getPK(),
                'nombre' => 'dependencia',
                'etiqueta' => 'DEPENDENCIA DEL CREADOR DEL DOCUMENTO',
                'tipo_dato' => 'INT',
                'longitud' => '11',
                'obligatoriedad' => '1',
                'banderas' => 'i,fdc',
                'acciones' => 'a,e',
                'etiqueta_html' => 'hidden',
                'valor' => '{*buscar_dependencia*}',
                'orden' => 1
            ]);
        }

        if (!in_array('encabezado', $fields) && !$this->item) {
            CamposFormato::newRecord([
                'formato_idformato' => $this->getPK(),
                'nombre' => 'encabezado',
                'etiqueta' => 'ENCABEZADO',
                'tipo_dato' => 'INT',
                'longitud' => '11',
                'obligatoriedad' => '1',
                'acciones' => 'a,e',
                'etiqueta_html' => 'hidden',
                'predeterminado' => 1
            ]);
        }

        if (!in_array('firma', $fields) && !$this->item) {
            CamposFormato::newRecord([
                'formato_idformato' => $this->getPK(),
                'nombre' => 'firma',
                'etiqueta' => 'FIRMAS DIGITALES',
                'tipo_dato' => 'INT',
                'longitud' => '11',
                'obligatoriedad' => '1',
                'acciones' => 'a,e',
                'etiqueta_html' => 'hidden',
                'predeterminado' => 1
            ]);
        }

        if (!in_array('estado_documento', $fields) && !$this->item) {
            CamposFormato::newRecord([
                'formato_idformato' => $this->getPK(),
                'nombre' => 'estado_documento',
                'etiqueta' => 'ESTADO DEL DOCUMENTO',
                'tipo_dato' => 'INT',
                'longitud' => '11',
                'obligatoriedad' => '1',
                'banderas' => '',
                'acciones' => 'a,e',
                'etiqueta_html' => 'hidden',
                'predeterminado' => 1
            ]);
        }
    }

    /**
     * realiza la busqueda de formatos 
     * por un termino indicado
     *
     * @param string $term
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-16
     */
    public static function findAllByTerm($term)
    {
        $sql = <<<SQL
            SELECT *
            FROM formato
            WHERE
                etiqueta like '%{$term}%' AND
                item <> 1
SQL;
        return self::findBySql($sql);
    }
}
