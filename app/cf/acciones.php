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

echo json_encode($Response);
/*if (JwtController::check($_REQUEST['token'], $_REQUEST['key'])) {
    
    print_r("1234");
    if (isset($_REQUEST['key']) && $_REQUEST['key'] != $_SESSION['idfuncionario']) {
        $Response->message = "Debe iniciar sesion";
    }else{
       print_r("123");
        $data["nombre"] = "llamado";
        $Response->data = $data;
        /*switch ($_REQUEST['type']) {
            case: 'editar':
                $Response->data = $data;
                //StaticSql::search("");
            break;
        }*/
   /* }

    echo json_encode($Response);
 

}*/

?>