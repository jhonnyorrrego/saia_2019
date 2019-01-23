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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

$texto = "";
$sExport = "csv";
if ($_REQUEST["iddoc"]) {
	$nombre_archivo = 'formato_' . date('Y--') . '_f23_cgr';
	$archivo = escapeshellcmd(strip_tags(strtoupper($nombre_archivo)));
	header('Content-type: text/html; charset=utf-8');
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=' . $archivo . '.csv');
	header("Cache-Control: must-revalidate, post-check=1, pre-check=0");
	$caracter_csv = ",";
	$plan = busca_filtro_tabla("idft_plan_mejoramiento", "ft_plan_mejoramiento", "documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);

	$datos = busca_filtro_tabla("A.clase_observacion,A.deficiencia,A.secretarias,A.procesos_vinculados,A.accion_mejoramiento,A.responsables,A.tiempo_cumplimiento,A.mecanismo_interno,A.tiempo_seguimiento,A.responsable_seguimiento,A.indicador_cumplimiento,A.observaciones,A.documento_iddocumento as hallazgo_iddoc", "ft_hallazgo A,documento C", "A.documento_iddocumento=C.iddocumento AND C.estado <>'ELIMINADO' AND C.estado<>'ANULADO' AND A.ft_plan_mejoramiento=" . $plan[0]["idft_plan_mejoramiento"], " documento_iddocumento asc", $conn);

	if ($datos["numcampos"]) {
		$cont_datos = count($datos[0]);
		$nom_col = array_keys($datos[0]);

		$texto .= '(N) Numero,(C) Clase De Observacion,(C) Descripcion Observacion Formulada Por La Cgr,(C) Areas Ciclos O Procesos Involucrados,(C) Acciones De Mejoramiento,(C) Responsable Del Mejoramiento,(F) Tiempo Programado Para El Cumplimiento De Las Acciones De Mejoramiento,(C) Mecanismo De Seguimiento Interno Adoptado Por La Entidad (Actividad),(C) Mecanismo De Seguimiento Interno Adoptado Por La Entidad (Tiempo),(C) Responsable Del Seguimiento Por La Entidad,(C) Indicador De Accion De Cumplimiento,(C) Observaciones' . "\n";
		$numcols = count($nom_col);

		$idformato_hallazgo_plan_mejoramiento = busca_filtro_tabla("idformato", "formato", "nombre='hallazgo'", "", $conn);

		for ($i = 0; $i < $datos["numcampos"]; $i++) {
			for ($j = 1; $j < ($numcols - 1); $j += 2) {
				if ($sExport == "csv") {
					if ($nom_col[$j] == "tiempo_seguimiento" || $nom_col[$j] == "tiempo_cumplimiento") {
						$valor = mostrar_valor_campo($nom_col[$j], $idformato_hallazgo_plan_mejoramiento[0]['idformato'], $datos[$i]["hallazgo_iddoc"], 1);
						if ($valor == 'null') {
							$valor = '" "';
						}
						$texto1 = str_replace('-', '/', $valor);
					} else if ($nom_col[$j] == "secretarias") {

						$valor1 = str_replace("&nbsp;", "", htmlspecialchars_decode(str_replace(",", ";", mostrar_valor_campo($nom_col[$j], $idformato_hallazgo_plan_mejoramiento[0]['idformato'], $datos[$i]["hallazgo_iddoc"], 1))));
						$valor1 = trim(strip_tags(html_entity_decode($valor1)));
						$valor1 = str_replace("\n", "", $valor1);
						$valor1 = str_replace("'", '"', $valor1);
						$valor1 = str_replace('"', '""', $valor1);
						$j += 2;
						$valor2 = str_replace("&nbsp;", "", htmlspecialchars_decode(str_replace(",", ";", procesos_vinculados_funcion2($datos[$i]["hallazgo_iddoc"]))));
						$valor2 = trim(strip_tags(html_entity_decode($valor2)));
						$valor2 = str_replace("\n", "", $valor2);
						$valor2 = str_replace("'", '"', $valor2);
						$valor2 = str_replace('"', '""', $valor2);
						$texto1 = '"' . $valor1 . ", " . $valor2 . '"';
					} else {

						$texto1 = str_replace("&nbsp;", "", htmlspecialchars_decode(str_replace(",", ";", mostrar_valor_campo($nom_col[$j], $idformato_hallazgo_plan_mejoramiento[0]['idformato'], $datos[$i]["hallazgo_iddoc"], 1))));
						$texto1 = trim(strip_tags(decodifica_encabezado(html_entity_decode($texto1))));
						$texto1 = str_replace("\n", "", $texto1);
						$texto1 = str_replace("'", '"', $texto1);
						$texto1 = str_replace('"', '""', $texto1);
						if ($texto1 == "" || $texto1 == "null") {
							$texto1 = " ";
						}
						$texto1 = '"' . $texto1 . '"';

					}
					if ($j == 1) {
						$consecutivo = busca_filtro_tabla("A.consecutivo_hallazgo", "ft_hallazgo A,documento C", "A.documento_iddocumento=C.iddocumento AND C.estado <>'ELIMINADO' AND C.estado<>'ANULADO' AND A.ft_plan_mejoramiento=" . $plan[0]["idft_plan_mejoramiento"], "documento_iddocumento asc", $conn);
						$texto .= ($consecutivo[$i]["consecutivo_hallazgo"]) . ',' . $texto1;
					} else {
						$texto .= $caracter_csv . $texto1;
					}
				}
			}
			$texto .= "\n";
		}
	}
}
echo(trim(codifica_encabezado($texto)));

function procesos_vinculados_funcion2($iddoc) {
	global $conn;
	$datos = busca_filtro_tabla("procesos_vinculados", "ft_hallazgo a", "a.documento_iddocumento=" . $iddoc, "", $conn);
	$procesos = explode(",", $datos[0]["procesos_vinculados"]);
	$cant = count($procesos);
	$nombres = array();
	for ($i = 0; $i < $cant; $i++) {
		if ($procesos[$i] != '') {
			if ($procesos[$i][0] != 'm') {
				$proceso = busca_filtro_tabla("nombre", "ft_proceso a", "a.idft_proceso='" . trim($procesos[$i]) . "'", "", $conn);
				$nombres[] = $proceso[0]["nombre"];
			} else {
				$proceso = busca_filtro_tabla("nombre", "ft_macroproceso_calidad a", "a.idft_macroproceso_calidad='" . str_replace("m", "", trim($procesos[$i])) . "'", "", $conn);
				$nombres[] = $proceso[0]["nombre"];
			}
		}
	}
	return implode(", ", $nombres);
}
?>