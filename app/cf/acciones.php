<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
];

if (JwtController::check($_REQUEST['token'], $_REQUEST['key'])) {
    if (isset($_REQUEST['key']) && $_REQUEST['key'] != $_SESSION['idfuncionario']) {
        $Response->message = "Debe iniciar sesion";
    }else{
        switch ($_REQUEST['type']) {
            case 'edit':
            $consulta = StaticSql::search("select * from " . $_REQUEST['table'] . " where id" . $_REQUEST['table'] . "=" . $_REQUEST['id']);
            foreach($consulta[0] as $key => $value){
                if(!is_numeric($key)){
                    $data[$key] = $value;
                }
            }
                $Response->data = $data;
                $Response->success = 1;
            break;
        }
    }

    echo json_encode($Response);
}

?>