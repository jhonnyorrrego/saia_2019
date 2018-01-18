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
include_once ($ruta_db_superior . "class_transferencia.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
global $conn;

if (isset($_REQUEST["tipo_aprobacion"]) && isset($_REQUEST["idcf"])) {
	$retorno = array();
	$retorno["exito"] = 0;
	$retorno["msn"] = "";
	$datos = busca_filtro_tabla("cf.*,d.estado,d.plantilla,d.numero", "cf_ruta_formato cf,documento d", "cf.idcf_ruta_formato=" . $_REQUEST["idcf"] . " and d.iddocumento=cf.documento_iddocumento", "", $conn);
	$siguiente = busca_filtro_tabla("cf.*,f.nombres,f.apellidos,f.idfuncionario,d.estado", "cf_ruta_formato cf,funcionario f,documento d", "cf.documento_iddocumento=" . $datos[0]["documento_iddocumento"] . " and cf.idcf_ruta_formato>" . $_REQUEST["idcf"] . " and cf.estado=1 and cf.funcionario_codigo=f.funcionario_codigo and d.iddocumento=cf.documento_iddocumento", "cf.orden asc", $conn);
	$idformato = busca_filtro_tabla("idformato,etiqueta,nombre_tabla", "formato", "nombre='" . strtolower($datos[0]["plantilla"]) . "'", "", $conn);

	$notas_transferencia = "";
	$anexos = array();
	$asunto = "NOTIFICACIONES FABRICATO";
	if ($_REQUEST["asunto_correo"] != "") {
		$asunto = $_REQUEST["asunto_correo"];
	}
	if (isset($_REQUEST["observ"]) && trim($_REQUEST["observ"]) != "" && trim($_REQUEST["observ"]) != "null" && trim($_REQUEST["observ"]) != "undefined") {
		$notas_transferencia = htmlentities($_REQUEST["observ"]) . "<br/><br/>";
	}
	$mensaje = "Cordial Saludo " . $siguiente[0]["nombres"] . " " . $siguiente[0]["apellidos"] . ",<br/><br/>
  Se le notifica que se ha solicitado su confirmaci&oacute;n para el documento con radicado No. " . $datos[0]["numero"] . " del formato " . $idformato[0]["etiqueta"] . "<br/><br/>";
	if ($notas_transferencia != "") {
		$mensaje .= "Observaciones:<br/>" . $notas_transferencia;
	}
	$mensaje .= "Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br/>
  ESTE ES UN MENSAJE AUTOMATICO, FAVOR NO RESPONDER";

	switch ($_REQUEST["tipo_aprobacion"]) {
		case '1' :
			//Aprobado
			$sql_update = "UPDATE cf_ruta_formato SET notificacion=1,tipo_aprobacion=1,fecha=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ",observaciones='" . htmlentities(@$_REQUEST["observ"]) . "' WHERE idcf_ruta_formato=" . $_REQUEST["idcf"];
			phpmkr_query($sql_update) or die("Error: " . $sql_update);

			if ($siguiente["numcampos"]) {
				if (@$_REQUEST["genera_pdf"] == 1) {
					$ch = curl_init();
					$fila = "http://" . RUTA_PDF_LOCAL . "/html2ps/public_html/demo/html2ps.php?plantilla=" . strtolower($datos[0]["plantilla"]) . "&iddoc=" . $datos[0]["documento_iddocumento"] . "&conexion_remota=1";
					curl_setopt($ch, CURLOPT_URL, $fila);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$contenido = curl_exec($ch);
					curl_close($ch);
					$datos_doc = busca_filtro_tabla("d.pdf", $idformato[0]["nombre_tabla"] . " ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $datos[0]["documento_iddocumento"], "", $conn);
					if ($datos_doc[0]['pdf'] != "") {
						$anexos[] = $ruta_db_superior . $datos_doc[0]['pdf'];
					}
				}
				if ($datos[0]["notificacion"] == 0) {
					if ($datos[0]["tipo_notificacion"] != 0) {
						switch ($datos[0]["tipo_notificacion"]) {
							case 1 :
								transferencia_automatica($idformato[0]["idformato"], $datos[0]["documento_iddocumento"], $siguiente[0]["funcionario_codigo"], 3, $notas_transferencia . " (APROBADO)");
								break;
							case 2 :
								enviar_mensaje("codigo", array($siguiente[0]["funcionario_codigo"]), $mensaje, "e-interno", $anexos, $asunto);
								break;
							case 3 :
								transferencia_automatica($idformato[0]["idformato"], $datos[0]["documento_iddocumento"], $siguiente[0]["funcionario_codigo"], 3, $notas_transferencia . " (APROBADO)");
								enviar_mensaje("codigo", array($siguiente[0]["funcionario_codigo"]), $mensaje, "e-interno", $anexos, $asunto);
								break;
						}
					}
				}
			}
			if ($datos[0]["nombre_funcion"] != "" && $datos[0]["libreria"] != "") {
				include_once ($ruta_db_superior . $datos[0]["libreria"]);
				$retorno["info_funcion"] = $datos[0]["nombre_funcion"]($datos, $siguiente, $idformato, 1);
			}
			$retorno["exito"] = 1;
			break;

		case '2' :
			//rechazado
			$sql_update = "UPDATE cf_ruta_formato SET tipo_aprobacion=0,fecha=" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ",observaciones='" . $notas_transferencia . "' WHERE idcf_ruta_formato=" . $_REQUEST["idcf"];
			phpmkr_query($sql_update) or die("Error: " . $sql_update);

			if ($datos[0]["nombre_funcion"] != "" && $datos[0]["libreria"] != "") {
				include_once ($ruta_db_superior . $datos[0]["libreria"]);
				$retorno["info_funcion"] = $datos[0]["nombre_funcion"]($datos, $siguiente, $idformato, 2);
			}
			$retorno["exito"] = 1;
			break;

		case '3' :
			//devolucion
			if ($datos["numcampos"]) {
				$anterior = busca_filtro_tabla("idcf_ruta_formato,funcionario_codigo", "cf_ruta_formato", "documento_iddocumento=" . $datos[0]["documento_iddocumento"] . " and orden<" . $datos[0]["orden"], "orden desc", $conn);
				if ($anterior["numcampos"]) {
					$update_anterior = "UPDATE cf_ruta_formato SET tipo_aprobacion=NULL,notificacion=0 WHERE idcf_ruta_formato=" . $anterior[0]["idcf_ruta_formato"];
					phpmkr_query($update_anterior) or die("Error: " . $update_anterior);
					transferencia_automatica($idformato[0]["idformato"], $datos[0]["documento_iddocumento"], $anterior[0]["funcionario_codigo"], 3, $notas_transferencia . " (DEVUELTO)", array("nombre" => "DEVOLUCION"));
				}
			}
			$sql_update = "UPDATE cf_ruta_formato SET notificacion=0,fecha=NULL,tipo_aprobacion=NULL WHERE idcf_ruta_formato=" . $_REQUEST["idcf"];
			phpmkr_query($sql_update) or die("Error: " . $sql_update);

			if ($datos[0]["nombre_funcion"] != "" && $datos[0]["libreria"] != "") {
				include_once ($ruta_db_superior . $datos[0]["libreria"]);
				$retorno["info_funcion"] = $datos[0]["nombre_funcion"]($datos, $siguiente, $idformato, 3);
			}
			$retorno["exito"] = 1;
			break;

		case '4' :
			//Reactivar Proceso
			$sql_update = "UPDATE cf_ruta_formato SET tipo_aprobacion=NULL,notificacion=0,fecha=NULL,observaciones=NULL WHERE idcf_ruta_formato=" . $_REQUEST["idcf"];
			phpmkr_query($sql_update) or die("Error: " . $sql_update);
			if ($datos[0]["nombre_funcion"] != "" && $datos[0]["libreria"] != "") {
				include_once ($ruta_db_superior . $datos[0]["libreria"]);
				$retorno["info_funcion"] = $datos[0]["nombre_funcion"]($datos, $siguiente, $idformato, 4);
			}
			$retorno["exito"] = 1;
			break;
	}
	echo json_encode($retorno);
}
?>