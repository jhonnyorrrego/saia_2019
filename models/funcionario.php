<?php
require_once $ruta_db_superior . 'db.php';
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

class Funcionario
{
    protected $idfuncionario;
    protected $funcionario_codigo;
    protected $login;
    protected $nombres;
    protected $apellidos;
    protected $estado;
    protected $email;
    protected $foto_original;
    protected $foto_recorte;
    protected $email_contrasena;
    protected $direccion;
    protected $telefono;

    public function __construct($idfuncionario = null)
    {
        if ($idfuncionario) {
            $this->idfuncionario = $idfuncionario;
            $this->find();
        }
    }

    public function getAttributeNames()
    {
        return array_keys(get_class_vars(__CLASS__));
    }

    public function getAttributes(){
        return get_object_vars($this);
    }

    public function setAttributes($attributes){
        foreach ($attributes as $name => $value) {
            if(property_exists(__CLASS__, $name)){
                $this->$name = $value;
            }
        }

        return true;
    }

    private function getNotNullAttributes(){
        return array_filter($this->getAttributes());
    }

    public function getPK(){
        return $this->idfuncionario;
    }

    public function setPK($value){
        $this->idfuncionario = $value;
    }

    protected function find()
    {
        global $conn;

        $columns = implode(',', $this->getAttributeNames());
        $data = busca_filtro_tabla($columns, 'funcionario', 'idfuncionario = ' . $this->idfuncionario, '', $conn);

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

    public function update(){
        $attributes = $this->getNotNullAttributes();

        if(count($attributes)){

            $sql = "update funcionario set ";
            
            foreach($attributes as $key => $value){
                $sql .= $key . "='" . addslashes($value) ."',";
            }
            
            $sql = substr($sql, 0, strlen($sql)-1);

            $sql .= " where idfuncionario = " . $this->getPK();
            phpmkr_query($sql);

            return $this->getPK();       
        }else{
            return 0;
        }
    }

    public function getBasicInformation()
    {
        $data = array(
            'iduser' => $this->idfuncionario,
            'name' => $this->getName(),
            'state' => $this->getState(),
            'foto_original' => $this->getImage('foto_original'),
            'foto_recorte' => $this->getImage('foto_recorte')
        );

        return $data;
    }

    public function getName()
    {
        $name = trim($this->nombres);
        $lastName = trim($this->apellidos);

        $completeName = ucfirst($name . " " . $lastName);

        return $completeName;
    }

    public function getState()
    {
        return $this->estado = 1 ? 'Activo' : 'Inactivo';
    }

    public function getImage($image)
    {
        global $ruta_db_superior; 
        
        $finalRoute = '';
        $Storage = new SaiaStorage("archivos");
        $Image = json_decode($this->$image);

        if (is_object($Image)) {
            if ($Storage->get_filesystem()->has($Image->ruta)) {
                $binary = StorageUtils::get_binary_file($this->$image);

                if (!is_dir($ruta_db_superior . 'temporal/temporal_' . $this->login)) {
                    mkdir($ruta_db_superior . 'temporal/temporal_' . $this->login, 0777);
                }

                $route = explode('/', $Image->ruta);
                $fileName = $route[count($route) - 1];
                $finalRoute = $ruta_db_superior . 'temporal/temporal_' . $this->login . '/' . $fileName;

                $file = fopen($finalRoute, 'w+');

                if ($file) {
                    $content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $binary));
                    fwrite($file, $content);
                    fclose($file);
                }
            }
        }

        return 'temporal/temporal_' . $this->login . '/' . $fileName;
    }

    public function updateImage($image, $campo){
        $ruta = RUTA_FOTOGRAFIA_FUNCIONARIO . 'original/' . rand() . 'r.' . $image['extention'];

        $tipo_almacenamiento = new SaiaStorage("imagenes");
        $content = $tipo_almacenamiento->almacenar_contenido($ruta, $image['binary'], false);

        if($content){
            $this->$campo = json_encode(array(
                "servidor" => $tipo_almacenamiento->get_ruta_servidor(),
                "ruta" => $ruta
            ));
            
            $sql = "UPDATE funcionario SET ".$campo."='" . $this->$campo . "' WHERE idfuncionario=" . $this->idfuncionario;
            phpmkr_query($sql);
            
            return $this->$campo;
        }else{
            return false;
        }
    }
}