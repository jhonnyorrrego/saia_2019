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
    protected $clave;
    protected $dbAttributes;
    
    /**
     * @param int $id value for idfuncionario attribute
     * @author jhon.valencia@cerok.com
     */
    function __construct($id){
        return parent::__construct($id);
    }

    /**
     * define the values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'funcionario_codigo',
            'login',
            'nombres',
            'apellidos',
            'estado',
            'email',
            'foto_original',
            'foto_recorte',
            'email_contrasena',
            'direccion',
            'telefono',
            'clave'
        ];
    
        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * @return array the basic information from user
     * @author jhon.valencia@cerok.com
     */
    public function getBasicInformation()
    {
        return array(
            'iduser' => $this->idfuncionario,
            'name' => $this->getName(),
            'cutedPhoto' => $this->getImage('foto_recorte')
        );
    }

    /**
     * @return  string the complete name formatted
     * @author jhon.valencia@cerok.com
     */
    public function getName()
    {
        $name = trim($this->nombres);
        $lastName = trim($this->apellidos);

        $completeName = ucfirst($name . " " . $lastName);

        return $completeName;
    }

    /**
     * @return string for represent state attribute
     * @author jhon.valencia@cerok.com
     */
    public function getState()
    {
        return $this->estado = 1 ? 'Activo' : 'Inactivo';
    }

    /**
     * @return email attribute
     * @author jhon.valencia@cerok.com
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @return email attribute
     * @author jhon.valencia@cerok.com
     */
    public function getDirection(){
        return $this->direccion;
    }

    /**
     * @return email attribute
     * @author jhon.valencia@cerok.com
     */
    public function getPhoneNumber(){
        return $this->telefono;
    }

    /**
     * @return email attribute
     * @author jhon.valencia@cerok.com
     */
    public function getPassword(){
        return $this->clave;
    }

    /**
     * create a temporal image
     * 
     * @param string $image attribute for find ej . foto_recorte foto_original
     * @param boolean $force omit if the temporal image exist
     * @return string url from temporal image
     * @author jhon.valencia@cerok.com
     */
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

            $name = strtok($this->nombres, " ") . ' ' . strtok($this->apellidos, " ");
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

    /**
     * update a specific image attribute
     * 
     * @param array $image ej. [extention => png, binary => binary_to_save]
     * @param string $attribute attribute to update ej. foto_recorte, foto_original
     * @return the new $attribute value
     * @author jhon.valencia@cerok.com
     */
    public function updateImage($image, $attribute){
        $ruta = RUTA_FOTOGRAFIA_FUNCIONARIO . 'original/' . rand() . 'r.' . $image['extention'];

        $tipo_almacenamiento = new SaiaStorage("imagenes");
        $content = $tipo_almacenamiento->almacenar_contenido($ruta, $image['binary'], false);

        if($content){
            $this->$attribute = json_encode(array(
                "servidor" => $tipo_almacenamiento->get_ruta_servidor(),
                "ruta" => $ruta
            ));
            
            $sql = "UPDATE funcionario SET ".$attribute."='" . $this->$attribute . "' WHERE idfuncionario=" . $this->idfuncionario;
            phpmkr_query($sql);
            
            return $this->$attribute;
        }else{
            return false;
        }
    }
}