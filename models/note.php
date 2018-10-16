<?php
class Note {
    protected $idnota;
    protected $nombre;
    protected $contenido;
    protected $funcionario_idfuncionario;
    protected $fecha;

    public function __construct($idnota = null){
        if($idnota){
            $this->setPK($idnota);
            $this->find();
        }
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
    }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
          $this->$property = $value;
        }
    
        return $this;
    }

    public function getAttributes(){
        return get_object_vars($this);
    }

    public function getAttributeNames(){
        return array_keys($this->getAttributes());
    }

    private function getNotNullAttributes(){
        return array_filter($this->getAttributes());
    }

    public function getPK(){
        return $this->idnota;
    }

    public function setPK($value){
        $this->idnota = $value;
    }

    protected function setDefaultAttributes(){
        $this->funcionario_idfuncionario = $_SESSION['idfuncionario'];
        $this->fecha = date('Y-m-d');
    }

    protected function find(){
        global $conn;

        $columns = implode(',', $this->getAttributeNames());
        $data = busca_filtro_tabla($columns, 'funcionario_notas', 'idnota = ' . $this->getPK(), '', $conn);

        if ($data['numcampos']) {
            foreach ($data[0] as $key => $value) {
                if (is_string($key)) {
                    $this->$key = $value;
                }
            }
        } else {
            throw new Exception("Invalid user", 1);
        }
    }

    public static function findActiveByUser($userId){
        $notes = busca_filtro_tabla('*', 'funcionario_notas', 'estado=1 and funcionario_idfuncionario =' . $userId, '', $conn);
        unset($notes['numcampos'], $notes['sql'], $notes['tabla']);
        
        return $notes;
    }

    public static function deleteByPk($idnota){
        if($idnota){
            $update = 'update funcionario_notas set estado=0 where idnota=' . $idnota;
            return phpmkr_query($update);
        }else{
            return false;
        }            
    }

    public function save(){
        if($this->getPK()){
            return $this->update();
        }else{
            return $this->create();
        }
    }

    private function update(){
        $attributes = $this->getNotNullAttributes();

        if(count($attributes)){

            $sql = "update funcionario_notas set ";
            
            foreach($attributes as $key => $value){
                $sql .= $key . "='" . addslashes($value) ."',";
            }
            
            $sql = substr($sql, 0, strlen($sql)-1);

            $sql .= " where idnota = " . $this->getPK();
            phpmkr_query($sql);

            return $this->getPK();       
        }else{
            return 0;
        }
    }

    public function create(){
        $this->setDefaultAttributes();

        $attributes = $this->getNotNullAttributes();

        $names  = implode(',', array_keys($attributes));
        $values = implode("','", array_values($attributes));

        $sql = "INSERT INTO funcionario_notas (" . $names . ") values ('" . $values . "')";
        phpmkr_query($sql);
        $id = phpmkr_insert_id();
        
        if($id){
            $this->setPK($id);
            return $this->getPK();
        }else{
            throw new Exception('Error al guardar ' . $sql);
        }
    }

}
