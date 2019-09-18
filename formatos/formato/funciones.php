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
include_once ($ruta_db_superior . "assets/librerias.php");

function no_permitir_adicion_formatos_acalidad($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	echo(librerias_notificaciones());
	?>
		<script>
		$(document).ready(function(){
		  notificacion_saia('Solo se puede realizar desde el formato SOLICITUD DE ELABORACI&Oacute;N, MODIFICACI&Oacute;N, ELIMINACI&Oacute;N DE DOCUMENTOS','dangerous','',4000);
		  window.location="<?php echo($ruta_db_superior); ?>vacio.php";
		});
		</script>
	<?php
}
?>