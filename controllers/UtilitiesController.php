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
    

    public static function generateFormToken ($formName) {
        $secret = TOKEN_SECRET;
        $sid = session_id();
        $token = md5($secret . $sid . $formName);
        return $token;
    }

    public static function verifyFormToken( $formName, $token) {
        $secret = TOKEN_SECRET;
        $sid = session_id();
        $correct = md5($secret . $sid . $formName);
        return ($token == $correct);
    }
}
