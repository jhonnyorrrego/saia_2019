<?php

use Stringy\Stringy;

/**
 * facilita la comunicacion con la base de datos
 * 
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
abstract class Model extends StaticSql
{
    use TModelEvents;

    /**
     * variable con definicion de los attributos segun la tabla
     *      safe => array attributos seguros
     *      date => array attributos tipo fecha
     *      primary => strign nombre de la llave primaria
     *      table => string nombre de la tabla
     * @var array
     */
    protected $dbAttributes;

    /**
     * inicializa la clase
     *
     * @param int $id identificador de un registro
     *  en caso de ser enviado setea las propiedades 
     *  al modelo
     */
    function __construct($id = null)
    {
        $this->defineAttributes();

        if ($id) {
            $this->setPK($id);
            $this->find();
        }
    }

    /**
     * obtiene el valor de un attributo 
     * solo si es de tipo safe (seguro)
     *
     * @param string $attribute nombre del atributo
     * @return void
     */
    public function __get($attribute)
    {
        if (
            property_exists($this, $attribute) &&
            in_array($attribute, $this->getSafeAttributes())
        ) {
            $response = $this->$attribute;
        } else {
            $response = null;
        }

        return $response;
    }

    /**
     * setea el valor de un attributo
     * solo si es de tipo safe (seguro)
     *
     * @param string $attribute nombre del atributo
     * @param void $value nuevo valor
     * @return boolean
     */
    public function __set($attribute, $value)
    {
        $response = property_exists($this, $attribute) &&
            in_array($attribute, $this->getSafeAttributes());

        if ($response) {
            $this->$attribute = $value;
        }

        return $response;
    }

    /**
     * elimina la llave primaria cuando el objeto es clonado
     *
     * @return void
     */
    public function __clone()
    {
        $this->setPK(null);
    }

    /**
     * define los tipos de dato de los attributos
     */
    protected abstract function defineAttributes();

    /**
     * retorna los atributos seguros
     * @return array
     */
    public function getSafeAttributes()
    {
        return $this->dbAttributes->safe;
    }

    /**
     * retorna los atributos tipo fecha
     * @return array
     */
    public function getDateAttributes()
    {
        return $this->dbAttributes->date ? $this->dbAttributes->date : [];
    }

    /**
     * asigna atributos masivamente
     * 
     * @param array $attributes lista de nuevos atributos 
     *      nombreAtributo -> valor donde el atributo es de tipo safe
     * @return boolean
     */
    public function setAttributes(array $attributes)
    {
        $safeAttributes = $this->getSafeAttributes();
        foreach ($attributes as $key => $value) {
            if (in_array($key, $safeAttributes)) {
                $this->$key = $value;
            }
        }

        return !empty($attributes);
    }

    /**
     * retorna matriz de atributos seguros
     *  nombreAttributo -> valor
     * @return array
     */
    public function getAttributes()
    {
        $data = [];

        foreach ($this->getSafeAttributes() as $value) {
            $data[$value] = $this->$value;
        }

        return $data;
    }

    /**
     * retorna la lista de atributos seguros que no son null
     * @return array
     */
    public function getNotNullAttributes()
    {
        return array_filter($this->getAttributes(), function ($value) {
            return count($value) && $value !== false;
        });
    }

    /**
     * obtiene un atributo tipo fecha 
     * en el formato necesario
     *
     * @param string $attribute nombre del atributo a convertir
     * @param string $format formato requerido
     * @return string
     */
    public function getDateAttribute(string $attribute, $format = 'd/m/Y H:i a')
    {
        return DateController::convertDate($this->$attribute, 'Y-m-d H:i:s', $format);
    }

    /**
     * retorna el nombre de la tabla
     *
     * @return string
     */
    public function getTable()
    {
        if (empty($this->dbAttributes->table)) {
            $Stringy = new Stringy(get_called_class());
            $this->dbAttributes->table = (string) $Stringy->underscored();
        }
        return $this->dbAttributes->table;
    }

    /**
     * retorna el nombre de la llave primaria
     *
     * @return string
     */
    public function getPkName()
    {
        if (empty($this->dbAttributes->primary)) {
            $this->dbAttributes->primary = 'id' . $this->getTable();
        }
        return $this->dbAttributes->primary;
    }

    /**
     * obtiene el nombre de la llave primaria
     * en un ambito estatico
     * @return string
     */
    public static function getPrimaryLabel()
    {
        $caller = get_called_class();
        $instance = new $caller();
        return $instance->getPkName();
    }

    /**
     * obtiene el nombre de la tabla
     * en un ambito estatico
     * 
     * @return string
     */
    public static function getTableName()
    {
        $caller = get_called_class();
        $instance = new $caller();
        return $instance->getTable();
    }

    /**
     * obtiene el valor de la llave primaria
     * 
     * @return integer
     */
    public function getPK()
    {
        $pk = $this->getPkName();
        return $this->$pk;
    }

    /**
     * setea el valor de la llave primaria
     *
     * @param int $value nuevo valor
     * @return void
     */
    public function setPK($value)
    {
        $pk = $this->getPkName();
        $this->$pk = $value;
    }

    /**
     * retorna la instancia de la relacion dada
     * usado para relaciones 1=1
     *
     * @param string $instance Nombre de la instancia requerida
     * @param string $fieldName atributo igual a la llave primaria de $instance
     * @return array|null
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     */
    public function getRelationFk(string $instance = null, $fieldName = null)
    {
        if ($instance) {
            $fieldName = $fieldName ?? 'fk_' . $instance::getTableName();
            $response = new $instance($this->$fieldName);
        }
        return $response ?? null;
    }

    /**
     * consulta un registro en la tabla segun 
     * la llave primaria y asigna masivamente los atributos
     *
     * @return void
     */
    public final function find()
    {
        $sql = self::generateSelectSql([$this->getPkName() => $this->getPK()]);
        $data = self::search($sql)[0];

        if (!$this->setAttributes($data)) {
            throw new Exception("invalid Pk", 1);
        }
    }

    /**
     * obtiene un objeto filtrado por las condiciones
     * obtiene null en caso de no encontrar una coincidencia
     *
     * @param array $conditions condiciones a cumplir attributo -> valor
     * @param array $fields filas a consultar
     * @param string $order string de ordenamiento id desc
     * @return void
     */
    public static function findByAttributes(
        array $conditions,
        $fields = [],
        $order = ''
    ) {
        $data = self::findAllByAttributes($conditions, $fields, $order, 0, 1);
        return $data ? $data[0] : null;
    }

    /**
     * obtiene una matriz de objetos filtrados por las condiciones
     * obtiene una matriz vacia en caso de no encontrar coincidencias
     *
     * @param array $conditions condiciones a cumplir atributo -> valor
     * @param array $fields lista de campos a consultar
     * @param string $order string de ordenamiento id desc
     * @param integer $offset limite inferior de la busqueda
     * @param integer $limit limite superior de la busqueda
     * @return array
     */
    public static function findAllByAttributes(
        array $conditions,
        $fields = [],
        $order = '',
        $offset = 0,
        $limit = 0
    ) {
        $sql = self::generateSelectSql($conditions, $fields, $order);
        $records = self::search($sql, $offset, $limit);
        return self::convertToObjectCollection($records);
    }

    /**
     * obtiene una matriz con los datos de una columna
     * filtrando los registros por las condiciones indicadas
     * 
     * obtiene una matriz vacia en caso de no encontrar coincidencias
     *
     * @param string $field nombre de la columna a consultar
     * @param array $conditions condiciones a cumplir atributo -> valor
     * @param string $order string de ordenamiento id desc
     * @return array
     */
    public static function findColumn(
        string $field,
        $conditions = [],
        $order = ''
    ) {
        $sql = self::generateSelectSql($conditions, [$field], $order);
        $records = self::search($sql);

        $data = [];
        foreach ($records as $value) {
            $data[] = $value[0];
        }
        return $data;
    }

    /**
     * ejecuta una busqueda normalmente con un sql avanzado
     *
     * @param string $sql sentencia a ejecutar
     * @param boolean $getInstance retornar instancias del modelo
     * @param integer $offset limite inferior de la consulta
     * @param integer $limit limite superior de la consulta
     * @return void
     */
    public static function findBySql(
        string $sql,
        $getInstance = true,
        $offset = null,
        $limit = null
    ) {
        $data = self::search($sql, $offset, $limit);
        if ($getInstance) {
            $className = get_called_class();
            $data = $className::convertToObjectCollection($data);
        }
        return $data;
    }

    /**
     * consulta la cantidad de registros
     * que cumplen con una condicion
     *
     * @param array $conditions condicion a cumplir atributo -> valor
     * @return int numero de coincidencias
     */
    public static function countRecords(array $conditions = [])
    {
        $condition = self::createCondition($conditions);
        $condition = $condition ? " where "  . $condition : '';
        $sql = "select count(*) as total from " . self::getTableName() . $condition;
        $record = self::search($sql);

        return $record[0]['total'];
    }

    /**
     * crea un nuevo registro en la tabla 
     * desde un ambito estatico
     *
     * @param array $attributes atributo -> valor
     * @return int valor de la nueva llave primaria
     */
    public static function newRecord(array $attributes)
    {
        $className = get_called_class();
        $Instance = new $className();
        $Instance->setAttributes($attributes);
        return $Instance->create();
    }

    /**
     * ejecuta el guardado en la tabla validando
     * si es un registro nuevo o existente
     * 
     * @return boolean
     */
    public function save()
    {
        return $this->getPK() ? $this->update() : $this->create();
    }

    /**
     * crea un registro en la tabla
     * ejecuta los eventos relacionados al crear
     *
     * @return integer
     */
    public final function create()
    {
        if ($this->beforeCreate()) {
            if ($this->runCreate()) {
                $this->afterCreate();
            }
        }
        return $this->getPK();
    }

    /**
     * ejecuta el insert de un registro
     *
     * @return integer valor de la nueva llave primaria
     */
    private function runCreate()
    {
        $table = $this->getTable();
        $attributes = $this->getNotNullAttributes();
        $dateAttributes = $this->getDateAttributes();

        $fields = $values = '';
        foreach ($attributes as $attribute => $value) {
            if (strlen($fields)) {
                $fields .= ',';
                $values .= ',';
            }

            $fields .= $attribute;
            if ($value === "NULL") {
                $values .= $value;
            } else if (in_array($attribute, $dateAttributes)) {
                $values .= self::setDateFormat($value, 'Y-m-d H:i:s');
            } else {
                $values .= "'" . $value . "'";
            }
        }

        $sql = "INSERT INTO {$table} ({$fields}) values ({$values})";

        $this->setPK(self::insert($sql));
        return $this->getPK() ?? 0;
    }

    /**
     * modifica un registro en la tabla
     * ejecuta los eventos relacionados al modificar
     *
     * @param boolean $force usar valores null
     * @return void
     */
    public final function update($force = false)
    {
        $response = false;
        if ($this->beforeUpdate()) {
            $response = $this->runUpdate($force);
            if ($response) {
                $this->afterUpdate();
            }
        }
        return $response ? $this->getPK() : 0;
    }

    /**
     * ejecuta el update de un registro
     *
     * @param boolean $force usar valores null
     * @return void
     */
    private function runUpdate($force)
    {
        $attributes = $force ? $this->getAttributes() : $this->getNotNullAttributes();
        return self::executeUpdate($attributes, [$this->getPkName() => $this->getPK()]);
    }

    /**
     * ejecuta un update basado en las
     * filas y condiciones pasados
     *
     * @param array $fields nuevos valores a guardar attributo -> valor
     * @param array $conditions condicion a cumplir attributo -> valor
     * @return void
     */
    public static function executeUpdate(array $fields, array $conditions)
    {
        $set = '';
        $className = get_called_class();
        $Instance = new $className();

        $dateAttributes = $Instance->getDateAttributes();
        foreach ($fields as $attribute => $value) {
            if ($set) {
                $set .= ',';
            }

            if ($value === "NULL") {
                $set .= $attribute . "=NULL";
            } else if (in_array($attribute, $dateAttributes)) {
                $set .= $attribute . "=" . self::setDateFormat($value, 'Y-m-d H:i:s');
            } else {
                $set .= $attribute . "='" . $value . "'";
            }
        }

        $sql = "UPDATE " . self::getTableName() . " SET " . $set . " WHERE " . self::createCondition($conditions);
        return self::query($sql);
    }

    /**
     * elimina un registro en la tabla
     * ejecuta los eventos relacionados al eliminar
     *
     * @return boolean
     */
    public final function delete()
    {
        if ($this->beforeDelete()) {
            if ($this->runDelete()) {
                $this->afterDelete();
            }
        }
        return !self::findByAttributes([$this->getPkName() => $this->getPK()]);
    }

    /**
     * ejecuta el delete de un registro
     *
     * @return void
     */
    private function runDelete()
    {
        return self::executeDelete([$this->getPkName() => $this->getPK()]);
    }

    /**
     * elimina registros basado en la condicion
     *
     * @param array $conditions condicion a cumplir atributo -> valor
     * @return void
     */
    public static function executeDelete(array $conditions)
    {
        $sql = "DELETE FROM " . self::getTableName() . " WHERE " . self::createCondition($conditions);
        return self::query($sql);
    }

    /**
     * create select portion for sql query
     * check date attributes
     *
     * @param array $fields
     * @return void
     */
    public static function createSelect($fields = [])
    {
        $className = get_called_class();
        $Instance = new $className();

        $dateAttributes = $Instance->getDateAttributes();
        $safeAttributes = $Instance->getSafeAttributes();
        $safeAttributes[] = $Instance->getPkName();
        $select = '';

        if (!$fields) {
            $fields = $safeAttributes;
        }

        foreach ($fields as $attribute) {
            if (!in_array($attribute, $safeAttributes)) {
                continue;
            }

            if (strlen($select)) {
                $select .= ',';
            }

            if (in_array($attribute, $dateAttributes)) {
                $select .= self::getDateFormat($attribute, 'Y-m-d H:i:s') . ' AS ' . $attribute;
            } else {
                $select .= $attribute;
            }
        }

        return $select;
    }

    /**
     * create where portion for sql query
     * check date attributes
     *
     * @param array $conditions
     * @return string
     */
    public static function createCondition($conditions)
    {
        $condition = '';

        if ($conditions) {
            $className = get_called_class();
            $Instance = new $className();
            $dateAttributes = $Instance->getDateAttributes();

            foreach ($conditions as $attribute => $value) {
                if ($condition) {
                    $condition .= ' AND ';
                }

                if (is_null($value)) {
                    $condition .= "{$attribute} IS NULL";
                } else if (in_array($attribute, $dateAttributes)) {
                    $condition .= self::getDateFormat($attribute, 'Y-m-d H:i:s') . "=" . $value;
                } else {
                    $condition .= "{$attribute}='{$value}'";
                }
            }
        }

        return $condition;
    }

    /**
     * crea la sentencia select basado en las 
     * condiciones, columnas y ordenamiento indicado
     *
     * @param array $conditions condiciones a cumplir atributo valor
     * @param array $fields filas a consultar
     * @param string $order string de ordenamiento id desc
     * @return string
     */
    public static function generateSelectSql(
        $conditions = [],
        $fields = null,
        $order = null
    ) {
        $condition = $conditions ? self::createCondition($conditions) : '';

        $sql = "SELECT ";
        $sql .= self::createSelect($fields);
        $sql .= " FROM " . self::getTableName();
        $sql .= $condition ? " WHERE {$condition} " : ' ';
        $sql .= $order ? "ORDER BY {$order} " : '';

        return $sql;
    }

    /**
     * convierte un array de arrays a un array de objetos
     * 
     * en caso de que el modelo defina el metodo massiveAssigned
     * este sera ejecutado 
     *
     * @param array $records array a convertir
     * @return array
     */
    public static function convertToObjectCollection(array $records)
    {
        $class = get_called_class();
        $massiveAssigned = method_exists($class, 'massiveAssigned');
        $data = [];

        foreach ($records as $row) {
            $Instance = new $class();
            $Instance->setAttributes($row);

            if (array_key_exists($Instance->getPkName(), $row)) {
                $Instance->setPK($row[$Instance->getPkName()]);
            }

            if ($massiveAssigned) {
                $Instance->massiveAssigned();
            }
            $data[] = $Instance;
        }

        return $data;
    }

    /**
     * retorna un clone de la instancia sin su llave primaria
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-15
     */
    public function clone()
    {
        $pk = $this->getPK();
        $response = clone $this;
        $this->setPK($pk);
        return $response;
    }

    /**
     * obtiene la etiqueta de un campo
     * en caso de no existir retorna el nombre del campo
     *
     * @param string $field
     * @return void
     */
    public function getFieldLabel($field)
    {
        if (!array_key_exists($field, $this->dbAttributes->labels)) {
            return $field;
        }

        return  $this->dbAttributes->labels[$field]['label'];
    }

    /**
     * obtiene la etiqueta de un valor de campo
     *
     * @param string $field
     * @return void
     */
    public function getValueLabel($field, $value)
    {
        if (!array_key_exists($value, $this->dbAttributes->labels[$field]['values'])) {
            return $value;
        }

        return $this->dbAttributes->labels[$field]['values'][$value];
    }
}
