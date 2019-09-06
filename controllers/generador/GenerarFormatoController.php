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

    public function generate()
    {
        //genero la carpeta y .gitignore
        $this->generateDirectory();

        //genero la tabla
        $this->generateTable();
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

        $directory = "{$ruta_db_superior}formatos/{$this->Formato->nombre}";

        if (!is_dir($directory)) {
            if (!mkdir($directory, PERMISOS_CARPETAS, true)) {
                throw new Exception("No es posible crear la carpeta {$directory}", 1);
            }
        } else {
            chmod($directory, PERMISOS_CARPETAS);
        }

        if (!(int) $this->Formato->pertenece_nucleo) {
            $content = '*';
        } else {
            $content = "{$this->Formato->ruta_adicionar}
                {$this->Formato->ruta_editar}
                {$this->Formato->ruta_buscar}
                {$this->Formato->ruta_mostrar}";
        }

        $ignoreFile = "{$directory}/.gitignore";
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
