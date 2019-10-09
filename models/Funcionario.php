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
        $this->dbAttributes = (object) [
            'safe' => [
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
            ],
            'date' => [
                'fecha_ingreso',
                'ultimo_pwd',
                'fecha_fin_inactivo'
            ],
            'labels' => [
                'estado' => [
                    'label' => 'Estado',
                    'values' => [
                        0 => 'Inactivo',
                        1 => 'Activo'
                    ]
                ]
            ]
        ];
    }

    /**
     * evento posterior al crear
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-28
     */
    public function afterCreate()
    {
        return $this->updateCode() && $this->sendCreatedMail();
    }

    /**
     * actualiza el id y el funcionario_codigo
     * con el valor del nit
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-28
     */
    public function updateCode()
    {
        Funcionario::executeUpdate([
            'idfuncionario' => $this->nit,
            'funcionario_codigo' => $this->nit
        ], [
            'idfuncionario' => $this->getPK()
        ]);

        return $this->setPK($this->nit);
    }
    /**
     * envia el mensaje de creacion del usuario
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-28
     */
    public function sendCreatedMail()
    {
        if (!$this->email) {
            return;
        }

        $description = <<<TEXT
        Listo para empezar?<br>
        Tu nombre de usuario es: <b>{$this->login}</b><br>
        <br>
        Ingresa al siguiente enlace crea tu clave de acceso.<br>
        {$this->getRecoveryPasswordRoute()}<br>
        <br>
        Que tengas un excelente dia!<br>
        Atentamente, <br>
        Equipo de atención al cliente de SAIA<br>
        soporte@cerok.com
TEXT;
        $SendMailController = new SendMailController('Bienvenido a SAIA!', $description);
        $SendMailController->setDestinations(
            SendMailController::DESTINATION_TYPE_EMAIL,
            [$this->email]
        );

        return $SendMailController->send();
    }

    /**
     * retorna una lista de objectos perfil
     *
     * @return array
     */
    public function getProfiles()
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select("*")
            ->from("perfil")
            ->where("idperfil in ({$this->perfil})");
        return Perfil::findByQueryBuilder($QueryBuilder);
    }

    /**
     * genera una ruta para reestablecer la contrasena
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-28
     */
    public function getRecoveryPasswordRoute()
    {
        $token = CriptoController::encrypt_blowfish($this->getPK());

        $this->token = $token;
        $this->save();

        return PROTOCOLO_CONEXION . RUTA_PDF . "/views/funcionario/reestablecer_clave.php?token=" . $token;
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
            'cutedPhoto' => $this->getImage('foto_recorte'),
            'login' => $this->login
        ];
    }

    /**
     * obtiene el nombre del funcionario
     * con un formato predefinido
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getName()
    {
        $name = $this->nombres . ' ' . $this->apellidos;
        $name = trim(strtolower(html_entity_decode($name)));
        $name = ucwords($name);
        return $name;
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

            if (!is_dir($tempRoute)) {
                mkdir($tempRoute, PERMISOS_CARPETAS, TRUE);
            }

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
        $fileName = "{$attribute}-{$this->getPK()}.{$image['extension']}";
        $this->$attribute = TemporalController::createFileDbRoute(
            "fotos/{$fileName}",
            "imagenes",
            $image['binary']
        );

        $this->save();
        return $this->$attribute;
    }

    /**
     * buscador para autocompletar por
     * nombre y apellido
     *
     * @param string $term palabra a buscar
     * @param string $field columna a retornar como llave
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function findAllByTerm($term, $field = 'idfuncionario')
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select([$field, 'idfuncionario', 'nombres', 'apellidos'])
            ->from('funcionario')
            ->where("
                LOWER(
                    CONCAT(
                        nombres,
                        CONCAT(
                            ' ',
                            apellidos
                        )
                    )
                ) like :like
            ")
            ->setParameter(':like', "%{$term}%")
            ->setFirstResult(0)
            ->setMaxResults(20);

        return self::findByQueryBuilder($QueryBuilder);
    }

    /**
     * busca los funcionario que estan presentes
     * en las transacciones de un documento
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function findByDocumentTransfer($documentId)
    {
        $records = BuzonSalida::findAllByAttributes([
            'archivo_idarchivo' => $documentId
        ]);

        $users = [];
        foreach ($records as $key => $BuzonSalida) {
            array_push($users, $BuzonSalida->origen, $BuzonSalida->destino);
        }

        $users = array_unique($users);
        $QueryBuilder = self::getQueryBuilder()
            ->select('*')
            ->from('funcionario')
            ->where('funcionario_codigo in (:userList)')
            ->setParameter(':userList', $users, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);

        return self::findByQueryBuilder($QueryBuilder);
    }

    /**
     * genere la condicion para excluir los funcionarios
     * de nucleo en un sql
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function excludeCondition()
    {
        $users = [
            self::CEROK,
            self::RADICADOR_SALIDA,
            self::RADICADOR_WEB
        ];

        return " idfuncionario not in(" . implode(',', $users) . ") ";
    }

    /**
     * verifica si no se ha excedido el limite de usuarios
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function checkAdition()
    {
        $total = self::getQueryBuilder()
            ->select('count(*) as total')
            ->from('funcionario')
            ->where(self::excludeCondition())
            ->andWhere('estado = 1')
            ->execute()->fetch();

        $Configuracion = Configuracion::findByAttributes([
            'nombre' => 'numero_usuarios'
        ]);

        $limit = $Configuracion->getValue();

        return $limit > $total['total'];
    }
}
