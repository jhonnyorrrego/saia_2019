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
include_once ($ruta_db_superior . "librerias_saia.php");
echo(librerias_jquery("1.7"));
?>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change', '.seleccionar', function(e) {
			var checkedVals = $('.seleccionar:checkbox:checked').map(function() {
				return this.value;
			}).get();
			$("#seleccionados_expediente").val(checkedVals.join(","));
		});

		$(document).on("click", "#transferencia_documental", function() {
			var seleccionados = $("#seleccionados_expediente").val();
			if (seleccionados) {
				$.ajax({
					type : "POST",
					url : "../expediente/validar_cierre_expedientes.php",
					data : {
						idexpedientes : seleccionados
					},
					dataType : 'json',
					success : function(response) {
						if (response.exito == 1) {
							enlace_katien_saia("formatos/transferencia_doc/adicionar_transferencia_doc.php?id=" + seleccionados, "Transferencia documental", "iframe", "");
						} else {
							alert(response.msn);
						}
					},
					error : function(err) {
						alert("Error al procesar la solicitud, intente de nuevo");
					}
				});
			}else{
				alert("Seleccione al menos un expediente");
			}

		});
		$(document).on("click", "#prestamo_documento", function() {
			var seleccionados = $("#seleccionados_expediente").val();
			var estado_archivo = 1;
			if (seleccionados) {
				enlace_katien_saia("formatos/solicitud_prestamo/adicionar_solicitud_prestamo.php?id=" + seleccionados + "&estado_archivo=" + estado_archivo, "Solicitud de prestamo", "iframe", "");
			} else {
				alert("Seleccione por lo menos un expediente");
			}
		});
	}); 
</script>