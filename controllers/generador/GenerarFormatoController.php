<?php
class GenerarFormatoController
{
    /**
     * nombre de la bandera para un campo
     * que se incluye en la descripcion
     * del formato
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    const BANDERA_DESCRIPCION = 'p';

    /**
     * nombre de la bandera para un campo
     * que se incluye el adicionar
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    const BANDERA_ADICIONAR = 'a';

    /**
     * nombre de la bandera para un campo
     * que se incluye el editar
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    const BANDERA_EDITAR = 'e';
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
     * almacena la Instancia del controlador
     * que genera los componentes
     *
     * @var ComponentFormGeneratorController
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-11
     */
    protected $ComponentFormGeneratorController;

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

        $content = <<<CODE
{$this->Formato->ruta_adicionar}
{$this->Formato->ruta_editar}
{$this->Formato->ruta_mostrar}
CODE;

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
        $this->generateForm(self::BANDERA_ADICIONAR);

        //genera el editar
        $this->generateForm(self::BANDERA_EDITAR);
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
        $code = $this->processContent();
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
                                {$code}
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
     * genera los formularios para edicionar y editar
     *
     * @param string $accion adicionar|editar
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-09
     */
    public function generateForm($flagAction)
    {
        $texto = "";
        $descriptions = [];
        $fields = $this->Formato->getFields();
        $this->ComponentFormGeneratorController = new ComponentFormGeneratorController(
            $this->Formato
        );

        foreach ($fields as $CamposFormato) {
            $actions = explode(',', $CamposFormato->acciones);

            if (in_array(self::BANDERA_DESCRIPCION, $actions)) {
                $descriptions[] = $CamposFormato->getPK();
            }

            if (!in_array($flagAction, $actions)) {
                continue;
            }

            $scope = $flagAction == self::BANDERA_ADICIONAR ?
                ComponentFormGeneratorController::SCOPE_ADD : ComponentFormGeneratorController::SCOPE_EDIT;
            $texto .= $this->ComponentFormGeneratorController->generate($CamposFormato, $scope);
        }

        if ($this->Formato->item && $flagAction == self::BANDERA_ADICIONAR) {
            $texto .= '
            <div "form-group">
                <label>ACCION A SEGUIR LUEGO DE GUARDAR</label>
                <div class="radio radio-success">
                    <input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">
                    <label for="opcion_item1">Adicionar otro</label>
                    <input type="radio" name="opcion_item" id="opcion_item" value="terminar" checked>
                    <label for="opcion_item">Terminar</label>
                </div>
            </div>';
        }

        if (!$descriptions) {
            throw new Exception("Recuerde asignar el campo que sera almacenado como descripcion del documento", 1);
        }

        $value = ($flagAction == self::BANDERA_EDITAR && $this->Formato->detalle) ? implode(',', $descriptions) : '';
        $texto .= "<input type='hidden' name='campo_descripcion' value='{$value}'>";

        if ($flagAction == self::BANDERA_EDITAR) {
            $texto .= '<input type="hidden" name="formato" value="' . $this->formatId . '">';
        }
        if ($this->Formato->detalle) {
            $texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>">';
            $texto .= '<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?' . '>">';
            if ($flagAction == self::BANDERA_ADICIONAR) {
                $texto .= '<input type="hidden" name="accion" value="guardar_detalle" >';
            } elseif ($flagAction == self::BANDERA_EDITAR) {
                $texto .= '<input type="hidden" name="accion" value="editar" >';
                $texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
                $texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
            }
        }

        if ($this->Formato->item) {
            $texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden" name="formato" value="' . $this->Formato->nombre . '">';

            if ($flagAction == self::BANDERA_ADICIONAR) {
                $texto .= '<input type="hidden" name="accion" value="guardar_item" >';
            } elseif ($flagAction == self::BANDERA_EDITAR) {
                $texto .= '<input type="hidden" name="accion" value="editar" >';
                $texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
                $texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
            }
        }

        $texto .= "<tr><td colspan='2'>";

        if ($flagAction == self::BANDERA_ADICIONAR) {
            $texto .= "<?php submit_formato({$this->formatId})?>";
        } else {
            $texto .= "<?php submit_formato({$this->formatId},\$_REQUEST['iddoc']) ?>";
        }

        $texto .= '</td></tr></table>';
        $texto .= '</form>';

        $content = <<<CONTENT
<?php
\$max_salida = 10;
\$ruta_db_superior = \$ruta = "";

while (\$max_salida > 0) {
    if (is_file(\$ruta . "db.php")) {
        \$ruta_db_superior = \$ruta;
    }

    \$ruta .= "../";
    \$max_salida --;
}

include_once \$ruta_db_superior . 'assets/librerias.php';
include_once \$ruta_db_superior . 'formatos/librerias/funciones_generales.php';
include_once \$ruta_db_superior . 'formatos/librerias/funciones_acciones.php';
include_once \$ruta_db_superior . 'app/arbol/crear_arbol_ft.php';
include_once \$ruta_db_superior . 'anexosdigitales/funciones_archivo.php';
include_once \$ruta_db_superior . 'formatos/{$this->Formato->nombre}/funciones.php';

llama_funcion_accion(null,{$this->formatId} ,'ingresar','ANTERIOR');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>SGDA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    <?= pace() ?>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
    <?= moment() ?>
    <?= select2() ?>
    <?= validate() ?>
    <?= ckeditor() ?>
    <?= jqueryUi() ?>
    <?= fancyTree(true) ?>
    <?= dateTimePicker() ?>
    <?= dropzone() ?>
</head>

<body>
    <div class='container-fluid container-fixed-lg col-lg-8' style='overflow: auto;' id='content_container'>
        <div class='card card-default'>
            <div class='card-body'>
                <h5 class='text-black w-100 text-center'>
                    {$this->Formato->etiqueta}
                </h5>
                <form name='formulario_formatos' id='formulario_formatos' role='form' autocomplete='off' method='post' action='<?= \$ruta_db_superior ?>app/documento/class_transferencia.php' enctype='multipart/form-data'>
    {$texto}
</body>
</html>
CONTENT;

        if ($flagAction == self::BANDERA_ADICIONAR) {
            $fileName = "{$this->directory}/{$this->Formato->ruta_adicionar}";
        } else {
            $fileName = "{$this->directory}/{$this->Formato->ruta_editar}";
        }

        if (!file_put_contents($fileName, $content)) {
            throw new Exception("Imposible crear el archivo {$flagAction}", 1);
        }
    }

    /**
     * convierte el cuerpo del formato con el
     * valor de las funciones
     *
     * @return string
     * 
     */
    public function processContent()
    {
        $baseContent = $this->Formato->cuerpo;
        $fields = $this->Formato->getFields();
        $functions = $this->Formato->getFunctions();

        foreach ($fields as $CamposFormato) {
            $search = "{*{$CamposFormato->nombre}*}";
            $baseContent = str_replace(
                $search,
                "<?= mostrar_valor_campo('{$CamposFormato->nombre}', {$this->formatId}, \$_REQUEST['iddoc']) ?>",
                $baseContent
            );
        }

        foreach ($functions as $FuncionesFormato) {
            $baseContent = str_replace(
                $FuncionesFormato->nombre,
                "<?= {$FuncionesFormato->nombre_funcion}({$this->formatId}, \$_REQUEST['iddoc']) ?>",
                $baseContent
            );
        }

        return $baseContent;
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
}
