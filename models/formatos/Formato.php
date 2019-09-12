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

    //relations
    protected $Formato;
    protected $Modulo;
    protected $Contador;
    protected $EncabezadoFormatoHeader;
    protected $EncabezadoFormatoFooter;
    protected $camposFormato;
    protected $funcionesFormato;

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
     * obtiene la instancia del formato padre
     *
     *
     * @return null|Formato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public function getParent()
    {
        if (!$this->Formato) {
            $this->Formato = $this->getRelationFk('Formato', 'cod_padre');
        }

        return $this->Formato;
    }

    /**
     * obtiene la instancia del modulo que
     * representa el formato
     *
     * @return null|Modulo
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public function getModule()
    {
        if (!$this->Modulo) {
            $this->Modulo = Modulo::findByAttributes([
                'nombre' => 'crear_' . $this->nombre
            ]);
        }

        return $this->Modulo;
    }

    /**
     * obtiene la instancia del Contador asignado
     *
     * @return null|Contador
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-012
     */
    public function getCounter()
    {
        if (!$this->Contador) {
            $this->Contador = $this->getRelationFk('Contador', 'contador_idcontador');
        }

        return $this->Contador;
    }

    /**
     * obtiene la instancia del encabezado formato
     * de la columna encabezado
     *
     * @return null|EncabezadoFormato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-05
     */
    public function getHeader()
    {
        if (!$this->EncabezadoFormatoHeader) {
            $this->EncabezadoFormatoHeader = $this->getRelationFk('EncabezadoFormato', 'encabezado');
        }

        return $this->EncabezadoFormatoHeader;
    }

    /**
     * obtiene la instancia del encabezado formato
     * de la columna pie_pagina
     *
     * @return null|EncabezadoFormato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-05
     */
    public function getFooter()
    {
        if (!$this->EncabezadoFormatoFooter) {
            $this->EncabezadoFormatoFooter = $this->getRelationFk('EncabezadoFormato', 'pie_pagina');
        }

        return $this->EncabezadoFormatoFooter;
    }

    /**
     * obtiene instancias de campos formato
     *
     * @return null|CamposFormato[]
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getFields()
    {
        if (!$this->camposFormato) {
            $this->camposFormato = CamposFormato::findAllByAttributes([
                'formato_idformato' => $this->getPK()
            ], null, 'orden asc');
        }

        return $this->camposFormato;
    }

    /**
     * obtiene las funciones vinculadas al formato
     * en instancias de FuncionesFormato
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    public function getFunctions()
    {
        if (!$this->funcionesFormato) {
            $QueryBuilder = self::getQueryBuilder()
                ->select('a.*')
                ->from('funciones_formato', 'a')
                ->join('a', 'funciones_formato_enlace', 'b', 'a.idfunciones_formato = b.funciones_formato_fk')
                ->join('b', 'formato', 'c', 'b.formato_idformato = c.idformato')
                ->where('c.idformato = :formatId')
                ->setParameter(':formatId', $this->getPK());

            $this->funcionesFormato = FuncionesFormato::findByQueryBuilder($QueryBuilder);
        }

        return $this->funcionesFormato;
    }

    /**
     * obtiene los nombres de las columnas de nucleo
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public function getSystemFields()
    {
        $systemFields = [
            "id{$this->nombre_tabla}",
            "documento_iddocumento",
            "dependencia",
            "encabezado",
            "firma"
        ];

        if ($this->getParent()) {
            $systemFields[] = $this->getParent()->nombre_tabla;
        }

        return $systemFields;
    }

    /**
     * obtiene las instancias de los campos formato que pertenecen
     * al proceso y no son de nucleo
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-05
     */
    public function getProcessFields()
    {
        $systemFields = $this->getSystemFields();

        $fields = CamposFormato::findAllByAttributes([
            'formato_idformato' => $this->getPK()
        ]);

        $data = [];
        foreach ($fields as $CamposFormato) {
            if (!in_array($CamposFormato->nombre, $systemFields)) {
                $data[] = $CamposFormato;
            }
        }

        return $data;
    }

    /**
     * encuentra la instancia del primer formato
     * en el proceso
     *
     * @return Formato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-16
     */
    public function findFirstParent()
    {
        return $this->cod_padre ? (new self($this->cod_padre))->findFirstParent() : $this;
    }

    /**
     * realiza la busqueda de formatos 
     * por un termino indicado
     *
     * @param string $term
     * @return array|Formato[]
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-16
     */
    public static function findAllByTerm($term)
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('*')
            ->from('formato')
            ->where('etiqueta like :like')
            ->andWhere('item <> 1')
            ->setParameter(':like', "%{$term}%");

        return self::findByQueryBuilder($QueryBuilder);
    }
}
