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
include_once ($ruta_db_superior . "formatos/plan_mejoramiento/funciones.php");
include_once ($ruta_db_superior . "formatos/hallazgo/funciones.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_notificaciones.php");


function add_edit_informe_contraloria($idformato, $idcampo,$iddoc){
global $conn,$ruta_db_superior;
	echo(librerias_notificaciones());
	$funcionario = busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","lower(dependencia) like'direcci%n%control%interno%' and estado=1 and estado_dc=1 and funcionario_codigo=".usuario_actual("funcionario_codigo"),"",$conn);
	if($_REQUEST["iddoc"]){
		$opt=1;
		if(!$funcionario['numcampos'] && $_SESSION["LOGIN"]!="0k"){
			//notificaciones("<b>El formato solo se puede editar por los funcionario de la<br />dependencia de Direcci&oacute;n de Control Interno</b>","warning",11500);
			//volver(1);
			//die();
		}
	}else{
		$opt=0;
		if(!$funcionario['numcampos']){
		//	notificaciones("<b>El formato solo se puede diligenciar por los funcionario de la<br />dependencia de Direcci&oacute;n de Control Interno</b>","warning",11500);
		//	volver(1);
		//	die();
		}
		$datos=auditoria_hallazgos($idformato, $iddoc);
	}
	?>
	<script>
		$(document).ready(function(){
			var opt=parseInt(<?php echo $opt;?>);
			if(opt==0){
				$("#proceso_auditado").val("<?php echo($datos)?>");
			}
		});
	</script>	
	<?php
}


