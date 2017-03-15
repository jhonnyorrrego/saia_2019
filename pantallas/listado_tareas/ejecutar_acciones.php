<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/listado_tareas/librerias.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idlistado_tareas");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

if (@$_REQUEST["ejecutar_accion"]) {
	if (!@$_REQUEST["tipo_retorno"]) {
		$_REQUEST["tipo_retorno"] = 1;
	}
	if ($_REQUEST["tipo_retorno"]) {
		echo(json_encode($_REQUEST["ejecutar_accion"]()));
	} else {
		$_REQUEST["ejecutar_accion"]();
	}
}

function delete_listado_tarea() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al eliminar";
	$exito = 0;
	
	$sql3="DELETE FROM tareas_listado WHERE listado_tareas_fk=".$_REQUEST["idlistado_tareas"];
	phpmkr_query($sql3);
 
	$sql2 = "DELETE FROM listado_tareas WHERE idlistado_tareas=" . $_REQUEST["idlistado_tareas"];
	phpmkr_query($sql2) ;
	
	$retorno -> exito = 1;
	$retorno -> mensaje = "El listado de tareas eliminado con &eacute;xito";
	
	return ($retorno);
}

function asignar_permiso_listado_tarea() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al asignar el permiso";

	if (@$_REQUEST["idlistado_tareas"]) {
					
		$llaves_entidad = busca_filtro_tabla("distinct (idfuncionario) as idfuncionario", "funcionario", "idfuncionario IN(" . $_REQUEST["funcionarios"] . ")", "", $conn);
		
		$funcionarios_almacenados = extrae_campo($llaves_entidad, "idfuncionario");
		$vector_idlistado_tareas=explode(',',$_REQUEST["idlistado_tareas"]);
		
		for($i=0;$i<count($funcionarios_almacenados);$i++){
		
			$permisos_actuales = busca_filtro_tabla("A.fk_listado_tareas", "permiso_listado_tareas A", "A.fk_listado_tareas in(" . $_REQUEST["idlistado_tareas"] . ") AND A.entidad_identidad=1 AND A.llave_entidad=".$funcionarios_almacenados[$i], "", $conn);	
		
			if($permisos_actuales['numcampos']){
				$vector_permisos_actuales=extrae_campo($permisos_actuales, "fk_listado_tareas");
				$vector_permisos_asignar=array_diff($vector_idlistado_tareas,$vector_permisos_actuales);			
			}else{
				$vector_permisos_asignar=$vector_idlistado_tareas;
			}
			$vector_permisos_asignar=array_values($vector_permisos_asignar);
		
			for($j=0;$j<count($vector_permisos_asignar);$j++){
				$sql="insert into permiso_listado_tareas(entidad_identidad, fk_listado_tareas, llave_entidad, estado) values('1','".$vector_permisos_asignar[$j]."','".$funcionarios_almacenados[$i]."','1')";
				phpmkr_query($sql);
			}	
		}				

		$retorno -> exito = 1;
		$retorno -> mensaje = "Asignaciones realizadas con &eacute;xito";
	}
	return ($retorno);
}



