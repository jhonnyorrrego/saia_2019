<?php
use Stringy\Stringy;

abstract class Model extends StaticSql
{
    use TModelEvents;

    protected $dbAttributes;

    /**
     * class initialization
     *
     * @param int $id row identificator
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
     * get attribute value
     *
     * @param string $attribute
     * @return void
     */
    public function __get($attribute)
    {
        if (property_exists($this, $attribute) && in_array($attribute, $this->getSafeAttributes())) {
            $response = $this->$attribute;
        } else {
            $response = null;
        }

        return $response;
    }

    /**
     * set attribute value
     *
     * @param string $attribute
     * @param void $value
     * @return boolean
     */
    public function __set($attribute, $value)
    {
        $response = property_exists($this, $attribute) && in_array($attribute, $this->getSafeAttributes());

        if ($response) {
            $this->$attribute = $value;
        }

        return $response;;
    }

    public function getTable()
    {
        if (empty($this->dbAttributes->table)) {
            $Stringy = new Stringy(get_called_class());
            $this->dbAttributes->table = (string)$Stringy->underscored();
        }
        return $this->dbAttributes->table;
    }

    public function getPkName()
    {
        if (empty($this->dbAttributes->primary)) {
            $this->dbAttributes->primary = 'id' . $this->getTable();
        }
        return $this->dbAttributes->primary;
    }

    /**
     * define database attributes
     */
    protected abstract function defineAttributes();

    /**
     * get safe attributes
     * @return array
     */
    public function getSafeAttributes()
    {
        return $this->dbAttributes->safe;
    }

    /**
     * get date attributes
     * @return array
     */
    public function getDateAttributes()
    {
        return $this->dbAttributes->date;
    }

    /**
     * massive assignment to safe attributes
     * @return boolean
     *      false if some attribute is not included on safeAttributes
     */
    public function setAttributes($attributes)
    {
        if (count($attributes)) {
            $seguros = $this->getSafeAttributes();
            foreach ($attributes as $key => $value) {
                if (in_array($key, $seguros)) {
                    $this->$key = $value;
                }
            }
        } else {
            $error = true;
        }

        return isset($error) ? false : true;
    }

    /**
     * get all values from safeAttributes
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
     * get the not null attributes from safeAttributes
     * @return array
     */
    public function getNotNullAttributes()
    {
        return array_filter($this->getAttributes(), function ($value) {
            return count($value) && $value !== false;
        });
    }

    /**
     * find and set the safeAttributes by pk
     */
    public final function find()
    {
        $data = self::findByAttributes([$this->getPkName() => $this->getPK()]);

        if ($data) {
            $this->setAttributes($data->getAttributes());
        } else {
            throw new Exception("invalid Pk", 1);
        }
    }

