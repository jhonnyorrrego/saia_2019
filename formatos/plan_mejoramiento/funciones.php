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
include_once ($ruta_db_superior . "formatos/librerias/funciones_formatos_generales.php");

/*ADICIONAR-EDITAR*/
function add_edit_plan_mejoramiento($idformato, $iddoc){
	global $conn;
	if($_REQUEST["iddoc"]){
		$opt=1;
	}else{
		$opt=0;
		if (isset($_REQUEST["seguimiento_indicador"])){
			echo "<input type='hidden' name='seguimiento_indicador' value='" . $_REQUEST["seguimiento_indicador"] . "'>";
		}
	}
}


/*POSTERIOR ADICIONAR*/
function relacionar_seguimiento_indicador($idformato, $iddoc) {
	global $conn;
	if (isset($_REQUEST["seguimiento_indicador"])) {
		$sql = "insert into seguimiento_planes(idft_seguimiento_indicador,plan_mejoramiento) values('" . $_REQUEST["seguimiento_indicador"] . "','".$iddoc."')";
		phpmkr_query($sql, $conn);
		echo "<script>window.close();</script>";
	}
}

function add_edit_ruta_plan($idformato, $iddoc) {
	$ruta = array();
	$datos = busca_filtro_tabla("revisado,aprobado", "ft_plan_mejoramiento", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos["numcampos"]) {
		if ($datos[0]["revisado"] != "") {
			array_push($ruta, array(
				"funcionario" => $datos[0]["revisado"],
				"tipo_firma" => 1,
				"tipo" => 5
			));
		}
		if ($datos[0]["aprobado"] != "") {
			array_push($ruta, array(
				"funcionario" => $datos[0]["aprobado"],
				"tipo_firma" => 1,
				"tipo" => 5
			));
		}
		if (count($ruta)) {
			insertar_ruta($ruta, $iddoc, 1);
		}
	}
}



/*MOSTRAR*/
function estado_del_plan($idformato, $iddoc) {
	global $conn, $cerrado;
	$parte="";
	$cerrado = busca_filtro_tabla("estado_plan_mejoramiento,idfun_termino,".fecha_db_obtener("fecha_termino","Y-m-d H:i:s")." as fecha_termino,observ_termino", "ft_plan_mejoramiento a", "a.documento_iddocumento=" . $iddoc, "", $conn);
	if ($cerrado[0]["estado_plan_mejoramiento"] ==3) {
		$estado = 'Cerrado';
		$color = 'btn-info';
		$nombre=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$cerrado[0]["idfun_termino"],"",$conn);
		if($nombre["numcampos"]){
			$parte="<br/>".$nombre[0]["nombres"]." ".$nombre[0]["apellidos"]."<br/>".$cerrado[0]["fecha_termino"]."<br/>".$cerrado[0]["observ_termino"];
		}
	} else if ($cerrado[0]["estado_plan_mejoramiento"] == 2) {
		$estado = "Aprobado";
		$color = 'btn-success';
	} else {
		$estado = 'Pendiente por Aprobar';
		$color = 'btn-warning';
	}
	if ($_REQUEST["tipo"] != 5) {
		$html = '<div id="mostrar_estado" class="btn btn-mini ' . $color . '">' . $estado . '</div>'.$parte;
		if ($cerrado[0]["estado_plan_mejoramiento"] == 2) {
			$html .= "&nbsp;<a class='btn btn-mini btn-warning' id='terminar_mejoramiento' onclick='aprobar_plan_mejora()'>Cerrar Plan</a>";
		}
	} else {
		$html = $estado.$parte;
	}
	echo $html;
	if ($_REQUEST["tipo"] != 5) {
	?>
	<script>
	function aprobar_plan_mejora(){
	  if(confirm('Seguro que desea terminar el plan de mejoramiento?')){
	  	var observa=prompt("Por favor ingrese una observacion");
	    $.ajax({
	    	url : 'terminar_plan_mejoramiento.php',
	    	data:{iddoc:<?php echo $iddoc;?>,observ_termino:observa,opt:1},
	    	type : 'post',
	    	dataType:'json',
	    	async:false,
	    	success : function(data) {
	    		if(data.exito==1){
	    			top.noty({text:'Datos Actualizados', type:"success", layout:"topCenter", timeout:3500});
	    			window.location.reload();
	    		}else{
	    			top.noty({text:data.msn, type:"error", layout:"topCenter", timeout:3500});
	    		}
	    	},error:function (){
	    		top.noty({text:'Error al procesar la peticion', type:"error", layout:"topCenter", timeout:3500});
	    	}
	    });
	  }
	}
	</script>
	<?php
	}
}

