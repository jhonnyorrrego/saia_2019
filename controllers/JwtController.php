<?php

use Firebase\JWT\JWT;

class JwtController
{
    private static $secret_key = LLAVE_SAIA;
    private static $encrypt = ['HS256'];

    /**
     * crea el token
     *
     * @param array $data informacion a guardar en el token
     * @param integer $duration tiempo de vida 
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-11
     */
    public static function SignIn($data, $duration)
    {
        $time = time();
        $token = [
            'iat' => $time,
            'exp' => $time + $duration,
            'aud' => self::Aud(),
            'data' => $data
        ];

        return JWT::encode($token, self::$secret_key);
    }

    /**
     * verifica si el token es valido
     *
     * @param string $token
     * @param integer $userId idfuncionario a verfificar    
     * @param boolean $logout cerrar sesion en caso de fallar
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-11
     */
    public static function Check($token, $userId, $logout = true)
    {
        if (empty($token)) {
            throw new Exception("Invalid token supplied.");
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if ($decode->data->web_service) {
            $fail =
                empty($decode->aud) ||
                $decode->data->id != $userId;
            $Funcionario = new Funcionario($decode->data->id);
            new SessionController($Funcionario);
        } else {
            $fail =
                $decode->aud !== self::Aud() ||
                $decode->data->id != $userId ||
                $decode->data->id != SessionController::hasActiveSession() ||
                !LogAcceso::checkActiveToken($token);
        }

        if ($fail) {
            if ($logout) {
                SessionController::logout("Debe iniciar sesión");
            } else {
                throw new Exception("Debe iniciar sesión");
            }
        } else {
            return true;
        }
    }

    /**
     * obtiene la informacion almacenada en el token
     *
     * @param string $token
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-11
     */
    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    /**
     * genera un string para validar el uso del token 
     * en el mismo navegador donde se generó
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-11
     */
    private static function Aud()
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
}
