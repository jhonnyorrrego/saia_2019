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

@set_time_limit(0);
if (!@$_SESSION["LOGIN"]) {
	@session_start();
	$_SESSION["LOGIN"] = "0k";
	$_SESSION["usuario_actual"] = "1449";
}
include_once ($ruta_db_superior . "class_transferencia.php");

hallazgos();
function hallazgos($padre = '') {
	global $conn, $ruta_db_superior;
	$where = "";
	if ($padre != '') {
		$where .= " and ft_plan_mejoramiento=" . $padre . " ";
	}

	$hallazgos = busca_filtro_tabla("h.idft_hallazgo,h.consecutivo_hallazgo," . fecha_db_obtener("h.tiempo_seguimiento", "Y-m-d") . " as tiempo_seguimiento," . fecha_db_obtener("h.tiempo_cumplimiento", "Y-m-d") . " as tiempo_cumplimiento,h.deficiencia,dh.iddocumento,dh.numero,h.responsables,dp.numero as numero_plan,TO_DATE(TO_CHAR(h.tiempo_cumplimiento,'YYYY-MM-DD'),'YYYY-MM-DD')-TO_DATE('" . date('Y-m-d') . "','YYYY-MM-DD') as resta", "ft_plan_mejoramiento p,documento dp,ft_hallazgo h, documento dh", " p.documento_iddocumento=dp.iddocumento and dp.estado not in('ELIMINADO', 'ANULADO') and p.idft_plan_mejoramiento=h.ft_plan_mejoramiento and h.documento_iddocumento=dh.iddocumento and dh.estado not in('ELIMINADO', 'ANULADO', 'ACTIVO')" . $where . "and TO_DATE(TO_CHAR(h.tiempo_cumplimiento,'YYYY-MM-DD'),'YYYY-MM-DD')-TO_DATE('" . date('Y-m-d') . "','YYYY-MM-DD')>=0", "", $conn);
	for ($i = 0; $i < $hallazgos["numcampos"]; $i++) {
		$cumplimiento = busca_filtro_tabla("b.iddocumento", "ft_seguimiento a, documento b", "a.porcentaje>=100 and a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO', 'ACTIVO') and a.ft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], "", $conn);
		if (!$cumplimiento["numcampos"]) {
			//if ($hallazgos[$i]["resta"] >=0) {
			if ($hallazgos[$i]["resta"] == 15 || $hallazgos[$i]["resta"] == 10 || $hallazgos[$i]["resta"] == 5) {
				$contenido = "Saludos,<br/><br/>
        Por favor revisar el hallazgo con radicado No " . $hallazgos[$i]["numero"] . " del plan de mejoramiento No " . $hallazgos[$i]["numero_plan"] . ", esta a punto de vencerse o ya fue vencido, por favor dar cumplimiento a la accion de mejora propuesta.<br/><br/>
        <strong>Consecutivo del hallazgo:</strong> " . $hallazgos[$i]["consecutivo_hallazgo"] . "<br/>
        <strong>No Plan de Mejoramiento:</strong> " . $hallazgos[$i]["numero_plan"] . "<br/>
        <strong>Observaciones del hallazgo:</strong> " . html_entity_decode($hallazgos[$i]["deficiencia"]) . "<br/>
        <strong>Tiempo programado Cumplimiento:</strong> " . $hallazgos[$i]["tiempo_cumplimiento"] . "<br/>
        <strong>Tiempo programado Seguimiento:</strong> " . $hallazgos[$i]["tiempo_seguimiento"] . "<br/>";
				$responsables = traer_correos($hallazgos[$i]["responsables"]);
				if (count($responsables)) {
					enviar_mensaje("email", $responsables, $contenido, "e-interno", array(), "Vencimiento del hallazgo No " . $hallazgos[$i]["numero"], $hallazgos[$i]["iddocumento"]);
				}
			}
		}
	}
}

function traer_correos($valor) {
	global $conn;
	$emails = array();
	$vector = explode(",", str_replace("#", "d", $valor));
	$vector = array_unique($vector);
	sort($vector);
	foreach ($vector as $fila) {
		if (strpos($fila, 'd') > 0) {
			$datos = busca_filtro_tabla("b.email", "dependencia_cargo a, funcionario b", "dependencia_iddependencia=" . str_replace("d", "", $fila) . " and a.estado=1 and b.estado=1 and a.funcionario_idfuncionario=b.idfuncionario", "", $conn);
			$emails = array_merge($emails, extrae_campo($datos, "email"));
		} else {
			if ($pos = strpos($fila, "_"))
				$fila = substr($fila, 0, $pos);
			$datos = busca_filtro_tabla("email", "funcionario", "funcionario_codigo='" . $fila . "'", "", $conn);
			$emails[] = $datos[0]["email"];
		}
	}
	return $emails;
}

@session_unset();
@session_destroy();
?>