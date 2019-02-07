<?php
use Stringy\Stringy;

abstract class GmModel {

    use TEvent;

    protected $dbAttributes;

    /**
     * class initialization
     *
     * @param int $id row identificator
     */
    function __construct() {
        $this->defineAttributes();
    }

    public static function conID($id) {
        $clase = get_called_class();
        $instance = new $clase();
        if ($id) {
            $instance->setPK($id);
            $instance->find();
        }
        return $instance;
    }

    public static function conAtributos(array $atributos ) {
        $clase = get_called_class();
        $instance = new $clase();
        $instance->setAttributes($atributos);
        return $instance;
    }


    /**
     * get attribute value
     *
     * @param string $attribute
     * @return void
     */
    public function __get($attribute) {
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
    public function __set($attribute, $value) {
        $response = property_exists($this, $attribute) && in_array($attribute, $this->getSafeAttributes());

        if ($response) {
            $this->$attribute = $value;
        }

        return $response;
        ;
    }

    public function getTable() {
        if (empty($this->dbAttributes->table)) {
            $Stringy = new Stringy(get_called_class());
            $this->dbAttributes->table = (string) $Stringy->underscored();
        }
        return $this->dbAttributes->table;
    }

    public function getPkName() {
        if (empty($this->dbAttributes->primary)) {
            $Stringy = new Stringy(get_called_class());
            $this->dbAttributes->primary = 'id' . $Stringy->underscored();
        }
        return $this->dbAttributes->primary;
    }

    /**
     * define database attributes
     */
    protected abstract function defineAttributes();

    /**
     * get safe attributes
     *
     * @return array
     */
    public function getSafeAttributes() {
        return $this->dbAttributes->safe;
    }

    /**
     * get date attributes
     *
     * @return array
     */
    public function getDateAttributes() {
        return $this->dbAttributes->date;
    }

    /**
     * massive assignment to safe attributes
     *
     * @return boolean false if some attribute is not included on safeAttributes
     */
    public function setAttributes($attributes) {
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
     *
     * @return array
     */
    public function getAttributes() {
        $data = [];

        foreach ($this->getSafeAttributes() as $value) {
            $data[$value] = $this->$value;
        }

        return $data;
    }

    /**
     * get the not null attributes from safeAttributes
     *
     * @return array
     */
    public function getNotNullAttributes() {
        return array_filter($this->getAttributes(), function ($value) {
            return count($value) && $value !== false;
        });
    }

    /**
     * find and set the safeAttributes by pk
     */
    public final function find() {
        $data = self::findByAttributes([
            $this->getPkName() => $this->getPK()
        ]);

        if ($data) {
            $this->setAttributes($data->getAttributes());
        } else {
            throw new Exception("invalid Pk", 1);
        }
    }

    /**
     * save the data on the table
     */
    public function save() {
        if ($this->getPK()) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    /**
     * insert a new record on the table
     */
    public function create() {
        if ($this->beforeCreate()) {
            if ($this->runCreate()) {
                $this->afterCreate();
            }
        }
        return $this->getPK();
    }

    private function runCreate() {
        $table = self::getTableName();
        $attributes = $this->getNotNullAttributes();
        $dateAttributes = $this->getDateAttributes();

        $fields = $values = '';
        foreach ($attributes as $attribute => $value) {
            if (strlen($fields)) {
                $fields .= ',';
                $values .= ',';
            }

            $fields .= $attribute;
            if (in_array($attribute, $dateAttributes)) {
                $values .= fecha_db_almacenar($value, 'Y-m-d H:i:s');
            } else {
                $values .= "'" . $value . "'";
            }
        }

        $sql = "INSERT INTO " . $table . " (" . $fields . ") values (" . $values . ")";

        if (phpmkr_query($sql)) {
            $this->setPK(phpmkr_insert_id());
            return $this->getPK();
        } else {
            return 0;
        }
    }

    /**
     * modify a record on the table by pk
     */
    public final function update() {
        $response = false;
        if ($this->beforeUpdate()) {
            $response = $this->runUpdate();
            if ($response) {
                $this->afterUpdate();
            }
        }
        return $response;
    }

    private function runUpdate() {
        return self::executeUpdate($this->getNotNullAttributes(), [
            $this->getPkName() => $this->getPK()
        ]);
    }

    public final function delete() {
        if ($this->beforeDelete()) {
            if ($this->runDelete()) {
                $this->afterDelete();
            }
        }
        return !$this->findByAttributes([
            $this->getPkName() => $this->getPK()
        ]);
    }

    private function runDelete() {
        return self::executeDelete([
            $this->getPkName() => $this->getPK()
        ]);
    }

    public function executeDelete($conditions = []) {
        $sql = 'DELETE FROM ' . $this->getTableName() . ' where ' . $this->createCondition($conditions);
        return phpmkr_query($sql);
    }

    /**
     * get primary key value
     */
    public function getPK() {
        $pk = $this->getPkName();
        return $this->$pk;
    }

    /**
     * set primary key value
     *
     * @param int $value
     * @return void
     */
    public function setPK($value) {
        $pk = $this->getPkName();
        $this->$pk = $value;
    }

    /**
     * get date attribute with specific format
     *
     * @param string $attribute
     *            attribute to convert
     * @param string $format
     *            required format
     * @return string
     */
    public function getDateAttribute($attribute, $format = 'd/m/Y H:i a') {
        return DateController::convertDate($this->$attribute, 'Y-m-d H:i:s', $format);
    }

    /**
     * define primary key label
     *
     * @return string
     */
    public function getPrimaryLabel() {
        return $this->getPkName();
    }

    /**
     * define table name
     */
    public function getTableName() {
        return $this->getTable();
    }

    /**
     * find a record filtered by $conditions
     *
     * @param array $conditions
     * @param array $fields
     * @return void
     */
    public function findByAttributes($conditions, $fields = []) {
        $data = $this->findAllByAttributes($conditions, $fields, '', 1);
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
    public function findAllByAttributes($conditions, $fields = [], $order = '', $limit = 0) {
        global $conn;

        $table = $this->getTableName();
        $select = $this->createSelect($fields);
        $condition = $this->createCondition($conditions);

        if ($limit) {
            $records = busca_filtro_tabla_limit($select, $table, $condition, $order, 0, $limit, $conn);
        } else {
            $records = busca_filtro_tabla($select, $table, $condition, $order, $conn);
        }

        if ($records['numcampos']) {
            $response = $this->convertToObjectCollection($records);
        } else {
            $response = null;
        }

        return $response;
    }

    /**
     * create select portion for sql query
     * check date attributes
     *
     * @param array $fields
     * @return void
     */
    public function createSelect($fields) {
        $safeAttributes = $this->getSafeAttributes();
        $dateAttributes = $this->getDateAttributes();
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
                $select .= fecha_db_obtener($attribute, 'Y-m-d H:i:s') . ' as ' . $attribute;
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
    public function createCondition($conditions) {
        $condition = '';

        if (count($conditions)) {
            $dateAttributes = $this->getDateAttributes();

            foreach ($conditions as $attribute => $value) {
                if (strlen($condition)) {
                    $condition .= ' and ';
                }

                if (in_array($attribute, $dateAttributes)) {
                    $condition .= fecha_db_obtener($attribute, 'Y-m-d H:i:s') . "=" . $value;
                } else {
                    $condition .= $attribute . "='" . $value . "'";
                }
            }
        }

        return $condition;
    }

    /**
     * convert simple array to array of objects
     *
     * @param array $records
     * @return array
     */
    public function convertToObjectCollection($records) {
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
    public function newRecord($attributes) {
        $this->setAttributes($attributes);

        if ($this->create()) {
            $response = $this->getPK();
        } else {
            $response = 0;
        }

        return $response;
    }

    /**
     * execute a update sentence
     *
     * @param array $fields
     *            new attributes
     * @param array $conditions
     * @return void
     */
    public function executeUpdate($fields, $conditions) {
        $set = '';

        $dateAttributes = $this->getDateAttributes();

        foreach ($fields as $attribute => $value) {
            if (strlen($set)) {
                $set .= ',';
            }

            if (in_array($attribute, $dateAttributes)) {
                $set .= $attribute . "=" . fecha_db_almacenar($value, 'Y-m-d H:i:s');
            } else {
                $set .= $attribute . "='" . $value . "'";
            }
        }

        $sql = 'UPDATE ' . self::getTableName() . ' set ' . $set . ' where ' . self::createCondition($conditions);
        return phpmkr_query($sql);
    }

}
