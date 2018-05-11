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

include_once ($ruta_db_superior . "pantallas/documento/menu_principal_documento.php");

$iddoc = @$_REQUEST["iddoc"];
menu_principal_documento($iddoc, 1);
$datos = busca_filtro_tabla("A.pdf,A.plantilla,B.mostrar_pdf,A.numero", "documento A,formato B", "lower(A.plantilla)=B.nombre AND A.iddocumento=" . $iddoc, "", $conn);
$es_pdf_word = $_REQUEST['pdf_word'];

if ($iddoc && !@$_REQUEST['pdf_word'] && $datos[0]['mostrar_pdf'] != 2) {
	$exportar_pdf = busca_filtro_tabla("valor", "configuracion A", "A.nombre='exportar_pdf'", "", $conn);
	$export = "";
	if ($datos[0]["pdf"] != "" && !isset($_REQUEST["actualizar_pdf"])) {
		$export = "visores/pdf/web/viewer2.php?iddocumento=" . $iddoc;
	} else {
		if ($exportar_pdf[0]["valor"] == 'html2ps') {
			$export = "exportar_impresion.php?iddoc=" . $iddoc . "&plantilla=" . strtolower($datos[0]["plantilla"]) . "&rand=" . rand(1, 100000);
		} else if ($exportar_pdf[0]["valor"] == 'class_impresion') {
			$export = "class_impresion.php?iddoc=" . $iddoc . "&rand=" . rand(1, 100000);
		} else {
			$export = "exportar_impresion.php?iddoc=" . $iddoc . "&plantilla=" . strtolower($datos[0]["plantilla"]) . "&rand=" . rand(1, 100000);
		}
	}
	$pdf = $ruta_db_superior . $export;
	if (@$_REQUEST["vista"]) {
		$pdf .= "&vista=" . $_REQUEST["vista"];
	}
} else {
	$_REQUEST['from_externo'] = 1;
	if (intval($datos[0]["numero"]) != 0) {
		include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/numero_radicado_word.php');
	} else {
		include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/exportar_word.php');
	}
	$anexos_documento_word = busca_filtro_tabla("d.ruta", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $iddoc . " AND d.documento_iddocumento=" . $iddoc, "", $conn);
	$almacenamiento = null;
	$ruta_pdf = null;
	if ($anexos_documento_word['numcampos']) {
		$arr_alm = StorageUtils::resolver_ruta($anexos_documento_word[0]["ruta"]);
		$dir_name = rtrim(dirname($arr_alm["ruta"]), "anexos");

		$pdf = $dir_name . 'docx/documento_word.pdf';
		$almacenamiento = $arr_alm["clase"];
		$arr_ruta_pdf = array(
			"servidor" => $arr_alm["servidor"],
			"ruta" => $pdf
		);
		$ruta_pdf = base64_encode(json_encode($arr_ruta_pdf));
	}

	if ($almacenamiento && !$almacenamiento -> get_filesystem() -> has($pdf)) {
		$documento = busca_filtro_tabla("", "documento a, formato b", "lower(a.plantilla)=b.nombre AND a.iddocumento=" . $iddoc, "", $conn);
		$ruta_mostrar = $ruta_db_superior . 'formatos/' . $documento[0]['nombre'] . '/' . $documento[0]['ruta_mostrar'] . '?idformato=' . $documento[0]['idformato'] . '&iddoc=' . $iddoc . '&error_pdf_word=1';
		include_once ($ruta_db_superior . "db.php");
		abrir_url($ruta_mostrar, '_self');
		die();
	} else {
		$pdf .= '?rand=' . rand(0, 100000);
	}
}
?>
<script>
	$(document).ready(function() {
		var alto_menu = $("#menu_principal_documento").height();
		if (parseInt(alto_menu) >= 0) {
			var alto = ($(window).height());
			$("#detalles").height((alto - alto_menu) - 20);
		} else {
			var alto = ($(window).height());
			$("#detalles").height(alto - 20);
		}
	}); 
</script>
<?php
if ($es_pdf_word) {
?>
<iframe id="detalles" width="100%" frameborder="0" name="detalles" src="<?php echo($ruta_db_superior . "filesystem/mostrar_binario.php?ruta=" . $ruta_pdf); ?>"></iframe>
<?php
} else {
?>
<iframe id="detalles" width="100%" frameborder="0" name="detalles" src="<?php echo($pdf); ?>"></iframe>
<?php
}
?>