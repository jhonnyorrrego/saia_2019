<?php
function filtrar_pendientes_propios($usuario){
	global $conn;
	$texto="";
	if($usuario=='usuario'){
		$usuario=usuario_actual('funcionario_codigo');
	}
	if(usuario_actual('login')!='cerok'){
		$texto=" AND a.ejecutor='".$usuario."'";
	}
	return($texto);
}
?>