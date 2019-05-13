<?php

class SessionController
{
    /**
     * tiempo de vida de la sesion
     */
    const TIME_LIFE = 86400; //1 DIA
    
    private static $data;
    private $admin = Funcionario::CEROK;

    /**
     * crea los datos de la sesion
     *
     * @param object $Funcionario instancia del funcionario
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    function __construct($Funcionario = null)
    {
        if ($Funcionario) {
            $this->setSessionData($Funcionario);
        } else {
            self::$data = $_SESSION;
        }

        $this->checkRootAccess();
    }

    /**
     * guarda los valores de la sesion
     *
     * @param object $Funcionario instancia del funcionario
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-05
     */
    public function setSessionData($Funcionario)
    {
        self::$data = [
            "usuario_actual" => $Funcionario->funcionario_codigo,
            "idfuncionario" => $Funcionario->getPK(),
            "ruta_temp_funcionario" => $Funcionario->getTemporalRoute(),
            "LOGIN" . LLAVE_SAIA => $Funcionario->login,
            "web_service" => $Funcionario->getPK() == Funcionario::RADICADOR_WEB
        ];

        $_SESSION = self::$data;
    }

    /**
     * define si el usuario de la sesion tiene
     * acceso root
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function checkRootAccess()
    {
        if (self::$data) {
            return self::$data && self::$data["idfuncionario"] == $this->admin;
        } else {
            throw new Exception("invalid session", 1);
        }
    }

    /**
     * retorna el valor solicitado de la sesion
     *
     * @param string $value
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function getValue($value)
    {
        if (!self::$data) {
            new self;
            if (!self::$data) {
                throw new Exception("invalid session key", 1);
            }
        }

        return self::$data[$value];
    }

    /**
     * setea el valor indicado en la sesion
     *
     * @param string $key nombre del valor a guardar
     * @param string $value valor a guardar
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function setValue($key, $value)
    {
        return self::$data[$key] = $_SESSION[$key] = $value;
    }

    /**
     * valida si el usuario logueado
     * tiene acceso root
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function isRoot()
    {
        $self = new self;
        return $self->checkRootAccess();
    }

    /**
     * retorna el login del usuario logueado
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function getLogin()
    {
        return self::getValue('LOGIN' . LLAVE_SAIA);
    }

    /**
     * retorna la carpeta temporal en caso de tenenr sesion
     * de otro modo retorna la ruta temporal para saia
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-12
     */
    public static function getTemporalDir(){
        return self::hasActiveSession() ?
            self::getValue('ruta_temp_funcionario') :
            TemporalController::$saiaDir;
    }

    /**
     * retorna el id de la sesion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function getId()
    {
        return session_id();
    }

    /**
     * verifica si tiene una sesion activa
     *
     * @return integer idfuncionario de la sesion
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-12
     */
    public static function hasActiveSession(){
        if($_SESSION){
            self::$data = $_SESSION;
        }

        return self::$data['idfuncionario'] ?? 0;
    }

    /**
     * cierra la sesion en el sistema
     *
     * @param string $message mensaje a mostrar 
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-12
     */
    public static function logout($message = '')
    {
        FuncionarioController::saveLogout();
        if (isset($_COOKIE['PHPSESSID'])) {
            setcookie('PHPSESSID', '', time() - 3600, '/');
        }
        session_unset();
        session_destroy();
        self::$data = [];

        echo "<script language='javascript' data-reference='logout'>
            let message = '" . $message . "';

            if(message) {
                top.notification({
                    type: 'info',
                    message: message
                });
                setTimeout(x=> {
                    top.window.location='" . PROTOCOLO_CONEXION . RUTA_PDF . "/views/login/login.php';
                },1000);
            } else {
                top.window.location='" . PROTOCOLO_CONEXION . RUTA_PDF . "/views/login/login.php';
            }
        </script>";
        exit;
    }
}
