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
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/graficos/librerias.php");
echo(librerias_jquery('1.7'));
echo(librerias_graficos());

/*MOSTRAR*/

function cargar_info_indicador($idformato, $iddoc) {
	global $conn, $datos;
	$datos = busca_filtro_tabla("p.nombre,d.estado,ic.fuente_datos,ic.idft_indicadores_calidad,tipo_grafico", "ft_proceso p,ft_indicadores_calidad ic, documento d", "p.idft_proceso=ic.ft_proceso and ic.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "", $conn);
}

function nombre_padre($idformato, $iddoc, $tipo = NULL) {
	global $datos;
	echo $datos[0]["nombre"];
}

function formula_calculo($idformato, $iddoc) {
	global $conn, $ruta_db_superior, $datos;
	$html = "";
	$formula = busca_filtro_tabla("f.idft_formula_indicador,f.observacion,f.nombre,f.unidad,d.iddocumento", "ft_formula_indicador f,documento d", "d.iddocumento=f.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and f.ft_indicadores_calidad=" . $datos[0]["idft_indicadores_calidad"], "", $conn);
	if ($formula["numcampos"]) {
		$idfor_segui = busca_filtro_tabla("idformato", "formato", "nombre='seguimiento_indicador'", "", $conn);
		$idfor_indicador = busca_filtro_tabla("idformato", "formato", "nombre='formula_indicador'", "", $conn);

		$html = '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
		<tr class="encabezado_list">
		  <td style="text-align:center;">Formula del calculo</td>
		  <td style="text-align:center;">Unidad</td>
		  <td style="text-align:center;">Naturaleza</td>
		  <td style="text-align:center;">Periodicidad</td>
		  <td style="text-align:center;">Descripci&oacute;n de variables</td>
		  <td style="text-align:center;">Seguimiento</td>
	  </tr>';

		for ($i = 0; $i < $formula["numcampos"]; $i++) {
			$html .= '<tr>
			<td>' . $formula[$i]["nombre"] . '</td>
			<td>' . $formula[$i]["unidad"] . '</td>
			<td>' . mostrar_valor_campo('naturaleza', $idfor_indicador[0]['idformato'], $formula[$i]["iddocumento"], 1) . '</td>
			<td>' . mostrar_valor_campo('periocidad', $idfor_indicador[0]['idformato'], $formula[$i]["iddocumento"], 1) . '</td>
			<td>' . $formula[$i]["observacion"] . '</td>
			<td><a href="' . $ruta_db_superior . 'formatos/seguimiento_indicador/adicionar_seguimiento_indicador.php?anterior=' . $formula[$i]["iddocumento"] . '&padre=' . $formula[$i]["idft_formula_indicador"] . '&idformato=' . $idfor_segui[0]["idformato"] . '&regresar=' . $iddoc . '">Registrar seguimiento indicador</a></td>
			</tr>';
		}
		$html .= '</table>';
	}
	echo $html;
}

function resultados_indicador($idformato, $iddoc) {
	global $conn, $ruta_db_superior, $datos;
	$html = "";
	$formulas = busca_filtro_tabla("nombre,idft_formula_indicador as id,unidad,rango_colores,tipo_rango", "ft_formula_indicador f,documento d", "d.iddocumento=f.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and f.ft_indicadores_calidad=" . $datos[0]["idft_indicadores_calidad"], "", $conn);
	if ($formulas["numcampos"]) {
		$configuracion_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal' AND tipo='ruta'", "", $conn);
		if ($configuracion_temporal["numcampos"]) {
			$ruta_temp = $configuracion_temporal[0]["valor"];
		}
		$ruta_grafico = $ruta_temp . "_" . $_SESSION['LOGIN' . LLAVE_SAIA] . "/" . $iddoc . "/";

		$colspan = 5;
		$td_html = "";
		if ($_REQUEST["tipo"] != 5) {
			$td_html .= '<td style="text-align:center;">Seguimiento Indicador</td>
			<td colspan="2" style="text-align:center;">Planes de Mejoramiento</td>';
			$colspan = 8;
		}

		for ($i = 0; $i < $formulas["numcampos"]; $i++) {
			$html .= '<table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
			<tr>
				<td class="encabezado_list" style="text-align:center" colspan="' . $colspan . '">SEGUIMIENTOS</td>
			</tr>		        
			<tr>
				<td class="encabezado_list" colspan="' . $colspan . '">Formula del Calculo: ' . $formulas[$i]["nombre"] . '</td>
			</tr>
			<tr class="encabezado_list">
				<td style="text-align:center;">Fecha</td>
				<td style="text-align:center;">Meta</td>
				<td style="text-align:center;">Resultado</td>
				<td style="text-align:center;">Cumplimiento</td>
				<td style="text-align:center;">Analisis de Datos</td>';
			$html .= $td_html . '</tr>';

			$rango = explode(",", $formulas[$i]["rango_colores"]);
			$dato = array();
			$dato2 = array();
			$dato3 = array();
			$dato4 = array();
			$dato5 = array();
			$array_colores = array();

			$seg = busca_filtro_tabla("f.*," . fecha_db_obtener("fecha_seguimiento", "Y-m-d") . " as fecha_seguimiento", "ft_seguimiento_indicador f,documento d", "documento_iddocumento=iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and ft_formula_indicador=" . $formulas[$i]["id"], "f.fecha_seguimiento", $conn);
			if ($seg["numcampos"]) {
				for ($j = 0; $j < $seg["numcampos"]; $j++) {
					$vector = explode(";", $seg[$j]["resultado"]);
					$formula2 = $formulas[$i]["nombre"];
					$formula2 = preg_replace_callback("([A-Za-z_]+[0-9]*)", create_function('$matches', 'return ("{".$matches[0]."}");'), $formula2);
					foreach ($vector as $fila) {$aux = explode(":", $fila);
						$formula2 = str_replace("{" . $aux[0] . "}", $aux[1], $formula2);
					}
					eval("\$respuesta=$formula2;");

					if ($formulas[0]["tipo_rango"] == 1) {
						$cumplimiento = number_format(($respuesta / $seg[$j]["meta_indicador_actual"]) * 100, 0, ".", "");
					} else if ($formulas[0]["tipo_rango"] == 0) {
						if ($respuesta <= $seg[$j]["meta_indicador_actual"]) {
							$cumplimiento = (1 + (($seg[$j]["meta_indicador_actual"] - $respuesta) / $seg[$j]["meta_indicador_actual"])) * 100;
						} else {
							$cumplimiento = (($seg[$j]["meta_indicador_actual"] - $respuesta) / $seg[$j]["meta_indicador_actual"]) * 100;
						}
					}
					if ($respuesta < $rango[0]) {
						if ($formulas[$i]["tipo_rango"] == "1")
							$color = "#FF4000";
						//ROJO
						else
							$color = "#00FF51";
						//VERDE
					} elseif ($respuesta >= $rango[0] && $respuesta <= $rango[1])
						$color = "#EAFF00";
					//AMARILLO
					else {
						if ($formulas[$i]["tipo_rango"] == "0")
							$color = "#FF4000";
						//ROJO
						else
							$color = "#00FF51";
						//VERDE
					}
					$html .= '<tr>
					<td style="text-align:center;">' . $seg[$j]["fecha_seguimiento"] . '</td>
					<td style="text-align:center;">' . $seg[$j]["meta_indicador_actual"] . $formulas[$i]["unidad"] . '</td>
					<td style="text-align:center;background:' . $color . '">' . $respuesta . $formulas[$i]["unidad"] . '</td>
					<td style="text-align:center;">' . $cumplimiento . '%</td>
					<td>' . $seg[$j]["observaciones"] . '</td>';

					if ($_REQUEST["tipo"] != 5) {
						$html .= '<td style="text-align:center;"><a class="highslide" onclick="return top.hs.htmlExpand(this, { objectType: \'iframe\',width: 875, height:400,preserveContent:false } )"  href="' . $ruta_db_superior . 'formatos/seguimiento_indicador/mostrar_seguimiento_indicador.php?menu_principal_inactivo=1&iddoc=' . $seg[$j]["documento_iddocumento"] . '">Ver</a></td>';
						$html .= '<td style="text-align:center;"><a target="detalles" href="../plan_mejoramiento/adicionar_plan_mejoramiento.php?seguimiento_indicador=' . $seg[$j]["idft_seguimiento_indicador"] . '">Adicionar Plan</a></td>
            <td style="text-align:center;"><a class="highslide" onclick="return top.hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )"  href="planes_relacionados.php?seguimiento_indicador=' . $seg[$j]["idft_seguimiento_indicador"] . '">Ver Planes</a></td>';
					}
					$html .= '</tr>';

					if (is_numeric($cumplimiento)) {
						array_push($dato, $cumplimiento);
						array_push($dato2, "Fecha:" . $seg[$j]["fecha_seguimiento"] . ", Valor: " . $cumplimiento . "%");
						array_push($dato3, $seg[$j]["fecha_seguimiento"] . "(" . $cumplimiento . "%)");
						array_push($array_colores, $color);
						array_push($dato4, $respuesta);
						array_push($dato5, $seg[$j]["fecha_seguimiento"] . "(" . $respuesta . "%)");
					}
				}
			}
			$html .= '<tr>
				<td colspan="' . $colspan . '">
					<b>Resultado:</b>
					<table class="table table-bordered" style="border-collapse: collapse; width: 50%;">
						<tr>
							<td bgcolor="#FF4000">Deficiente</td>
							<td bgcolor="#EAFF00">Satisfactorio</td>
							<td bgcolor="#00FF51">Sobresaliente</td>
						</tr>
					</table>
				</td>
			</tr>';

			if (empty($dato) || empty($dato2)) {
				$html .= "<tr><td colspan='" . $colspan . "'>No es posible generar un grafico, no se han generado seguimientos</td></tr>";
			} else {
				if (@$_REQUEST['tipo'] != 5) {
					$html .= ' <tr>
						<td colspan="' . $colspan . '">
							<div id="contenedor_grafico_pc_' . $formulas[$i]["id"] . '" style="height:300px;"></div>
							<br/>
							<div id="contenedor_grafico_rs_' . $formulas[$i]["id"] . '" style="height:300px;"></div>
						</td> 
					</tr>';

					if ($dato[0] != 0) {
						switch(trim($datos[0]["tipo_grafico"])) {
							case 'torta' :
								// -----> TORTA
								$configuracion_grafico = array();
								$configuracion_grafico['imagen'] = 1;
								$configuracion_grafico['titulo_grafico'] = 'CUMPLIMIENTO POR SEGUIMIENTO';
								$configuracion_grafico['subtitulo_grafico'] = '';
								$configuracion_grafico['contenedor'] = 'contenedor_grafico_pc_' . $formulas[$i]["id"];
								$configuracion_grafico['nombres'] = $dato2;
								$configuracion_grafico['valores'] = $dato;
								$configuracion_grafico['colores'] = $array_colores;
								generar_grafico_torta($configuracion_grafico);

								// -----> TORTA
								$configuracion_grafico = array();
								$configuracion_grafico['imagen'] = 1;
								$configuracion_grafico['titulo_grafico'] = 'RESULTADO POR SEGUIMIENTO';
								$configuracion_grafico['subtitulo_grafico'] = '';
								$configuracion_grafico['contenedor'] = 'contenedor_grafico_rs_' . $formulas[$i]["id"];
								$configuracion_grafico['nombres'] = $dato5;
								$configuracion_grafico['valores'] = $dato4;
								$configuracion_grafico['colores'] = $array_colores;
								generar_grafico_torta($configuracion_grafico);
								break;
							case 'barras' :
								// -----> BARRA
								$configuracion_grafico = array();
								$configuracion_grafico['contenedor'] = 'contenedor_grafico_pc_' . $formulas[$i]["id"];
								$configuracion_grafico['titulo_grafico'] = 'CUMPLIMIENTO POR SEGUIMIENTO';
								$configuracion_grafico['subtitulo_grafico'] = '';
								$configuracion_grafico['titulox'] = 'Seguimiento';
								$configuracion_grafico['tituloy'] = 'Cumplimiento';
								$configuracion_grafico['imagen'] = 1;
								$configuracion_grafico['color_saia'] = 1;
								$configuracion_grafico['nombres'] = $dato3;
								$configuracion_grafico['valores'] = array($dato);
								$configuracion_grafico['valores_nombre'] = array('Valores');
								$configuracion_grafico['colores'] = $array_colores;
								generar_grafico_barra($configuracion_grafico);

								// -----> BARRA
								$configuracion_grafico = array();
								$configuracion_grafico['contenedor'] = 'contenedor_grafico_rs_' . $formulas[$i]["id"];
								$configuracion_grafico['titulo_grafico'] = 'RESULTADO POR SEGUIMIENTO';
								$configuracion_grafico['subtitulo_grafico'] = '';
								$configuracion_grafico['titulox'] = 'Seguimiento';
								$configuracion_grafico['tituloy'] = 'Resultado';
								$configuracion_grafico['imagen'] = 1;
								$configuracion_grafico['color_saia'] = 1;
								$configuracion_grafico['nombres'] = $dato5;
								$configuracion_grafico['valores'] = array($dato4);
								$configuracion_grafico['valores_nombre'] = array('Valores');
								$configuracion_grafico['colores'] = $array_colores;
								generar_grafico_barra($configuracion_grafico);
								break;
							case 'lineas' :
								// -----> LINEA
								$configuracion_grafico = array();
								$configuracion_grafico['contenedor'] = 'contenedor_grafico_pc_' . $formulas[$i]["id"];
								$configuracion_grafico['titulo_grafico'] = 'CUMPLIMIENTO POR SEGUIMIENTO';
								$configuracion_grafico['subtitulo_grafico'] = '';
								$configuracion_grafico['titulox'] = 'Seguimiento';
								$configuracion_grafico['tituloy'] = 'Cumplimiento';
								$configuracion_grafico['imagen'] = 1;
								$configuracion_grafico['nombres'] = $dato3;
								$configuracion_grafico['valores'] = array($dato);
								$configuracion_grafico['valores_nombre'] = array('Valores');
								$configuracion_grafico['color_saia'] = 1;
								$configuracion_grafico['colores'] = $array_colores;
								generar_grafico_linea($configuracion_grafico);

								// -----> LINEA
								$configuracion_grafico = array();
								$configuracion_grafico['contenedor'] = 'contenedor_grafico_rs_' . $formulas[$i]["id"];
								$configuracion_grafico['titulo_grafico'] = 'RESULTADO POR SEGUIMIENTO';
								$configuracion_grafico['subtitulo_grafico'] = '';
								$configuracion_grafico['titulox'] = 'Seguimiento';
								$configuracion_grafico['tituloy'] = 'Resultado';
								$configuracion_grafico['imagen'] = 1;
								$configuracion_grafico['nombres'] = $dato5;
								$configuracion_grafico['valores'] = array($dato4);
								$configuracion_grafico['valores_nombre'] = array('Valores');
								$configuracion_grafico['color_saia'] = 1;
								$configuracion_grafico['colores'] = $array_colores;
								generar_grafico_linea($configuracion_grafico);
								break;
						}

						$datos_guardar = array();
						$datos_guardar['iddoc'] = $iddoc;
						$datos_guardar['nombre_imagen'] = 'total_evaluacion';
						$datos_guardar['extension'] = 'jpg';
						$datos_guardar['contenedor_grafico'] = 'contenedor_grafico_pc_' . $formulas[$i]["id"];
						guardar_grafico_temporal($datos_guardar);

						$datos_guardar = array();
						$datos_guardar['iddoc'] = $iddoc;
						$datos_guardar['nombre_imagen'] = 'competencias';
						$datos_guardar['extension'] = 'jpg';
						$datos_guardar['contenedor_grafico'] = 'contenedor_grafico_rs_' . $formulas[$i]["id"];
						guardar_grafico_temporal($datos_guardar);

					}
				} else {
					if (file_exists($ruta_db_superior . $ruta_grafico)) {
						$datos = explode(",", listado_directorio($ruta_db_superior . $ruta_grafico));
						$html .= '<tr><td colspan="' . $colspan . '">';
						for ($x = 0; $x < count($datos); $x++) {
							$html .= '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/' . $ruta_grafico . $datos[$x] . '" /><br/>';
						}
						$html .= '</td></tr>';
					}
				}
			}
			$html .= "</table>";
		}
	}
	echo $html;
}

function listado_directorio($directorio) {
	$html = array();
	if (chdir($directorio)) {
		foreach (scandir($directorio,1) as $elemento) {
			if (file_exists($elemento) && $elemento != "." && $elemento != "..") {
				$html[] .= $elemento;
			}
		}
	}
	return (implode(",", $html));
}
?>