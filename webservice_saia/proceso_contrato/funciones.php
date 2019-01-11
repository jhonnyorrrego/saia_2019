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
if (!$_SESSION["LOGIN" . LLAVE_SAIA]) {
	logear_funcionario_webservice("radicador_web");
}
include_once ($ruta_db_superior . 'formatos/librerias/funciones_generales.php');
include_once ($ruta_db_superior . 'pantallas/qr/librerias.php');

function consultar_datos_contrato($datos) {
	global $conn, $ruta_db_superior;
	$retorno = array();
	$retorno['exito'] = 1;
	$retorno['msn'] = '';
	$datos = json_decode($datos, true);

	if ($datos["numero_radicado"] != "") {
		$contrato = busca_filtro_tabla("idft_identifica_contrato,d.iddocumento", "ft_identifica_contrato c,documento d", "d.iddocumento=c.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO','ACTIVO') and d.numero='" . $datos["numero_radicado"] . "'", "", $conn);
		if ($contrato["numcampos"]) {
			$form = busca_filtro_tabla("idformato", "formato", "nombre='identifica_contrato'", "", $conn);
			$info = array();
			for ($j = 0; $j < $contrato["numcampos"]; $j++) {
				$info[$j]["naturaleza_contrato"] = mostrar_valor_campo('naturaleza_contrato', $form[0]["idformato"], $contrato[$j]["iddocumento"], 1);
				$info[$j]["estado_contrato"] = mostrar_valor_campo('estado_contrato', $form[0]["idformato"], $contrato[$j]["iddocumento"], 1);
				$info[$j]["fecha_inicio"] = mostrar_valor_campo('fecha_acta', $form[0]["idformato"], $contrato[$j]["iddocumento"], 1);
				$info[$j]["fecha_fin"] = mostrar_valor_campo('fecha_final_contrato', $form[0]["idformato"], $contrato[$j]["iddocumento"], 1);
				$info[$j]["qr"] = mostrar_codigo_qr($form[0]["idformato"], $contrato[$j]["iddocumento"], 1,100,100);
				$datos_hijos = array();
				$hijos = busca_filtro_tabla("dc.*,s.nombre as nombre_serie", "ft_docs_contrato dc,documento d, serie s", "d.iddocumento=dc.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO') and s.idserie=dc.tipo_documento and dc.ft_identifica_contrato=" . $contrato[$j]["idft_identifica_contrato"], "estado_docs desc, fecha_vencimiento desc", $conn);
				if ($hijos["numcampos"]) {
					$idcampo = busca_filtro_tabla("idcampos_formato", "campos_formato cf,formato f", "f.idformato=cf.formato_idformato and cf.nombre='anexo_docs' and f.nombre='docs_contrato'", "", $conn);
					for ($i = 0; $i < $hijos["numcampos"]; $i++) {
						$fecha_vencimiento = "";
						if ($hijos[$i]["fecha_vencimiento"]) {
							$dias = resta_fechasphp($hijos[$i]["fecha_vencimiento"], date('Y-m-d'));
							$color = "";
							if ($dias > 15) {
								$color = "success";
							} else if ($dias > 0 && $dias <= 15) {
								$color = "warning";
							} else if ($dias <= 0) {
								$color = "danger";
							}
							$fecha_vencimiento = '<span class="label label-' . $color . '">' . $hijos[$i]["fecha_vencimiento"] . '</span>';
						}

						$color_estado = "";
						if ($hijos[$i]["estado_docs"] == 'Activo') {
							$color_estado = 'success';
						} else if ($hijos[$i]["estado_docs"] == 'Inactivo') {
							$color_estado = "important";
						}
						$datos_hijos[$i]["nombre_documento"] = $hijos[$i]["nombre_documento"];
						$datos_hijos[$i]["nombre_serie"] = $hijos[$i]["nombre_serie"];
						$datos_hijos[$i]["fecha_vencimiento"] = $fecha_vencimiento;
						$datos_hijos[$i]["estado_docs"] = '<span class="label label-' . $color_estado . '">' . $hijos[$i]["estado_docs"] . '</span>';
						$datos_hijos[$i]["anexo"] = "";

						$anexos = busca_filtro_tabla("etiqueta,ruta", "anexos", "documento_iddocumento=" . $hijos[$i]["documento_iddocumento"] . " and campos_formato=" . $idcampo[0]["idcampos_formato"], "", $conn);
						if ($anexos["numcampos"]) {
							$ruta_archivo = json_decode($anexos[0]["ruta"]);
							if (is_object($ruta_archivo)) {
								$archivo_bin = StorageUtils::get_file_content($anexos[0]["ruta"]);
								if ($archivo_bin !== false) {
									$datos_hijos[$i]["anexo"] = base64_encode($archivo_bin);
									$datos_hijos[$i]["etiqueta_anexo"] = $anexos[0]["etiqueta"];
								}
							}
						}
					}
				}
				$info[$j]["datos_hijos"] = $datos_hijos;
			}
			$retorno["datos"] = $info;
		} else {
			$retorno['exito'] = 0;
			$retorno['msn'] = "No se encontraron documentos con los datos suministrados";
		}
	} else {
		$retorno['exito'] = 0;
		$retorno['msn'] = "Debe ingresar el numero de radicado";
	}

	$conf_color = busca_filtro_tabla("valor", "configuracion", "nombre='barra_inferior' and tipo='temas_main'", "", $conn);
	if ($conf_color["numcampos"]) {
		$retorno["color_saia"] = $conf_color[0]["valor"];
	}

	ob_clean();
	session_destroy();
	return (json_encode($retorno));
}

session_destroy();
?>