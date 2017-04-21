<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
function filtro_where($iddoctarea){ //Tareas del documento
	return("documento_iddocumento=".$iddoctarea);
}
function mostrar_funcionario($funcionario_codigo){
	$responsable = busca_filtro_tabla("nombres,apellidos", "vfuncionario_dc", "iddependencia_cargo=" . $funcionario_codigo, "", $conn);
	return($responsable[0]['nombres']." ".$responsable[0]['apellidos']);
}
function mostrar_funcionario_asignado_por($funcionario_codigo){
	$responsable=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$funcionario_codigo,"",$conn);
	//$responsable = busca_filtro_tabla("nombres,apellidos", "vfuncionario_dc", "iddependencia_cargo=" . $funcionario_codigo, "", $conn);
	return($responsable[0]['nombres']." ".$responsable[0]['apellidos']);
}
function mostrar_prioridad($prioridad){
	switch ($prioridad) {
		case 0:
			return("Baja");
			break;
		case 1:
			return("Media");
			break;
		case 2:
			return("Alta");
			break;
	}
}
function estado_tarea_actual($estado_tarea){
global $conn;
switch ($estado_tarea) {
	case 0 :
		$estado = "Pendiente";
		break;
	case 1 :
		$estado = "Proceso";
		break;
	case 2 :
		$estado = "Terminada";
	break;
}
return($estado);
}
function validar_request_tareas(){
	if(!@$_REQUEST["iddoc"]){
		$condicion=condicion_mis_tareas_pendientes();
		if($condicion){
			$condicion.=' OR ';
		}
		$condicion.=condicion_mis_tareas_asignadas();
		return($condicion); 
	}
	else{
		return("documento_iddocumento=".$_REQUEST["iddoc"]);	
	}
}
function condicion_todas_mis_pendientes(){
	$condicion=condicion_mis_tareas_pendientes();
	if($condicion){
		$condicion.=' OR ';
	}
	$condicion.=condicion_mis_tareas_asignadas();
	return("(".$condicion.") AND estado_tarea<>2");
}
function condicion_mis_tareas_pendientes(){
$mis_roles=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
if($mis_roles["numcampos"]){
	$roles=extrae_campo($mis_roles,"iddependencia_cargo");
	$concat=array();
	$cadena_concatenar=array("','","responsable","','");
	foreach ($roles AS $key=>$value){
			
		array_push($concat,concatenar_cadena_sql($cadena_concatenar)." LIKE('%,".$value.",%')");
	}
	return("(".implode(" OR ",$concat).")");
}
else{
	return("1=0");
}
}
function condicion_mis_tareas_asignadas(){
	$cadena_concatenar=array("','","ejecutor","','");
	return(concatenar_cadena_sql($cadena_concatenar)." LIKE('%,".usuario_actual("funcionario_codigo").",%')");
}
function informacion_tarea_documento($documento_iddocumento){
if($documento_iddocumento!="documento_iddocumento"){
	$documento=busca_filtro_tabla("","documento","iddocumento=".$documento_iddocumento,"",$conn);
	if($documento["numcampos"]){
		if(strpos($_SERVER["HTTP_REFERER"],"iddoc=")==FALSE){
			return('<br> Ver documento:<br><div class="link kenlace_saia" conector="iframe"  enlace="ordenar.php?key='.$documento[0]["iddocumento"].'&mostrar_formato=1'.'" titulo="Documento No.'.$documento[0]["numero"].'"><b>'.$documento[0]["numero"]."-".$documento[0]["descripcion"].'</b></div>');
		}
	}	
}
}

function mostrar_texto_codificado($texto){
    global $conn,$ruta_db_superior;
    $texto=html_entity_decode($texto);
    return($texto);
}

?>