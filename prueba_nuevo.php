<?php
die();
include_once("db.php");
$modulo=busca_filtro_tabla("","modulo","cod_padre=1045","",$conn);
for($i=0;$i<$modulo["numcampos"];$i++){
	$sql1="update modulo set etiqueta='".$modulo[$i]["etiqueta"]."', enlace='".$modulo[$i]["enlace"]."', destino='".$modulo[$i]["destino"]."', imagen='".$modulo[$i]["imagen"]."', orden='".$modulo[$i]["orden"]."', cod_padre='".$modulo[$i]["cod_padre"]."' where nombre='".$modulo[$i]["nombre"]."';\n";
	echo($sql1);
}
?>