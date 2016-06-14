<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");

$identificacion = explode("|",$_REQUEST["identificacion"]);

switch($identificacion[0]){
	case "1":
		$proceso = busca_filtro_tabla("a.nombre, a.idft_proceso as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_proceso a, documento b, formato c","a.documento_iddocumento=b.iddocumento AND lower(b.plantilla) like(lower(c.nombre)) and a.idft_proceso=".$identificacion[1],"",$conn);
	break;
	case "2":
		$proceso = busca_filtro_tabla("a.nombre, a.idft_macroproceso_calidad as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_macroproceso_calidad a, documento b, formato c","a.documento_idocumento=b.iddocumento AND LOWER(b.plantilla) LIKE(LOWER(c.nombre)) AND a.idft_macroproceso_calidad=".$identificacion[1],"",$conn);
	break;	
}

echo($proceso[0]["idformato"]."-".$proceso[0]["idft_tabla"]."-id".$proceso[0]["nombre_tabla"]);