function quitar_permiso_listado_tarea(){
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al quitar el permiso";

	if (@$_REQUEST["idlistado_tareas"]) { //QUITAR EL DISTINTO OJO
		$llaves_entidad = busca_filtro_tabla("distinct (idfuncionario) as idfuncionario", "funcionario", "idfuncionario IN(" . $_REQUEST["funcionarios"] . ")", "", $conn);
		$funcionarios_almacenados = extrae_campo($llaves_entidad, "idfuncionario");
		$cantidad_listados=explode(',',$_REQUEST["idlistado_tareas"]);
		
		for($i=0;$i<count($funcionarios_almacenados);$i++){
			$listas_creadas=busca_filtro_tabla('idlistado_tareas','listado_tareas','creador_lista='.$funcionarios_almacenados[$i],'',$conn);
			$vector_listas_creadas=extrae_campo($listas_creadas,'idlistado_tareas');
			$cadena_listado_tareas=$_REQUEST["idlistado_tareas"];
			$valor=explode(',',$cadena_listado_tareas);
			$longitud=count($valor);
			for($j=0;$j<$longitud;$j++){
				if($valor[$j]==''){
					unset($valor[$j]); 
				}
			}
			$valor=array_values($valor);
			$cadena_listado_tareas=implode(',',$valor);	
			$vector_listado_tareas=explode(',',$cadena_listado_tareas);
			$vector_listas_quitar=array_diff($vector_listado_tareas,$vector_listas_creadas);
			$cadena_listas_quitar=implode(',',$vector_listas_quitar);				

			$sql="DELETE FROM permiso_listado_tareas WHERE fk_listado_tareas IN(".$cadena_listas_quitar.") AND llave_entidad='".$funcionarios_almacenados[$i]."'; ";
			phpmkr_query($sql);	
		}			
		$retorno -> exito = 1;
		if(count($cantidad_listados)==1){
			$retorno -> mensaje = "Permiso eliminado con &eacute;xito";
		}else{
			$retorno -> mensaje = "Permisos eliminados con &eacute;xito";
		}	
	}
	return ($retorno);	
}


/*
function asignar_permiso_listado_tarea() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al asignar el permiso";

	if (@$_REQUEST["idlistado_tareas"]) {
		$llaves_entidad = busca_filtro_tabla("distinct (idfuncionario) as idfuncionario", "funcionario", "idfuncionario IN(" . $_REQUEST["funcionarios"] . ")", "", $conn);
		$funcionarios_almacenados = extrae_campo($llaves_entidad, "idfuncionario");
	
		$datos = busca_filtro_tabla("A.llave_entidad", "permiso_listado_tareas A", "A.fk_listado_tareas in(" . $_REQUEST["idlistado_tareas"] . ") AND A.entidad_identidad=1", "", $conn);
		$datos_array = extrae_campo($datos, "llave_entidad", "U");

		$quitar = array_diff($datos_array, $funcionarios_almacenados);
		$quitar = array_merge($quitar);

		$adicionales = array_diff($funcionarios_almacenados, $datos_array);
		$adicionales = array_merge($adicionales);

		$cantidad_eliminar = count($quitar);
		$cantidad_adicionar = count($adicionales);

		if ($cantidad_eliminar) {
			$sql1 = "DELETE FROM permiso_listado_tareas WHERE fk_listado_tareas in (" . $_REQUEST["idlistado_tareas"] . ") AND entidad_identidad=1 AND llave_entidad IN(" . implode(",", $quitar) . ")";
			phpmkr_query($sql1);
		}

		$exito = 1;
		if ($cantidad_adicionar) {
			for ($i = 0; $i < $cantidad_adicionar; $i++) {
				asignar_permiso_listado($_REQUEST["idlistado_tareas"], "1", $adicionales[$i]);
			}
		}
		if ($exito) {
			$retorno -> exito = 1;
			$retorno -> mensaje = "Asignaciones realizadas con &eacute;xito";
		} else if ($exito == 0) {
			$retorno -> exito = 0;
			$retorno -> mensaje = "No se realizan asignaciones al listado de tareas";
		} else {
			$retorno -> exito = 0;
			$retorno -> mensaje = "Se realizan algunas asignaciones al listado de tareas, se presentan errores";
		}
	}
	return ($retorno);
}
*/
function seleccionar_todos_listado_tareas_ajax(){

	$listados=busca_filtro_tabla('a.idlistado_tareas','listado_tareas a left join permiso_listado_tareas p on a.idlistado_tareas=p.fk_listado_tareas and p.entidad_identidad=1','a.creador_lista='.usuario_actual('idfuncionario').' or p.llave_entidad='.usuario_actual('idfuncionario'),'',$conn);
	$listados_cadena=implode(',', extrae_campo($listados,'idlistado_tareas') );
	$retorno = new stdClass;
	$retorno-> listados_cadena = $listados_cadena;
	return($retorno);
}
?>