<?php
include_once("db.php");
$id=@$_REQUEST["id"];
if($id=="-2"){
	abrir_url("documentoadd.php","previsualizar");
}
if($id!="-1"){
	$formato=busca_filtro_tabla("","formato","idformato=".$id,"",$conn);
	abrir_url(FORMATOS_CLIENTE . $formato[0]["nombre"]."/".$formato[0]["ruta_adicionar"],"previsualizar");
}
?>