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
include_once ($ruta_db_superior . "librerias_saia.php");


/*ADICIONAR*/
function mostrar_enlace_plantilla($idformato, $iddoc) {// ADICIONAR
	global $ruta_db_superior, $conn;
	$configuracion = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_plantilla_word'", "", $conn);
	if(!$configuracion["numcampos"] || $configuracion[0]["valor"]==""){
		notificaciones("No se ha definido la ruta de la plantilla Word");
		redirecciona($ruta_db_superior."vacio.php");
	}
	$ruta_plantilla = $ruta_db_superior . $configuracion[0]['valor'];
	?>
<script>
		$(document).ready(function(){
			$html='<div style="text-align:center; font-size:11pt;">';
			$html+='<b>ATENCION!</b> <BR>Por favor descargue ';
			$html+=' <a href="<?php echo($ruta_plantilla); ?>plantilla_nuevo_oficio.docx" target="_blank">ESTA PLANTILLA</a> ';
			$html+=' para crear un nuevo oficio, &oacute; hacer caso omiso si ya dispone de ella.';
			$html+='<br>Si desea ';
			$html+='<a href="<?php echo($ruta_plantilla); ?>plantilla_nuevo_oficio_combinar.docx" target="_blank">COMBINAR</a>';
			$html+=' correspondencia descargue la siguiente plantilla.</div>';
			$('#enlace_plantilla').html($html);
		});
	</script>
<?php
}

/*POSTERIOR ADICIONAR-EDITAR*/
function generar_exportar_word($idformato, $iddoc) {// POSTERIOR AL ADICIONAR Y EDITAR
	global $ruta_db_superior, $conn;
	include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/exportar_word.php');
}

/*MOSTRAR*/
function mostrar_mensaje_error_pdf($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$anexos_documento_word = busca_filtro_tabla("d.ruta", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $iddoc . " AND d.documento_iddocumento=" . $iddoc, "", $conn);
	$ruta_almacenar = explode('anexos', $anexos_documento_word[0]["ruta"]);
	$pdf = $ruta_db_superior . $ruta_almacenar[0] . 'docx/documento_word.pdf';
	if (!file_exists($pdf)) {
		$cadena = '<div class="well alert-danger">No Fue posible generar el PDF, por favor intente subir nuevamente el archivo .docx<br>' . $html . '</div>';
		echo($cadena);
	}
}


/*POSTERIOR CONFIRMAR*/
function generar_firma_word($idformato, $iddoc) {
	global $ruta_db_superior, $conn;
	include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/firmar_word.php');	
}

/*POSTERIOR APROBAR*/
function generar_radicado_word($idformato, $iddoc) {// POSTERIOR AL APROBAR
	global $ruta_db_superior, $conn;
	$busca_masivo = busca_filtro_tabla("", "anexos a, campos_formato b", "b.nombre='anexo_csv' AND a.campos_formato=b.idcampos_formato AND a.documento_iddocumento=" . $iddoc, "", $conn);
	if ($busca_masivo['numcampos']) {
		include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/funciones_radicacion_word.php');
		$radicar_word = new RadicadoWord($iddoc);
		$radicar_word -> asignar_radicado();
	} else {
		include_once ($ruta_db_superior . 'pantallas/lib/PhpWord/numero_radicado_word.php');
	}
}

?>
