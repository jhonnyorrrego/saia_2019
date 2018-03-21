<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "bpmn/bpmn/class_bpmn.php");


function validar_ruta_documento_flujo_eliminar($iddoc, $idformato) {
	//ELIMINAR FUNCION
	//Debe definir el valor de la ruta siguiente a traves de las actividades de los pasos en el flujo
	$paso_actual = busca_filtro_tabla("", "paso_documento A, paso_actividad B, accion C", "B.estado=1 AND A.paso_idpaso=B.paso_idpaso AND B.accion_idaccion=C.idaccion AND A.documento_iddocumento=" . $iddoc . " AND A.estado_paso_documento IN(4,5,6,7) AND (C.nombre LIKE 'confirmar' OR C.nombre LIKE 'aprobar')", "", $conn);
}

function validar_accion_siguiente_paso($iddoc, $accion, $idformato, $momento) {
	global $debug;
	//ELIMINAR FUNCION
	$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $iddoc, "", $conn);
	//Se verifica que el documento no este aprobado
	if ($documento["numcampos"] && !$documento[0]["numero"]) {
		$paso_actual = busca_filtro_tabla("", "paso_documento A", "A.documento_iddocumento=" . $iddoc . " AND A.estado_paso_documento IN(4,5,6,7)", "", $conn);
		if ($paso_actual["numcampos"]) {
			$bpmn = new bpmn();
			$diagrama = busca_filtro_tabla("", "diagram_instance", "iddiagram_instance=" . $paso_actual[0]["diagram_iddiagram_instance"], "", $conn);
			$bpmn -> get_bpmn($diagrama[0]["diagram_iddiagram"]);
			$bpmn -> verificar_bpmn($paso_actual[0]["diagram_iddiagram_instance"], $paso_actual[0]["idpaso_documento"]);
			$bpmn -> get_condicionales_bpmn();
			for ($i = 0; $i < $bpmn -> condicionales["numcampos"]; $i++) {
				//definir si existen otros tipos de condicional o solo se tiene en cuenta el condicional exclusivo
				if ($bpmn -> condicionales[$i]["tipo_condicional"] == "exclusivegateway") {
					$bpmn -> validar_estado_condicional($bpmn -> condicionales[$i]);
				}
			}
			//Buscar el paso siguiente al paso actual si el paso actual esta en 0 y validar el condicional para los pasos siguientes
			//$bpmn->tarea_siguiente($paso_actual[][]);
			//Se deben volver a calcular los pasos posterior a que se inactivan por el condicional
			$paso_actual = busca_filtro_tabla("", "paso_documento A, paso_actividad B, accion C", "B.estado=1 AND A.paso_idpaso=B.paso_idpaso AND B.accion_idaccion=C.idaccion AND A.documento_iddocumento=" . $iddoc . " AND A.estado_paso_documento IN(4,5,6,7) AND (C.nombre LIKE 'confirmar' OR C.nombre LIKE 'aprobar')", "", $conn);
			if ($paso_actual["numcampos"] && $momento == 'ANTERIOR') {
				for ($i = 0; $i < $paso_actual["numcampos"]; $i++) {
					$funcionario = busca_filtro_tabla("", "vfuncionario_dc", "idcargo=" . $paso_actual[$i]["llave_entidad"] . " AND estado_dc=1 AND estado=1", "", $conn);
					if ($funcionario["numcampos"]) {
						adicionar_ruta_documento_paso($iddoc, $funcionario, $paso_actual[0]["idpaso_actividad"]);
					}
				}
			}
		}
	}
	if (@$debug == 1) {
		alerta("ALERTA DE ESPERA " . $momento . " " . $accion);
	}
}

