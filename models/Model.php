<?php
use Stringy\Stringy;

class Model {
    protected $dbAttributes;
    public static $table;
    public static $primary;

    /**
     * class initialization
     *
     * @param int $id row identificator
     */
    function __construct($id = null) {
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
    public function __get($attribute) {
        if (property_exists($this, $attribute) && 
            in_array($attribute, $this->getSafeAttributes())) {
            $response = $this->$attribute;
        }else{
            $response = NULL;
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
        $response = property_exists($this, $attribute) && 
            in_array($attribute, $this->getSafeAttributes());

        if ($response) {
            $this->$attribute = $value;
        }

        return $response;;
    }

    /**
     * define database attributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [],
            'date' => []
        ];
    }

    /** 
     * get safe attributes 
     * @return array
     */
    public function getSafeAttributes(){
        return $this->dbAttributes->safe;
    }

    /** 
     * get date attributes 
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
    public function setAttributes($attributes) {
        $diff = array_diff(array_keys($attributes), $this->getSafeAttributes());

        if(!count($diff)){
            foreach ($attributes as $key => $value) {
                $this->$key = $value;
            }
        }else{
            $error = true;
        }

        return isset($error) ? false : true;
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
    public function find() {
        $data = self::findByAttributes([
            self::getPrimaryLabel() => $this->getPK()
        ]);

        if ($data) {
            $this->setAttributes($data->getAttributes());
        }else{
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
        return self::executeUpdate($this->getNotNullAttributes(),[
            self::getPrimaryLabel() => $this->getPK()
        ]);
    }

    /**
     * get primary key value
     */
    public function getPK() {
        $pk = self::getPrimaryLabel();
        return $this->$pk;
    }

    /**
     * set primary key value
     *
     * @param int $value
     * @return void
     */
    public function setPK($value) {
        $pk = self::getPrimaryLabel();
        $this->$pk = $value;
    }

    /**
     * get date attribute with specific format
     *
     * @param string $attribute attribute to convert
     * @param string $format required format
     * @return string 
     */
    public function getDateAttribute($attribute, $format = 'd/m/Y H:i a'){
        return DateController::convertDate($this->$attribute, 'Y-m-d H:i:s', $format);
    }

     /**
     * define primary key label
     * @return string
     */
    public static function getPrimaryLabel(){
        return self::$primary ? self::$primary : 'id'.self::getTableName();
    }

    /**
     * define table name
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
     * find a record filtered by $conditions
     *
     * @param array $conditions
     * @param array $fields
     * @return void
     */
    public static function findByAttributes($conditions, $fields = []){
        $data = self::findAllByAttributes($conditions, $fields, '', 1);
        return $data ? $data[0] : NULL;
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
    public static function findAllByAttributes($conditions, $fields = [], $order = '', $limit = 0){
        global $conn;

        $table = self::getTableName();        
        $select = self::createSelect($fields);
        $condition = self::createCondition($conditions);

        if($limit){
            $records = busca_filtro_tabla_limit($select, $table, $condition, $order, 0, $limit, $conn);
        }else{
            $records = busca_filtro_tabla($select, $table, $condition, $order, $conn);
        }
        
        if ($records['numcampos']) {
            $response = self::convertToObjectCollection($records);
        }else{
            $response = NULL;
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
     * create where portion for sql query
     * check date attributes
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
     * create a new record on table
     *
     * @param array $attributes
     * @return int new primary key 
     */
    public static function newRecord($attributes){
        $className = get_called_class();
        $Instance = new $className();
        $Instance->setAttributes($attributes);
            
        if($Instance->create()){
            $response = $Instance->getPK();
        }else{
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
    public static function executeUpdate($fields, $conditions){        
        $set = '';

        foreach($fields as $attribute => $value){
            if(strlen($set)){
                $set .= ',';
            }
            
            if(in_array($attribute, $dateAttributes)){
                $set .= $attribute . "=" . fecha_db_almacenar($value, 'Y-m-d H:i:s');
            }else{
                $set .= $attribute . "='" . $value . "'";
            }
        }
        
        $sql = 'UPDATE ' . self::getTableName() . ' set ' . $set . ' where ' . self::createCondition($conditions);
        return phpmkr_query($sql);
    }
}