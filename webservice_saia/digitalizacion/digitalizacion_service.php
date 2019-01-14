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

if (! @$_SESSION["LOGIN" . LLAVE_SAIA]) {
    @session_start();
    $_SESSION["LOGIN" . LLAVE_SAIA] = "radicador_web";
    $_SESSION["usuario_actual"] = "20";
    $_SESSION["conexion_remota"] = 1;
}

$protocol = "http://";
if(!empty($_SERVER['HTTPS'])) {
    $protocol = "https://";
}

$port = "";
if(!empty($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
    $port = ":" . $_SERVER["SERVER_PORT"];
}

//$soap_address = "http://localhost/~giovanni/saia_reborn/saia/webservice_saia/digitalizacion/digitalizacion_service.php";
$service_address = $protocol .  $_SERVER["SERVER_NAME"] . $port . dirname($_SERVER['PHP_SELF']) . "/wsdl.php?wsdl";


//$server = new SoapServer("http://localhost/~giovanni/saia_reborn/saia/webservice_saia/digitalizacion/wsdl.php?wsdl");	// Locate WSDL file to learn structure of functions
$server = new SoapServer($service_address);
$server->addFunction("consultar_info");	// Same func name as in our WSDL XML, and below
$server->addFunction("actualizar_estado");	// Same func name as in our WSDL XML, and below
$server->addFunction("verificar_login");
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

function verificar_login($qry_data) {
    global $conn;

    $resp = array("status" => 0, "message" => "Error de ejecucion");

    $qry_data = get_object_vars($qry_data); // Pull parameters from SOAP connection

    // Sort out the parameters and grab their data
    $user = $qry_data['usuario'];
    $pass = $qry_data['clave'];


    $idfunc = validar_usuario($user, $pass);
    if($idfunc) {
        $resp = array("status" => 1, "message" => "OK", "idfunc" => $idfunc);
    }

    return $resp;
}

function validar_usuario($user, $pass) {
    global $conn,$ruta_db_superior;
    
	$ch = curl_init();
	$fila = PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/verificar_login.php?conexion_remota=1&conexio_usuario=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&LLAVE_SAIA=".LLAVE_SAIA."&userid=".$user."&passwd=".$pass;
	curl_setopt($ch, CURLOPT_URL,$fila);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	$contenido=curl_exec($ch);
	curl_close ($ch);    
    $contenido=json_decode($contenido);
    
    //TODO: convertir $contenido a json y validar que la variable ingresar sea = 1 
    $user_data=busca_filtro_tabla("idfuncionario","funcionario","login='".$user."'","",$conn);
    if($user_data['numcampos'] && $contenido->ingresar) {
        return $user_data[0]["idfuncionario"];
    }
    return false;
}
?>
