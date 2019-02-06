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

include_once $ruta_db_superior . 'controllers/autoload.php';

$iddoc = $_REQUEST["iddoc"];
$datos = busca_filtro_tabla("A.pdf,A.plantilla,B.mostrar_pdf,A.numero,B.idformato", "documento A,formato B", "lower(A.plantilla)=B.nombre AND A.iddocumento=" . $iddoc, "", $conn);
//$es_pdf_word = $_REQUEST['pdf_word'];
if (isset($_REQUEST['pdf_word'])) {
	if ($datos[0]["pdf"] != "" && !isset($_REQUEST["actualizar_pdf"])) {
		$export = "visores/pdf.js-view/web/viewer2.php?tipo_visor=1&actualizar_pdf=1&iddocumento=" . $iddoc . "&ruta=" . base64_encode($datos[0]["pdf"]);
	} else {
		if (!isset($_REQUEST["error_pdf_word"])) {
			include_once ($ruta_db_superior . FORMATOS_CLIENTE . "oficio_word/funciones.php");
			generar_documento_word($datos[0]["idformato"], $iddoc);
			$datos_word = busca_filtro_tabla("pdf", "documento", "iddocumento=" . $iddoc, "", $conn);
			if ($datos_word[0]["pdf"] != "") {
				$export = "visores/pdf.js-view/web/viewer2.php?tipo_visor=1&actualizar_pdf=1&iddocumento=" . $iddoc . "&ruta=" . base64_encode($datos_word[0]["pdf"]);
			}
		}
	}
} else {
	if ($iddoc && $datos[0]['mostrar_pdf'] != 2) {
		$exportar_pdf = busca_filtro_tabla("valor", "configuracion A", "A.nombre='exportar_pdf'", "", $conn);
		$export = "";
		if ($datos[0]["pdf"] != "" && !isset($_REQUEST["actualizar_pdf"])) {
			$export = "visores/pdf.js-view/web/viewer2.php?tipo_visor=1&iddocumento=" . $iddoc . "&ruta=" . base64_encode($datos[0]["pdf"]);
		} else {
			if ($exportar_pdf[0]["valor"] == 'html2ps') {
				$export = "exportar_impresion.php?iddoc=" . $iddoc . "&plantilla=" . strtolower($datos[0]["plantilla"]) . "&rand=" . rand(1, 100000);
			} else{
				$export = "class_impresion.php?iddoc=" . $iddoc . "&rand=" . rand(1, 100000);
			}
		}
	}
}
$pdf = $ruta_db_superior . $export;

?>
<iframe width="100%" frameborder="0" onload="this.height = window.innerHeight - 20" src="<?= $pdf ?>"></iframe>