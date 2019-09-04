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

        $this->createModule();
        self::createDirectory($this->Formato);
        return $this->Formato->getPK();
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
     * @param object $Formato instancia del formato
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-03
     */
    public static function createDirectory($Formato)
    {
        global $ruta_db_superior;

        $directory = "{$ruta_db_superior}formatos/{$Formato->nombre}";

        if (!is_dir($directory)) {
            if (!mkdir($directory, PERMISOS_CARPETAS, true)) {
                throw new Exception("No es posible crear la carpeta {$directory}", 1);
            }
        }

        if (!(int) $Formato->pertenece_nucleo) {
            $content = '*';
        } else {
            $content = "{$Formato->ruta_adicionar}
                {$Formato->ruta_editar}
                {$Formato->ruta_buscar}
                {$Formato->ruta_mostrar}";
        }

        $ignoreFile = "{$directory}/.gitignore";
        file_put_contents($ignoreFile, $content);
        chmod($ignoreFile, PERMISOS_ARCHIVOS);
    }

    /**
     * obtiene la instancia del AbstractSchemaManager
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-02
     */
    public static function getSchema()
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
