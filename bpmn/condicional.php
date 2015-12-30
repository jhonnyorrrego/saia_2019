<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
if(@$_REQUEST["vista_bpmn"] && @$_REQUEST["idbpmn"]){
  $condicional=busca_filtro_tabla("","paso_condicional A","A.idcondicional='".$_REQUEST["idcondicional"]."' AND diagram_iddiagram=".$_REQUEST["idbpmn"],"",$conn);
  redirecciona($ruta_db_superior."bpmn/condicional/condicionales_admin.php?tipo=usuario&idpaso_condicional=".$condicional[0]["idpaso_condicional"]);
}
else if(@$_REQUEST["idbpmni"] && @$_REQUEST["idcondicional"]){
  $bpmn=busca_filtro_tabla("","diagram_instance","iddiagram_instance=".$_REQUEST["idbpmni"],"",$conn);
  $condicional=busca_filtro_tabla("","paso_condicional A","A.idcondicional='".$_REQUEST["idcondicional"]."' AND diagram_iddiagram=".$bpmn[0]["diagram_iddiagram"],"",$conn);
  redirecciona($ruta_db_superior."bpmn/condicional/condicionales.php?tipo=usuario&idpaso_condicional=".$condicional[0]["idpaso_condicional"]."&bpmni=".$_REQUEST["idbpmni"]);
}
else{
  print_r($_REQUEST);
  echo("default<br>");
  $paso=busca_filtro_tabla("","paso A, paso_documento B","A.idpaso=B.paso_idpaso AND A.idfigura='".$_REQUEST["idfigura"]."'"." AND B.diagram_iddiagram_instance=".$_REQUEST["idbpmni"],"",$conn);
  //redirecciona($ruta_db_superior."bpmn/paso/actividades_paso.php?idpaso=".$paso[0]["paso_idpaso"]."&diagrama=".$paso[0]["diagram_iddiagram_instance"]."&documento=".$paso[0]["documento_iddocumento"]."&idpaso_documento=".$paso[0]["idpaso_documento"]);
}
?>