<?php
function filtro_funcionario_borrador($funcionario){
	global $conn;
	return usuario_actual("funcionario_codigo");
}
?>