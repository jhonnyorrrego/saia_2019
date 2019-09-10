<?php
class GenerarFormatoController
{
    /**
     * almacena la instancia del schemaManager
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    protected $AbstractSchemaManager;

    /**
     * almacena el identificador del formato
     *
     * @var integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    protected $formatId;

    /**
     * almacena la instancia del fomato a generar
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    protected $Formato;

    /**
     * almacena la informacion con la que
     * se generara el formato
     *
     * @var array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    protected $newData;

    /**
     * instancia de la tabla del formato
     *
     * @var object Doctrine\DBAL\Schema\Table
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    protected $Table;

    /**
     * almacena la ruta relativa a la carpeta
     *
     * @var string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-09
     */
    protected $directory;

    /**
     * inicia el proceso de generacion
     *
     * @param integer $formatId identificador del formato
     * @param array $data nuevos datos
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    public function __construct($formatId = null)
    {
        $this->formatId = $formatId;
        $this->findFormat();
    }

    /**
     * obtiene la instancia del formato
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    public function findFormat()
    {
        $this->Formato = new Formato($this->formatId);
        return $this->Formato;
    }

    /**
     * obtiene la instancia del modulo que 
     * representa el formato
     *
     * @return object Modulo::class
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public function getModule()
    {
        if (!$this->Formato->getPK()) {
            throw new Exception("No existe un formato referencia", 1);
        }

        return $this->Formato->getModule();
    }

    /**
     * ejecuta las acciones para generar el formato
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-09
     */
    public function generate()
    {
        //genero la carpeta y .gitignore
        $this->generateDirectory();

        //genero la tabla
        $this->generateTable();

        //genero los archivos del crud
        $this->generateFiles();
    }

    /**
     * actualiza los datos del formato
     *
     * @param array $data atributos de la clase formato
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public function refreshFormat($data)
    {
        $this->Formato->setAttributes($data);

        if (!$this->Formato->save()) {
            throw new Exception("Error al guardar el formato", 1);
        }

        if (!$this->formatId) {
            $this->formatId = $this->Formato->getPK();
        }


        $this->createModule();
        return $this->formatId;
    }

    /**
     * crea o actualiza el modulo del formato
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public function createModule()
    {
        $exist = Modulo::countRecords([
            'nombre' => 'crear_' . $this->Formato->nombre
        ]);

        if ($exist) {
            Modulo::executeUpdate([
                'etiqueta' => $this->Formato->etiqueta
            ], [
                'nombre' => 'crear_' . $this->Formato->nombre
            ]);
        } else {
            $Modulo = Modulo::findByAttributes(['nombre' => 'modulo_formatos']);
            Modulo::newRecord([
                'nombre' => 'crear_' . $this->Formato->nombre,
                'tipo' => 2,
                'etiqueta' => $this->Formato->etiqueta,
                'enlace' => "formatos/{$this->Formato->nombre}/{$this->Formato->ruta_adicionar}",
                'cod_padre' => $Modulo->getPK()
            ]);
        }
    }

    /**
     * crea el directorio del formato con su respectivo
     * archivo .gitignore
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public function generateDirectory()
    {
        global $ruta_db_superior;

        $this->directory = "{$ruta_db_superior}formatos/{$this->Formato->nombre}";

        if (!is_dir($this->directory)) {
            if (!mkdir($this->directory, PERMISOS_CARPETAS, true)) {
                throw new Exception("No es posible crear la carpeta {$this->directory}", 1);
            }
        } else {
            chmod($this->directory, PERMISOS_CARPETAS);
        }

        $content = "{$this->Formato->ruta_adicionar}
                {$this->Formato->ruta_editar}
                {$this->Formato->ruta_buscar}
                {$this->Formato->ruta_mostrar}";

        $ignoreFile = "{$this->directory}/.gitignore";
        file_put_contents($ignoreFile, $content);
        chmod($ignoreFile, PERMISOS_ARCHIVOS);
    }

    public function generateTable()
    {
        $schema = self::getSchema();

        if (!$schema->tablesExist([$this->Formato->nombre_tabla])) {
            $Table = new \Doctrine\DBAL\Schema\Table(
                $this->Formato->nombre_tabla
            );
            $Table->addColumn('_id', 'integer');
            $schema->createTable($Table);
        }

        $this->Table = $schema->listTableDetails($this->Formato->nombre_tabla);
        $this->generateColumns();
    }

    /**
     * genera las columas de la tabla
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public function generateColumns()
    {
        //configuro los campos de nucleo
        $this->configDefaultFields();
        $fields = $this->Formato->getFields();

        if ($fields) {
            if ($this->Table->hasColumn('_id')) {
                $this->Table->dropColumn('_id');
            }

            foreach ($fields as $CamposFormato) {
                $flags = explode(',', $CamposFormato->banderas);
                $options = [
                    'length' => $CamposFormato->logitud,
                    'notnull' => $CamposFormato->obligatoriedad,
                    'default' => $CamposFormato->predeterminado,
                    'autoincrement' => in_array('ai', $flags)
                ];

                if ($this->Table->hasColumn($CamposFormato->nombre)) {
                    $this->Table->changeColumn($CamposFormato->nombre, $options);
                } else {
                    $this->Table->addColumn(
                        $CamposFormato->nombre,
                        $CamposFormato->tipo_dato,
                        $options
                    );
                }

                $indexName = 'i' . $this->Formato->nombre_tabla . $CamposFormato->nombre;
                if (in_array('i', $flags)) {
                    if (!$this->Table->hasIndex($indexName)) {
                        $this->Table->addIndex([$CamposFormato->nombre], $indexName);
                    }
                } else {
                    if ($this->Table->hasIndex($indexName)) {
                        $this->Table->dropIndex($indexName);
                    }
                }

                if (in_array('pk', $flags) && !$this->Table->hasPrimaryKey()) {
                    $this->Table->setPrimaryKey([$CamposFormato->nombre]);
                }
            }

            $schema = self::getSchema();
            $InitialTable = $schema->listTableDetails($this->Formato->nombre_tabla);
            $TableDiff = (new Doctrine\DBAL\Schema\Comparator())->diffTable($InitialTable, $this->Table);
            if ($TableDiff) {
                $schema->alterTable($TableDiff);
            }
        }
    }

    /**
     * crea los campos predeterminados para el formato
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-06
     */
    public function configDefaultFields()
    {
        $systemFields = $this->Formato->getSystemFields();
        $fields = Model::getQueryBuilder()
            ->select('nombre')
            ->from('campos_formato')
            ->where('formato_idformato = :formatId')
            ->andWhere('nombre in (:fields)')
            ->setParameter(':formatId', $this->Formato->getPK(), 'integer')
            ->setParameter(
                ':fields',
                $systemFields,
                \Doctrine\DBAL\Connection::PARAM_STR_ARRAY
            )
            ->execute()->fetchAll();

        $created = [];
        foreach ($fields as $row) {
            $created[] = $row['nombre'];
        }

        $miss = array_diff($systemFields, $created);

        foreach ($miss as $field) {
            CamposFormato::createDefaultField($field, $this->Formato);
        }
    }

    /**
     * genera los archivos del crud
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-09
     */
    public function generateFiles()
    {
        //genera el mostrar
        $this->generateShow();

        //genera el adicionar
        $this->generateForm('adicionar');

        //genera el editar
        $this->generateForm('editar');
    }