    /**
     * save the data on the table
     */
    public function save()
    {
        if ($this->getPK()) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    /**
     * insert a new record on the table
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

        $sql = "INSERT INTO " . $table . " (" . $fields . ") values (" . $values . ")";
        $this->setPK(self::insert($sql));

        return $this->getPK() ?? 0;
    }

    /**
     * modify a record
     *
     * @param boolean $force omitir valores null
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

    private function runUpdate($force)
    {
        $attributes = $force ? $this->getAttributes() : $this->getNotNullAttributes();
        return self::executeUpdate($attributes, [$this->getPkName() => $this->getPK()]);
    }

    public final function delete()
    {
        if ($this->beforeDelete()) {
            if ($this->runDelete()) {
                $this->afterDelete();
            }
        }
        return !self::findByAttributes([$this->getPkName() => $this->getPK()]);
    }

    private function runDelete()
    {
        return self::executeDelete([$this->getPkName() => $this->getPK()]);
    }

    public static function executeDelete($conditions = [])
    {
        $sql = 'DELETE FROM ' . self::getTableName() . ' WHERE ' . self::createCondition($conditions);
        return self::query($sql);
    }

    /**
     * get primary key value
     */
    public function getPK()
    {
        $pk = $this->getPkName();
        return $this->$pk;
    }

    /**
     * set primary key value
     *
     * @param int $value
     * @return void
     */
    public function setPK($value)
    {
        $pk = $this->getPkName();
        $this->$pk = $value;
    }

    /**
     * get date attribute with specific format
     *
     * @param string $attribute attribute to convert
     * @param string $format required format
     * @return string
     */
    public function getDateAttribute($attribute, $format = 'd/m/Y H:i a')
    {
        return DateController::convertDate($this->$attribute, 'Y-m-d H:i:s', $format);
    }

    /**
     * define primary key label
     * @return string
     */
    public static function getPrimaryLabel()
    {
        $caller = get_called_class();
        $instance = new $caller();
        return $instance->getPkName();
    }

    /**
     * define table name
     */
    public static function getTableName()
    {
        $caller = get_called_class();
        $instance = new $caller();
        return $instance->getTable();
    }

    /**
     * find a record filtered by $conditions
     *
     * @param array $conditions
     * @param array $fields
     * @return void
     */
    public static function findByAttributes($conditions, $fields = [])
    {
        $data = self::findAllByAttributes($conditions, $fields, '', 0, 1);
        return $data ? $data[0] : null;
    }

    /**
     * find all records filtered by $conditions
     *
     * @param array $conditions
     * @param array $fields
     * @param string $order
     * @param integer $limit
     * @return void
     */
    public static function findAllByAttributes($conditions, $fields = [], $order = '', $offset = 0, $limit = 0)
    {
        $sql = self::generateSelectSql($conditions, $fields, $order);
        $records = self::search($sql, $offset, $limit);
        return self::convertToObjectCollection($records);
    }

    /**
     * busca una columna especifica
     *
     * @param string $field nombre de la columna
     * @param array $conditions
     * @param string $order
     * @return void
     */
    public static function findColumn($field, $conditions = [], $order = '')
    {
        $sql = self::generateSelectSql($conditions, [$field], $order);
        $records = self::search($sql);

        $data = [];
        foreach ($records as $key => $value) {
            $data[] = $value[0];
        }
        return $data;
    }

    /**
     * consulta la cantidad de registros
     * que cumplen con una condicion
     *
     * @param array $conditions
     * @return int
     */
    public static function countRecords($conditions = [])
    {
        $condition = self::createCondition($conditions);
        $sql = 'select count(*) as total from ' . self::getTableName() . ' where ' . $condition;
        $record = self::search($sql);

        return $record[0]['total'];
    }

    /**
     * convert simple array to array of objects
     *
     * @param array $records
     * @return array
     */
    public static function convertToObjectCollection($records)
    {
        $class = get_called_class();
        $total = isset($records['numcampos']) ? $records['numcampos'] : count($records);

        $data = [];
        for ($row = 0; $row < $total; $row++) {
            $Instance = new $class();
            foreach ($records[$row] as $key => $value) {
                if (is_string($key) && property_exists($class, $key)) {
                    $Instance->$key = $value;
                }
            }
            if (method_exists($Instance, 'massiveAssigned')) {
                $Instance->massiveAssigned();
            }
            $data[] = $Instance;
        }

        return $data;
    }

    /**
     * create a new record on table
     *
     * @param array $attributes
     * @return int new primary key
     */
    public static function newRecord($attributes)
    {
        $className = get_called_class();
        $Instance = new $className();
        $Instance->setAttributes($attributes);

        if ($Instance->create()) {
            $response = $Instance->getPK();
        } else {
            $response = 0;
        }

        return $response;
    }

    /**
     * execute a update sentence
     *
     * @param array $fields new attributes
     * @param array $conditions
     * @return void
     */
    public static function executeUpdate($fields, $conditions)
    {
        $set = '';
        $className = get_called_class();
        $Instance = new $className();

        $dateAttributes = $Instance->getDateAttributes();
        foreach ($fields as $attribute => $value) {
            if (strlen($set)) {
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

        $sql = 'UPDATE ' . self::getTableName() . ' SET ' . $set . ' WHERE ' . self::createCondition($conditions);
        return self::query($sql);
    }

    /**
     * create select portion for sql query
     * check date attributes
     *
     * @param array $fields
     * @return void
     */
    public static function createSelect($fields)
    {
        $className = get_called_class();
        $Instance = new $className();

        $safeAttributes = $Instance->getSafeAttributes();
        $dateAttributes = $Instance->getDateAttributes();
        $safeAttributes[] = $Instance->getPkName();
        $select = '';

        $fields = count($fields) ? $fields : $safeAttributes;

        foreach ($fields as $attribute) {
            if (!in_array($attribute, $safeAttributes)) {
                continue;
            }

            if (strlen($select)) {
                $select .= ',';
            }

            if (in_array($attribute, $dateAttributes)) {
                $select .= self::getDateFormat($attribute, 'Y-m-d H:i:s') . ' as ' . $attribute;
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

        if (count($conditions)) {
            $className = get_called_class();
            $Instance = new $className();
            $dateAttributes = $Instance->getDateAttributes();

            foreach ($conditions as $attribute => $value) {
                if (strlen($condition)) {
                    $condition .= ' and ';
                }

                if (in_array($attribute, $dateAttributes)) {
                    $condition .= self::getDateFormat($attribute, 'Y-m-d H:i:s') . "=" . $value;
                } else {
                    $condition .= $attribute . "='" . $value . "'";
                }
            }
        }

        return $condition;
    }

    public static function generateSelectSql($conditions, $fields, $order)
    {
        $condition = self::createCondition($conditions);

        $sql = "Select ";
        $sql .= self::createSelect($fields) ?? "*";
        $sql .= " FROM " . self::getTableName();
        $sql .= $condition ? " WHERE {$condition} " : ' ';
        $sql .= $order ? "ORDER BY {$order} " : '';

        return $sql;
    }

    /**
     * retorna la instancia de la relacion dada
     *
     * @param string $instance : Nombre de la instancia
     * @param string $fieldName : Nombre del campo
     * @return array|null
     * @author Andre.Agudelo <andres.agudelo@cerok.com>
     */
    public function getRelationFk(string $instance = null, string $fieldName = null)
    {
        if ($instance) {
            $fieldName = $fieldName ?? 'fk_' . $instance::getTableName();
            $response = new $instance($this->$fieldName);
        }
        return $response ?? null;
    }

    public static function findBySql($sql, $getInstance = true)
    {
        $data = self::search($sql);
        if ($getInstance) {
            $className = get_called_class();
            $data = $className::convertToObjectCollection($data);
        }
        return $data;
    }
}