function ver_indicador_plan($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$html = "";
	$seguimiento = busca_filtro_tabla("i.documento_iddocumento,i.nombre", "seguimiento_planes s,ft_seguimiento_indicador si,ft_indicadores_calidad i,ft_formula_indicador f", "plan_mejoramiento=" . $iddoc . " and s.idft_seguimiento_indicador=si.idft_seguimiento_indicador and idft_indicadores_calidad=ft_indicadores_calidad and ft_formula_indicador=idft_formula_indicador", "", $conn);
	if ($seguimiento["numcampos"]) {
		if ($_REQUEST["tipo"] != 5) {
			$html = "<a class='btn btn-mini btn-info kenlace_saia' conector='iframe' titulo='" . $seguimiento[0]["nombre"] . "' enlace='ordenar.php?mostrar_formato=1&key=" . $seguimiento[0]["documento_iddocumento"] . "'>Ver: " . $seguimiento[0]["nombre"] . "</a>";
		} else {
			$html = $seguimiento[0]["nombre"];
		}
	}
	echo $html;
}

function mostrar_link_reporte($idformato, $iddoc) {
	global $conn;
	$mostrar = '';
	if ($_REQUEST["tipo"] != 5) {
		$mostrar .= '<a href="reporte_hallazgos_cumplimiento.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '" onclick="" target="_self">VER REPORTE DE AVANCE PLAN DE MEJORAMIENTO</a>';
	}
	echo $mostrar;
}

