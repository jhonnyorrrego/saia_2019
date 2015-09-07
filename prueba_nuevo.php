<?php
die();
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");
$funcionario=busca_filtro_tabla("","funcionario a","","",$conn);
for($i=0;$i<$funcionario["numcampos"];$i++){
	$sql1="update funcionario set clave='".encrypt_md5(trim($funcionario[$i]["clave"]))."' where idfuncionario=".$funcionario[$i]["idfuncionario"];
	phpmkr_query($sql1);
}
?>