function porcentaje_plan($idformato, $idcampo, $iddoc = NULL, $informe = null) {
	global $conn;
	if ($_REQUEST["padre"] || $informe) {
		$iddoc = $_REQUEST["padre"];
		if ($informe) {
			$iddoc = $informe;
		}
		$hallazgos = busca_filtro_tabla("idft_hallazgo, a.documento_iddocumento as hallazgo_iddoc", "ft_hallazgo a, ft_plan_mejoramiento b,documento c", " a.ft_plan_mejoramiento= b.idft_plan_mejoramiento and a.documento_iddocumento= c.iddocumento AND a.ft_plan_mejoramiento=b.idft_plan_mejoramiento AND  a.documento_iddocumento=iddocumento and c.estado not in('ELIMINADO') and a.ft_plan_mejoramiento=" . $iddoc, "idft_hallazgo asc", $conn);
		
		for ($i = 0; $i < $hallazgos["numcampos"]; $i++) {
			$seguimientos = busca_filtro_tabla_limit("a.idft_seguimiento,a.porcentaje", "ft_seguimiento a, ft_hallazgo b, documento c", "a.documento_iddocumento=c.iddocumento and lower(c.estado) not in('eliminado','anulado') and b.idft_hallazgo =a.ft_hallazgo and b.idft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], " order by a.idft_seguimiento desc", intval(0), intval(1), $conn);
			$porcentage[] = $seguimientos[0]["porcentaje"];
		}
		$promedio = number_format((array_sum($porcentage) / sizeof($porcentage)), 2);
		if ($informe) {
			return ($promedio);
		} else {
			echo "<td><input type='text' name='cumplimiento_plan' value='" . $promedio . "' size='50'></td>";
		}
	} else {
		$porcentaje = busca_filtro_tabla("cumplimiento_plan", "ft_informe_contraloria", "documento_iddocumento=" . $iddoc, "", $conn);
		echo "<td><input type='text' name='cumplimiento_plan' value='" . $porcentaje[0]["cumplimiento_plan"] . "' size='50'></td>";
	}
}


function logo_contraloria() {
	echo '<img src="http://' . RUTA_PDF . '/imagenes/contraloria.jpg" alt="" />';
}

function listar_hallazgo_informe($idformato, $iddoc, $condicion = "") {
	global $conn;
	$formato = busca_filtro_tabla("", "formato A", "A.idformato=" . $idformato, "", $conn);
	if ($formato["numcampos"]) {
		$documento = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
	
	}
	
	if ($condicion == "" && $documento[0]["idft_plan_mejoramiento"]) {
		$condicion = " A.ft_plan_mejoramiento= b.idft_plan_mejoramiento and a.documento_iddocumento= c.iddocumento and A.estado<>'INACTIVO' and C.estado<>'ELIMINADO' AND A.ft_plan_mejoramiento=B.idft_plan_mejoramiento AND A.estado<>'INACTIVO' AND A.documento_iddocumento=iddocumento and C.estado<>'ELIMINADO' AND A.ft_plan_mejoramiento=" . $documento[0]["idft_plan_mejoramiento"];
	}
	if ($condicion != "") {
		$formato_hallazgo = busca_filtro_tabla("", "formato", "nombre LIKE '%hallazgo%'", "", $conn);
		$formato_seguimiento = busca_filtro_tabla("", "formato", "nombre LIKE '%seguimiento%'", "", $conn);
		
		$hallazgos = busca_filtro_tabla("A.*,B.*,A.documento_iddocumento as hallazgo_iddoc", "ft_hallazgo A, ft_plan_mejoramiento B,documento C", $condicion, "idft_hallazgo asc", $conn);
		
		if ($hallazgos["numcampos"]) {
			$texto .= "";
			$estado_actual = "Todos";
			if (@$_REQUEST["estado"]) {
				$estado_actual = $_REQUEST["estado"];
			}
			if (!isset($_REQUEST["tipo_impresion"]) && !$_REQUES["papel"] && !isset($_REQUEST["tipo"])) {
				$texto_enlaces .= '<table border="1px"  style="border-collapse:collapse;font-size:8pt">
      <tr>
      <!--td colspan="3" align="center" valign="middle">Estado Actual(' . ucfirst($estado_actual) . ')</td>
      <td colspan="3" align="center" valign="middle">Imprimir</td>
      </tr>
      <tr align=center>
      <td  align="center" valign="middle">
      <a href="' . genera_enlace_plan_mejoramiento() . '&estado=pendientes">Listado Pendientes</a>
      </td>
      <td align="center" valign="middle">
      <a href="' . genera_enlace_plan_mejoramiento() . '&estado=terminados" >Listado Terminados</a>
      </td>
      <td align="center" valign="middle">
      <a href="' . genera_enlace_plan_mejoramiento() . '">Todos</a>
      </td>
      <td align="center" valign="middle">
      <a href="../../html2ps/public_html/demo/html2ps.php?plan_mejoramiento=1&iddoc=' . $iddoc . '&tipo_impresion=1&font_size=5&papel=Legal&orientacion=1" target="_blank">Plan Auditoria<br />Interna</a>
      </td>
      <td align="center" valign="middle">
      <a href="../../html2ps/public_html/demo/html2ps.php?plan_mejoramiento=1&iddoc=' . $iddoc . '&tipo_impresion=2&font_size=6&papel=Legal&orientacion=1" target="_blank">Plan CGR<br />(No.20)</a>
      </td>
      <td>
      <a href="../plan_mejoramiento/mostrar_plan_mejoramiento.php?iddoc=' . $iddoc . '&idformato=1&export=excel&tipo_impresion=2" target="_blank">Plan CGR<br />(No.20) (Excel)</a>
      </td-->';

				$texto_enlaces .= '<td align="center" valign="middle"><a href="' . $ruta_db_superior . '/SAIA/saia/class_impresion.php?iddoc=' . $_REQUEST["iddoc"] . '" target="_blank">Generar<br>Informe PDF</a></td><td><a href="?iddoc=' . $_REQUEST["iddoc"] . '&idformato=1&export=excel&tipo_impresion=2" target="_blank">Generar<br>Informe (Excel)</a></td>';

				$texto_enlaces .= '</tr></table ><br />';
			}
			$texto .= '<pagebreak/>
    <table style="width:100%"><tr><td style="width: 2%;"></td><td style="width: 96%;"><table border="2px" cellpadding="5" style="border-collapse:collapse;font-size:6pt;width:100%" bordercolor="black">';
			$texto .= '<thead>
<tr class="encabezado_list">

<td  style="font-size: 8pt; width: 5%;" align="center" valign="middle">No</td>
<td style="font-size: 8pt; width: 16%;" align="center" valign="middle">DEFICIENCIA ADMINISTRATIVA</td>';

			$texto .= '<td style="font-size: 8pt; width: 22%;" align="center">COMPROMISOS DE<br>MEJORAMIENTO SUSCRITOS</td>
<td style="font-size: 8pt; width: 8%;" align="center">RESPONSABLE</td>
<td style="font-size: 8pt; width: 6%;" align="center">TERMINO</td>
<td style="font-size: 8pt; width: 8%;" align="center">INDICADORES DE CUMPLIMIENTO</td>
<td style="font-size: 8pt; width: 18%;" align="center" >LOGROS ALCANZADOS</td>
<td style="font-size: 8pt; width: 7%;">PORCENTAJE DE CUMPLIMIENTO</td>
<td style="font-size: 8pt; width: 10%;" align="center">OBSERVACIONES</td>
</thead><tbody>';
			$ingresa = 0;
			for ($i = 0, $j = 1; $i < $hallazgos["numcampos"]; $i++) {

				$porcentajes = busca_filtro_tabla_limit("a.idft_seguimiento,a.porcentaje", "ft_seguimiento a, ft_hallazgo b, documento c", "a.documento_iddocumento=c.iddocumento and lower(c.estado) not in('eliminado','anulado') and b.idft_hallazgo =a.ft_hallazgo and b.idft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], " order by a.idft_seguimiento desc", intval(0), intval(1), $conn);

				$seguimientos = busca_filtro_tabla("logros_alcanzados,observaciones", "ft_seguimiento a,documento b", "documento_iddocumento=iddocumento and b.estado<>'ELIMINADO' and ft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], "", $conn);
				$logros = array();
				$observaciones = "";
				
				if ($seguimientos['numcampos'] == 0) {
					$observaciones = " <br />";
				} else {
					for ($a = 0; $a < $seguimientos["numcampos"]; $a++) {
						if ($seguimientos[$a]["logros_alcanzados"]) {
							$logros[] = "<li>" . strip_tags(utf8_encode(html_entity_decode($seguimientos[$a]["logros_alcanzados"]))) . "</li>";
						}

						if ($seguimientos[$a]["observaciones"]) {
							$observaciones .= utf8_encode(html_entity_decode($seguimientos[$a]["observaciones"])) . "<br />";
						}
					}
				}

				if ((@$_REQUEST["estado"] == "pendientes" && $promedio[0]["total_porcentaje"] < 100) || (@$_REQUEST["estado"] == "terminados" && $promedio[0]["total_porcentaje"] >= 100) || (!@$_REQUEST["estado"])) {
					$ingresa = 1;

					$consecutivo = busca_filtro_tabla("A.consecutivo_hallazgo", "ft_hallazgo A", "A.documento_iddocumento=" . $hallazgos[$i]["hallazgo_iddoc"], "", $conn);

					$texto .= '<tr><td style="font-size: 8pt; " class="transparente" ><a class="abrir_higslide" ruta="formatos/hallazgo/mostrar_hallazgo.php?iddoc=' . $hallazgos[$i]["hallazgo_iddoc"] . '&idformato=' . $formato_hallazgo[0]["idformato"] . '" style="color: -webkit-link; text-decoration: underline;">&nbsp;' . $consecutivo[0]['consecutivo_hallazgo'] . ($i + 1) . '&nbsp;</a></td>';

					$texto .= '<td style="font-size: 8pt;" class="transparente" >' . mostrar_valor_campo("deficiencia", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1) . '</td>';

					//fin condicion encabezado
					$texto .= '<td style="font-size: 8pt;" class="transparente" >' . strip_tags(str_replace("&nbsp;", " ", mostrar_valor_campo("accion_mejoramiento", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1))) . '</td>';
					$idformato_hallazgo_plan_mejoramiento = busca_filtro_tabla("idformato","formatos","nombre='hallazgo'","",$conn);
					$campo_responsables=busca_filtro_tabla("idcampos_formato","campos_formato","nombre='responsables' AND formato_idformato=".$idformato_hallazgo_plan_mejoramiento[0]['idformato'],"",$conn);
					$texto .= '<td style="font-size: 8pt;" class="transparente" >' . strip_tags(mostrar_seleccionados($idformato_hallazgo_plan_mejoramiento[0]['idformato'], $campo_responsables[0]['idcampos_formato'], 0, $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';
					$texto .= '<td  style="font-size: 8pt;" class="transparente" align="center">' . strip_tags(mostrar_valor_campo("tiempo_cumplimiento", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';

					$texto .= '<td style="font-size: 8pt;" class="transparente">' . strip_tags(mostrar_valor_campo("indicador_cumplimiento", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';

					$texto .= '<td style="font-size: 8pt;" class="transparente"><ul>' . implode("", $logros) . '</ul></td>
           <td style="font-size: 8pt;" class="transparente" align="center"><a href="../plan_mejoramiento/seguimiento_list.php?idhallazgo=' . $hallazgos[$i]["idft_hallazgo"] . '" class="highslide" onclick="return hs.htmlExpand(this, { objectType: ' . "'" . 'iframe' . "'" . ',width: 400, height:250 } )">' . $porcentajes[0]["porcentaje"] . '% </a></td>
           <td style="font-size: 8pt;" class="transparente" >' . strip_tags($observaciones) . '</td>';
					$observaciones = '';

					$texto .= '</tr>';
					$j++;
				}
			}
			$texto .= '</tbody></table></td><td style="width: 2%;"></td></tr></table></div>';
		}
	}
	if (!$ingresa)
		$texto .= "<br /><br /><b>No se han definido hallazgos " . @$_REQUEST["estado"] . " para el plan de mejoramiento mostrado</b>";
	echo($texto_enlaces . $texto);
}

function mostrar_plan_mejoramiento_completo($idformato, $iddoc) {
	global $conn;
	$informe = busca_filtro_tabla("", "ft_informe_contraloria", "documento_iddocumento=" . $iddoc, "", $conn);
	$plan = busca_filtro_tabla("", "ft_plan_mejoramiento", "idft_plan_mejoramiento=" . $informe[0]["ft_plan_mejoramiento"], "", $conn);
	listar_hallazgo_informe(1, $plan[0]["documento_iddocumento"]);
}

function suscripcion_plan($idformato, $iddoc) {
	global $conn;
	$resultado = busca_filtro_tabla(fecha_db_obtener("fecha_suscripcion", "Y-m-d") . " as fecha,a.descripcion_plan", "ft_plan_mejoramiento a,ft_informe_contraloria ic", "idft_plan_mejoramiento=ft_plan_mejoramiento and ic.documento_iddocumento=$iddoc", "", $conn);
	echo($resultado[0]["fecha"]);
}

function fila_plan_mejoramiento($idformato, $iddoc) {
	global $conn;
	//$resultado = busca_filtro_tabla(fecha_db_obtener("fecha_suscripcion", "Y-m-d") . " as fecha,a.descripcion_plan", "ft_plan_mejoramiento a,ft_informe_contraloria ic", "idft_plan_mejoramiento=ft_plan_mejoramiento and ic.documento_iddocumento=$iddoc", "", $conn);
}

function radicado_plan($idformato, $iddoc) {
	global $conn;

	$papa = busca_filtro_tabla("c.numero", "ft_informe_contraloria a, ft_plan_mejoramiento b, documento c", "a.ft_plan_mejoramiento=b.idft_plan_mejoramiento and b.documento_iddocumento=c.iddocumento and a.documento_iddocumento=" . $iddoc, "", $conn);

	echo($papa[0]["numero"]);
}

function observaciones_informe($idformato, $idcampo, $iddoc = NULL) {
	global $conn;

	if ($iddoc == NULL) {$resultado = busca_filtro_tabla("a.observaciones", "ft_seguimiento a,ft_hallazgo b", "ft_hallazgo=idft_hallazgo and ft_plan_mejoramiento=" . $_REQUEST["padre"], "", $conn);
		$cadena = '<ul>';
		for ($i = 0; $i < $resultado['numcampos']; $i++) {
			if ($resultado[$i]["observaciones"] <> "")
				$cadena .= "<li>" . $resultado[$i]["observaciones"] . "</li>";
		}
		$cadena .= "</ul>";
	} else
		$cadena = mostrar_valor_campo('observaciones', $idformato, $iddoc, 1);

	echo "<td><textarea name='observaciones' class='tiny_avanzado required'>" . $cadena . "</textarea></td>";
}

function conclusiones_informe($idformato, $idcampo, $iddoc = NULL) {
	global $conn;
	if ($iddoc == NULL) {
		$resultado = busca_filtro_tabla("a.conclusiones", "ft_informe_contraloria a,ft_plan_mejoramiento b,documento c", "ft_plan_mejoramiento=idft_plan_mejoramiento and b.documento_iddocumento=iddocumento and c.estado not in('ACTIVO','ELIMINADO') and idft_plan_mejoramiento=" . $_REQUEST["padre"], "iddocumento desc", $conn);
		
		$cadena = $resultado[0]["conclusiones"];

	} else
		$cadena = mostrar_valor_campo('conclusiones', $idformato, $iddoc, 1);

	echo "<td><textarea name='conclusiones' class='tiny_avanzado'>$cadena</textarea></td>";

}

function objetivo_general_informe($idformato, $idcampo, $iddoc = NULL) {
	global $conn;

	if ($iddoc == NULL) {
		$resultado = busca_filtro_tabla("a.cumplimiento_general", "ft_informe_contraloria a,ft_plan_mejoramiento b,documento c", "ft_plan_mejoramiento=idft_plan_mejoramiento and b.documento_iddocumento=iddocumento and c.estado not in('ACTIVO','ELIMINADO') and idft_plan_mejoramiento=" . $_REQUEST["padre"], "iddocumento desc", $conn);
		
		$cadena = $resultado[0]["cumplimiento_general"];
	} else
		$cadena = mostrar_valor_campo('cumplimiento_general', $idformato, $iddoc, 1);

	echo "<td><textarea name='cumplimiento_general' class='tiny_avanzado required'>$cadena</textarea></td>";
}

function objetivos_especificos_informe($idformato, $idcampo, $iddoc = NULL) {
	global $conn;

	if ($iddoc == NULL) {$resultado = busca_filtro_tabla("a.cumplimiento_especificos", "ft_informe_contraloria a,ft_plan_mejoramiento b,documento c", "ft_plan_mejoramiento=idft_plan_mejoramiento and b.documento_iddocumento=iddocumento and c.estado not in('ACTIVO','ELIMINADO') and idft_plan_mejoramiento=" . $_REQUEST["padre"], "iddocumento desc", $conn);
		//print_r($resultado);
		$cadena = $resultado[0]["cumplimiento_especificos"];
	} else
		$cadena = mostrar_valor_campo('cumplimiento_especificos', $idformato, $iddoc, 1);

	echo "<td><textarea name='cumplimiento_especificos' class='tiny_avanzado required'>$cadena</textarea></td>";
}

function ciudad_predeterminada() {
	echo "<td><input type='text' name='municipio_informe' size='50' readonly=true value='" . ciudad(0, 0, 1) . "'></td>";
}

function buscar_jefe_control() {
	global $conn;
	$resultado = busca_filtro_tabla("nombres,apellidos", "vfuncionario_dc", "lower(dependencia) like'direcci%n%control%interno' and lower(cargo) like'director%' and estado=1 and estado_dep=1 and estado_dc=1", "", $conn);

	echo("<td><input type='text' name='jefe_control' readonly=true value='" . $resultado[0]['nombres'] . " " . $resultado[0]['apellidos'] . "' size='50'></td>");
}



function nombre_director_controli($idformato, $iddoc) {
	global $conn;

	$cargo = strtolower("director de control interno");
	$datos = busca_filtro_tabla("c.nombres, c.apellidos, b.nombre", "dependencia_cargo a, cargo b, funcionario c", "a.estado=1 and b.estado=1 and c.estado=1 and a.funcionario_idfuncionario=c.idfuncionario and a.cargo_idcargo=b.idcargo and lower(b.nombre) like '%" . str_replace(' ', '%', $cargo) . "%'", "", $conn);
	echo "<span style='font-size:6pt'><b>" . ucwords(strtolower($datos[0]["nombres"])) . " " . ucwords(strtolower($datos[0]["apellidos"])) . "</b><br>" . ucwords(strtolower($datos[0]["nombre"])) . "</span>";
}

function link_agregar_campos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
		if(@$_REQUEST["tipo"] != 5 ){
			$enlace = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="abrir_higslide"  alto="250" ancho="550" ruta="formatos/informe_contraloria/llenar_campos.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '" style="font-size:8pt;color: rgb(38, 50, 187);text-decoration: underline;">Agregar campos</a>';
			echo $enlace;
			//echo(librerias_highslide());
		}
}

function validar_campos_confirmar($idformato, $iddoc) {
	global $conn;
	$max_salida = 6;
	$ruta_db_superior = $ruta = "";
	while ($max_salida > 0) {
		if (is_file($ruta . "db.php")) {
			$ruta_db_superior = $ruta;			
		}
		$ruta .= "../";
		$max_salida--;
	}

	$datos = busca_filtro_tabla("", "ft_informe_contraloria a", "a.documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos[0]["cumplimiento_general"] == '') {
		alerta("No se ha llenado el campo Cumplimiento del objetivo general del plan");
		abrir_url($ruta_db_superior . "formatos/informe_contraloria/mostrar_informe_contraloria.php?iddoc=" . $iddoc . "&idformato=" . $idformato, "_self");
		die();
	}
	if ($datos[0]["cumplimiento_especificos"] == '') {
		alerta("No se ha llenado el campo Cumplimiento de los objetivos especificos");
		abrir_url($ruta_db_superior . "formatos/informe_contraloria/mostrar_informe_contraloria.php?iddoc=" . $iddoc . "&idformato=" . $idformato, "_self");
		die();
	}
	if ($datos[0]["conclusiones"] == '') {
		alerta("No se ha llenado el campo Conclusiones");
		abrir_url($ruta_db_superior . "formatos/informe_contraloria/mostrar_informe_contraloria.php?iddoc=" . $iddoc . "&idformato=" . $idformato, "_self");
		die();
	}
}


function auditoria_hallazgos($idformato, $iddoc) {
	global $conn, $ruta_db_superior;

	$plan = busca_filtro_tabla("idft_plan_mejoramiento", "ft_plan_mejoramiento", "documento_iddocumento=" . $_REQUEST["anterior"], "", $conn);

	$hallazgos = busca_filtro_tabla("", "ft_hallazgo a, documento b", "a.documento_iddocumento=b.iddocumento and b.estado not in ('ELIMINADO','ANULADO') and ft_plan_mejoramiento=" . $plan[0]["idft_plan_mejoramiento"], "", $conn);
	$auditado = array();
	$idformato_hallazgo_plan_mejoramiento=busca_filtro_tabla("idformato","formato","nombre='hallazgo'","",$conn);
	for ($i = 0; $i < $hallazgos["numcampos"]; $i++) {
		$auditado[] = procesos_vinculados_funcion($idformato_hallazgo_plan_mejoramiento[0]['idformato'], $hallazgos[$i]["documento_iddocumento"], 1);
	}

	$datos = array_unique($auditado);
	return (implode(", ", $datos));
}

function radicado_plan_mejora($idformato, $iddoc) {

	$papa = busca_filtro_tabla("c.numero", "ft_informe_contraloria a, ft_plan_mejoramiento b,documento c", "a.ft_plan_mejoramiento    =idft_plan_mejoramiento AND a.documento_iddocumento =" . $iddoc . " AND c.iddocumento=b.documento_iddocumento", "", $conn);
	print_r($papa[0]["numero"]);

}

function tipo_registrado_plan($idformato, $iddoc) {

	$papa = busca_filtro_tabla("b.tipo_plan", "ft_informe_contraloria a, ft_plan_mejoramiento b,documento c", "a.ft_plan_mejoramiento    =idft_plan_mejoramiento AND a.documento_iddocumento =" . $iddoc . " AND c.iddocumento=b.documento_iddocumento", "", $conn);

	if ($papa[0]["tipo_plan"] == 1) {
		print_r("INSTITUCIONAL");
	}
	if ($papa[0]["tipo_plan"] == 2) {
		print_r("DE PROCESO");
	}
	if ($papa[0]["tipo_plan"] == 3) {
		print_r("INDIVIDUAL");
	}
}

function codificacion_especifica($idformato, $iddoc) {
	$especifico = busca_filtro_tabla("cumplimiento_especificos", "ft_informe_contraloria", "documento_iddocumento=" . $iddoc, "", $conn);
	print_r($especifico[0]["cumplimiento_especificos"]);
}

function transferir_responsables($idformato, $iddoc) {
	global $conn;

	$funcionarios = "";
	$ft_plan = busca_filtro_tabla("ft_plan_mejoramiento", "ft_informe_contraloria", "documento_iddocumento=" . $iddoc, "", $conn);
	$hallazgo = busca_filtro_tabla("a.responsables,a.responsable_seguimiento", "ft_hallazgo a, documento d", "a.documento_iddocumento=d.iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and a.ft_plan_mejoramiento=" . $ft_plan[0]["ft_plan_mejoramiento"], "", $conn);

	for ($i = 0; $i < $hallazgo["numcampos"]; $i++) {
		if ($hallazgo[$i]["responsables"] != "")
			$funcionarios .= $hallazgo[$i]["responsables"] . ",";
		if ($hallazgo[$i]["responsable_seguimiento"] != "")
			$funcionarios .= $hallazgo[$i]["responsable_seguimiento"] . ",";
	}
	$funcionarios = explode(",", $funcionarios);
	$funcionarios = array_unique($funcionarios);
	$final = array();
	for ($i = 0; $i < count($funcionarios); $i++) {
		if ($funcionarios[$i] != "") {
			$final[] = $funcionarios[$i];
		}
	}

	$destinos = implode("@", $final);
	transferencia_automatica($idformato, $iddoc, $destinos, 3, "Se realiz&oacute; seguimiento al plan de mejoramiento, consultar reporte respectivo para su informaci&oacute;n");

}

function mostrar_nombre_jefe_control($idformato, $iddoc){
    global $conn,$ruta_db_superior;
    
    $datos=busca_filtro_tabla("b.nombres,b.apellidos","ft_informe_contraloria a,funcionario b","a.jefe_control=b.funcionario_codigo AND a.documento_iddocumento=".$iddoc,"",$conn);
    echo($datos[0]['nombres'].' '.$datos[0]['apellidos']);
}

?>