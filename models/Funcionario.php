<?php
class Funcionario extends Model
{
    const CEROK = 1;
    const RADICADOR_SALIDA = 2;
    const RADICADOR_WEB = 3;

    protected $idfuncionario;
    protected $funcionario_codigo;
    protected $login;
    protected $nombres;
    protected $apellidos;
    protected $firma;
    protected $firma_temporal;
    protected $firma_original;
    protected $estado;
    protected $fecha_ingreso;
    protected $clave;
    protected $nit;
    protected $perfil;
    protected $debe_firmar;
    protected $tipo;
    protected $ultimo_pwd;
    protected $mensajeria;
    protected $email;
    protected $sistema;
    protected $email_contrasena;
    protected $direccion;
    protected $telefono;
    protected $fecha_fin_inactivo;
    protected $intento_login;
    protected $foto_original;
    protected $foto_recorte;
    protected $foto_cordenadas;
    protected $ventanilla_radicacion;
    protected $pertenece_nucleo;
    protected $token;
    protected $dbAttributes;

    /**
     * @param int $id value for idfuncionario attribute
     * @author jhon.valencia@cerok.com
     */
    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'funcionario_codigo',
            'login',
            'nombres',
            'apellidos',
            'firma',
            'firma_temporal',
            'firma_original',
            'estado',
            'fecha_ingreso',
            'clave',
            'nit',
            'perfil',
            'debe_firmar',
            'tipo',
            'ultimo_pwd',
            'mensajeria',
            'email',
            'sistema',
            'email_contrasena',
            'direccion',
            'telefono',
            'fecha_fin_inactivo',
            'intento_login',
            'foto_original',
            'foto_recorte',
            'foto_cordenadas',
            'ventanilla_radicacion',
            'pertenece_nucleo',
            'token'
        ];

        // set the date attributes on the schema
        $dateAttributes = [
            'fecha_ingreso',
            'ultimo_pwd',
            'fecha_fin_inactivo'
        ];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * return the user temporal route
     *
     * @return string
     */
    public function getTemporalRoute()
    {
        return 'temporal/temporal_' . strtolower($this->login);
    }

    /**
     * @return array the basic information from user
     * @author jhon.valencia@cerok.com
     */
    public function getBasicInformation()
    {
        return [
            'iduser' => $this->idfuncionario,
            'name' => $this->getName(),
            'cutedPhoto' => $this->getImage('foto_recorte')
        ];
    }

    /**
     * @return  string the complete name formatted
     * @author jhon.valencia@cerok.com
     */
    public function getName()
    {
        $name = $this->nombres . ' ' . $this->apellidos;
        $name = trim(strtolower(html_entity_decode($name)));
        $name = ucwords($name);
        return $name;
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
     * @return string attribute
     * @author jhon.valencia@cerok.com
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string attribute
     * @author jhon.valencia@cerok.com
     */
    public function getDirection()
    {
        return $this->direccion;
    }

    /**
     * @return string attribute
     * @author jhon.valencia@cerok.com
     */
    public function getPhoneNumber()
    {
        return $this->telefono;
    }

    /**
     * @return string attribute
     * @author jhon.valencia@cerok.com
     */
    public function getPassword()
    {
        return $this->clave;
    }

    /**
     * @return string attribute
     * @author jhon.valencia@cerok.com
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * obtiene una foto del funcionario
     *
     * @param string $image attribute for find ej . foto_recorte foto_original
     * @param boolean $force omit if the temporal image exist
     * @return string url from temporal image
     * @author jhon.valencia@cerok.com
     */
    public function getImage($image, $force = false)
    {
        global $ruta_db_superior;

        if ($this->$image) {
            return TemporalController::createTemporalFile($this->$image, '', $force)->route;
        } else if ($image != 'firma') {
            $avatar = new LasseRafn\InitialAvatarGenerator\InitialAvatar();
            $tempRoute = $ruta_db_superior . $this->getTemporalRoute();

            $name = strtok($this->nombres, " ") . ' ' . strtok($this->apellidos, " ");
            $avatar = $avatar
                ->name($name)
                ->background('#48b0f7')
                ->color('#fff')
                ->generate();

            $fileName = 'avatar.jpg';
            $avatar->save($tempRoute . '/' . $fileName);

            $imageData = array(
                'binary' => file_get_contents($tempRoute . '/' . $fileName),
                'extension' => 'jpg',
            );

            if ($this->updateImage($imageData, $image)) {
                return $this->getImage($image, true);
            }
        }
    }

    /**
     * update a specific image attribute
     *
     * @param array $image ej. [extension => png, binary => binary_to_save]
     * @param string $attribute attribute to update ej. foto_recorte, foto_original
     * @return string the new $attribute value
     * @author jhon.valencia@cerok.com
     */
    public function updateImage($image, $attribute)
    {
        $fileName = "{$attribute}-{$this->nit}.{$image['extension']}";
        $this->$attribute = TemporalController::createFileDbRoute(
            "fotos/{$fileName}",
            "imagenes",
            $image['binary']
        );

        $this->save();
        return $this->$attribute;
    }

    public static function findAllByTerm($term, $field = 'idfuncionario')
    {
        $sql = <<<SQL
            SELECT 
                {$field},idfuncionario,nombres,apellidos
            FROM 
                funcionario
            WHERE
                LOWER(CONCAT(nombres,CONCAT(' ', apellidos))) 
                LIKE '%{$term}%'
SQL;

        return self::findBySql($sql);
    }

    public static function findByDocumentTransfer($documentId)
    {
        $sql = "select origen,destino from buzon_salida where archivo_idarchivo = {$documentId}";
        $records = self::search($sql);

        $users = [];
        foreach ($records as $key => $value) {
            array_push($users, $value['origen'], $value['destino']);
        }

        $users = array_unique($users);
        $list = implode(',', $users);
        $sql = "select * from funcionario where funcionario_codigo in ({$list})";

        return self::findBySql($sql);
    }

    /**
     * retorna una lista de objectos perfil
     *
     * @return array
     */
    public function getProfiles()
    {
        $sql = "select * from perfil where idperfil in ({$this->perfil})";
        return Perfil::findBySql($sql);
    }

    /**
     * verifica si un token es valido
     *
     * @param string $token
     * @param integer $userId
     * @return boolean
     */
    public function isValidToken($token, $userId)
    {
        return Funcionario::countRecords([
            'token' => $token,
            self::getPrimaryLabel() => $userId
        ]);
    }

    public static function excludeCondition()
    {
        $users = [
            self::CEROK,
            self::RADICADOR_SALIDA,
            self::RADICADOR_WEB
        ];

        return " idfuncionario not in(" . implode(',', $users) . ") ";
    }

    public static function checkAdition()
    {
        $exclude = self::excludeCondition();
        $sql = <<<SQL
            select
                count(*) as total 
            from 
                funcionario
            where
                {$exclude}
                AND
                estado = 1
SQL;
        $row = StaticSql::search($sql);
        $total = $row[0]['total'];

        $Configuracion = Configuracion::findByAttributes([
            'nombre' => 'numero_usuarios'
        ]);
        $limit = $Configuracion->getValue();

        return $limit > $total;
    }
}
