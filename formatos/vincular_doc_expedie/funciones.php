<?php
function fecha_documento_funcion($idformato,$iddoc){
	global $conn;
	$fecha_doc=busca_filtro_tabla(fecha_db_obtener('fecha_documento','Y-m-d')." as fecha_doc","ft_vincular_doc_expedie A","A.documento_iddocumento=".$iddoc,"");
	$datos=date_parse($fecha_doc[0]["fecha_doc"]);
	echo($datos["day"]." de ".mes($datos["month"])." del ".$datos["year"]);
}
?>