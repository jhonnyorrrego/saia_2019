<?php
include_once(dirname(__FILE__)."/../../db.php");
//print_r($_REQUEST);
if(@$_REQUEST["tabla"]=='tareas'){
	$_REQUEST["asignado_a"]=limpiar_dependencias($_REQUEST["asignado_a"]);
	if(@$_REQUEST["iddoc"]){
	  $sql2="INSERT INTO tareas(documento_iddocumento,etiqueta,fecha_vencimiento,asignada_por,asignada_a,orden) VALUES(".$_REQUEST["iddoc"].",'".$_REQUEST["etiqueta"]."',".fecha_db_almacenar($_REQUEST["fecha_vencimiento"]).",'".usuario_actual("idfuncionario")."','".$_REQUEST["asignado_a"]."','".$_REQUEST["orden"]."')";
	}
	else{
	  $sql2="INSERT INTO tareas(etiqueta,fecha_vencimiento,asignada_por,asignada_a,orden) VALUES('".$_REQUEST["etiqueta"]."',".fecha_db_almacenar($_REQUEST["fecha_vencimiento"]).",'".$_SESSION["usuario_actual"]."','".$_REQUEST["asignado_a"]."','".$_REQUEST["orden"]."')";
	}
	phpmkr_query($sql2);
	$id=phpmkr_insert_id();
	if($id){            
	  echo('<div id="tarea_'.$id.'"><div>TAREA '.$i.'</div><div><i class="icon-edit"></i></div>');
	}
}
else if(@$_REQUEST["tabla"]=='tareas_buzon'){
	$terminado_por=usuario_actual("idfuncionario");
	$descripcion_estado="'".$_REQUEST["descripcion"]."'";
	$fecha_estado=fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
	$tareas_idtareas=$_REQUEST["idtareas"];
	$tarea=busca_filtro_tabla("","tareas_buzon","tareas_idtareas=".$_REQUEST["idtareas"],"",$conn);
	$sql1="INSERT INTO tareas_buzon (terminado_por, descripcion_estado, fecha_estado, tareas_idtareas) VALUES(".$terminado_por.",".$descripcion_estado.",".$fecha_estado.",".$tareas_idtareas.")";

	phpmkr_query($sql1);
}
function limpiar_dependencias($fun){
	global $conn;
	$funcionarios=explode(",",$fun);
	$cantidad=count($funcionarios);
	$listado=array();
	for($i=0;$i<$cantidad;$i++){
		if(!strpos($funcionarios[$i],"#")){
			$listado[]=$funcionarios[$i];
		}
	}
	return implode(",",$listado);
}
?>