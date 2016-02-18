<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
if(@$_REQUEST["vista_bpmn"] && @$_REQUEST["idbpmn"]){
	$paso=busca_filtro_tabla("","paso A","A.idfigura='".$_REQUEST["idfigura"]."'"." AND diagram_iddiagram=".$_REQUEST["idbpmn"],"",$conn);
	redirecciona($ruta_db_superior."bpmn/paso/actividades_paso_admin.php?tipo=usuario&idpaso=".$paso[0]["idpaso"]);
	//redirecciona($ruta_db_superior."workflow/actividades_paso.php?idpaso=".$paso[0]["idpaso"],"_self");
}
else if($_REQUEST["idpaso_documento"]){
	$paso=busca_filtro_tabla("","paso A, paso_documento B","A.idpaso=B.paso_idpaso AND B.idpaso_documento=".$_REQUEST["idpaso_documento"],"",$conn);
	redirecciona($ruta_db_superior."bpmn/paso/actividades_paso.php?tipo=usuario&idpaso=".$paso[0]["paso_idpaso"]."&diagrama=".$paso[0]["diagram_iddiagram_instance"]."&documento=".$paso[0]["documento_iddocumento"]."&idpaso_documento=".$paso[0]["idpaso_documento"]);
}
else{
	$paso=busca_filtro_tabla("","paso A, paso_documento B","A.idpaso=B.paso_idpaso AND A.idfigura='".$_REQUEST["idfigura"]."'"." AND B.diagram_iddiagram_instance=".$_REQUEST["idbpmni"],"",$conn);
	redirecciona($ruta_db_superior."bpmn/paso/actividades_paso.php?idpaso=".$paso[0]["paso_idpaso"]."&diagrama=".$paso[0]["diagram_iddiagram_instance"]."&documento=".$paso[0]["documento_iddocumento"]."&idpaso_documento=".$paso[0]["idpaso_documento"]);
}
?>