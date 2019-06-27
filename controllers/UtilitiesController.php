<?php
class UtilitiesController
{
    /**
     * filtra el array eliminando los datos vacios
     *
     * @param array $data : valores a procesar
     * @param int $setnull : 1 para setear los valores vacios a null
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function cleanForm(array $data, int $setNull = 0): array
    {
        if ($setNull) {
            array_walk_recursive($data, function (&$element, $key) {
                if (trim($element) != '') {
                    $element = trim($element);
                } else {
                    $element = 'NULL';
                }
            });
            $response = $data;
        } else {
            array_walk_recursive($data, function (&$element, $key) {
                if (trim($element) != '') {
                    $element = trim($element);
                }
            });
            $response = array_filter($data, function ($val, $key) {
                return trim($val) != '' || is_array($val);
            }, ARRAY_FILTER_USE_BOTH);
        }
        return $response;
    }


    public static function generateFormToken($formName)
    {
        $secret = TOKEN_SECRET;
        $sid = session_id();
        $token = md5($secret . $sid . $formName);
        return $token;
    }

    public static function verifyFormToken($formName, $token)
    {
        $secret = TOKEN_SECRET;
        $sid = session_id();
        $correct = md5($secret . $sid . $formName);
        return ($token == $correct);
    }

    /**
     * Busca la ip real de la maquina cliente
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function getRealIP()
    {
        if (@$_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
            $client_ip = self::remoteServer();
            // los proxys van añadiendo al final de esta cabecera
            // las direcciones ip que van "ocultando". Para localizar la ip real
            // del usuario se comienza a mirar por el principio hasta encontrar
            // una dirección ip que no sea del rango privado. En caso de no
            // encontrarse ninguna se toma como valor el REMOTE_ADDR
            $entries = preg_split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
            reset($entries);
            while (list(, $entry) = each($entries)) {
                $entry = trim($entry);
                if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)) {
                    $private_ip = array(
                        '/^0\./',
                        '/^127\.0\.0\.1/',
                        '/^192\.168\..*/',
                        '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                        '/^10\..*/'
                    );
                    $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
                    if ($client_ip != $found_ip) {
                        $client_ip = $found_ip;
                        break;
                    }
                }
            }
        } else {
            $client_ip = self::remoteServer();
        }
        return $client_ip;
    }

    /**
     * obtiene la ip del cliente
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function remoteServer()
    {
        $client_ip = !empty($_SERVER['REMOTE_ADDR']) ?
            $_SERVER['REMOTE_ADDR'] : (!empty($_ENV['REMOTE_ADDR']) ?
                $_ENV['REMOTE_ADDR'] : "unknown");
        return $client_ip;
    }

    /**
     * convierte el string de busqueda_filtro_temp
     * a un sql
     *
     * @param string $string
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    public static function convertTemporalFilter($string)
    {
        $old = ["|+|", "|=|", "|like|", "|-|", "|<|", "|>|", "|>=|", "|<=|", "|in|", "||"];
        $new = [" AND ", " = ", " like ", " OR ", " < ", " > ", " >= ", " <= ", " in ", " LIKE "];

        return str_replace($old, $new, $string);
    }

    /**
     * convierte los nombres de las funciones de un sql
     * a su respectivo valor
     *
     * @param string $string
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-27
     */
    public static function sqlGetFunctionValue($string)
    {
        $match = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $string, $resultado);

        if (!$match) {
            return $string;
        }

        $functions = str_replace(["{*", "*}"], "", $resultado[0]);
        foreach ($functions as $functionName) {
            $string = str_replace("{*{$functionName}*}", $functionName(), $string);
        }

        return $string;
    }
}
