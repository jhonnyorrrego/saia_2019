<?php
require_once $ruta_db_superior . 'db.php';
require_once $ruta_db_superior . 'models/model.php';
require_once $ruta_db_superior . 'vendor/autoload.php';
require_once $ruta_db_superior . 'StorageUtils.php';
require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

class Funcionario extends Model {
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
    protected $table = 'funcionario';
    protected $primary = 'idfuncionario';

    function __construct($id){
        return parent::__construct($id);
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

    public function getImage($image, $force = false)
    {
        global $ruta_db_superior;

        $tempRoute = $ruta_db_superior . 'temporal/temporal_' . $this->login;
        $Storage = new SaiaStorage("archivos");
        $Image = json_decode($this->$image);

        if (is_object($Image)) {
            if ($Storage->get_filesystem()->has($Image->ruta)) {
                $binary = StorageUtils::get_binary_file($this->$image);

                if (!is_dir($tempRoute)) {
                    mkdir($tempRoute, 0777);
                }

                $route = explode('/', $Image->ruta);
                $fileName = $route[count($route) - 1];
                $finalRoute = $tempRoute . '/' . $fileName;
                
                if(!is_file($finalRoute) || $force){
                    $file = fopen($finalRoute, 'w+');
                    
                    if ($file) {
                        $content = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $binary));
                        fwrite($file, $content);
                        fclose($file);
                    }
                }

                return 'temporal/temporal_' . $this->login . '/' . $fileName;
            }
        }else{
            $avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();

            $name = strtok($this->nombres, " ") . ' ' . $this->apellidos;
            $avatar = $avatar
                ->name($name)
                ->background('#48b0f7')
                ->color('#fff')
                ->generate();
            
            if (!is_dir($tempRoute)) {
                mkdir($tempRoute, 0777);
            }
            
            $fileName = 'avatar.jpg';
            $avatar->save($tempRoute . '/' . $fileName);

            $imageData = array(
                'binary' => file_get_contents($tempRoute . '/' . $fileName),
                'extention' => 'jpg',
            );

            if($this->updateImage($imageData, $image))
                return $this->getImage($image, true);
        }
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