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
include_once ($ruta_db_superior . "db.php");
require_once('vendor/autoload.php');
use \Firebase\JWT\JWT;
if(isset($_REQUEST['login']) && $_REQUEST['login']!=''){
	$login=$_REQUEST['login'];
	$tokenId    =  uniqid();
	$issuedAt   = time();
	$notBefore  = $issuedAt + 5;             //Adding 5 seconds 
	$expire     = $notBefore + 3600;            // Adding 3600 seconds /1 Hora
	$serverName = $_SERVER['SERVER_ADDR']; // Retrieve the server name from config file
	
	$data = array(
	    'iat'  => $issuedAt,         // Issued at: time when the token was generated
	    'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
	    'iss'  => $serverName,       // Issuer
	    'nbf'  => $notBefore,        // Not before
	    'exp'  => $expire           // Expire
	);
	$params["login"]= $login;
	$data['data'] = $params;

	$secretKey = LLAVE_SAIA;
	$jwt = JWT::encode(
	    $data,      //Data to be encoded in the JWT
	    $secretKey, // The signing key
	    'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
	    );
	$mensaje="Se ha generado el siguiente token: <br/>".$jwt;
	$mensaje.="<br/>Este Token expira hasta: ".date("H:i:s",$expire);
	
	if($jwt){
		$valida_usuario=busca_filtro_tabla("","funcionario","estado=1 and login='".$login."'","",$conn);
		if($valida_usuario['numcampos']){
			$msj=enviar_mensaje("","email",array("soporte@cerok.com"),"Solicitud Token Release1",$mensaje);
			echo($msj);	
		}else{
			echo(2);
			die();
		}	
	}else{
		echo("Error al generar Token. Error:".$jwt);
	}
}
if(isset($_REQUEST['token']) && $_REQUEST['token']!=''){
	$jwt=$_REQUEST['token'];
	$key = LLAVE_SAIA;
	$decoded = JWT::decode($jwt, $key, array('HS512'));
	$decoded_array = (array) $decoded;
	if($decoded_array['data']){
		echo(json_encode($decoded_array['data']));
	}else{
		echo(json_encode(array("error"=>$decoded)));
	}
}
?>