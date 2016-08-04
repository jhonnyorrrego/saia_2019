<?php
function filtrar_funcionario($funcionario){
	global $conn;
	if($funcionario=='funcionario'){
		$funcionario=usuario_actual("idfuncionario");
	}
	return usuario_actual("idfuncionario");
}

function filtro_indicadores($prioridad){
    global $conn;
    
    $cadena=" AND b.prioridad=".$prioridad;
    
    return($cadena);
}

?>