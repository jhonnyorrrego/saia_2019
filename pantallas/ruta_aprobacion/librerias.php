<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . FORMATOS_SAIA . "libreria/funciones_generales.php");

$idfun_actual = usuario_actual("idfuncionario");
if (isset($_REQUEST["ejecutar_funcion"])) {
	$_REQUEST["ejecutar_funcion"]();
}

function eliminar_resp_tarea() {
	global $conn;
	$retorno = array("exito" => 0, "msn" => "Error al Eliminar");
	if (isset($_REQUEST["idtarea"]) && $_REQUEST["idtarea"] != "") {
		$retorno["msn"] = "Error al Eliminar la tarea";
		$delete = "DELETE FROM tareas WHERE idtareas=" . $_REQUEST["idtarea"];
		phpmkr_query($delete) or die(json_encode($retorno));

		$retorno["msn"] = "Error al eliminar los avances de la tarea";
		$delete_avance = "DELETE FROM tareas_avance WHERE tareas_idtareas=" . $_REQUEST["idtarea"];
		phpmkr_query($delete) or die(json_encode($retorno));

		$retorno["msn"] = "Responsable Eliminado!";
		$retorno["exito"] = 1;
	} else {
		$retorno["msn"] = "No se recibieron los parametros";
	}
	echo json_encode($retorno);
	die();
}

function insertar_ruta_aprob() {
	global $conn, $idfun_actual,$ruta_db_superior;
	$retorno = array("exito" => 0, "msn" => "Error al guardar la informacion");
	if (isset($_REQUEST["responsables"]) && $_REQUEST["iddoc"] != "") {
		$asunto = htmlentities($_REQUEST["asunto"]);
		$insert = "INSERT INTO documento_ruta_aprob (documento_iddocumento, fecha_vencimiento, estado_ruta_aprob, idfunc_creador, aprobacion_en, asunto, descripcion) VALUES	(" . $_REQUEST["iddoc"] . ", " . fecha_db_almacenar($_REQUEST["fecha_vencimiento"], "Y-m-d") . ", 0, " . $idfun_actual . ", " . $_REQUEST["aprobacion_en"] . ", '" . $asunto . "', '" . htmlentities($_REQUEST["descripcion"]) . "');";
		$retorno["sql_ins"] = $insert;
		phpmkr_query($insert) or die(json_encode($retorno));
		$iddoc_ruta = phpmkr_insert_id();
		if ($iddoc_ruta) {
			$retorno["msn"] = "Error al actualizar las tareas";
			$update = "UPDATE tareas SET estado_tarea=-1, tarea='" . $asunto . "',fecha_tarea=" . fecha_db_almacenar($_REQUEST["fecha_vencimiento"], "Y-m-d") . ",ruta_aprob=" . $iddoc_ruta . " WHERE ruta_aprob=-1 and documento_iddocumento=" . $_REQUEST["iddoc"];
			phpmkr_query($update) or die(json_encode($retorno));
			$retorno["exito"] = 1;
			$retorno["msn"] = "";
			$tareas=busca_filtro_tabla("A.*,C.idformato","tareas A, documento B, formato C","A.documento_iddocumento=B.iddocumento AND lower(B.plantilla)=lower(C.nombre) AND A.ruta_aprob=".$iddoc_ruta,"orden_tareas ASC",$conn);
			//Para aprobacion en serie =1
			if($tareas["numcampos"]){
				include_once($ruta_db_superior."class_transferencia.php");
				if(@$_REQUEST["aprobacion_en"]==1){
					$retorno["msn"]="Error al actualizar la tarea (Serie)";
					$update="UPDATE tareas SET estado_tarea=0 WHERE idtareas=".$tareas[0]["idtareas"];
					phpmkr_query($update) or die(json_encode($retorno));
					transferencia_automatica($tareas[0]["idformato"],$tareas[0]["documento_iddocumento"],$tareas[0]["responsable"],1);
				}else{
					$retorno["msn"]="Error al actualizar la tarea (Paralelo)";
					$update="UPDATE tareas SET estado_tarea=0 WHERE ruta_aprob>0 and documento_iddocumento=".$tareas[0]["documento_iddocumento"];
					phpmkr_query($update) or die(json_encode($retorno));
					for($i=0;$i<$tareas["numcampos"];$i++){
						transferencia_automatica($tareas[$i]["idformato"],$tareas[$i]["documento_iddocumento"],$tareas[$i]["responsable"],1);
					}
				}
			}
		} else {
			$retorno["msn"] = "Error al obtener el iddocumento_ruta_aprob";
			$delete = "DELETE FROM documento_ruta_aprob WHERE documento_iddocumento=" . $_REQUEST["iddoc"] . " and idfunc_creador=" . $idfun_actual . " and estado_ruta_aprob =0 and asunto like '" . $asunto . "' and aprobacion_en=" . $_REQUEST["aprobacion_en"];
			phpmkr_query($delete) or die(json_encode($retorno));
		}
	}
	echo json_encode($retorno);
	die();
}
?>