    /**
     * genera el archivo mostar_*.php
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-09
     */
    public function generateShow()
    {
        $content = <<<CODE
<?php
\$max_salida = 10;
\$ruta_db_superior = \$ruta = '';

while (\$max_salida > 0) {
    if (is_file(\$ruta . 'db.php')) {
        \$ruta_db_superior = \$ruta;
        break;
    }

    \$ruta .= '../';
    \$max_salida--;
}

include_once \$ruta_db_superior . 'core/autoload.php';

try {
    JwtController::check(\$_REQUEST["token"], \$_REQUEST["key"]);    
} catch (\Throwable \$th) {
    die("invalid access");
}

if(
    !\$_REQUEST['mostrar_pdf'] && !\$_REQUEST['actualizar_pdf'] && (
        (\$_REQUEST["tipo"] && \$_REQUEST["tipo"] == 5) ||
        0 == {$this->Formato->mostrar_pdf}
    )
): ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
            <meta charset="utf-8" />
            <meta name="viewport"
                content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-touch-fullscreen" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="default">
            <meta content="" name="description" />
            <meta content="" name="Cero K" /> 
        </head>
        <body>
            <div class="container bg-master-lightest mx-0 px-2 px-md-2 mw-100">
                <div id="documento" class="row p-0 m-0">
                    <div id="pag-0" class="col-12 page_border bg-white">
                        <div class="page_margin_top mb-0" id="doc_header">
                        <?php include_once \$ruta_db_superior . "formatos/librerias/header_nuevo.php" ?>
                        </div>
                        <div id="pag_content-0" class="page_content">
                            <div id="page_overflow">
                                {$this->Formato->cuerpo}
                            </div>
                        </div>
                        <?php include_once \$ruta_db_superior . "formatos/librerias/footer_nuevo.php" ?>
                    </div> <!-- end page-n -->
                </div> <!-- end #documento-->
            </div> <!-- end .container -->
        </body>
    </html>
<?php else:
    \$documentId = \$_REQUEST["iddoc"];
    \$Documento = new Documento(\$documentId);
    \$Formato = \$Documento->getFormat();

    \$params = [
        "iddoc" => \$documentId,
        "type" => "TIPO_DOCUMENTO",
        "typeId" => \$documentId,
        "exportar" => \$Formato->exportar,
        "ruta" => base64_encode(\$Documento->pdf)
    ];

    if((\$Formato->mostrar_pdf == 1 && !\$Documento->pdf) || \$_REQUEST["actualizar_pdf"]){
        \$params["actualizar_pdf"] = 1;
    }else if(\$Formato->mostrar_pdf == 2){
        \$params["pdf_word"] = 1;
    }

    \$url = PROTOCOLO_CONEXION . RUTA_PDF . "/views/visor/pdfjs/viewer.php?";
    \$url.= http_build_query(\$params);

    ?>
    <iframe width="100%" frameborder="0" onload="this.height = window.innerHeight - 20" src="<?= \$url ?>"></iframe>
<?php endif; ?>
CODE;

        $fileName = "{$this->directory}/{$this->Formato->ruta_mostrar}";

        if (!file_put_contents($fileName, $content)) {
            throw new Exception("Imposible crear el archivo mostrar", 1);
        }
    }

