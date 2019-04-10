<?php

class FuncionarioController
{
    /**
     * valida los intentos de login
     *
     * @param string $user login del funcionario
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-05
     */
    public static function failedLogin($user)
    {
        $Configuracion = Configuracion::findByAttributes(['nombre' => 'intentos_login']);
        $Funcionario = Funcionario::findByAttributes(['login' => $user]);
        $Funcionario->intento_login++;

        if ($Funcionario->intento_login >= $Configuracion->valor) {
            $Funcionario->estado = 0;
        }

        $log = LogAcceso::newRecord([
            'login' => $user,
            'iplocal' => UtilitiesController::getRealIP(),
            'ipremota' => UtilitiesController::remoteServer(),
            'exito' => 0,
            'fecha' => date('Y-m-d H:i:s')
        ]);
        return $log && $Funcionario->save();
    }

    /**
     * genera el token de acceso
     *
     * @param object $Funcionario instancia de funcionario
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function generateToken($Funcionario, $duration = 86400, $forWebService = false)
    {
        $data = [
            "id" => $Funcionario->getPK(),
            "funcionario_codigo" => $Funcionario->funcionario_codigo,
            "login" => $Funcionario->usuario,
            "web_service" => $forWebService
        ];

        return JwtController::SignIn($data, $duration);
    }

    /**
     * loguea el usuario radicador web
     *
     * @return void token generado
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function loginWebUser()
    {
        $userId = Funcionario::RADICADOR_WEB;
        $Funcionario = new Funcionario($userId);
        new SessionController($Funcionario);
        return self::generateToken($Funcionario);
    }

    /**
     * guarda el acceso al sistema
     *
     * @param string $login
     * @param integer $userId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function saveAccess(){
        LogAcceso::newRecord([
            'login' => SessionController::getLogin(),
            'iplocal' => UtilitiesController::getRealIP(),
            'ipremota' => UtilitiesController::remoteServer(),
            'exito' => 1,
            'fecha' => date('Y-m-d H:i:s'),
            'funcionario_idfuncionario' => SessionController::getValue('idfuncionario'),
            'idsesion_php' => SessionController::getId(),
            'token' => SessionController::getValue('token')
        ]);
    }

    /**
     * guarda el registro de cierre de sesion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public static function saveLogout(){
        $LogAcceso = LogAcceso::findByAttributes([
            'exito' => 1,
            'login' => SessionController::getLogin(),
            'iplocal' => UtilitiesController::getRealIP(),
            'idsesion_php' => SessionController::getId(),
            'funcionario_idfuncionario' => SessionController::getValue('idfuncionario')
        ]);

        if($LogAcceso){
            $LogAcceso->fecha_cierre = date('Y-m-d H:i:s');
            $LogAcceso->save();
        }else{
            throw new Exception("Invalid logout", 1);
        }
    }
}
