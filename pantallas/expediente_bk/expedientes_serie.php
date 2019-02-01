<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");

$idserie=@$_REQUEST["idserie"];
$serie_subserie=busca_filtro_tabla("cod_padre","serie a","a.idserie=".$idserie,"",$conn);
$expediente=busca_filtro_tabla("","expediente a","a.serie_idserie=".$serie_subserie[0]["cod_padre"],"",$conn);
//$intermedios=busca_filtro_tabla("","expediente a","a.cod_padre='".$expediente[0]["idexpediente"]."' and (serie_idserie is null or serie_idserie='')","",$conn);
if($expediente["numcampos"]){
	$idexp=obtener_expediente_ultimo($expediente[0]["idexpediente"]);
	echo("1-".$idexp);
}
else{
	echo(2);
}
/*
 * Responsabilidad: Se encarga de obtener el ultimo expediente, en otras palabras, el expediente que no tenga cod_padre
 */
function obtener_expediente_ultimo($exp,$indice=0){
	global $conn;
	if($indice>100)return false;
	$padre=busca_filtro_tabla("","expediente A","A.idexpediente=".$exp,"",$conn);
	if($padre[0]["cod_padre"]){
		$indice++;
		return obtener_expediente_ultimo($padre[0]["cod_padre"],$indice);
	}
	else{
		return($exp);
	}
}
?>