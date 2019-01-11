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
	if (isset($_REQUEST["iddoc"])) {
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
	$plantilla=busca_filtro_tabla("ruta_anexo,nombre,extension","plantilla_word","estado=1","",$conn);
	$option='<select id="plantilla_word" name="plantilla_word"><option value="">Seleccione</option>';
	if($plantilla["numcampos"]){
		for ($i=0; $i <$plantilla["numcampos"] ; $i++) { 
			$option.='<option value="'.base64_encode($plantilla[$i]["ruta_anexo"]).'">'.$plantilla[$i]["nombre"].' ('.$plantilla[$i]["extension"].')</option>';
		}
	}
	$option.='</select>';
?>
<script>
	$(document).ready(function() {
		tree_clasifica_expediente.setOnCheckHandler(actualiza_serie_expediente);
		
		$("#tr_asunto_word").after('<tr id="tr_plantillas_word"><td class="encabezado">PLANTILLA</td> <td><?php echo $option;?> <span id="descargar_plantilla">-</span></td></tr>');
		$("#plantilla_word").change(function (){
			$("#descargar_plantilla").empty().html('<a href="<?php echo $ruta_db_superior;?>anexosdigitales/parsea_accion_archivo.php?accion=descargar_ruta_json&ruta='+$(this).val()+'">Descargar</a>');
		});
		$("#formulario_formatos").submit(function(event){
			var csv = $("#anexo_csv").val();
			var word = $("#anexo_word").val();
			$.ajax({
				type:'POST',
				dataType: 'json',
				url: "validar_plantilla.php",
				data: {anexo_word:word, anexo_csv:csv},
				success: function(respuesta){
					if(respuesta.exito == 1){
						//form.submit();
					}else if(respuesta.exito == 0){
						alert("Faltan variables obligatorias en el word. (formato_numero, ciudad_fecha, nombre_funcionario, cargo, nombre_dependencia)");
					}else if(respuesta.exito == 2){
						alert("Faltan variables en archivo excel o csv. Faltantes: "+respuesta.faltante);
					}else if(respuesta.exito == 3){
						alert("Excel o csv vacios");
					}
					event.preventDefault();
					return false;
				}
			});
			return false;
		});
	});
	
	
	function actualiza_serie_expediente(nodeId) {
		idexp_serie = nodeId.split('sub');
		$('[name="serie_idserie"]').val(idexp_serie[1]);
		$('[name="fk_idexpediente"]').val(idexp_serie[0]);
	}
</script>
<?php
}

/*POSTERIOR ADICIONAR*/
function post_add_documento_word($idformato, $iddoc){
	global $ruta_db_superior,$conn;
	$datos=busca_filtro_tabla("fk_idexpediente","ft_oficio_word","documento_iddocumento=".$iddoc,"",$conn);
	if($datos["numcampos"]){
		include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");
		vincular_documento_expediente($datos[0]["fk_idexpediente"], $iddoc);
	}
	return;
}

/*POSTERIOR*/
function generar_documento_word($idformato, $iddoc) {// POSTERIOR AL ADICIONAR,EDITAR,CONFIRMAR,APROBAR
	global $conn, $ruta_db_superior;
	$word = new RadicadoWord($idformato, $iddoc, "anexo_word", "anexo_csv");
	$word -> prepare();
	if ($word -> retorno["exito"]) {
		$word -> generar_pdf_word();
		if (!$word -> retorno["exito"]) {
			redirecciona($ruta_db_superior . "formatos/oficio_word/mostrar_oficio_word.php?iddoc=" . $iddoc . "&idformato=" . $idformato . "&error_pdf_word=1&rand=" . rand(0, 10000));
			die();
		}
	} else {
		redirecciona($ruta_db_superior . "formatos/oficio_word/mostrar_oficio_word.php?iddoc=" . $iddoc . "&idformato=" . $idformato . "&error_pdf_word=1&rand=" . rand(0, 10000));
		die();
	}
}

function mostrar_error_pdf($idformato, $iddoc) {
	$html = "";
	if ($_REQUEST["error_pdf_word"]) {
		$html = '<h3 style="color:red;text-align:center">NO SE PUDO GENERAR EL DOCUMENTO</h3>';
	}
	echo $html;
}
?>
