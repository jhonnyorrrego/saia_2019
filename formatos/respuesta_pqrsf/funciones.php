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
include_once($ruta_db_superior . "db.php");

/*ADICIONAR*/
function add_resp_pqrsf($idformato, $iddoc)
{

	$ok = 0;
	if ($_REQUEST["anterior"]) {
		$datos_papa = busca_filtro_tabla("d.numero,ft.email,ft.nombre,ft.documento,ft.telefono", "ft_pqrsf ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $_REQUEST["anterior"], "");
		if ($datos_papa["numcampos"]) {
			$eje = busca_filtro_tabla("iddatos_ejecutor", "vejecutor", "lower(nombre) like '" . $datos_papa[0]["nombre"] . "' and lower(email) like '" . $datos_papa[0]["email"] . "' ", "");
			if ($eje["numcampos"]) {
				$ok = $eje[0]["iddatos_ejecutor"];
			}
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#asunto").val("Respuesta Solicitud PQRSF No <?php echo $datos_papa[0]["numero"]; ?>");
					$("#destinos").after('<a href="#" onclick="cagar_info_pqrsf()">Cargar Datos PQRSF</a>');
					var destino = parseInt(<?php echo $ok ?>);
					if (destino != 0 && isNaN(destino) != true) {
						document.getElementById("frame_destinos").src = "../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=destinos&tabla=ft_respuesta_pqrsf&campos_auto=nombre,identificacion&amp;tipo=unico&campos=email&destinos=<?php echo $ok; ?>";
						$("#destinos").val(<?php echo $ok; ?>);
					}
				});

				function cagar_info_pqrsf() {
					$('#frame_destinos').contents().find('#nombre_ejecutor').attr("value", "<?php echo ($datos_papa[0]['nombre']) ?>");
					$('#frame_destinos').contents().find('#identificacion_ejecutor').attr("value", "<?php echo ($datos_papa[0]['documento']) ?>");
					$('#frame_destinos').contents().find('#telefono_ejecutor').attr("value", "<?php echo ($datos_papa[0]['telefono']) ?>");
					$('#frame_destinos').contents().find('#email_ejecutor').attr("value", "<?php echo ($datos_papa[0]['email']) ?>");
				}
			</script>
<?php
		}
	}
}

/*POSTERIOR APROBAR*/
function post_aprob_resp_pqrsf($idformato, $iddoc)
{ //es llamada desde el webservice
	global $conn, $ruta_db_superior;
	distribucion_res_pqrsf($idformato, $iddoc);
	transferencia_automatica($idformato, $iddoc, "copiainterna", 2, "", $nombre = "COPIA");

	$ch = curl_init();
	$fila = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/class_impresion.php?conexion_remota=1&iddoc=" . $iddoc . "&LOGIN=" . $_SESSION["LOGIN" . LLAVE_SAIA] . "&usuario_actual=" . $_SESSION["usuario_actual"];
	curl_setopt($ch, CURLOPT_URL, $fila);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$contenido = curl_exec($ch);
	curl_close($ch);

	$iddoc_papa = buscar_papa_formato_campo($idformato, $iddoc, "ft_pqrsf", "documento_iddocumento");
	$datos_papa = busca_filtro_tabla("d.numero,ft.email", "ft_pqrsf ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc_papa, "");

	$anexos = array();
	$anexos_pqrsf = busca_filtro_tabla("ruta,etiqueta", "anexos", "documento_iddocumento=" . $iddoc, "");
	if ($anexos_pqrsf["numcampos"]) {
		for ($i = 0; $i < $anexos_pqrsf["numcampos"]; $i++) {
			$ruta_archivo = json_decode($anexos_pqrsf[$i]['ruta']);
			if (is_object($ruta_archivo)) {
				$anexos[] = $anexos_pqrsf[$i]['ruta'];
			} else {
				if (file_exists($ruta_db_superior . $anexos_pqrsf[$i]['ruta'])) {
					$anexos[] = $ruta_db_superior . $anexos_pqrsf[$i]['ruta'];
				}
			}
		}
	}

	$datos = busca_filtro_tabla("d.numero,d.pdf,ft.destinos,ft.copia", "ft_respuesta_pqrsf ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "");
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
	$email = array();
	$tipo_email = array(
		"para" => "email",
		"copia" => "email"
	);
	if ($datos[0]["destinos"] != "") {
		$eje = busca_filtro_tabla("email", "vejecutor", "iddatos_ejecutor=" . $datos[0]["destinos"], "");
		if ($eje["numcampos"] && $eje[0]["email"] != "") {
			$email["para"][] = $eje[0]["email"];
		}
	}

	if ($datos[0]["copia"] != "") {
		$eje = busca_filtro_tabla("email", "vejecutor", "iddatos_ejecutor in (" . $datos[0]["copia"] . ")", "");
		if ($eje["numcampos"] && $eje[0]["email"] != "") {
			$email["copia"][] = $eje[0]["email"];
		}
	}
	if (!count($email)) {
		$email["para"][] = $datos_papa[0]["email"];
	}
	$mensaje = "Cordial Saludo,<br/>
				Se adjunta copia de la respuesta a la solicitud PQRSF No " . $datos_papa[0]['numero'] . "<br/><br/>
				Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br/>
				ESTE ES UN MENSAJE AUTOMATICO, FAVOR NO RESPONDER";
	$ok = enviar_mensaje("", $tipo_email, $email, "RESPUESTA A SOLICITUD PQR NO " . $datos_papa[0]['numero'], $mensaje, $anexos, $iddoc);
	if ($ok === true) {
		$update_estado = "UPDATE ft_pqrsf SET estado_reporte=3,funcionario_reporte=" . $_SESSION["idfuncionario"] . ",fecha_reporte=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $iddoc_papa;
		phpmkr_query($update_estado);
	}
}

function distribucion_res_pqrsf($idformato, $iddoc)
{
	global $conn, $ruta_db_superior;
	$datos = busca_filtro_tabla("tipo_mensajeria,requiere_recogida", "ft_respuesta_pqrsf", "documento_iddocumento=" . $iddoc, "");
	if ($datos["numcampos"]) {
		$estado_recogida = 0;
		$estado_distribucion = 1;
		if (!$datos[0]['requiere_recogida']) {
			$estado_recogida = 1;
			$estado_distribucion = 0;
		}
		if ($datos[0]['tipo_mensajeria'] == 3) {
			$estado_distribucion = 3;
		}

		include_once($ruta_db_superior . "app/distribucion/funciones_distribucion.php");
		pre_ingresar_distribucion($iddoc, 'dependencia', 1, 'destinos', 2, $estado_distribucion, $estado_recogida);
		//INT -EXT
	}
}