    /**
     * obtiene la instancia del AbstractSchemaManager
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    public static function getSchema(): Doctrine\DBAL\Schema\AbstractSchemaManager
    {
        return Connection::getInstance()->getSchemaManager();
    }

    /**
     * obtiene las columnas en instancias Doctrine\DBAL\Schema\Column
     *
     * @param strign $table
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    public static function getFieldsFromTable($table)
    {
        return self::getSchema()->listTableColumns($table);
    }

    /**
     * obtiene los nombres de las columnas de una tabla
     *
     * @param string $table
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    public static function getFieldsName($table)
    {
        $columns = self::getFieldsFromTable($table);
        $data = [];

        foreach ($columns as $key => $Column) {
            $data[] = $Column->getName();
        }

        return $data;
    }

    //////////////////////////////////////////////////////CODIGO RECICLADO (POR MEJORAR)//////////////////////////////////////////////////////
    public function generateForm($accion)
    {
        global $conn, $ruta_db_superior;
        $texto = '';
        $includes = "";
        $obligatorio = "";
        $autoguardado = array();
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->formatId, "", $conn);
        if ($formato[0]["item"]) {
            $action = '<?= $ruta_db_superior ?>' . FORMATOS_SAIA . 'librerias/funciones_item.php';
            $estiloItem = '';
        } else {
            $action = '<?= $ruta_db_superior ?>app/documento/class_transferencia.php"';
            $estiloItem = '-8';
        }
        $texto .= '<div class="container-fluid container-fixed-lg col-lg' . $estiloItem . '" style="overflow: auto;" id="content_container">
                      <!-- START card -->
                      <div class="card card-default">
                            <div class="card-body">';
        if (!$formato[0]["item"]) {
            $texto .= '<center><h5 class="text-black">' . strtoupper($formato[0]["etiqueta"]) . '</h5></center>';
        }
        $texto .= '<?php llama_funcion_accion(@$_REQUEST["iddoc"],' . $this->formatId . ',"ingresar","ANTERIOR"); ?>
                       <form name="formulario_formatos" id="formulario_formatos" role="form" autocomplete="off" method="post" action="' . $action . '" enctype="multipart/form-data">';


        $librerias = array();
        if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
            $includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
        }
        $includes .= $this->incluir('$ruta_db_superior . "assets/librerias.php"', "librerias");

        $includes .= $this->incluir_libreria("funciones_formatos.js", "javascript");
        // $includes .= $this->incluir("../../js/cmxforms.js", "javascript");
        if ($formato[0]["estilos"] && $formato[0]["estilos"] != "") {
            $includes .= $this->incluir($formato[0]["estilos"], "estilos", 1);
        }
        if ($formato[0]["javascript"] && $formato[0]["javascript"] != "") {
            $includes .= $this->incluir($formato[0]["javascript"], "javascript", 1);
        }
        $arboles = 0;
        $spinner = 0;
        $dependientes = 0;
        $mascaras = 0;
        $textareas = 0;
        $textareacke = 0;
        $arboles_fancy = 0;
        $autocompletar = 0;
        $checkboxes = 0;
        $fecha = 0;
        $hora = 0;
        $archivo = 0;
        $lista_enmascarados = "";
        $indice_tabindex = 1;
        $listado_campos = array();
        $unico = array();
        $campos = busca_filtro_tabla("*", "campos_formato A", "A.acciones like '%" . $accion[0] . "%' and A.formato_idformato=" . $this->formatId, "orden ASC", $conn);

        $fun_campos = array();
        for ($h = 0; $h < $campos["numcampos"]; $h++) {
            if ($campos[$h]["etiqueta_html"] == "arbol") {
                $arboles = 1;
            } else if ($campos[$h]["etiqueta_html"] == "textarea") {
                $textareas = 1;
            } else if ($campos[$h]["etiqueta_html"] == "textarea_cke") {
                $textareacke = 1;
            }
            if ($campos[$h]["obligatoriedad"]) {
                $obliga = "*";
            } else {
                $obliga = "";
            }
            $tabindex = " tabindex='$indice_tabindex' ";
            if ($campos[$h]["autoguardado"])
                $autoguardado[] = $campos[$h]["nombre"];
            // ******************** validaciones *****************
            $adicionales = "";
            $longitud = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica ='maxlength' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
            if ($longitud["numcampos"]) {
                if ($longitud[0][0] > $campos[$h]["longitud"])
                    $adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";
                else
                    $adicionales .= "maxlength=\"" . $longitud[0][0] . "\" ";
            } elseif ($campos[$h]["longitud"])
                $adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";

            $caracteristicas = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica not in('adicionales','class','maxlength') and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
            for ($c = 0; $c < $caracteristicas["numcampos"]; $c++) {
                $adicionales .= " " . $caracteristicas[$c]["tipo_caracteristica"] . "='" . $caracteristicas[$c]["valor"] . "' ";
            }
            // obligatoriedad
            $class = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica='class' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);

            if ($campos[$h]["obligatoriedad"]) {
                if ($class["numcampos"])
                    $adicionales .= " class=\"required " . $class[0][0] . "\" ";
                else
                    $adicionales .= " class=\"required\" ";
            } elseif ($class["numcampos"])
                $adicionales .= " class=\"" . $class[0][0] . "\" ";
            // atributos adicionales
            $otros = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica='adicionales' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
            if ($otros["numcampos"])
                $adicionales .= $otros[0]["valor"];

            // ***************************************************
            if ($campos[$h]["banderas"] != "") {
                $bandera_unico = strpos("u", $campos[$h]["banderas"]);
                if ($bandera_unico !== false) {
                    array_push($unico, array(
                        $campos[$h]["nombre"],
                        $campos[$h]["idcampos_formato"]
                    ));
                    $obligatorio = 'obligatorio="obligatorio"';
                    $obliga = "(*)";
                }
            }
            if (strpos($campos[$h]["valor"], "*}") > 0) {
                $nombre_func = str_replace("{*", "", $campos[$h]["valor"]);
                $nombre_func = str_replace("*}", "", $nombre_func);

                $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '"><label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>';
                $parametros = $this->formatId . "," . $campos[$h]["idcampos_formato"];
                $texto .= $this->arma_funcion($nombre_func, $parametros, $accion) . "</div>";
                array_push($fun_campos, $nombre_func);
            } else {
                if ($accion == 'adicionar')
                    $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ?>';
                elseif ($accion == "editar") {
                    $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->formatId,$" . "_REQUEST['iddoc'])); ?>";
                }
                switch ($campos[$h]["etiqueta_html"]) {
                    case "etiqueta":
                    case "etiqueta_titulo":
                        $texto .= '<div id="tr_' . $campos[$h]["nombre"] . '">
                                        <h5 title="' . $campos[$h]["ayuda"] . '" id="' . $campos[$h]["nombre"] . '"><label >' . strtoupper($campos[$h]["valor"]) . '</label></h5>
                                      </div>';
                        break;
                    case "etiqueta_parrafo":
                        $texto .= '<p id="' . $campos[$h]["nombre"] . '">' . $campos[$h]["valor"] . '</p>';
                        break;
                    case "etiqueta_linea":
                        $texto .= '<hr class="border" id="' . $campos[$h]["nombre"] . '">';
                        break;
                    case "password":

                        $texto .= '<div class="form-group form-group-default ' . $obligatorio . '" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <input class="form-control" ' . $tabindex . ' type="password" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . " $adicionales " . ' value="' . $valor . '">
                                       </div>';
                        $indice_tabindex++;
                        break;
                    case "textarea_cke":
                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <div class="celda_transparente">';
                        $idcampo_cke = $campos[$h]["nombre"];
                        $texto .= '<textarea ' . $tabindex . ' name="' . $campos[$h]["nombre"] . '" id="' . $idcampo_cke . '" cols="53" rows="3" class="form-control';
                        if ($campos[$h]["obligatoriedad"]) {
                            $texto .= ' required';
                        }
                        $texto .= '">' . $valor . '</textarea>';
                        $texto .= '<script>
                            var config = {
                                removePlugins : "preview,copyformatting,save,sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley"
                            };
                            var editor = CKEDITOR.replace("' . $idcampo_cke . '", config);
                            </script>
                            </div></div>';
                        $textareacke++;
                        $indice_tabindex++;
                        break;
                    case "arbol_fancytree":
                        $idcampo_ft = $campos[$h]["idcampos_formato"];
                        $params_ft = json_decode($campos[$h]["valor"], true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $opc_ft = "";
                            $param_url = "";
                            $parts = parse_url($params_ft["url"]);
                            parse_str($parts['query'], $query_ft);
                            foreach ($query_ft as $key => $value) {
                                $param_url .= '"' . $key . '" => "' . $value . '",';
                            }

                            $texto .= '<div class="form-group  ' . $obligatorio . '" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label><?php $origen_' . $idcampo_ft . ' = array(
                                    "url" => "' . $params_ft["url"] . '",
                                    "ruta_db_superior" => $ruta_db_superior,';
                            if (!empty($param_url)) {
                                $texto .= '"params" => array(' . $param_url . '),';
                            }
                            $texto .= ');';
                            if (isset($params_ft["checkbox"])) {
                                $texto .= '$origen_' . $idcampo_ft . '["params"]["checkbox"]="' . $params_ft["checkbox"] . '";';
                                if ($params_ft["checkbox"] == "checkbox") {
                                    $opc_ft .= '"selectMode" => 2,';
                                } else {
                                    $opc_ft .= '"selectMode" => 1,';
                                }
                            } else {
                                $opc_ft .= '"selectMode" => 1,';
                            }

                            if (isset($params_ft["funcion_click"]) && !empty($params_ft["funcion_click"])) {
                                $opc_ft .= '"onNodeClick" => "' . $params_ft["funcion_click"] . '", ';
                            } else {
                                $opc_ft .= '"seleccionarClick" => 1,';
                            }
                            if (isset($params_ft["funcion_select"]) && !empty($params_ft["funcion_select"])) {
                                $opc_ft .= '"onNodeSelect" => "' . $params_ft["funcion_select"] . '", ';
                            }
                            if (isset($params_ft["funcion_dobleclick"]) && !empty($params_ft["funcion_dobleclick"])) {
                                $opc_ft .= '"onNodeDblClick" => "' . $params_ft["funcion_dobleclick"] . '", ';
                            }
                            if (isset($params_ft["buscador"]) && !empty($params_ft["buscador"])) {
                                $opc_ft .= '"busqueda_item" => "' . $params_ft["buscador"] . '", ';
                            }
                            if ($campos[$h]["obligatoriedad"]) {
                                $opc_ft .= '"obligatorio" => 1,';
                            }

                            $texto .= '$opciones_arbol_' . $idcampo_ft . ' = array(
                                    "keyboard" => true,' . $opc_ft . '
                                );
                                $extensiones_' . $idcampo_ft . ' = array(
                                    "filter" => array()
                                );
                                $arbol_' . $idcampo_ft . ' = new ArbolFt("' . $campos[$h]["nombre"] . '", $origen_' . $idcampo_ft . ', $opciones_arbol_' . $idcampo_ft . ', $extensiones_' . $idcampo_ft . ');
                                echo $arbol_' . $idcampo_ft . '->generar_html();?></div>';
                            $arboles_fancy++;
                        }

                        break;
                    case "textarea":
                        $valor = $campos[$h]["valor"];
                        $valor2 = explode("|", $campos[$h]["valor"]);
                        $nivel_barra = "";
                        if (count($valor2)) {
                            $nivel_barra = $valor2[0];
                            if (@$valor2[1] != "") {
                                if ($accion == "adicionar" && strpos($valor2[1], "*}")) {
                                    $includes .= $this->incluir("funciones.php", "librerias");
                                    $valor = $this->arma_funcion($valor2[1], $this->formatId . ",$" . "_REQUEST['iddoc']", $accion);
                                } else if ($accion == "adicionar" && strpos($valor2[1], "*}") === false) {
                                    $valor = $valor2[1];
                                }
                            } else {
                                $valor = "";
                            }
                        }
                        if ($accion == "editar") {
                            $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->formatId,$" . "_REQUEST['iddoc'])); ?>";
                        } else if ($valor == "") {
                            $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ?>';
                        }
                        if ($nivel_barra == "") {
                            $nivel_barra = "basico";
                        }
                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <div class="celda_transparente">
                                        <textarea ' . $tabindex . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" cols="53" rows="3" class="form-control';
                        if ($campos[$h]["obligatoriedad"]) {
                            $texto .= ' required';
                        }
                        $texto .= '">' . $valor . '</textarea></div></div>';
                        $textareas++;
                        $indice_tabindex++;
                        break;
                    case "fecha":
                        // si la fecha es obligatoria, que valide que no se vaya con solo ceros
                        $texto .= $this->procesar_componente_fecha($campos[$h], $indice_tabindex, $accion);
                        $indice_tabindex++;
                        $fecha++;
                        break;
                    case "radio":
                        /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas */
                        $classRadios = '';
                        if ($campos[$h]["obligatoriedad"]) {
                            $classRadios = 'required';
                            $labelRequired = '<label id="' . $campos[$h]["nombre"] . '-error" class="error" for="' . $campos[$h]["nombre"] . '" style="display: none;"></label>';
                        }
                        /* En los campos de  e ste tipo se debe validar que  v alor contenga un list a do con las siguentes caracteristicas */
                        $texto .= '<div class="form-group  ' . $classRadios . '" id="tr_' . $campos[$h]["nombre"] . '">
                            <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga .   '</label>';
                        $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->formatId . "," . $campos[$h]["idcampos_formato"], 'editar') . $labelRequired . '<br></div>';
                        break;
                    case "link":
                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>';
                        if (strpos($adicionales, "class") !== false)
                            $adicionales = str_replace("required", "required url", $adicionales);
                        else
                            $adicionales .= " class='url' ";
                        $texto .= '<textarea form-control cols="40" rows="3" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" ' . $adicionales . '>';
                        if ($accion == "editar") {
                            $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->formatId,$" . "_REQUEST['iddoc'])); ?>";
                        } else if ($valor == "")
                            $valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ?>';
                        $texto .= $valor . '</textarea></div>';
                        break;
                    case "checkbox":
                        if ($campos[$h]["obligatoriedad"]) {
                            $labelRequired = '<label id="' . $campos[$h]["nombre"] . '[]-error" class="error" for="' . $campos[$h]["nombre"] . '[]" style="display: none;"></label>';
                        } else {
                            $labelRequired = "";
                        }

                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>';
                        $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->formatId . "," . $campos[$h]["idcampos_formato"], 'editar') . $labelRequired . '<br></div>';
                        $checkboxes++;
                        break;
                    case "select":
                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>';
                        $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->formatId . "," . $campos[$h]["idcampos_formato"], 'editar') . '</div>';
                        break;
                    case "dependientes":
                        /* parametros:
                              nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
                              (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=) */
                        $parametros = explode("|", $campos[$h]["valor"]);
                        if (count($parametros) < 2) {
                            throw new Exception("Por favor verifique los parametros de configuracion de su select dependiente " . $campos[$h]["etiqueta"], 1);
                        } else {
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                          <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>';
                            $texto .= $this->arma_funcion("genera_campo_listados_editar", $this->formatId . "," . $campos[$h]["idcampos_formato"], 'editar') . '</div>';
                            $dependientes++;
                        }
                        break;
                    case "archivo":
                        $multiple = 'unico';
                        if ($campos[$h]["valor"] != '') {
                            $mystring = $campos[$h]["valor"];
                            $findme = '@';
                            $pos = strpos($mystring, $findme);
                            if ($pos !== false) { // fue encontrada
                                $vector_extensiones_tipo = explode($findme, $mystring);
                                $multiple = $vector_extensiones_tipo[1];
                                $extensiones_fijas = $vector_extensiones_tipo[0];
                            }
                        }

                        // $ul_adicional_archivo='';

                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <div class="tools">
                                             <a class="collapse" href="javascript:;"></a>
                                             <a class="config" data-toggle="modal" href="#grid-config"></a>
                                             <a class="reload" href="javascript:;"></a>
                                             <a class="remove" href="javascript:;"></a>
                                       </div>
                                       <div class="card-body no-scroll no-padding">';

                        if ($extensiones_fijas != "") {
                            $new_ext = array_map('trim', explode('|', $extensiones_fijas));
                            $extensiones_fijas = "." . implode(', .', $new_ext);
                            $extensiones = $extensiones_fijas;
                        } else {
                            $extensiones = '<?php echo $extensiones;?' . '>';
                        }
                        if ($accion == "adicionar") {
                            $opcionesCampo = json_decode($campos[$h]['opciones'], true);
                            $longitud = $opcionesCampo['longitud'];
                            $cantidad = $opcionesCampo['cantidad'];
                            $idelemento = "dz_campo_{$campos[$h]["idcampos_formato"]}";
                            $texto .= '<div id="' . $idelemento . '" class="saia_dz dropzone no-margin" data-nombre-campo="' . $campos[$h]["nombre"] . '" data-longitud="' . $longitud . '"  data-cantidad="' . $cantidad . '" data-idformato="' . $this->formatId . '" data-idcampo-formato="' . $campos[$h]["idcampos_formato"] . '" data-extensiones="' . $extensiones . '" data-multiple="' . $multiple . '">';
                            $texto .= '<div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div>';
                            if ($campos[$h]["obligatoriedad"]) {
                                $texto .= '<input type="hidden" class="required" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" value="">';
                            }
                            $texto .= '</div>';
                            // $texto.=$ul_adicional_archivo;
                        }
                        if ($accion == "editar") {

                            /* SE DEBEN LISTAR TODOS LOS ANEXOS Y PERMITIR BORRARLOS CON UN AGREGA BOTON */
                            $texto .= '<?php echo \'<div class="textwrapper">
                                            <a href="../../anexosdigitales/anexos_documento_edit.php?key=\'.$_REQUEST["iddoc"].\'&idformato=' . $campos[$h]["formato_idformato"] . '&idcampo=' . $campos[$h]["idcampos_formato"] . '" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
                                            objectType: \\\'iframe\\\', outlineType: \\\'rounded-white\\\', wrapperClassName: \\\'highslide-wrapper drag-header\\\',
                                            outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
                                            </div>\'; ?' . '>';
                        }
                        $texto .= '</div></div>';
                        $indice_tabindex++;
                        $archivo++;
                        break;
                    case "tarea":
                        // parametros:id de la tarea
                        $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                                        <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input type="hidden" name="tarea_' . $campos[$h]["nombre"] . '" value="' . $campos[$h]["valor"] . '"><input type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="';
                        if ($accion == "adicionar") {
                            if ($campos[$h]["predeterminado"] == "now()")
                                $texto .= '<?php echo(date("Y-m-d H:i")); ?' . '>';
                            else
                                $texto .= '<?php echo(date("0000-00-00 00:00")); ?' . '>';
                        } else
                            $texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->formatId,$" . "_REQUEST['iddoc']); ?" . ">";
                        $texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formato","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font></td>';
                        $fecha++;
                        $mascaras++;
                        $lista_enmascarados .= "
                                $('#" . $campos[$h]["nombre"] . "').mask('9999-99-99 99:99',{
                                    completed:function(){
                                      $.ajax({
                                        type:'POST',
                                        url:'../librerias/validar_fecha.php',
                                        data:'formato=%Y-%m-%d %H:%s:00&valor='+this.val()+':00',
                                        success: function(datos,exito){
                                          if(datos==0){
                                            alert('Fecha no valida');
                                            this.focus();
                                          }
                                        }
                                      });
                                    }
                                  });";
                        break;
                    case "hidden":
                        $texto .= '<input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '">';
                        break;
                    case "autocompletar":
                        /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                              ej: nombres,apellidos;idfuncionario;funcionario
                             */
                        $parametros = json_decode($campos[$h]['valor']);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            die("Autocompletar: El campo valor debe ser una cadena json");
                        }
                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                       <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>';
                        if ($campos[$h]["obligatoriedad"] == 1) {
                            $obligatorio = "required";
                        }

                        $adicional = "";
                        if ($accion == "editar") {
                            $adicional = " data-data='<?php echo(mostrar_autocompletar('{$campos[$h]["nombre"]}', $this->formatId, $" . "_REQUEST['iddoc'])); ?>'";
                        }
                        $texto .= '<input type="text" class="form-control" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value=""' . $adicional . $obligatorio . '></div>';
                        $texto .= $this->crea_campo_autocompletar($campos[$h]["nombre"], $parametros);
                        $autocompletar++;
                        break;
                    case "etiqueta":
                        $texto .= '<div class="card-body" id="tr_' . $campos[$h]["nombre"] . '">
                                        <h5><center>' . $valor . '</center></h5><input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '">
                                       </div>';
                        break;
                    case "ejecutor":
                        if ($accion == "editar") {
                            $valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->formatId,$" . "_REQUEST['iddoc'])); ?>";
                        } else
                            $valor = $campos[$h]["predeterminado"];

                        $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</label>
                                        <input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="' . $valor . '"><?php componente_ejecutor("' . $campos[$h]["idcampos_formato"] . '",@$_REQUEST["iddoc"]); ?' . '>';
                        $texto .= '</div>';
                        break;
                    case "item":
                        break;
                    case "detalle":
                        if ($formato[0]["item"]) {
                            $padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
                            if ($padre["numcampos"]) {
                                $texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden"  name="idpadre" ' . $obligatorio . ' value="<?php echo $_REQUEST["idpadre"]; ?' . '>">' . '<?php } ?' . '>';
                            } else
                                $texto .= '<?php listar_select_padres(' . $padre[0]["nombre_tabla"] . '); ?' . '>';
                        } else {
                            $padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
                            if ($padre["numcampos"] && $accion == "adicionar") {
                                $texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>">' . '<?php } ?' . '>';
                                $texto .= '<?php if($_REQUEST["anterior"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["anterior"]; ?' . '>">' . '<?php }  else {listar_select_padres(' . $padre[0]["nombre_tabla"] . ');} ?' . '>';
                            }
                        }
                        break;
                    case "moneda":
                        $texto .= $this->procesar_componente_numero($campos[$h], $indice_tabindex, true);
                        $indice_tabindex++;
                        //$spinner++;
                        break;
                    case "spin":
                        $texto .= $this->procesar_componente_numero($campos[$h], $indice_tabindex);
                        $indice_tabindex++;
                        //$spinner++;
                        break;
                    default: // text
                        $estilo = json_decode($campos[$h]["estilo"], true);
                        $tam = 100;
                        $ancho = "";
                        if (!empty($estilo)) {
                            $tam = $estilo["size"];
                            $ancho = ' col-md-' . $tam . ' col-lg-' . $tam . ' col-xl-' . $tam . '';
                        }

                        if ($campos[$h]["obligatoriedad"] == 1) {
                            $obligatorio = "required";
                        }
                        $texto .= '<div class="form-group ' .  $ancho . '"  id="tr_' . $campos[$h]["nombre"] . '">
                                        <label title="' . $campos[$h]["ayuda"] . '">' . str_replace("ACUTE;", "acute;", strtoupper($campos[$h]["etiqueta"])) . $obliga . '</label>
                                        <input class="form-control" ' . $obligatorio . " $adicionales $tabindex" . ' type="text"  size="100" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '">
                                       </div>';
                        if ($campos[$h]["mascara"] != "") {
                            $mascaras++;
                            $lista_enmascarados .= "$('#" . $campos[$h]["nombre"] . "').mask('" . $campos[$h]["mascara"] . "');";
                        }
                        $indice_tabindex++;
                        break;
                }
            }
            array_push($listado_campos, "'" . $campos[$h]["nombre"] . "'");
        }
        // ******************************************************************************************
        if ($formato[0]["item"] && $accion == "adicionar") {
            $texto .= '<div "form-group">'
                . '<label>ACCION A SEGUIR LUEGO DE GUARDAR</label>'
                . '<div class="radio radio-success">'
                . '<input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">'
                . '<label for="opcion_item1">Adicionar otro</label>'
                . '<input type="radio" name="opcion_item" id="opcion_item" value="terminar" checked>'
                . '<label for="opcion_item">Terminar</label>'
                . '</div>'
                . '</div>';
        }
        $wheref = "A.idfunciones_formato=B.funciones_formato_fk AND B.formato_idformato=" . $this->formatId . " AND A.acciones LIKE '%" . strtolower($accion[0]) . "%' ";
        if (count($listado_campos)) {
            $wheref .= "AND nombre_funcion NOT IN(" . implode(",", $listado_campos) . ")";
        }

        $funciones = busca_filtro_tabla("A.*,B.funciones_formato_fk", "funciones_formato A, funciones_formato_enlace B", $wheref, " A.idfunciones_formato asc", $conn);
        for ($i = 0; $i < $funciones["numcampos"]; $i++) {
            $ruta_orig = "";
            $form_origen = busca_filtro_tabla("formato_idformato", "funciones_formato_enlace", "funciones_formato_fk=" . $funciones[$i]["funciones_formato_fk"], "idfunciones_formato_enlace asc", $conn);
            if ($form_origen["numcampos"]) {
                $formato_orig = $form_origen[0]["formato_idformato"];
            }

            if ($formato_orig != $this->formatId && $funciones[$i]["ruta"] == "funciones.php") { // busco el nombre del formato inicial
                $dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig, "", $conn);
                if ($dato_formato_orig["numcampos"]) {
                    // si el archivo existe dentro de la carpeta del archivo inicial
                    if (is_file(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                        $includes .= $this->incluir("'../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . "'", "librerias");
                    } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                        $includes .= $this->incluir("'../" . $funciones[$i]["ruta"] . "'", "librerias");
                    } else { // si no existe en ninguna de las dos
                        // trato de crearlo dentro de la carpeta del formato actual
                        if (crear_archivo($ruta_db_superior . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                            $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                        } else {
                            throw new Exception("No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"], 1);
                        }
                    }
                }
            } else {
                if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
                    $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                } elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
                    // Modificacion realizada el 28-02-2009 porque buscaba la ruta en la raiz pero debia buscarla en la raiz del propio formato se quita el ../
                    $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                } else { // si no existe en ninguna de las dos
                    // trato de crearlo dentro de la carpeta del formato actual
                    $ruta_libreria = $ruta_db_superior . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"];
                    $ruta_real = realpath($ruta_libreria);
                    if ($ruta_real === false) {
                        $ruta_real = normalizePath($ruta_libreria);
                    }
                    if (crear_archivo($ruta_real)) {
                        $includes .= $this->incluir("'" . $funciones[$i]["ruta"] . "'", "librerias");
                    } else {
                        throw new Exception("No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"], 1);
                    }
                }
            }
            if (!in_array($funciones[$i]["nombre_funcion"], $fun_campos)) {
                $parametros = "$this->formatId,NULL";
                $texto .= $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, $accion);
            }
        }
        // ******************************************************************************************
        $campo_descripcion = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $this->formatId . " AND acciones LIKE '%p%'", "", $conn);
        $valor1 = extrae_campo($campo_descripcion, "idcampos_formato", "U");
        $valor = implode(",", $valor1);
        if ($campo_descripcion["numcampos"]) {
            if ($accion == "editar") {
                if ($formato[0]["detalle"]) {
                    $valor = "<?php echo('" . $valor . "'); ?>";
                } else {
                    $valor = "<?php echo('" . $valor . "'); ?>";
                }
            }
            $texto .= '<input type="hidden" name="campo_descripcion" value="' . $valor . '">';
        } else {
            throw new Exception("Recuerde asignar el campo que sera almacenado como descripcion del documento", 1);
        }
        if ($accion == "editar") {
            $texto .= '<input type="hidden" name="formato" value="' . $this->formatId . '">';
        }
        if ($formato[0]["detalle"]) {
            $texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>">';
            $texto .= '<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?' . '>">';
            if ($accion == "adicionar") {
                $texto .= '<input type="hidden" name="accion" value="guardar_detalle" >';
            } elseif ($accion == "editar") {
                $texto .= '<input type="hidden" name="accion" value="editar" >';
                $texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
                $texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
            }
        }
        if ($formato[0]["item"]) {
            $texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden" name="formato" value="' . $formato[0]["nombre"] . '">';
            if ($accion == "adicionar") {
                $texto .= '<input type="hidden" name="accion" value="guardar_item" >';
            } elseif ($accion == "editar") {
                $texto .= '<input type="hidden" name="accion" value="editar" >';
                $texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
                $texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
            }
        }
        $texto .= "<tr><td colspan='2'>" . $this->arma_funcion("submit_formato", $this->formatId, $accion);
        $texto .= '</td></tr></table>';

        $includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
        $includes .= $this->incluir_libreria("funciones_acciones.php", "librerias");
        //$includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
        if ($archivo) {
            $texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
            $id_unico = '<?php echo (uniqid("' . $this->formatId . '-") . "-" . uniqid());?>';
            $texto .= "<input type='hidden' name='form_uuid'       id='form_uuid'       value='$id_unico'>";
        }
        $texto .= '</form></body>';
        if ($textareas) {
            $includes .= $this->incluir_libreria("header_formato.php", "librerias");
        }
        if ($textareacke) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js', "javascript");
        }
        if ($formato[0]["item"] <> 1) {
            $includes .= '<?= pace() ?>
                        <?= jquery() ?>
                        <?= bootstrap() ?>
                        <?= theme() ?>
                        <?= icons() ?>
                        <?= moment() ?>';
        }
        $includes .= "<?= validate() ?>";

        if ($arboles_fancy) {
            $includes .= '<style>
                    ul.fancytree-container {
                    width: 80%;
                    height: 80%;
                    overflow: auto;
                    position: relative;
                    border: none !important;
                        outline:none !important;
                    }
                    span.fancytree-title {
                        font-family: verdana;
                    font-size: 7pt;
                    }
                    span.fancytree-checkbox.fancytree-radio {
                        vertical-align: middle;
                    }
                    span.fancytree-expander {
                        vertical-align: middle !important;
                    }
                    </style>';
            $includes .= $this->incluir('$ruta_db_superior . "app/arbol/crear_arbol_ft.php"', "librerias");
            $includes .= '<?= jqueryUi() ?>';
            $includes .= '<?= fancyTree(true) ?>';
        }

        $includes .= $this->incluir('<?= $ruta_db_superior ?>js/title2note.js', "javascript");
        if ($arboles) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/dhtmlXCommon.js', "javascript");
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/dhtmlXTree.js', "javascript");
            $includes .= $this->incluir_libreria("header_formato.php", "librerias");
            $includes .= '<link rel="STYLESHEET" type="text/css" href="<?= $ruta_db_superior ?>css/dhtmlXTree.css">';
        }
        if ($autocompletar) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>css/selectize.css', "estilos");
            // $includes .= $this->incluir("../../js/jquery-1.7.2.js", "javascript");
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/selectize.js', "javascript");
            // $includes .= incluir("../librerias/autocompletar.js", "javascript");
        }
        if ($dependientes > 0) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>librerias/dependientes.js', "javascript");
        }

        if ($hora) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/jquery.clock.js', "javascript");
        }
        $numero_unicos = count($unico);
        $enmascarar = '';
        if ($numero_unicos) {
            $listado = array();
            $enmascarar .= '<script type="text/javascript">
                $(document).ready(function() {';
            for ($k = 0; $k < $numero_unicos; $k++) {
                $enmascarar .= "$('#" . $unico[0][0] . "').blur(function(){
                $.ajax({url: '../librerias/validar_unico.php',
                type:'POST',
                data:'nombre=unico&valor='+$('#" . $unico[0][0] . "').val()+'&tabla=" . $formato[0]["nombre_tabla"] . "&iddoc=<" . "?php echo $" . "_REQUEST[\"iddoc\"]; ?" . ">',
                success: function(datos){
                if(datos==0){
                alert('El campo " . $unico[0][0] . " debe Ser unico');
                $('#" . $unico[0][0] . "').val('');
                $('#" . $unico[0][0] . "').focus();
                }
                }
                });
                });";
            }
            $enmascarar .= '});
                </script>';
        }

        if ($spinner)
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/jquery.spin.js', "javascript");
        if ($mascaras) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>js/jquery.maskedinput.js', "javascript");
            $enmascarar .= '
      <script type="text/javascript">
      jQuery.noConflict();(function($) {
        $(function() {' . $lista_enmascarados . '});
       })(jQuery);
      </script>';
        }
        if ($formato[0]["enter2tab"]) {
            $codigo_enter2tab = "<script>$(document).ready(function()
      {/* Para que el enter se comporte como tabulador    */
        tb = $('input');
        if ($.browser.mozilla)
           $(tb).keypress(enter2tab);
        else
           $(tb).keydown(enter2tab);
      });

      function enter2tab(e)
      {
        if (e.keyCode == 13)
        {
          cb = parseInt($(this).attr('tabindex'));
          if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null)
            {
              $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
              $(':input[tabindex=\'' + (cb + 1) + '\']').select();
              e.preventDefault();
              return false;
            }
        }
      }</script>";
        }
        if (count($autoguardado) > 0 && $accion == "adicionar") {
            $texto .= '
      <script type="text/javascript">
      setInterval("auto_save(' . "'" . implode(",", $autoguardado) . "'" . ',' . "'" . $formato[0]["nombre"] . "'" . ')",' . $formato[0]["tiempo_autoguardado"] . ');
      </script>';
        }

        $js_archivos = "";
        if ($archivo) {
            $includes .= $this->incluir('<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/min/dropzone.min.js', "javascript");
            $includes .= $this->incluir("'<?= $ruta_db_superior ?>anexosdigitales/funciones_archivo.php'", "librerias");
            $includes .= $this->incluir('<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide-with-html.js', "javascript");
            $includes .= '<link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/highslide.css" /></style>';
            $includes .= '<link rel="stylesheet" type="text/css" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/dropzone/custom.css" /></style>';
            $includes .= '<script type="text/javascript"> hs.graphicsDir = "<?= $ruta_db_superior ?>anexosdigitales/highslide-5.0.0/highslide/graphics/"; hs.outlineType = "rounded-white";</script>';
            $js_archivos = $this->crear_campo_dropzone(null, null);
        }
        //$includes .= "<style>label.error{color:red}</style>";

        $contenido = '<?php
                    $max_salida = 10;
                    $ruta_db_superior = $ruta = "";

                    while ($max_salida > 0) {
                        if (is_file($ruta . "db.php")) {
                            $ruta_db_superior = $ruta;
                        }

                        $ruta .= "../";
                        $max_salida --;
                    }

                    ?>
                        <!DOCTYPE html>
                            <html>
                                <head>
                                    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
                                    <meta charset="utf-8" />
                                    <title>.:' . strtoupper($accion . ' ' . $formato[0]["etiqueta"]) . ':.</title>
                                    <meta name="viewport"
                                      content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
                                    <meta name="apple-mobile-web-app-capable" content="yes">
                                    <meta name="apple-touch-fullscreen" content="yes">
                                    <meta name="apple-mobile-web-app-status-bar-style" content="default">
                                    <meta content="" name="description" />
                                    <meta content="" name="Cero K" /> ' . $includes . '
                  <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css"
                                  rel="stylesheet" type="text/css" media="screen" />
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"
                                  rel="stylesheet" type="text/css" media="screen" />
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css"
                                  rel="stylesheet" type="text/css" media="screen" />                                
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css"
                                  rel="stylesheet" type="text/css" />
                                <link
                                  href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css"
                                  rel="stylesheet" type="text/css" media="screen">
                                <script
                                    src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js"
                                    type="text/javascript"></script>

                                <link rel="stylesheet"
                                    href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css"  type="text/css" media="screen" />
                                <script
                                  src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>' . $enmascarar . ' ' . $codigo_enter2tab . '
                                <script
                                  src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js"></script>' . $enmascarar . ' ' . $codigo_enter2tab . '
                  </head>
                  ' . $texto . $js_archivos . '
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $(".form-group.form-group-default").click(function() {
                                    $(this).find("input").focus();
                                });

                                if (!this.initFormGroupDefaultRun) {
                                    $("body").on("focus", ".form-group.form-group-default :input", function() {
                                        $(".form-group.form-group-default").removeClass("focused");
                                        $(this).parents(".form-group").addClass("focused");
                                    });

                                    $("body").on("blur", ".form-group.form-group-default :input", function() {
                                        $(this).parents(".form-group").removeClass("focused");
                                        if ($(this).val()) {
                                            $(this).closest(".form-group").find("label").addClass("fade");
                                        } else {
                                            $(this).closest(".form-group").find("label").removeClass("fade");
                                        }
                                    });

                                    // Only run the above code once.
                                    this.initFormGroupDefaultRun = true;
                                }

                                $(".form-group.form-group-default .checkbox, .form-group.form-group-default .radio").hover(function() {
                                    $(this).parents(".form-group").addClass("focused");
                                }, function() {
                                    $(this).parents(".form-group").removeClass("focused");
                                });
                                
                            });
                        </script>
                  </html>';
        if ($accion == "editar") {
            $contenido .= '<?php include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/footer_plantilla.php");?' . '>';
        }

        if ($accion == 'adicionar') {
            $fileName = "{$this->directory}/{$this->Formato->ruta_adicionar}";
        } else {
            $fileName = "{$this->directory}/{$this->Formato->ruta_editar}";
        }

        if (!file_put_contents($fileName, $contenido)) {
            throw new Exception("Imposible crear el archivo {$accion}", 1);
        }
    }

    /*
     * <Clase>
     * <Nombre></Nombre>
     * <Parametros>cad:cadena con las rutas relativas de los archivos a incluir separadas por comas;
     * tipo:Tipo de libreria a incluir librerias->php, javascript->js,estilos->css;
     * eval:Si debe crear el archivo o no</Parametros>
     * <Responsabilidades>Genera la cadena que se necesita incluir los archivos especificados<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida>Cadena de texto</Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function incluir($cad, $tipo, $eval = 0)
    {
        $includes = "";
        $lib = explode(",", $cad);
        switch ($tipo) {
            case "librerias":
                $texto1 = '<?php include_once(';
                $texto2 = '); ?>';
                break;
            case "javascript":
                $texto1 = '<script type="text/javascript" src="';
                $texto2 = '"></script>';
                break;
            case "estilos":
                $texto1 = '<link rel="stylesheet" type="text/css" href="';
                $texto2 = '"/>';
                break;
            default:
                return (""); // retorna un vacio si no existe el tipo
                break;
        }

        for ($j = 0; $j < count($lib); $j++) {
            $pos = array_search($texto1 . $lib[$j] . $texto2, $this->incluidos);
            if ($pos === false) {
                if (!is_file($lib[$j]) & $eval) {
                    if (crear_archivo($lib[$j])) {
                        $includes .= $texto1 . $lib[$j] . $texto2;
                    } else {
                        throw new Exception("Problemas al generar el Formato en " . $lib[$j], 1);
                        return ("");
                    }
                } else {
                    $includes .= $texto1 . $lib[$j] . $texto2;
                }
                array_push($this->incluidos, $texto1 . $lib[$j] . $texto2);
            }
        }
        return ($includes);
    }

    /*
     * <Clase>
     * <Nombre>incluir_libreria</Nombre>
     * <Parametros>$nombre:nombre del archivo;$tipo:tipo de archivo php, js, css</Parametros>
     * <Responsabilidades>Crea la cadena necesaria para incluir un archivo que se encuentre en la carpeta formatos/librerias<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function incluir_libreria($nombre, $tipo)
    {
        global $ruta_db_superior;
        $includes = "";
        if (!is_file($ruta_db_superior . FORMATOS_SAIA . "librerias/" . $nombre)) {
            if (!crear_archivo($ruta_db_superior . FORMATOS_SAIA . "librerias/" . $nombre)) {
                throw new Exception("No es posible generar el archivo " . $nombre, 1);
            }
        }
        if ($tipo == 'librerias') {
            $includes .= $this->incluir("'../../" . $ruta_db_superior . FORMATOS_SAIA . "librerias/" . $nombre . "'", $tipo);
        } else {
            $includes .= $this->incluir("../../" . $ruta_db_superior . FORMATOS_SAIA . "librerias/" . $nombre, $tipo);
        }

        return ($includes);
    }

    /*
     * <Clase>
     * <Nombre>arma_funcion</Nombre>
     * <Parametros>$nombre:nombre de la funciï¿½n;$parametros:parametros que se le deben pasar;$accion:formato al cual corresponde (adicionar,editar,buscar)</Parametros>
     * <Responsabilidades>Crea la cadena de texto necesaria para hacer el llamado a la funciï¿½n especificada<Responsabilidades>
     * <Notas></Notas>
     * <Excepciones></Excepciones>
     * <Salida></Salida>
     * <Pre-condiciones><Pre-condiciones>
     * <Post-condiciones><Post-condiciones>
     * </Clase>
     */

    private function arma_funcion($nombre, $parametros, $accion)
    {
        if ($parametros != "" && $accion != "adicionar" && $accion != 'buscar')
            $parametros .= ",";
        if ($accion == "mostrar") {
            $texto = '<?php if(isset($_REQUEST["iddoc"])){';
            $texto .= $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);";
            $texto .= '}?>';
        } elseif ($accion == "adicionar")
            $texto = "<?php " . $nombre . "(" . $parametros . ");?>";
        elseif ($accion == "editar")
            $texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);?>";
        elseif ($accion == "buscar")
            $texto = "<?php " . $nombre . "(" . $parametros . ",'',1);?>";

        return ($texto);
    }

    private function procesar_componente_fecha($campo, $indice_tabindex, $accion)
    {
        $tabindex = ' tabindex="' . $indice_tabindex . ' "';

        //$formato_fecha="L";
        $formato_fecha = "YYYY-MM-DD";
        $texto = array();

        //$nombre_selector =  "dtp_" . $campo["nombre"];
        $nombre_selector = $campo["nombre"];
        $labelRequired = '';
        $required = '';
        if ($campo["obligatoriedad"]) {
            $obliga = "*";
            $labelRequired = '<label id="' . $campo["nombre"] . '-error" class="error" for="' . $campo["nombre"] . '" style="display: none;"></label>';
            $required = 'required';
        } else {
            $obliga = "";
        }
        $texto[] = '<div class="form-group" id="tr_' . $campo["nombre"] . '">';
        $texto[] = '<label for="' . $campo["nombre"] . '">' . $this->codifica($campo["etiqueta"]) . '</label>';
        $texto[] = $labelRequired;
        $texto[] = '<div class="input-group date">';
        $texto[] = '<input ' . $tabindex . ' type="text" class="form-control" ' . ' id="' . $campo["nombre"] . '"  ' . $required . ' name="' . $campo["nombre"] . '" />';
        $texto[] = '<div class="input-group-append">';
        $texto[] = '<span class="input-group-text"><i class="fa fa-calendar"></i></span>';

        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);

            $ini = "";
            $fin = "";
            $ancho = "";
            if (isset($opciones["tipo"]) && $opciones["tipo"] == "datetime") {
                //$formato_fecha="L LT";
                $formato_fecha = "YYYY-MM-DD HH:mm:ss";
            }
            $fecha_por_defecto = '';
            $opciones_fecha = array();
            if (isset($opciones["criterio"])) {
                $criterio = $opciones["criterio"];
                switch ($criterio) {
                    case "max_lt":
                        $ff = new Datetime($opciones["fecha_1"]);
                        $fin = $ff->sub(new DateInterval('P1D'));
                        $opciones_fecha["maxDate"] = $fin->format("Y-m-d");
                        break;
                    case "max":
                        $fin = $opciones["fecha_1"];
                        $opciones_fecha["maxDate"] = $fin;
                        break;
                    case "min":
                        $ini = $opciones["fecha_1"];
                        $opciones_fecha["minDate"] = $ini;
                        break;
                    case "min_gt":
                        $fi = new Datetime($opciones["fecha_1"]);
                        $ini = $fi->add(new DateInterval('P1D'));
                        $opciones_fecha["minDate"] = $ini->format("Y-m-d");
                        break;
                    case "between":
                        $ini = $opciones["fecha_1"];
                        $fin = $opciones["fecha_2"];
                        $opciones_fecha["minDate"] = $ini;
                        $opciones_fecha["maxDate"] = $fin;
                        break;
                    case "actual":
                        if ($opciones["tipo"] == "datetime") {
                            $fecha_por_defecto = date("Y-m-d H:i:s");
                        } else if ($opciones["tipo"] == "date") {
                            $fecha_por_defecto = date("Y-m-d");
                        }
                        break;
                    case "ant_actual":
                        if ($opciones["tipo"] == "datetime") {
                            $opciones_fecha["maxDate"] = date("Y-m-d H:i:s");
                        } else if ($opciones["tipo"] == "date") {
                            $opciones_fecha["maxDate"] = date("Y-m-d");
                        }
                        break;
                    case "not_between":
                        $excluidos = array();
                        $fi = new Datetime($opciones["fecha_1"]);
                        $ff = new Datetime($opciones["fecha_2"]);
                        if ($fi > $ff) {
                            $t = $fi;
                            $fi = $ff;
                            $ff = $t;
                        }
                        $interval = DateInterval::createFromDateString('1 day');
                        $period = new DatePeriod($fi, $interval, $ff);

                        foreach ($period as $dt) {
                            $excluidos[] = $dt->format("Y-m-d");
                        }
                        if (!empty($excluidos)) {
                            $opciones_fecha["disabledDates"] = $excluidos;
                        }
                        break;
                }
            }
        } else {
            if (strtoupper($campo["tipo_dato"]) == "DATE") {
                $formato_fecha = "YYYY-MM-DD";

                if ($accion == "adicionar") {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('Y-m-d')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
                $indice_tabindex++;
            } else if (strtoupper($campo["tipo_dato"]) == "DATETIME") {
                $formato_fecha = "YYYY-MM-DD LT";
                if ($accion == "adicionar") {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('Y-m-d H:i')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
                $indice_tabindex++;
            } else if (strtoupper($campo["tipo_dato"]) == "TIME") {
                $formato_fecha = "LT";
                if ($accion == "adicionar") {
                    if ($campo["predeterminado"] == "now()") {
                        $fecha_por_defecto = "<?php echo(date('H:i')); ?>";
                    } else {
                        $fecha_por_defecto = '';
                    }
                }
                $indice_tabindex++;
            }
            if ($accion == "editar") {
                $fecha_por_defecto = "<?php echo(mostrar_valor_campo('" . $campo["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ?" . ">";
            }
        }

        if (!empty($fecha_por_defecto)) {
            $opciones_fecha["defaultDate"] = $fecha_por_defecto;
        }
        $opciones_fecha["format"] = $formato_fecha;
        $opciones_fecha["locale"] = "es";
        $opciones_fecha["useCurrent"] = true;

        $texto[] = "</div>";
        $opciones_json = json_encode($opciones_fecha, JSON_NUMERIC_CHECK);
        $texto[] = '<script type="text/javascript">
            $(function () {
                var configuracion=' . $opciones_json . ';
                $("#' . $nombre_selector . '").datetimepicker(configuracion);
                $("#content_container").height($(window).height());
            });
        </script>';
        $texto[] = "</div>";
        $texto[] = "</div>";

        return implode("\n", $texto);
    }

    private function procesar_componente_numero($campo, $indice_tabindex, $moneda = false)
    {
        $valor = $campo["valor"];

        $obligatorio = "";
        $obliga = "";
        $tabindex = ' tabindex="' . $indice_tabindex . ' "';
        if ($campo["obligatoriedad"]) {
            $obliga = "*";
            $obligatorio = " required ";
        }
        $aux2 = [];
        $texto = array();
        if (!empty($campo["opciones"])) {
            $opciones = json_decode($campo["opciones"], true);
            $estilo = json_decode($campo["estilo"], true);

            $ini = 0;
            $fin = ""; //anteriormente estaba en 1000
            $decimales = 0;
            $incremento = 1;
            $tam = 100;
            $ancho = "";
            if (isset($opciones["con_decimales"]) && isset($opciones["decimales"])) {
                $decimales = $opciones["decimales"];
            }
            if (!empty($estilo)) {
                $tam = $estilo["size"];
            }
            if (isset($opciones["criterio"])) {
                $criterio = $opciones["criterio"];
                switch ($criterio) {
                    case "max_lt":
                        $fin = $opciones["valor_1"] - 1;
                        break;
                    case "max":
                        $fin = $opciones["valor_1"];
                        break;
                    case "min":
                        $ini = $opciones["valor_1"];
                        break;
                    case "min_gt":
                        $ini = $opciones["valor_1"] + 1;
                        break;
                    case "between":
                        $ini = $opciones["valor_1"];
                        $fin = $opciones["valor_2"];
                        if (empty($fin)) {
                            $fin = 1000;
                        }
                        if ($fin <= $ini) {
                            $fin = $ini + 1;
                        }
                        break;
                    case "not_between":
                        break;
                }
                if ($decimales) {
                    $incremento = pow(10, -$decimales);
                }
            }
            $aux2[] = 'min="' . $ini . '"';
            $aux2[] = 'max="' . $fin . '"';
            $aux2[] = 'step=' . $incremento;
            $ancho = ' col-md-' . $tam . ' col-lg-' . $tam . ' col-xl-' . $tam . '';
        } else if (!empty($valor)) {
            $parametros = explode("@", $valor);
            if (is_numeric($parametros[0])) {
                $aux2[] = 'min="' . $parametros[0] . '"';
            }
            if (is_numeric($parametros[1])) {
                $aux2[] = 'max="' . $parametros[1] . '"';
            }
            if (is_numeric($parametros[2]))
                $aux2[] = 'step="' . $parametros[2] . '"';
            if (is_numeric($parametros[3]) && $parametros[3]) {
                $aux[] = 'lock:true';
            }
        }

        $adicionales = '';
        if (is_array($aux2)) {
            $adicionales .= implode(" ", $aux2);
        }
        $pre = "";
        $post = "";
        $texto[] = '<div class="form-group ' . $obligatorio . $ancho . '" id="tr_' . $campo["nombre"] . '">';
        $texto[] = '<label title="' . $campo["ayuda"] . '" for="' . $campo["nombre"] . '">' . $campo["etiqueta"] . '</label>';
        if ($moneda) {
            $pre = '<div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>';
            $post = '</div>';
            $ancho = "";
        }
        $texto[] = $pre;
        $texto[] = '<input class="form-control" ' . " $adicionales $tabindex $obligatorio" . ' type="number" id="' . $campo["nombre"] . '" name="' . $campo["nombre"] . '"  value="' . $valor . '">';
        $texto[] = '</div>';
        $texto[] = $post;
        return implode("\n", $texto);
    }


    private function crea_campo_autocompletar($nombre, $parametros)
    {

        /* {"tipo":"multiple","url":"../../autocompletar.php","campoid":"funcionario_codigo","campotexto":["nombres","apellidos"],"tablas":["funcionario"],"condicion":"estado=1","orden":""} */
        if ($parametros->tipo == "simple") {
            $tipo = "1";
        } else {
            $tipo = "null";
        }

        $consulta = array(
            "campoid" => $parametros->campoid,
            "campotexto" => $parametros->campotexto,
            "tablas" => $parametros->tablas,
            "condicion" => $parametros->condicion,
            "orden" => $parametros->orden
        );

        $consulta64 = base64_encode(json_encode($consulta));

        $selector = "[name='$nombre']";

        $campo = '
            <script>
            $(document).ready(function(){
        $("' . $selector . '").selectize({
            valueField: "value",
            labelField: "text",
            searchField: "text",
        persist: false,
        createOnBlur: true,
        create: false,
        maxItems: ' . $tipo . ',
        load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: "' . $parametros->url . '",
                    type: "POST",
                    dataType: "json",
                    data: {
                        consulta: "' . $consulta64 . '",
                        valor: query,
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        });
            });';
        $campo .= '</script>';

        return ($campo);
    }

    private function crear_campo_dropzone($nombre, $parametros)
    {

        $upload_max_size = str_replace("M", "", ini_get('upload_max_filesize'));
        $maximo = str_replace("M", "", return_megabytes($upload_max_size));
        $js_archivos = "<script type='text/javascript'>
            var upload_url = '../../app/temporal/cargar_archivos_formato.php';
            var mensaje = 'Arrastre aquiï¿½ los archivos';
            Dropzone.autoDiscover = false;
            var lista_archivos = new Object();
            $(document).ready(function () {
                Dropzone.autoDiscover = false;
                $('.saia_dz').each(function () {
                    var upload_max_size = $upload_max_size;
                    var maximo = $maximo;
                    var tamanoMaximo = $(this).attr('data-longitud');
                    var archivosMaximo = $(this).attr('data-cantidad');
                    var multiple_text = $(this).attr('data-multiple');
                    if(tamanoMaximo > 1){
                         multiple_text = 'multiple';
                    }
                    
                    var idformato = $(this).attr('data-idformato');
                  var idcampo = $(this).attr('id');
                  var paramName = $(this).attr('data-nombre-campo');
                  var idcampoFormato = $(this).attr('data-idcampo-formato');
                  var extensiones = $(this).attr('data-extensiones');
                  
                  var multiple = false;
                  var form_uuid = $('#form_uuid').val();
                    var maxFiles = 1;
                    var maxFilesize = $maximo;
                  if(multiple_text == 'multiple') {
                      multiple = true;
                        if(tamanoMaximo > upload_max_size){
                            maxFilesize = 200;                           
                        }else{
                            maxFilesize = tamanoMaximo;
                        }
                        if(archivosMaximo > maximo){
                            maxFiles = 10;
                        }else{
                            maxFiles = archivosMaximo;
                        } 
                  }
                    var opciones = {
                        maxFilesize: maxFilesize,
                      ignoreHiddenFiles : true,
                      maxFiles : maxFiles,
                      acceptedFiles: extensiones,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Quitar anexo',
                    dictMaxFilesExceeded : 'No puede subir mas archivos',
                    dictResponseError : 'El servidor respondio con codigo {{statusCode}}',
                  uploadMultiple: multiple,
                      url: upload_url,
                      paramName : paramName,
                      params : {
                          idformato : idformato,
                          idcampo_formato : idcampoFormato,
                          nombre_campo : paramName,
                          uuid : form_uuid
                        },
                        removedfile : function(file) {
                            if(lista_archivos && lista_archivos[file.upload.uuid]) {
                              $.ajax({
                              url: upload_url,
                              type: 'POST',
                              data: {
                                  accion:'eliminar_temporal',
                                      idformato : idformato,
                                      idcampo_formato : idcampoFormato,
                                  archivo: lista_archivos[file.upload.uuid]}
                              });
                            }
                            if (file.previewElement != null && file.previewElement.parentNode != null) {
                                file.previewElement.parentNode.removeChild(file.previewElement);
                              delete lista_archivos[file.upload.uuid];
                              $('#'+paramName).val(Object.values(lista_archivos).join());
                            }
                            return this._updateMaxFilesReachedClass();
                        },
                        success : function(file, response) {
                          for (var key in response) {
                              if(Array.isArray(response[key])) {
                                  for(var i=0; i < response[key].length; i++) {
                                  archivo=response[key][i];
                                      if(archivo.original_name == file.upload.filename) {
                                      lista_archivos[file.upload.uuid] = archivo.id;
                                      }
                                  }
                              } else {
                              if(response[key].original_name == file.upload.filename) {
                                  lista_archivos[file.upload.uuid] = response[key].id;
                              }
                              }
                          }
                          $('#'+paramName).val(Object.values(lista_archivos).join());
                            if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                                $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                            }
                        }
                    };
                    $(this).dropzone(opciones);
                    $(this).addClass('dropzone');
                });
            });</script>";
        return $js_archivos;
    }
}
