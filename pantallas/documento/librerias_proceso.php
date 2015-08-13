<?php
function filtro_consulta($iddoc){
	global $conn,$count,$start;
	$destino=usuario_actual("funcionario_codigo");
	return "origen='".$destino."'";
}
?>