function adicionar_ruta_documento_paso($iddoc, $funcionario, $paso_actividad) {
	//ELIMINAR FUNCION
	$ruta_actual = busca_filtro_tabla("", "ruta", "documento_iddocumento=" . $iddoc, "", $conn);
	$radicador_salida = busca_filtro_tabla("", "configuracion A, vfuncionario_dc B", "A.valor=B.login AND A.nombre='radicador_salida'", "", $conn);
	if (!$ruta_actual["numcampos"]) {
		//Si no existe ruta se busca el funcionario que tiene pendiente el documento
		$por_aprobar_inicial = busca_filtro_tabla("", "buzon_entrada", "archivo_idarchivo=" . $iddoc . " AND nombre='POR_APROBAR'", "", $conn);
		if ($por_aprobar_inicial["numcampos"]) {
			if ($por_aprobar_inicial[0]["origen"] == $radicador_salida[0]["funcionario_codigo"]) {
				$origen_por_aprobar = busca_filtro_tabla("", "vfuncionario_dc", "funcionario_codigo=" . $por_aprobar_inicial[0]["destino"] . " AND estado_dc=1 AND estado=1", "", $conn);
				$sql2 = "INSERT INTO ruta(origen,tipo, destino, condicion_transferencia, documento_iddocumento, fecha, tipo_origen, tipo_destino, obligatorio, restrictivo, clase, idenlace_nodo) VALUES(" . $origen_por_aprobar[0]["iddependencia_cargo"] . ",'ACTIVO'," . $funcionario[0]["iddependencia_cargo"] . ",'POR_APROBAR'," . $iddoc . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ",5,5,1,0,1)";
				phpmkr_query($sql2);
				$idruta = phpmkr_insert_id();
				$sql2 = "UPDATE buzon_entrada SET origen=" . $funcionario[0]["funcionario_codigo"] . ",ruta_idruta=" . $idruta . " WHERE idtransferencia=" . $por_aprobar_inicial[0]["idtransferencia"];
				phpmkr_query($sql2);
				$sql2 = "INSERT INTO ruta(origen,tipo, destino, condicion_transferencia, documento_iddocumento, fecha, tipo_origen, tipo_destino, obligatorio, restrictivo, clase) VALUES(" . $funcionario[0]["iddependencia_cargo"] . ",'ACTIVO'," . $radicador_salida[0]["funcionario_codigo"] . ",'POR_APROBAR'," . $iddoc . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ",5,1,1,0,1," . $paso_actividad . ")";
				phpmkr_query($sql2);
				$idruta2 = phpmkr_insert_id();
				$sql2 = "INSERT INTO buzon_entrada(archivo_idarchivo, nombre, destino, tipo_origen, fecha, origen, tipo_destino, notas, activo,ruta_idruta) VALUES(" . $iddoc . ",'POR_APROBAR'," . $funcionario[0]["funcionario_codigo"] . ",1," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . "," . $radicador_salida[0]["funcionario_codigo"] . ",1,'{paso_actividad:" . $paso_actividad . "}',1," . $idruta2 . ")";
				phpmkr_query($sql2);
			}
		}
	} else if ($ruta[0]["idenlace_nodo"] != $paso_actividad) {
		//Se adiciona la ruta al final del documento , se debe tener en cuenta que no debe tener rutas el documento
		$por_aprobar_activo = busca_filtro_tabla("", "buzon_entrada", "archivo_idarchivo=" . $iddoc . " AND nombre='POR_APROBAR' AND activo=1 AND ruta_idruta<>0", "", $conn);
		if ($por_aprobar_activo["numcampos"]) {
			if ($por_aprobar_activo[0]["origen"] == $radicador_salida[0]["funcionario_codigo"]) {
				$origen_por_aprobar = busca_filtro_tabla("", "vfuncionario_dc", "funcionario_codigo=" . $por_aprobar_activo[0]["destino"] . " AND estado_dc=1 AND estado=1", "", $conn);
				$sql2 = "UPDATE buzon_entrada SET destino=" . $funcionario[0]["funcionario_codigo"] . " WHERE idtransferencia=" . $por_aprobar_activo[0]["idtransferencia"];
				phpmkr_query($sql2);
				$sql2 = "UPDATE ruta SET destino=" . $funcionario[0]["iddependencia_cargo"] . ",tipo_destino=5 WHERE idruta=" . $por_aprobar_activo[0]["ruta_idruta"] . " AND documento_iddocumento=" . $iddoc;
				phpmkr_query($sql2);
				$sql2 = "INSERT INTO ruta(origen,tipo, destino, condicion_transferencia, documento_iddocumento, fecha, tipo_origen, tipo_destino, obligatorio, restrictivo, clase,idenlace_nodo) VALUES(" . $funcionario[0]["iddependencia_cargo"] . ",'ACTIVO'," . $radicador_salida[0]["funcionario_codigo"] . ",'POR_APROBAR'," . $iddoc . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ",5,1,1,0,1," . $paso_actividad . ")";
				phpmkr_query($sql2);
				$idruta2 = phpmkr_insert_id();
				$sql2 = "INSERT INTO buzon_entrada(archivo_idarchivo, nombre, destino, tipo_origen, fecha, origen, tipo_destino, notas, activo,ruta_idruta) VALUES(" . $iddoc . ",'POR_APROBAR'," . $funcionario[0]["funcionario_codigo"] . ",1," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . "," . $radicador_salida[0]["funcionario_codigo"] . ",1,'{paso_actividad:" . $paso_actividad . "}',1," . $idruta2 . ")";
				phpmkr_query($sql2);
			}
		}

	}
}

