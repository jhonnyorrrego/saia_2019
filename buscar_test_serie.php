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
if($_REQUEST['tabla']){
	$tabla=$_REQUEST['tabla'];
	
	$busca_papas=busca_filtro_tabla("id".$tabla.",nombre,cod_padre",$tabla,"lower(nombre) like(lower('%".$_REQUEST['nombre']."%'))","",$conn);
	
	$resultados=array();
		for ($i=0; $i < $busca_papas['numcampos']; $i++) {
			$campos = array();
			lista_papas($busca_papas[$i]['id'.$tabla], $campos,$tabla);
			$resultados[]=array_reverse(array_unique($campos));
		}
	
	echo(json_encode($resultados));
}
function lista_papas($id,&$campos,$tabla){
	global $conn;
	$campos[]=$id;
	$buscar_campo=busca_filtro_tabla("cod_padre",$tabla,"cod_padre IS NOT NULL AND id".$tabla."=".$id,"",$conn);
	
	if($buscar_campo["numcampos"]){
		lista_papas($buscar_campo[0]["cod_padre"], $campos,$tabla);
	}
}
?>