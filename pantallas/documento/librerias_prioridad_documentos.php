<?php
function filtrar_funcionario(){
	global $conn;

    $cadena=" AND b.funcionario_idfuncionario=".usuario_actual("idfuncionario");
	return $cadena;
}

function filtro_indicadores(){
    global $conn;
    
    
    if(@$_REQUEST['filtro_indicadores']){
         $cadena=" AND b.prioridad=".$_REQUEST['filtro_indicadores'];
    }
    return($cadena);
}

?>