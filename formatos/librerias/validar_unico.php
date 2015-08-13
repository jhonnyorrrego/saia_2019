<?php 
if(@$_REQUEST["tabla"] && @$_REQUEST["valor"]&& @$_REQUEST["nombre"]){
include_once("../../db.php");
if(isset($_REQUEST["iddoc"])&&$_REQUEST["iddoc"])
$dato=busca_filtro_tabla("",$_REQUEST["tabla"],$_REQUEST["nombre"]." LIKE '".trim($_REQUEST["valor"])."' and documento_iddocumento<>'".$_REQUEST["iddoc"]."'","",$conn);
else
$dato=busca_filtro_tabla("",$_REQUEST["tabla"],$_REQUEST["nombre"]." LIKE '".trim($_REQUEST["valor"])."'","",$conn);
//print_r($dato);
if($dato["numcampos"]){
  echo(0);
}
else echo(1);
}
else
  echo(1);
?>
