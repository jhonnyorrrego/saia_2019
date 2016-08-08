<?php
@set_time_limit(0);
if (!@$_SESSION["LOGIN"]) {
	@session_start();
	$_SESSION["LOGIN"] = "0k";
	$_SESSION["usuario_actual"] = "1449";
}
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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "class_transferencia.php");

$planes_mejoramiento = busca_filtro_tabla("b.iddocumento, C.idformato, A.aprobado, A.revisado, B.numero", "ft_plan_mejoramiento A, documento B, formato C", "A.documento_iddocumento=B.iddocumento AND LOWER(B.plantilla) LIKE C.nombre AND B.estado not in ('ELIMINADO','ANULADO') AND (TO_DATE(sysdate, 'dd/mm/yyyy')-TO_DATE(B.fecha_creacion, 'dd/mm/yyyy')) =15", "b.fecha_creacion DESC", $conn);

$dependencia = busca_filtro_tabla("A.nombre AS dependencia, C.funcionario_codigo, C.nombres, C.apellidos", "dependencia A, dependencia_cargo B, funcionario C,cargo D", "LOWER(A.nombre) LIKE'direccion de control interno' AND A.iddependencia=B.dependencia_iddependencia AND LOWER(D.nombre) LIKE'profesional universitario grado 22'  AND  C.idfuncionario=B.funcionario_idfuncionario AND D.idcargo=B.cargo_idcargo AND A.estado=1 AND B.estado=1 AND C.estado=1", "", $conn);

$nota = array('encabezado' => date('Y-m-d H:i:s'), 'cuerpo' => '', 'sql' => 'consulta ejecutada ' . $planes_mejoramiento['sql']);
$cuerpo = array();
$control_interno = extrae_campo($dependencia, "funcionario_codigo", "U");
for ($i = 0; $i < $planes_mejoramiento['numcampos']; $i++) {

	/*$planes_mejoramiento[$i]['revisado'] = explode(',', $planes_mejoramiento[$i]['revisado']);
	$array_responsable_revision = retornar_funcionario_codigo($planes_mejoramiento[$i]['revisado']);

	$planes_mejoramiento[$i]['aprobado'] = explode(',', $planes_mejoramiento[$i]['aprobado']);
	$array_responsable_aprobacion = retornar_funcionario_codigo($planes_mejoramiento[$i]['aprobado']);*/

	//725 -> JAMES SEPULVEDA OVIEDO
	//110 -> Elsa Ximena Loaiza Rodriguez
	$array_responsable = array(110);
	foreach ($array_responsable as $funcionario_codigo) {
		transferencia_automatica($planes_mejoramiento[$i]['idformato'], $planes_mejoramiento[$i]['iddocumento'], $funcionario_codigo . "@", 3, 'El documento esta vencido o por vencerce');
		$cuerpo[] = "*se transfiere el documento plan de mejoramiento No " . $planes_mejoramiento[$i]['numero'] . " con iddocumento igual a " . $planes_mejoramiento[$i]['iddocumento'] . " al siguiente funcionario_codigo " . $funcionario_codigo . " con notificacion para revision.\n";
	}

	/*foreach ($array_responsable_revision as $funcionario_codigo) {
		transferencia_automatica($planes_mejoramiento[$i]['idformato'], $planes_mejoramiento[$i]['iddocumento'], $funcionario_codigo . "@", 3, 'El documento esta vencido o por vencerce');
		$cuerpo[] = "*se transfiere el documento plan de mejoramiento No " . $planes_mejoramiento[$i]['numero'] . " con iddocumento igual a " . $planes_mejoramiento[$i]['iddocumento'] . " al siguiente funcionario_codigo " . $funcionario_codigo . " con notificacion para revision.\n";
	}

	foreach ($array_responsable_aprobacion as $funcionario_codigo) {
		transferencia_automatica($planes_mejoramiento[$i]['idformato'], $planes_mejoramiento[$i]['iddocumento'], $funcionario_codigo . "@", 3, 'El documento esta vencido o por vencerce');
		$cuerpo[] = "*se transfiere el documento plan de mejoramiento No " . $planes_mejoramiento[$i]['numero'] . " con iddocumento igual a " . $planes_mejoramiento[$i]['iddocumento'] . " al siguiente funcionario_codigo " . $funcionario_codigo . " con notificacion para probacion.\n";
	}

	foreach ($control_interno as $funcionario_codigo) {
		transferencia_automatica($planes_mejoramiento[$i]['idformato'], $planes_mejoramiento[$i]['iddocumento'], $funcionario_codigo . "@", 3, 'El documento esta vencido o por vencerce');
		$cuerpo[] = "*se transfiere el documento plan de mejoramiento No " . $planes_mejoramiento[$i]['numero'] . " con iddocumento igual a " . $planes_mejoramiento[$i]['iddocumento'] . " al siguiente funcionario_codigo " . $funcionario_codigo . " con notificacion para control interno.\n ---------------------------------------- \n";
	}*/
}

$nota['cuerpo'] = $cuerpo;
$log = fopen($ruta_db_superior . "tareas/tareas_administrativas_saia/exports/log_plan_mejoramiento.txt", "a+");
fwrite($log, $nota['encabezado'] . " \n ");
foreach ($nota['cuerpo'] AS $value) {
	fwrite($log, $value);
}
fwrite($log, $nota['sql'] . " \n %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% \n \n");
fclose($log);

function retornar_funcionario_codigo($array) {
	global $ruta_db_superior;
	foreach ($array as $fila) {
		if (strpos($fila, '#') > 0) {
			$ids = buscar_funcionarios_dependencia(str_replace("#", "", $fila));
		} else {
			if ($pos = strpos($fila, "_"))
				$fila = substr($fila, 0, $pos);
			$ids[] = ($fila);
		}
	}
	return ($ids);

}

function buscar_funcionarios_dependencia($dependencia, $arreglo = NULL) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "class_transferencia.php");
	$dependencias = dependencias($dependencia);

	array_push($dependencias, $dependencia);
	$dependencias = array_unique($dependencias);
	$funcionarios = busca_filtro_tabla("A.funcionario_codigo", "funcionario A,dependencia_cargo B, cargo C,dependencia D", "B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia=D.iddependencia and B.dependencia_iddependencia IN(" . implode(",", $dependencias) . ") AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1", "", $conn);

	$arreglo = extrae_campo($funcionarios, "funcionario_codigo", "U");
	return ($arreglo);
}

@session_unset();
@session_destroy();
?>