function validar_confirmacion_documento($iddoc, $idformato, $accion, $momento) {
	global $conn;
	$ruta = busca_filtro_tabla("", "buzon_entrada A, ruta B", "A.ruta_idruta=B.idruta AND A.archivo_idarchivo=" . $iddoc . " AND A.nombre='POR_APROBAR' AND A.origen=-1 AND A.activo=1 AND A.destino=" . usuario_actual("funcionario_codigo"), "B.idruta ASC", $conn);
	echo("<hr>Accion: $accion<hr>");
	if ($ruta["numcampos"]) {
		//se debe garantizar calcular el paso siguiente si existe una condicional cuando se tiene un paso con 2 opciones
		//actualizar_ruta_documento($ruta[0]["idruta"],$iddoc,$idformato);
		/*$funcionario_origen=busca_filtro_tabla("",);
		 $sql=*/
	}
}

function actualizar_ruta_documento($idruta, $iddoc, $idformato) {
	global $conn, $debug;
	die("NOOOOOOOOOOOO!!!!!!!!");
	$paso_actual = busca_filtro_tabla("", "paso_documento", "documento_iddocumento=" . $iddoc, "idpaso_documento DESC", $conn);
	if ($paso_actual["numcampos"]) {
		$bpmn = new bpmn();
		$diagrama = busca_filtro_tabla("", "diagram_instance", "iddiagram_instance=" . $paso_actual[0]["diagram_iddiagram_instance"], "", $conn);
		$bpmn -> get_bpmn($diagrama[0]["diagram_iddiagram"]);
		$bpmn -> verificar_bpmn($paso_actual[0]["diagram_iddiagram_instance"], $paso_actual[0]["idpaso_documento"]);
		$bpmn -> bpmni -> get_bpmni($diagrama[0]["diagram_iddiagram_instance"]);
		$bpmn -> dibuja_bpmn();
	}
	if ($debug == 1) {
		echo("PARAMETROS FUNCION ------->>" . $idruta . "-->>" . $iddoc . "--->>" . $idformato . "<hr>");
		echo("<hr>");
	}
	$ruta_modificar = busca_filtro_tabla("", "ruta", "documento_iddocumento=" . $iddoc . " AND idruta=" . $idruta . " AND destino=-1", "", $conn);
	if ($debug == 1) {
		echo("RUTA MODIFICADA ---->");
		print_r($ruta_modificar);
		echo("<hr>SQL------->");
	}
	if ($ruta_modificar["numcampos"]) {
		$ruta_modificar2 = busca_filtro_tabla("", "ruta", "documento_iddocumento=" . $iddoc . " AND orden=" . ($ruta_modificar[0]["orden"] + 1), "", $conn);
		if ($debug == 1) {
			echo("RUTA MODIFICADA 2---->");
			print_r($ruta_modificar2);
			echo("<hr>SQL------->");
		}
		if ($ruta_modificar2["numcampos"] && $ruta_modificar2[0]["origen"] == -1 && $ruta_modificar2[0]["idenlace_nodo"]) {
			$paso_actual = busca_filtro_tabla("", "paso_documento A, paso_actividad B, accion C", "B.estado=1 AND A.paso_idpaso=B.paso_idpaso AND A.documento_iddocumento=" . $iddoc . " AND estado_paso_documento IN (4,5,6,7) AND B.accion_idaccion=C.idaccion AND (C.nombre LIKE 'confirmar%' || C.nombre LIKE 'aprobar%')", "", $conn);
			if ($debug == 1) {
				echo("PASO ACTUAL---->");
				print_r($paso_actual);
				echo("<hr>");
			}
			//se debe garantizar que en el paso_actividad siempre va un cargo
			$funcionario_ruta_siguiente = busca_filtro_tabla("", "vfuncionario_dc A, paso_actividad B", "B.estado=1 AND A.idcargo=B.llave_entidad AND B.idpaso_actividad=" . $ruta_modificar2[0]["idenlace_nodo"], "", $conn);
			if ($debug == 1) {
				echo("FUNCIONARIO ---->");
				print_r($funcionario_ruta_siguiente);
				echo("<hr>");
			}
			if ($funcionario_ruta_siguiente["numcampos"]) {
				$sql2 = "UPDATE ruta SET destino=" . $funcionario_ruta_siguiente[0]["iddependencia_cargo"] . " , tipo_destino=5 WHERE idruta=" . $ruta_modificar[0]["idruta"];
				phpmkr_query($sql2);
				if ($debug == 1) {
					echo($sql2 . "<hr>");
				}
				$sql2 = "UPDATE buzon_entrada SET origen=" . $funcionario_ruta_siguiente[0]["funcionario_codigo"] . " WHERE ruta_idruta=" . $ruta_modificar[0]["idruta"] . " AND nombre='POR_APROBAR'";
				phpmkr_query($sql2);
				if ($debug == 1) {
					echo($sql2 . "<hr>");
				}
				$sql2 = "UPDATE ruta SET origen=" . $funcionario_ruta_siguiente[0]["iddependencia_cargo"] . " , tipo_origen=5 WHERE idruta=" . $ruta_modificar2[0]["idruta"];
				phpmkr_query($sql2);
				if ($debug == 1) {
					echo($sql2 . "<hr>");
				}
				$sql2 = "UPDATE buzon_entrada SET destino=" . $funcionario_ruta_siguiente[0]["funcionario_codigo"] . " WHERE ruta_idruta=" . $ruta_modificar2[0]["idruta"] . " AND nombre='POR_APROBAR'";
				phpmkr_query($sql2);
				if ($debug == 1) {
					echo($sql2 . "<hr>");
				}
			}
		}
	}
}

function crear_posible_ruta_documento($iddoc, $idformato, $accion, $momento) {
	$paso_actual = busca_filtro_tabla("", "paso_documento", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($paso_actual["numcampos"]) {
		$bpmn = new bpmn();
		$diagrama = busca_filtro_tabla("", "diagram_instance", "iddiagram_instance=" . $paso_actual[0]["diagram_iddiagram_instance"], "", $conn);
		$bpmn -> get_bpmn($diagrama[0]["diagram_iddiagram"]);
		$bpmn -> verificar_bpmn($paso_actual[0]["diagram_iddiagram_instance"], $paso_actual[0]["idpaso_documento"]);
		$bpmn -> crear_posible_ruta($iddoc);
	}
}
?>