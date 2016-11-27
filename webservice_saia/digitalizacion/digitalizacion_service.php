<?php

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
    if (is_file ( $ruta . "db.php" )) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}

include_once ($ruta_db_superior . "db.php");

//$server = new SoapServer("http://localhost/~giovanni/saia_reborn/saia/webservice_saia/digitalizacion/wsdl.php?wsdl");	// Locate WSDL file to learn structure of functions
$server = new SoapServer(dirname(__FILE__));
$server->addFunction("consultar_info");	// Same func name as in our WSDL XML, and below
$server->addFunction("actualizar_estado");	// Same func name as in our WSDL XML, and below
$server->handle();

function consultar_info($qry_data) {
    global $conn;
    $qry_data = get_object_vars($qry_data); // Pull parameters from SOAP connection

    // Sort out the parameters and grab their data
    $user = $qry_data['usuario'];
    $pass = $qry_data['clave'];

    $resp = array("status" => 0, "message" => "Error de ejecucion");

    $idfunc = validar_usuario($user, $pass);
    if($idfunc) {
        $datos_dig = busca_filtro_tabla("", "tmp_tarea_dig", "estado=1 and idfuncionario=$idfunc", "", $conn);
        if($datos_dig["numcampos"]) {
            $resp = array("status" => 1, "message" => "OK", "iddoc" => $datos_dig[0]["iddocumento"], "idfunc" => $idfunc);
        } else {
            $resp = array("status" => 0, "message" => "No se encontr&oacute; informaci&oacute; para digitalizar del usuario: $user");
        }
    } else {
        $resp = array("status" => 0, "message" => "Login incorrecto");
    }

    return $resp;
}

function actualizar_estado($qry_data){
    global $conn;
    $qry_data = get_object_vars($qry_data); // Pull parameters from SOAP connection

    // Sort out the parameters and grab their data
    $func = $qry_data['idfunc'];
    $doc = $qry_data['iddoc'];

    $resp = array("status" => 0, "message" => "Error de ejecucion");

    $sql1 = "update tmp_tarea_dig set estado = 0 where idfuncionario = $func and iddocumento = $doc";
    phpmkr_query($sql1) or die ($sql1);

    $resp = array("status" => 1, "message" => "OK");
    return $resp;
}

function validar_usuario($user, $pass) {
    global $conn;
    $user_data = busca_filtro_tabla("idfuncionario", "funcionario", "login='$user'", "", $conn);
    //TODO: verificar clave
    if($user_data['numcampos']) {
        return $user_data[0]["idfuncionario"];
    }
    return false;
}
?>