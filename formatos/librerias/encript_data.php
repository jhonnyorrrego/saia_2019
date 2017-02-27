<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");

$data = array();
if (isset($_POST["datos"])) {
    $info = json_decode($_POST["datos"], true);
	//print_r($info);die();
	$arreglo_name=array();
	$canti=count($info);
  $k=0;
    for($i = 0; $i < $canti; $i ++) {
    	if(strpos($info[$i]["name"],"[]")!=false){
    		if(!isset($arreglo_name[$info[$i]["name"]])){
    			$arreglo_name[$info[$i]["name"]]=array();
    		}
			array_push($arreglo_name[$info[$i]["name"]],$info[$i]["value"]);
    	}
		  else{
        	$data[$k]["name"] = encrypt_blowfish($info[$i]["name"], LLAVE_SAIA_CRYPTO);
        	$data[$k]["value"] = encrypt_blowfish($info[$i]["value"], LLAVE_SAIA_CRYPTO);
          $k++;
		  }
    }
	foreach($arreglo_name AS $key=>$valor){
		$data[$k]["name"]=encrypt_blowfish(str_replace("[]","",$key), LLAVE_SAIA_CRYPTO);
    $data[$k]["value"]=encrypt_blowfish(implode(",",$valor), LLAVE_SAIA_CRYPTO);
    $data[$k]["es_arreglo"]=1;
    $k++; 
	}
}

echo(json_encode($data));

?>