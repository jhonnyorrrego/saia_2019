<?php
require_once $ruta_db_superior . 'db.php';
use Stringy\Stringy;

class Model {
    protected $dbAttributes;
    public static $table;
    public static $primary;

    function __construct($id = null) {
        $this->defineAttributes();

        if ($id) {
            $this->setPK($id);
            $this->find();
        }
    }

    /**
     * define the database attributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [],
            'date' => []
        ];
    }

    /**
     * define the label of primary key
     * @return string
     */
    public static function getPrimaryLabel(){
        return self::$primary ? self::$primary : 'id'.self::getTableName();
    }

    /**
     * define the table name
     */
    public static function getTableName(){
        if(self::$table){
            $response = self::$table;
        }else{
            $Stringy = new Stringy(get_called_class());        
            $response = $Stringy->underscored();
        }

        return $response;
    }

    /** 
     * get the safe attributes 
     * @return array
     */
    public function getSafeAttributes(){
        return $this->dbAttributes->safe;
    }

    /** 
     * get the date attributes 
     * @return array
     */
    public function getDateAttributes(){
        return $this->dbAttributes->date;
    }

    /**
     * massive assignment to safe attributes
     * @return boolean 
     *      false if some attribute is not included on safeAttributes
     */
    public function setAttributes($values) {
        $violation = false;

        foreach ($values as $key => $value) {
            if (in_array(strval($key), $this->getSafeAttributes())){
                $this->$key = $value;
            }else{
                $violation = true;
                break;
            }
        }

        return $violation;
    }

    /**
     * get all values from safeAttributes
     * @return array
     */
    public function getAttributes() {
        $data = [];

        foreach ($this->getSafeAttributes() as $value){
            $data[$value] = $this->$value;
        }

        return $data;
    }

    /**
     * get the not null attributes from safeAttributes
     * @return array 
     */
    public function getNotNullAttributes() {
        return array_filter($this->getAttributes(), function($value) {
            return count($value) && $value !== false;
        });
    }

    /**
     * find and set the safeAttributes by pk
     */
    protected function find() {
        global $conn;

        $table = self::getTableName();
        $primary = self::getPrimaryLabel();
        $select = self::createSelect($fields);
        $record = busca_filtro_tabla($select, $table, $primary.'='.$this->getPK(), '', $conn);
        
        if ($record['numcampos']) {
            foreach ($record[0] as $key => $value) {
                if (is_string($key) && property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }else{
            throw new Exception("invalid Pk", 1);
        }
    }

    public static function findByAttributes($conditions, $fields = []){
        $data = self::findAllByAttributes($conditions, $fields, 1);
        return count($data) ? $data[0] : NULL;
    }

    /**
     * Undocumented function
     *
     * @param [type] $conditions
     * @param array $fields
     * @param string $order
     * @param integer $limit
     * @return void
     */
    public static function findAllByAttributes($conditions, $fields = [], $order = '', $limit = 0){
        global $conn;

        $data = [];
        $table = self::getTableName();        
        $select = self::createSelect($fields);
        $condition = self::createCondition($conditions);

        if($limit){
            $records = busca_filtro_tabla_limit($select, $table, $condition, $order, 0, $limit, $conn);
        }else{
            $records = busca_filtro_tabla($select, $table, $condition, $order, $conn);
        }
        
        if ($records['numcampos']) {
            $data = self::convertToObjectCollection($records);
        }
        return $data;
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
        $table = self::getTableName();
        $attributes = $this->getNotNullAttributes();
        $dateAttributes = $this->getDateAttributes();

        $fields = $values = '';
        foreach($attributes as $attribute => $value){
            if(strlen($fields)){
                $fields .= ',';
                $values .= ',';
            }

            $fields .= $attribute;
            if(in_array($attribute, $dateAttributes)){
                $values .= fecha_db_almacenar($value, 'Y-m-d H:i:s');
            }else{
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
    public function update() {
        $attributes = $this->getNotNullAttributes();
        $dateAttributes = $this->getDateAttributes();

        if (count($attributes)) {
            $table = self::getTableName();
            $primary = self::getPrimaryLabel();

            $sql = "update " . $table . " set ";

            foreach($attributes as $attribute => $value){
                if(in_array($attribute, $dateAttributes)){
                    $sql .= $attribute . "=" . fecha_db_almacenar($value, 'Y-m-d H:i:s') . ",";
                }else{
                    $sql .= $attribute . "='" . addslashes($value) . "',";
                }
            }

            $sql = substr($sql, 0, strlen($sql) - 1);
            $sql .= " where " . $primary . " = " . $this->getPK();
            phpmkr_query($sql) or die("Error al actualizar");
            return $this->getPK();
        } else {
            return 0;
        }
    }

    /**
     * return the value from the primary key
     */
    public function getPK() {
        $pk = self::getPrimaryLabel();
        return $this->$pk;
    }

    /**
     * set the value for the primary key
     */
    public function setPK($value) {
        $pk = self::getPrimaryLabel();
        $this->$pk = $value;
    }

    /**
     * crea el selec de una consulta
     * valida los campos tipo fecha
     *
     * @param [type] $fields
     * @return void
     */
    public static function createSelect($fields){
        $Instance = new self;
        $safeAttributes = $Instance->getSafeAttributes();
        $dateAttributes = $Instance->getDateAttributes();
        $select = '';

        $fields = count($fields) ? $fields : $safeAttributes;

        foreach($fields as $attribute){
            if(!in_array($attribute, $safeAttributes)){
                continue;
            }
            
            if(strlen($select)){
                $select .= ',';
            }
            
            if(in_array($attribute, $dateAttributes)){
                $select .= fecha_db_obtener($attribute, 'Y-m-d H:i:s') . ' as ' . $attribute;
            }else{
                $select .= $attribute;
            }
        }
        
        return $select;
    }

    /**
     * crea la condicion de una busqueda
     * valida los campos tipo fecha
     *
     * @param array $conditions
     * @return string
     */
    public static function createCondition($conditions){
        $condition = '';

        if(count($conditions)){
            $Instance = new self;
            $dateAttributes = $Instance->getDateAttributes();
            
            foreach($conditions as $attribute => $value){
                if(strlen($condition)){
                    $condition .= ' and ';
                }
                
                if(in_array($attribute, $dateAttributes)){
                    $condition .= fecha_db_obtener($attribute, 'Y-m-d H:i:s') . "=" . $value;
                }else{
                    $condition .= $attribute . "=" . $value;
                }
            }
        }

        return $condition;
    }

    /**
     * convierte un array simple a un array de objetos
     *
     * @param array:busca_filtro_tabla $records
     * @return array
     */
    public static function convertToObjectCollection($records){
        $class = get_called_class();
        $total = isset($records['numcampos']) ? $records['numcampos'] : count($records);
        $data = [];
        for($row=0; $row < $total; $row++){                
            $Instance = new $class();
            foreach ($records[$row] as $key => $value) {
                if (is_string($key) && property_exists($class , $key)) {
                    $Instance->$key = $value;
                }
            }
            $data[] = $Instance;
        }

        return $data;
    }

    /**
     * crea un registro en la base de datos
     *
     * @param array $attributes atributos a guardar
     * @return int identificador del registro
     */
    public static function newRecord($attributes){
        $className = get_called_class();
        $Instance = new $className();
        $Instance->setAttributes($attributes);
            
        if($Instance->save()){
            $response = $Instance->getPK();
        }else{
            $response = 0;
        }

        return $response;
    }
    
}