<?php
include_once("db.php");
include_once("formatos/librerias/funciones_generales.php");

$dato=busca_filtro_tabla("a.diagram_iddiagram_instance,e.id","paso_documento a, documento b, diagram e, diagram_instance d","a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND b.iddocumento=".$_REQUEST["key"],"GROUP BY a.diagram_iddiagram_instance,e.id",$conn);
$target="_parent";
if(@$_REQUEST["target"]){
  $target=$_REQUEST["target"];
}
if($dato["numcampos"]){
  abrir_url("bpmn/procesar_bpmn.php?idbpmn=".$dato[0]["id"]."&idbpmni=".$dato[0]["diagram_iddiagram_instance"]."&key=".$_REQUEST["key"],$target);
  die();
}
else{
  echo "No pertenece a ningun flujo";
}
$formato = busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND iddocumento=".$_REQUEST["key"]." and cod_padre<>0","",$conn);
if($formato["numcampos"]){
  //$iddocpapa = buscar_papa_primero($_REQUEST["key"]);
  $dato=busca_filtro_tabla("a.diagram_iddiagram_instance, a.idpaso_documento, a.documento_iddocumento","paso_documento a","a.documento_iddocumento=".$formato[0]["documento_iddocumento"],"GROUP BY a.diagram_iddiagram_instance,a.idpaso_documento",$conn);
  if($dato["numcampos"]==1){
    //$iddocpapa = buscar_papa_primero($_REQUEST["key"]);
    abrir_url("bpmn/procesar_bpmn.php?idpaso_documento=".$dato[0]["idpaso_documento"]."&iddiagram_instance=".$dato[0]["diagram_iddiagram_instance"],"centro");  
  }
}
?>