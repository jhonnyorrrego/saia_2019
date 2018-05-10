<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");
function mostrar_file_imagen($idanexo){
	global $conn,$ruta_db_superior;
	$anexo=busca_filtro_tabla("","anexos","idanexos IN(".$idanexo.")","",$conn);
	if($anexo["numcampos"]){
		return("<img src=".$ruta_db_superior.$anexo[0]["ruta"]." class='img-polaroid'>");
	}
	else{
		return("No existe logo");
	}	
}

?>