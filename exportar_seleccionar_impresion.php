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

$iddoc = $_REQUEST["iddoc"];
unset($_REQUEST["iddoc"]);
if ($iddoc) {
	include_once ("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento($iddoc));
}

require_once ($ruta_db_superior . "class_impresion_tcpdf.php");
usuario_actual("id");

use setasign\Fpdi\Fpdi;
class ConcatPdf extends Fpdi {
	public $files = array();

	public function setFiles($files) {
		$this -> files = $files;
	}

	public function concat() {
		foreach ($this->files AS $file) {
			$pageCount = $this -> setSourceFile($file);
			for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
				$pageId = $this -> ImportPage($pageNo);
				$s = $this -> getTemplatesize($pageId);
				$this -> AddPage($s['orientation'], $s);
				$this -> useImportedPage($pageId);
			}
		}
	}

}

function parsea_idformato($id = 0) {
	$arreglo = array();
	if ($id) {
		$arreglo = explode("-", $id);
	} else if ($_REQUEST["id"]) {
		$arreglo = explode("-", $_REQUEST["id"]);
	} else {
		return ($arreglo);
	}
	if ($arreglo[2][0] == "r") {
		$arreglo[2] = 0;
	}
	if ($_REQUEST["accion"]) {
		$arreglo[3] = $_REQUEST["accion"];
	} else {
		$arreglo[3] = "mostrar";
	}
	return ($arreglo);
}

$ruta_temp = $_SESSION["ruta_temp_funcionario"];
$listado_pdf = array();
$pag = array();

$arreglo_dato = array_filter(explode(",", @$_REQUEST["seleccion"]));
unset($_REQUEST["seleccion"]);
$cant_sel = count($arreglo_dato);

if ($cant_sel) {
	for ($i = 0; $i < $cant_sel; $i++) {
		if ($arreglo_dato[$i]) {
			$dato = parsea_idformato($arreglo_dato[$i]);
			// caso cuando es un formato
			if ($dato[1] && $dato[2] && $dato[0] != "p") {
				$formato = busca_filtro_tabla("nombre,ruta_mostrar,nombre_tabla,etiqueta", "formato", "idformato=" . $dato[0], "", $conn);
				if ($formato["numcampos"]) {
					$busca_doc = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"], "id" . $formato[0]["nombre_tabla"] . "=" . $dato[2], "", $conn);
					if ($busca_doc["numcampos"]) {
						$nombre_archivo = $ruta_temp . date("Y_m_d_H_i_s") . "_" . $i . ".pdf";
						$_REQUEST["tipo_salida"] = "F";
						$_REQUEST["nombre_archivo"] = $nombre_archivo;
						$pdf_form = new Imprime_Pdf($busca_doc[0]["documento_iddocumento"]);
						$pdf_form -> configurar_pagina($_REQUEST);
						$pdf_form -> imprimir();
						if (is_file($nombre_archivo)) {
							array_push($listado_pdf, $nombre_archivo);
						} else {
							notificaciones("No se pudo generar el documento del formato " . $formato[0]["etiqueta"]);
						}
					}
				}
			} else if ($dato[0] == "p" && $dato[1]) {
				$pagina = busca_filtro_tabla("id_documento", "pagina", "consecutivo=" . $dato[1], "", $conn);
				if ($pagina["numcampos"]) {
					$iddoc_pag = $pagina[0]["id_documento"];
					$pag[] = $dato[1];
				} else {
					notificaciones("El identificador de la pagina NO existe");
				}
			}
		}
	}

	$listado_final = $listado_pdf;
	if (count($pag)) {
		$nombre_archivo = $ruta_temp . date("Y_m_d_H_i_s") . "_pg" . ".pdf";
		$_REQUEST["tipo_salida"] = "F";
		$_REQUEST["iddoc_pag"] = $iddoc_pag;
		$_REQUEST["nombre_archivo"] = $nombre_archivo;

		$pdf_form = new Imprime_Pdf("");
		$pdf_form -> configurar_pagina($_REQUEST);
		if ($_REQUEST["config"] == 0) {
			$pdf_form -> set_variable("margenes", array());
		}
		$pdf_form -> set_variable("imprimir_paginas", 1);
		$pdf_form -> set_variable("idpaginas", implode(",", $pag));
		$pdf_form -> imprimir();
		if (is_file($nombre_archivo)) {
			array_push($listado_final, $nombre_archivo);
		} else {
			notificaciones("No se pudo generar las paginas");
		}
	}

	if (count($listado_final) == 1) {
		$url_archivo = $listado_final[0];
	} else {
		$nombre_archivo = $ruta_temp . date("Y_m_d_H_i_s") . ".pdf";
		$pdf_concat = new ConcatPdf();
		$pdf_concat -> setFiles($listado_final);
		$pdf_concat -> concat();
		$pdf_concat -> Output('F', $nombre_archivo);
		foreach ($listado_final as $file) {
			unlink($file);
		}
		$url_archivo = $nombre_archivo;
	}

	$url = "vacio.php";
	if (is_file($url_archivo)) {
		$url = $url_archivo;
		$nombre_archivo = basename($url);
		$destino = $iddoc . "/" . date("Y-m-d") . "/";

		$alm_destino = new SaiaStorage("historial_impresion");
		$alm_destino -> copiar_contenido_externo($url, $destino . $nombre_archivo);
		$ruta_alm = array(
			"servidor" => $alm_destino -> get_ruta_servidor(),
			"ruta" => $destino . $nombre_archivo
		);
		$ipremoto = servidor_remoto();
		$insert = "INSERT INTO historial_impresion (fecha,funcionario_idfuncionario,ip,ruta_pdf) VALUES (" . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . "," . $_SESSION["idfuncionario"] . ",'" . $ipremoto . "','" . json_encode($ruta_alm) . "')";
		phpmkr_query($insert) or die("Error al guardar el registro en la DB");
	}
}
?>
<iframe  src="<?php echo $url; ?>" width="100%" height="100%" style="border: 0;"></iframe>