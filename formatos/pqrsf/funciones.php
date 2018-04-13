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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ("../clasificacion_pqrsf/funciones.php");


/*ADICIONAR*/
function mostrar_radicado_pqrsf($idformato, $iddoc) {
	global $conn;
	$contador = busca_filtro_tabla("b.consecutivo", "formato a, contador b", "a.contador_idcontador=b.idcontador AND a.idformato=" . $idformato, "", $conn);
	echo("<td><input type='text' readonly id='numero_radicado' name='numero_radicado' value='" . $contador[0]['consecutivo'] . "'></td>");
}

/*ADICIONAR-EDITAR*/
function add_edit_pqrsf($idformato, $iddoc){
	global $ruta_db_superior;
	if($_REQUEST["iddoc"]){
		$opt=1;
	}else{
		$opt=0;
	}
?>
<script>
	$(document).ready(function (){
		$("#tr_tipo td").eq(1).append('<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )" href="mensaje.php">Ayuda</a> ');
		$("#email").addClass("required email");
	});
</script>
<?php
}

/*POSTERIOR EDITAR*/
function post_edit_pqrsf($idformato, $iddoc) {
	global $conn;
	$datos = busca_filtro_tabla("estado", "documento", "iddocumento=" . $iddoc, "", $conn);
	if($datos[0]["estado"]=="INICIADO"){
		$up = "UPDATE documento SET estado='APROBADO' WHERE iddocumento=" . $iddoc;
		phpmkr_query($up);
		post_aprobar_pqrsf($idformato, $iddoc);
	}
}

