<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    /**
     * Con este php llamado desde el ajax se cargan las sedes de la organización
     * 
     * @param $_REQUEST[''] En el request solo llega el token y key para validar la sesión    
     * @return string en formato json se envian los nombres y los id de las sedes.
     * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
     * @date 2019-09-26
     */

    $data = Model::getQueryBuilder()
        ->select('nombre', 'idcf_ventanilla')
        ->from('cf_ventanilla')
        ->execute()
        ->fetchAll();

    $sedes = array();

    foreach ($data as $key => $cf_ventanilla) {
        array_push($sedes, ["nombre" => $cf_ventanilla['nombre'], "id" => $cf_ventanilla['idcf_ventanilla']]);
    }

    $Response->data = json_encode($sedes);
    $Response->success = 1;
    $Response->message = "Sedes cargadas correctamente";
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
