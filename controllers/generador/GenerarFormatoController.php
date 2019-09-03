<?php
class GenerarFormatoController
{
    /**
     * almacena la instancia del schemaManager
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-01
     */
    protected $AbstractSchemaManager;

    /**
     * almacena la instancia del fomato a generar
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-01
     */
    protected $Formato;

    /**
     * almacena la informacion con la que
     * se generara el formato
     *
     * @var array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-01
     */
    protected $newData;

    /**
     * inicia el proceso de generacion
     *
     * @param integer $formatId identificador del formato
     * @param array $data nuevos datos
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-01
     */
    public function __construct($formatId = null, $data)
    {
        if ($formatId) {
            $this->getFormat($formatId);
        }

        $this->newData = $data;
        $this->updateFormat();
    }

    /**
     * obtiene la instancia del formato
     *
     * @param integer $formatId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-01
     */
    public function getFormat($formatId)
    {
        $this->Formato = new Formato($formatId);
    }

    /**
     * obtiene la instancia del AbstractSchemaManager
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-01
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
     * @date 2019-09-01
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
     * @date 2019-09-01
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
