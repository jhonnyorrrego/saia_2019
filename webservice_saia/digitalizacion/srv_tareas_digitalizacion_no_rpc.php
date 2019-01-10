<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida --;
}

//ini_set("display_errors", true);

include_once ($ruta_db_superior . "db.php");

require_once('../vendor/autoload.php');
use \Firebase\JWT\JWT;

if (! @$_SESSION["LOGIN" . LLAVE_SAIA]) {
	@session_start();
	$_SESSION["LOGIN" . LLAVE_SAIA] = "radicador_web";
	$_SESSION["usuario_actual"] = "20";
	$_SESSION["conexion_remota"] = 1;
}

require_once ('../nusoap.php');
//require_once ('string_utils.php');

$URL = "www.cerok.com";
$namespace = $URL . '/digitalizacionservice';
// using soap_server to create server object
$server = new soap_server();
// $server->configureWSDL('hellotesting', $namespace);
$server->configureWSDL("TareasDigitalizacion");

$server->wsdl->schemaTargetNamespace = $namespace;

$server->wsdl->addComplexType('TareaDigitalizacion', 'complexType', 'struct', 'sequence', '', 
	array(
		'idtarea_dig' => array( 'name' => 'idtarea_dig', 'type' => 'xsd:int'),
		'idfuncionario' => array( 'name' => 'idfuncionario', 'type' => 'xsd:int'),
		'iddocumento' => array( 'name' => 'iddocumento', 'type' => 'xsd:int'),
		'estado' => array( 'name' => 'estado', 'type' => 'xsd:int'),
		'fecha' => array( 'name' => 'fecha', 'type' => 'xsd:date'),
		'token' => array( 'name' => 'token', 'type' => 'xsd:string')
	)
);

$server->wsdl->addComplexType(
	'TareasArray', 
	'complexType', 
	'array', 
	'sequence', 
	'', 
	array(
		'datos' => array(
			'name' => 'datos', 
			'type' => 'tns:TareaDigitalizacion', 
			'minOccurs' => '0', 
			'maxOccurs' => '0'
		)
	)
);

// register a function that works on server
$server->register("consulta_tareas_digitalizacion", array(
		"idfuncionario" => "xsd:string"
), array(
		"return" => "tns:TareasArray"
), $namespace, false, 'document', 'literal', 'Metodo consultar tareas');

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

function consulta_tareas_digitalizacion($idfuncionario) {
	global $conn;
	if (empty($idfuncionario)) {
		return array();
	}

	$respuesta = array();

	$func = busca_filtro_tabla("idfuncionario, login", "funcionario", "funcionario_codigo=$idfuncionario", "", $conn);
	if($func["numcampos"] == 1) {
	$datos = busca_filtro_tabla("", "tmp_tarea_dig", "estado=1 and idfuncionario=" . $func[0]["idfuncionario"], "fecha desc", $conn);
	if ($datos['numcampos']) {
	$respuesta['datos'] = array();
		for($i = 0; $i < $datos["numcampos"]; $i ++) {
			$fila = array();
			$fila['idtarea_dig'] = $datos[$i]['idtarea_dig'];
			$fila['idfuncionario'] = $datos[$i]['idfuncionario'];
			$fila['iddocumento'] = $datos[$i]['iddocumento'];
			$fila['estado'] = $datos[$i]['codigo'];
			//$fila['token'] = getToken($func[0]['codigo'], $datos[$i]['iddocumento']);
			$fila['token'] = $func[0]['login'];
			$respuesta['datos'][] = $fila;
		}
	}
	}
	return $respuesta;
}
/*
function getToken($codigo, $iddocumento) {
global $ruta_db_superior;
    $tokenId    =  uniqid();
    $issuedAt   = time();
    $notBefore  = $issuedAt + 10;             //Adding 10 seconds
    $expire     = $notBefore + 3600;            // Adding 3600 seconds
    $serverName = $_SERVER['SERVER_ADDR']; // Retrieve the server name from config file
    
    $data = array(
        'iat'  => $issuedAt,         // Issued at: time when the token was generated
        'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
        'iss'  => $serverName,       // Issuer
        'nbf'  => $notBefore,        // Not before
        'exp'  => $expire           // Expire
    );
    $params = consultar_configuracion();
    $params["radica"]= $iddocumento;
    $params["verLog"]=true;
    $params["maxtabs"]=50;

    $data['data'] = $params;


    $secretKey = $codigo;
    
    $jwt = JWT::encode(
        $data,      //Data to be encoded in the JWT
        $secretKey, // The signing key
        'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
        
    return $jwt;
}
 */
function consultar_configuracion() {
	$params = array();
  $configuracion["numcampos"] = 0;
  $configuracion = busca_filtro_tabla("A.*", "configuracion A", "tipo='ruta' OR tipo='clave' OR tipo='usuario' OR tipo='imagen' OR tipo='ftp'", "", $conn);
  for ($i = 0; $i < $configuracion["numcampos"]; $i++) {
    switch($configuracion[$i]["nombre"]) {
      case "ruta_servidor" :
				$params["host"]= $configuracion[$i]["valor"];
        break;
      case "ruta_ftp" :
				$params["dftp"]= $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
        break;
      case "ruta_temporal" :
				$params["url"]= $configuracion[$i]["valor"] . "_" . $_SESSION["LOGIN" . LLAVE_SAIA];
        break;
      case "puerto_ftp" :
				if(empty($configuracion[$i]["valor"])) {
					$params["port"]= 21;
				} else {
					$params["port"]= $configuracion[$i]["valor"];
				}
        break;
      case "clave_ftp" :
		if($configuracion[$i]['encrypt']){
			include_once($ruta_db_superior.'pantallas/lib/librerias_cripto.php');
			$configuracion[$i]['valor']=decrypt_blowfish($configuracion[$i]['valor'],LLAVE_SAIA_CRYPTO);					
		}			  
				$params["clave"]= $configuracion[$i]["valor"];
        break;
      case "usuario_ftp" :
				$params["usuario"]= $configuracion[$i]["valor"];
        break;
      case "ancho_imagen" :
				$params["ancho"]= $configuracion[$i]["valor"];
        break;
      case "alto_imagen" :
				$params["alto"]= $configuracion[$i]["valor"];
        break;
    }
  }	
return $params;
}
?>