function listar_hallazgo_plan_mejoramiento($idformato, $iddoc, $condicion = "") {
	global $conn, $ruta_db_superior;
	$formato = busca_filtro_tabla("", "formato A", "A.idformato=" . $idformato, "", $conn);
	if ($formato["numcampos"]) {
		$documento = busca_filtro_tabla("idft_plan_mejoramiento", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
		if ($condicion == "" && $documento[0]["idft_plan_mejoramiento"]) {
			$condicion = "AND a.ft_plan_mejoramiento=" . $documento[0]["idft_plan_mejoramiento"] . " ";
		}
	}
	if ($condicion != "") {
		$formato_hallazgo = busca_filtro_tabla("idformato", "formato a", "a.nombre LIKE 'hallazgo'", "", $conn);
		$campos_formato_hallazgo = busca_filtro_tabla("nombre,idcampos_formato", "campos_formato a", "a.formato_idformato=" . $formato_hallazgo[0]['idformato'], "", $conn);
		$vector_campos_id = array();
		for ($i = 0; $i < $campos_formato_hallazgo['numcampos']; $i++) {
			$vector_campos_id[$campos_formato_hallazgo[$i]['nombre']] = $campos_formato_hallazgo[$i]['idcampos_formato'];
		}
		$hallazgos = busca_filtro_tabla("a.*,b.*,a.documento_iddocumento as hallazgo_iddoc", "ft_hallazgo a, ft_plan_mejoramiento b,documento c", "a.ft_plan_mejoramiento= b.idft_plan_mejoramiento and a.documento_iddocumento= c.iddocumento and c.estado not in ('ELIMINADO','ANULADO','ACTIVO') " . $condicion, "idft_hallazgo asc", $conn);
		if ($hallazgos["numcampos"]) {
			$texto .= "";
			$estado_actual = "Todos";
			if (@$_REQUEST["estado"]) {
				$estado_actual = $_REQUEST["estado"];
			}
			if (!isset($_REQUEST["tipo_impresion"]) && !$_REQUEST["papel"] && $_REQUEST["tipo"] != 5) {
				$texto_enlaces .= '<table border="1px" width="100%" style="border-collapse:collapse;">
	      <tr>
	      <td colspan="2" align="center">Estado Actual(' . ucfirst($estado_actual) . ')</td>
	      <td align="center" valign="middle">Imprimir</td>
	      </tr>
	      <tr>
	      <td align="center"><a href="' . genera_enlace_plan_mejoramiento() . '&estado=pendientes">Hallazgos Pendientes</a></td>
	      <td align="center" valign="middle"><a href="' . genera_enlace_plan_mejoramiento() . '&estado=terminados" >Hallazgos Terminados</a></td>
	      <td align="center" valign="middle"><a href="' . $ruta_db_superior . 'class_impresion.php?iddoc=' . $iddoc . '" target="_blank">Generar Plan de Mejoramiento (PDF)</a></td>
	      <td align="center" valign="middle"><a href="archivo_plano_contraloria.php?iddoc=' . $iddoc . '" target="_blank">Archivo Contralor&iacute;a</a></td>';

				$texto_enlaces .= '</tr></table>';
			}
			$texto .= '
   	 	<pagebreak/><table border="1px" style="border-collapse:collapse;" width="100%">';
			$texto .= '<tr class="encabezado_list">
			<td rowspan="2" align="center">No<br /></td>
			<td colspan="4" align="center">Alcance</td>';
			if (isset($_REQUEST["tipo_impresion"]) && $_REQUEST["tipo_impresion"] == 1)
				$texto .= '<td rowspan="2">Causa</td>';
			$texto .= '<td rowspan="2" align="center">Acciones de mejoramiento<br /></td>
			<td rowspan="2" align="center">Responsable de mejoramiento<br /></td>
			<td align="center">Tiempo programado para el cumplimiento de las acciones de mejoramiento</td>
			<td colspan="2" align="center">Mecanismo de seguimiento interno adoptado<br /></td>
			<td rowspan="2" align="center">Responsable del seguimiento<br />
			</td>
			<td rowspan="2" align="center">Indicador de acci&oacute;n de cumplimiento<br /></td>
			<td rowspan="2" align="center">Observaciones<br /></td>';
			if (isset($_REQUEST["tipo_impresion"]) && $_REQUEST["tipo_impresion"] == 3)
				$texto .= '<td rowspan="2">Logros alcanzados</td>';
			$texto .= '</tr>
				<tr class="encabezado_list">
				<td align="center">Descripci&oacute;n observaci&oacute;n y/o hallazgo<br /></td>
				<td>CAUSAS</td>
				<td align="center">Clase de observaci&oacute;n<br /></td>
				<td align="center">&Aacute;reas,ciclos o procesos vinculados<br /></td>
				<td align="center">Tiempo programado<br /></td>
				<td align="center">Actividad<br /></td>
				<td align="center">Tiempo<br /></td>
				</tr>';

			$ingresa = 0;
			for ($i = 0, $j = 1; $i < $hallazgos["numcampos"]; $i++) {
				$seguimiento[$a]["total_porcentaje"] = 0;
				if (isset($_REQUEST["tipo_impresion"]) && $_REQUEST["tipo_impresion"] == 3)
					$seguimiento = busca_filtro_tabla("A.*, A.porcentaje AS total_porcentaje", "ft_seguimiento A", "A.ft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], "idft_seguimiento DESC", $conn);
				else {
					$porcentaje = busca_filtro_tabla("A.porcentaje", "ft_seguimiento A", "A.ft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], "idft_seguimiento desc", $conn);
					$seguimiento = busca_filtro_tabla("'" . $porcentaje[0]["porcentaje"] . "' AS total_porcentaje", "ft_seguimiento A", "A.ft_hallazgo=" . $hallazgos[$i]["idft_hallazgo"], "GROUP BY ft_hallazgo", $conn);
				}
				
				$a = 0;
				if ((@$_REQUEST["estado"] == "pendientes" && $seguimiento[$a]["total_porcentaje"] < 100) || (@$_REQUEST["estado"] == "terminados" && $seguimiento[$a]["total_porcentaje"] >= 100) || (!@$_REQUEST["estado"])) {
					$ingresa = 1;
					if (!isset($_REQUEST["export"]))
						$texto .= '<tr><td class="transparente" ><a href="../hallazgo/mostrar_hallazgo.php?iddoc=' . $hallazgos[$i]["hallazgo_iddoc"] . '&idformato=' . $formato_hallazgo[0]["idformato"] . '">&nbsp;' . $hallazgos[$i]["consecutivo_hallazgo"] . '&nbsp;</a></td>';
					else
						$texto .= '<tr><td class="transparente">' . $j . '</td>';
					$texto .= '<td class="transparente" >' . mostrar_mensaje_accion($hallazgos[$i]["clase_accion"], $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"]) . '</td>';
					$texto .= '<td class="transparente" >' . mostrar_valor_campo("causas", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1) . '</td>';
					$texto .= '<td class="transparente" >' . mostrar_valor_campo("clase_observacion", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1) . '</td>';

					$texto .= '<td class="transparente" ><b>Areas:</b> ' . ucfirst(strtolower(strip_tags(mostrar_seleccionados($formato_hallazgo[0]["idformato"], $vector_campos_id['secretarias'], 2, $hallazgos[$i]["hallazgo_iddoc"], 1)))) . '<br /><b>Procesos:</b> ' . ucfirst(strtolower(strip_tags(procesos_vinculados_funcion2($formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"])))) . '</td>';

					if (isset($_REQUEST["tipo_impresion"]) && $_REQUEST["tipo_impresion"] == 1) {
						$texto .= '<td class="transparente" >' . strip_tags(mostrar_valor_campo("causas", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';
					}

					$item = busca_filtro_tabla("", "ft_accion_plan_mejoramiento A, ft_hallazgo B", "idft_hallazgo=ft_hallazgo and B.documento_iddocumento=" . $hallazgos[$i]["hallazgo_iddoc"], "CAST(A.calificacion_total AS unsigned) DESC", $conn);

					if ($item['numcampos']) {
						$cadena_acciones = '
						<table border="1px" width="100%" style="border-collapse:collapse;">
						<tr>
							<td class="encabezado_list">ACCIÓN</td>
							<td class="encabezado_list">CALIFICACIÓN TOTAL</td>
						</tr>';
						for ($l = 0; $l < $item['numcampos']; $l++) {
							$cadena_acciones .= '		
									<tr>
										<td>' . strip_tags(codifica_encabezado(html_entity_decode($item[$l]['accion_item']))) . '</td>
										
										<td style="text-align: center;"><center>' . $item[$l]['calificacion_total'] . '</center></td>
									</tr>';
						}
						$cadena_acciones .= '</table>';
					} else {
						$cadena_acciones = "";
					}
					$texto .= '<td class="transparente" >' . $cadena_acciones . '</td>';
					$texto .= '<td class="transparente" >' . ucfirst(strtolower(mostrar_seleccionados($formato_hallazgo[0]["idformato"], $vector_campos_id['responsables'], 0, $hallazgos[$i]["hallazgo_iddoc"], 1))) . '</td>';
					$texto .= '<td class="transparente" align="center">' . mostrar_valor_campo("tiempo_cumplimiento", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1) . '</td>';
					$texto .= '<td class="transparente" >' . strip_tags(mostrar_valor_campo('mecanismo_interno', $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';
					$texto .= '<td class="transparente"  align="center">' . mostrar_valor_campo("tiempo_seguimiento", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1) . '</td>';
					$texto .= '<td class="transparente" >' . ucfirst(strtolower(mostrar_seleccionados($formato_hallazgo[0]["idformato"], $vector_campos_id['responsable_seguimiento'], 0, $hallazgos[$i]["hallazgo_iddoc"], 1))) . '</td>';
					$texto .= '<td class="transparente" >' . strip_tags(mostrar_valor_campo("indicador_cumplimiento", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';
					$texto .= '<td class="transparente" >' . strip_tags(mostrar_valor_campo("observaciones", $formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"], 1)) . '</td>';

					if ($seguimiento["numcampos"] && isset($_REQUEST["tipo_impresion"]) && $_REQUEST["tipo_impresion"] == 3) {
						$idformato_seguimiento = busca_filtro_tabla("idformato", "formato", " nombre='seguimiento' ", "", $conn);
						$texto .= '<td class="transparente">' . mostrar_valor_campo('logros_alcanzados', $idformato_seguimiento[0]['idformato'], $seguimiento[$a]["documento_iddocumento"], 1) . '</td><td class="transparente" align="center" ><a href="../plan_mejoramiento/seguimiento_list.php?idhallazgo=' . $hallazgos[$i]["idft_hallazgo"] . '" class="highslide" onclick="return hs.htmlExpand(this, { objectType: ' . "'" . 'iframe' . "'" . ',width: 400, height:250 } )">' . $seguimiento[$a]["total_porcentaje"] . '%</a></td>';
					}
					$texto .= '</tr>';
					$j++;
				}
			}
			$texto .= '</table>';
		}
	}
	if (!$ingresa){
		$texto .= "<br /><br /><b>No se han definido hallazgos " . @$_REQUEST["estado"] . " para el plan de mejoramiento mostrado</b>";
	}
	echo($texto_enlaces . $texto);
}

function genera_enlace_plan_mejoramiento() {
	$parametros_ruta = array();
	if ($_REQUEST["tipo"])
		array_push($parametros_ruta, "tipo=" . $_REQUEST["tipo"]);
	if ($_REQUEST["proceso"])
		array_push($parametros_ruta, "proceso=" . $_REQUEST["proceso"]);
	if ($_REQUEST["usuario"])
		array_push($parametros_ruta, "usuario=" . $_REQUEST["usuario"]);
	if ($_REQUEST["iddoc"])
		array_push($parametros_ruta, "iddoc=" . $_REQUEST["iddoc"]);
	if ($_REQUEST["idformato"])
		array_push($parametros_ruta, "idformato=" . $_REQUEST["idformato"]);
	$ruta = $_SERVER["PHP_SELF"] . "?" . implode("&", $parametros_ruta);
	return ($ruta);
}

function procesos_vinculados_funcion2($idformato, $iddoc) {
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

function mostrar_mensaje_accion($clase_accion, $idformato, $hallazgo_iddoc) {
	global $conn;
	if ($clase_accion == 3) {
		$mensaje = "No Aplica porque es una acción de mejora";
	} else {
		$mensaje = strip_tags(mostrar_valor_campo("deficiencia", $idformato, $hallazgo_iddoc, 1));
	}
	return ($mensaje);
}

/*POSTERIOR APROBAR*/
function post_aprob_plan_mejo($idformato, $iddoc){
	$update="UPDATE ft_plan_mejoramiento SET estado_plan_mejoramiento=2 WHERE documento_iddocumento=".$iddoc;
	phpmkr_query($update);
}

?>