/*MOSTRAR*/
function enlace_llenar_datos_radicacion_rapida_pqrsf($idformato, $iddoc) {
	global $conn,$datos;
	$html="";
	$datos = busca_filtro_tabla("idft_pqrsf,d.estado,".fecha_db_obtener("Y-m-d", "fecha_reporte")." as fecha_reporte", "ft_pqrsf ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
	if($datos["numcampos"]){
		if ($datos[0]['estado'] == 'INICIADO' && $_REQUEST["tipo"]!=5) {
			$html = '<br><br><button class="btn btn-mini btn-warning" onclick="window.location=\'editar_pqrsf.php?no_sticker=1&iddoc=' . $iddoc . '&idformato=' . $idformato . '\';">Llenar datos</button>';
		}
	}
	echo $html;
}

function ver_fecha_reporte($idformato, $iddoc) {
	global $conn,$datos;
	echo($datos[0]['fecha_reporte']);
}

function mostrar_anexos_pqrsf($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$anexos = busca_filtro_tabla("", "anexos a", "a.documento_iddocumento=" . $iddoc, "", $conn);
	$anexos_array = array();
	for ($i = 0; $i < $anexos["numcampos"]; $i++) {
		$anexos_array[] = '<a class="previo_high" style="cursor:pointer" enlace="' . $anexos[$i]["ruta"] . '">' . $anexos[$i]["etiqueta"] . '</a>';
	}
	echo(implode(", ", $anexos_array));
	if ($_REQUEST["tipo"] != 5) {
		?>
		<script>
		$(document).ready(function(){
			$(".previo_high").click(function(e){
				var enlace=$(this).attr("enlace");
				top.hs.htmlExpand(this, { objectType: 'iframe',width: 1000, height: 600,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
				
			});
		});
		</script>
		<?php
	}
}

function mostrar_datos_hijos($idformato, $iddoc) {
	global $conn, $datos;
	$clasificacion = busca_filtro_tabla("d.iddocumento,idft_clasificacion_pqrsf", "ft_clasificacion_pqrsf c,documento d", "c.documento_iddocumento=d.iddocumento and d.iddocumento not in ('ELIMINADO','ANULADO','ACTIVO') and c.ft_pqrsf=" . $datos[0]['idft_pqrsf'], "", $conn);
	if ($clasificacion["numcampos"]) {
		$idfor_clas = busca_filtro_tabla("idformato", "formato", "nombre_tabla='ft_clasificacion_pqrsf'", "", $conn);
		for ($i = 0; $i < $clasificacion['numcampos']; $i++) {
			$html .= '<table style="border-collapse: collapse; width: 100%;" border="1">
			<tr>
			<td style="text-align: left;"><strong>&nbsp;Clasificacion del Reclamo</strong></td>
			<td>&nbsp;' . mostrar_valor_campo('serie', $idfor_clas[0]["idformato"], $clasificacion[$i]['iddocumento'], 1) . '</td>
			</tr>
			<tr>
			<td style="text-align: left;"><strong>&nbsp;Resonsable:&nbsp;</strong></td>
			<td style="text-align: left;">&nbsp;' . ver_responsable($idfor_clas[0]["idformato"], $clasificacion[$i]['iddocumento'], 1) . '</td>
			</tr>
			<tr>
			<td style="text-align: left;" colspan="2"><strong>&nbsp;Observaciones:</strong></td>
			</tr>
			<tr>
			<td colspan="2">&nbsp;' . mostrar_valor_campo('observaciones', $idfor_clas[0]["idformato"], $clasificacion[$i]['iddocumento'], 1) . '</td>
			</tr>
			</table><br/>';
			$analisis = busca_filtro_tabla("iddocumento", "ft_analisis_pqrsf ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and ft.ft_clasificacion_pqrsf=" . $clasificacion[$i]['idft_clasificacion_pqrsf'], "", $conn);
			if ($analisis["numcampos"]) {
				$idfor_anali = busca_filtro_tabla("idformato", "formato", "nombre_tabla='ft_analisis_pqrsf'", "", $conn);
				for ($j = 0; $j < $analisis['numcampos']; $j++) {
					$html .= '<table style="border-collapse: collapse; width: 100%;" border="1">
					<tr>
					<td style="text-align: left;"><strong>&nbsp;Analisis de Causas</strong></td>
					<td>&nbsp;' . mostrar_valor_campo('analisis_causas', $idfor_anali[0]["idformato"], $analisis[$j]['iddocumento'], 1) . '</td>
					</tr>
					</table>';
					$html .= mostrar_items($idfor_anali[0]["idformato"], $analisis[$j]['iddocumento']);
				}
			}
		}
	}
	echo $html;
}

function mostrar_items($idformato, $iddoc) {
	global $conn;
	$html = "";
	$idft = busca_filtro_tabla("idft_analisis_pqrsf,estado", "ft_analisis_pqrsf,documento", "iddocumento=documento_iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
	if ($idft["numcampos"]) {
		$item = busca_filtro_tabla("I.accion_causa,nombres, apellidos," . fecha_db_obtener('I.fecha_limite', 'Y-m-d') . " as fecha_limite,idft_item_causas_pqrsf", "ft_item_causas_pqrsf I,vfuncionario_dc v", "v.iddependencia_cargo=I.responsable AND I.ft_analisis_pqrsf=" . $idft[0][0], "", $conn);
		if ($item["numcampos"]) {
			$html = '<table  style="border-collapse: collapse; width: 100%;" border="1">';
			$html .= "<tr align='center'><th>Accion</th> <th>Responsable</th> <th>Fecha Limite</th>";
			$html .= "</tr>";
			for ($i = 0; $i < $item['numcampos']; $i++) {
				$html .= '<tr> <td>' . $item[$i]['accion_causa'] . '</td> <td>' . ucwords(strtolower($item[$i]['nombres'] . ' ' . $item[$i]['apellidos'])) . '</td> <td>' . $item[$i]['fecha_limite'] . '</td>';
				$html .= '</tr>';
			}
			$html .= "</table><br/>";
		}
	}
	return $html;
}


/*POSTERIOR APROBAR-EDITAR*/
function validar_digitalizacion_formato_pqr($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	if(!isset($_REQUEST["no_redirecciona"])){
		if ($_REQUEST["digitalizacion"] == 1) {
			if (@$_REQUEST["iddoc"]) {
				$iddoc = $_REQUEST["iddoc"];
				$enlace = "ordenar.php?key=" . $iddoc . "&accion=mostrar&mostrar_formato=1";
				abrir_url($ruta_db_superior . "paginaadd.php?target=_self&key=" . $iddoc . "&enlace=" . $enlace, '_self');
			} else {
				abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&enlace=paginaadd.php?key=" . $iddoc, '_self');
			}
		} elseif ($_REQUEST["digitalizacion"] == 2 && $_REQUEST['no_sticker'] == 1) {
			abrir_url($ruta_db_superior . "formatos/radicacion_entrada/mostrar_radicacion_entrada.php?iddoc=" . $iddoc . "&idformato=" . $idformato, '_self');
		} else if ($_REQUEST["digitalizacion"] == 2) {
			if (@$_REQUEST["iddoc"]) {
				$iddoc = $_REQUEST["iddoc"];
			}
			$enlace = "ordenar.php?key=" . $iddoc . "&accion=mostrar&mostrar_formato=1";
			abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&enlace=" . $enlace, '_self');
		}
	}
}


/*POSTERIOR APROBAR*/
function post_aprobar_pqrsf($idformato, $iddoc) {//es llamada desde el webservice
	global $conn, $ruta_db_superior;
	$ok = false;
	if (!isset($_REQUEST["no_redirecciona"])) {
		vincular_distribucion_pqrsf($idformato, $iddoc);
		if (!isset($_REQUEST["radicacion_rapida"])) {
			$anexos = array();
			$anexos_pqrsf = busca_filtro_tabla("ruta,etiqueta", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
			if ($anexos_pqrsf["numcampos"]) {
				for ($i = 0; $i < $anexos_pqrsf["numcampos"]; $i++) {
					$ruta_archivo = json_decode($anexos_pqrsf[$i]['ruta']);
					if (is_object($ruta_archivo)) {
						$anexos[] = $anexos_pqrsf[$i]['ruta'];
					} else {
						if (file_exists($ruta_db_superior . $anexos_pqrsf[$i]['ruta'])) {
							$anexos[] = $anexos_pqrsf[$i]['ruta'];
						}
					}
				}
			}

			$ch = curl_init();
			$fila = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/class_impresion.php?conexion_remota=1&iddoc=" . $iddoc . "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&usuario_actual=" . $_SESSION["usuario_actual"];
			curl_setopt($ch, CURLOPT_URL, $fila);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$contenido = curl_exec($ch);
			curl_close($ch);

			$datos = busca_filtro_tabla("d.numero,d.pdf,ft.email", "ft_pqrsf ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
			if ($datos[0]["email"] != "") {
				if ($datos[0]["pdf"] != "") {
					$ruta_archivo = json_decode($datos[0]["pdf"]);
					if (is_object($ruta_archivo)) {
						$anexos[] = $datos[0]["pdf"];
					} else {
						if (file_exists($ruta_db_superior . $datos[0]["pdf"])) {
							$anexos[] = $ruta_db_superior . $datos[0]["pdf"];
						}
					}
				}
				$mensaje = "Cordial Saludo,<br/>
				Se adjunta copia de la solicitud PQRSF No " . $datos[0]['numero'] . " diligenciada el dia de hoy.<br/><br/>
				Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br/>
				ESTE ES UN MENSAJE AUTOMATICO, FAVOR NO RESPONDER";
				$ok = enviar_mensaje("", array("para" => "email"), array("para" => array($datos[0]['email'])), "SOLICITUD PQR NO " . $datos[0]['numero'], $mensaje, $anexos, $iddoc);
			}
		}
	}
	return $ok;
}

function vincular_distribucion_pqrsf($idformato, $iddoc) {//POSTERIOR AL APROBAR
	global $conn, $ruta_db_superior;
	if(isset($_REQUEST["radicacion_rapida"])){
		$update = "UPDATE documento SET estado='INICIADO' WHERE iddocumento=" . $iddoc;
		phpmkr_query($update);
	}else{
		$datos = busca_filtro_tabla("a.nombre,a.documento,a.email,a.telefono", "ft_pqrsf a,documento b", "a.documento_iddocumento=b.iddocumento AND a.documento_iddocumento=" . $iddoc, "", $conn);
		if($datos["numcampos"]){
			//INGRESAMOS EL ORIGEN COMO UN REMITENTE
			$ie = " INSERT INTO ejecutor (identificacion,nombre,fecha_ingreso,estado,tipo_ejecutor) VALUES ('" . $datos[0]['documento'] . "',	'" . $datos[0]['nombre'] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",1,1)";
			phpmkr_query($ie);
			$idejecutor = phpmkr_insert_id();
			$iddatos_ejecutor = 0;
			if ($idejecutor) {
				$ide = " INSERT INTO datos_ejecutor (ejecutor_idejecutor,email,telefono,fecha) VALUES(" . $idejecutor . ",'" . $datos[0]['email'] . "',	'" . $datos[0]['telefono'] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")";
				phpmkr_query($ide);
				$iddatos_ejecutor = phpmkr_insert_id();
			}
		
			$upr = "UPDATE ft_pqrsf SET remitente_origen=" . $iddatos_ejecutor . " WHERE documento_iddocumento=" . $iddoc;
			phpmkr_query($upr);
		
			//DESTINO INTERNO DE LA PQRSF
			$lasignadas = busca_filtro_tabla("B.parametros", "funciones_formato_accion C,accion A,funciones_formato B", "C.accion_idaccion=A.idaccion AND B.idfunciones_formato=C.idfunciones_formato and B.nombre_funcion='transferencia_automatica' AND C.formato_idformato=" . $idformato, "", $conn);
			$rol_destino = 0;
			if ($lasignadas['numcampos']) {
				$vector_parametros = explode(',', $lasignadas[0]['parametros']);
				$rol_destino = $vector_parametros[0];
			}
		
			if ($iddatos_ejecutor && $rol_destino) {
				include_once ($ruta_db_superior . "distribucion/funciones_distribucion.php");
				//EXT -INT
				$datos_distribucion = array();
				$datos_distribucion['origen'] = $iddatos_ejecutor;
				$datos_distribucion['tipo_origen'] = 2;
				$datos_distribucion['destino'] = $rol_destino;
				$datos_distribucion['tipo_destino'] = 1;
				$datos_distribucion['estado_distribucion'] = 1;
				$ingresar = ingresar_distribucion($iddoc, $datos_distribucion);
			} 
		}
	}
}
?>