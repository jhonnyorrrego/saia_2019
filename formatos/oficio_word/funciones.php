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
include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/funciones_radicacion_word.php');

function add_edit_oficio_word($idformato, $iddoc) {
	global $ruta_db_superior, $conn;
	if ($_REQUEST["iddoc"]) {
		$opt = 1;
		$datos = busca_filtro_tabla("numero", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
		if ($datos["numcampos"] && $datos[0]["numero"] != 0) {
			notificaciones("El documento ya cuenta con un radicado, NO se puede editar el documento");
			redirecciona($ruta_db_superior . "vacio.php");
			die();
		}
	} else {
		$opt = 0;
	}
?>
<script>
	$(document).ready(function() {
		tree_clasifica_expediente.setOnCheckHandler(actualiza_serie_expediente);
	});
	function actualiza_serie_expediente(nodeId) {
		idexp_serie = nodeId.split('sub');
		$('[name="serie_idserie"]').val(idexp_serie[1]);
		$('[name="fk_idexpediente"]').val(idexp_serie[0]);
	}
</script>
<?php
}

/*POSTERIOR ADICIONAR-EDITAR*/
function post_add_edit_oficio_word($idformato, $iddoc) {// POSTERIOR AL ADICIONAR Y EDITAR
	global $conn, $ruta_db_superior;
	$word = new RadicadoWord($idformato, $iddoc, "anexo_word", "anexo_csv");
	$word -> prepare();
	if ($word -> retorno["exito"]) {
		$word -> cambiar_variables_word_add_edit();
		if (!$word -> retorno["exito"]) {
			redirecciona($ruta_db_superior . "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $iddoc . "&error_oficio=1&rand=" . rand(0, 10000));
			die();
		}
	} else {
		redirecciona($ruta_db_superior . "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $iddoc . "&error_oficio=1&rand=" . rand(0, 10000));
		die();
	}
}

function mostrar_error_pdf($idformato, $iddoc) {
	$html = "";
	if ($_REQUEST["error_oficio"]) {
		$html = '<h3 style="color:red;text-align:center">NO SE PUDO GENERAR EL DOCUMENTO</h3>';
	}
	echo $html;
}

/*POSTERIOR CONFIRMAR*/
function generar_firma_word($idformato, $iddoc) {
	global $ruta_db_superior, $conn;
	//include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/firmar_word.php');
}

/*POSTERIOR APROBAR*/
function post_aprob_oficio_word($idformato, $iddoc) {
	global $ruta_db_superior;
	/*$datos = busca_filtro_tabla("fk_idexpediente", "ft_oficio_word", "documento_iddocumento=" . $iddoc, "", $conn);
	 if ($datos["numcampos"]) {
	 if ($datos[0]["fk_idexpediente"]) {
	 include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");
	 vincular_documento_expediente($datos[0]["fk_idexpediente"], $iddoc);
	 }
	 }*/
}

function generar_radicado_word($idformato, $iddoc) {// POSTERIOR AL APROBAR
	/*global $ruta_db_superior, $conn;
	 $busca_masivo = busca_filtro_tabla("", "anexos a, campos_formato b", "b.nombre='anexo_csv' AND a.campos_formato=b.idcampos_formato AND a.documento_iddocumento=" . $iddoc, "", $conn);
	 if ($busca_masivo['numcampos']) {

	 $radicar_word = new RadicadoWord($idformato,$iddoc,$idanexo);
	 $radicar_word -> asignar_radicado();
	 } else {
	 include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/numero_radicado_word.php');
	 }*/
}
?>
