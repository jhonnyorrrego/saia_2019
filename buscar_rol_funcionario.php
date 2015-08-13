<?php
include_once("db.php");
$funcionario_codigo = $_REQUEST["funcionario_codigo"];

$rol = busca_filtro_tabla("","funcionario a, dependencia_cargo b","funcionario_codigo=".$funcionario_codigo." AND idfuncionario=funcionario_idfuncionario AND b.estado=1","iddependencia_cargo desc",$conn);

if($rol["numcampos"] > 0)
	echo 1;
else
	echo 0;
?>