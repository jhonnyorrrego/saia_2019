<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php"); 
ini_set("display_errors",true);
global $conn;

$idexpedientes = $_REQUEST['idexpedientes'];
if (strlen($idexpedientes)){
	$response = ['tipo' => 1,'msn'=>""];
	$estados = busca_filtro_tabla('estado_cierre,nombre','expediente','idexpediente in ('.$idexpedientes.')',"",$conn);
	unset($estados[tabla],$estados[sql],$estados[numcampos]);
	foreach ($estados as $key) {
		if ($key[estado_cierre] == 1){
			$response[tipo] = 0;
			$response[msn] .= $key[nombre].",";
		}
	}
	echo json_encode($response);
}
?>