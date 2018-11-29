<?php
require_once $ruta_db_superior . 'db.php';

class Model {
    protected $table;
    protected $primary;

    function __construct($id = null){
        if($id){
            $this->setPK($id);
            $this->find();
        }
    }

    public function setAttributes($values){
        $attributes = $this->getAttributeNames();

        foreach ($values as $key => $value){
            if(in_array(strval($key), $attributes))
                $this->$key = $value;
        }
    }

    public function getAttributes(){
        $attributes = get_object_vars($this);
        unset($attributes['table'], $attributes['primary']);

        return $attributes;
    }

    public function getNotNullAttributes(){
        return array_filter($this->getAttributes(), function($value){
            return count($value) && $value !== false;
        });
    }

    public function getAttributeNames(){
        return array_keys($this->getAttributes());
    }

    public function getAttributeValues(){
        return array_values ($this->getAttributes());
    }

    protected function find(){
        global $conn;

        $columns = implode(',', $this->getAttributeNames());
        $data = busca_filtro_tabla($columns, $this->table, $this->primary . ' = ' . $this->getPK(), '', $conn);

        if ($data['numcampos']) {
            foreach ($data[0] as $key => $value) {
                if (is_string($key)) {
                    $this->$key = $value;
                }
            }
        } else {
            throw new Exception("Invalid pk", 1);
        }
    }

    public function save(){
        if($this->getPK()){
            return $this->update();
        }else{
            return $this->create();
        }
    }

    public function create(){
        $attributes = $this->getNotNullAttributes();

        $names  = implode(',', array_keys($attributes));
        $values = implode("','", array_values($attributes));

        $sql = "INSERT INTO " . $this->table . " (" . $names . ") values ('" . $values . "')";

        if(phpmkr_query($sql)){
            $this->setPK(phpmkr_insert_id());
            
            return $this->getPK();
        }else{
            return 0;
        }
    }

    public function update(){
        $attributes = $this->getNotNullAttributes();

        if(count($attributes)){

            $sql = "update " . $this->table . " set ";
            
            foreach($attributes as $key => $value){
                $sql .= $key . "='" . addslashes($value) ."',";
            }
            
            $sql = substr($sql, 0, strlen($sql)-1);

            $sql .= " where " . $this->primary . " = " . $this->getPK();
            phpmkr_query($sql);

            return $this->getPK();       
        }else{
            return 0;
        }
    }

    public function getPK(){
        $pk = $this->primary;
        return $this->$pk;
    }

    public function setPK($value){
        $pk = $this->primary;
        $this->$pk = $value;
    }
}