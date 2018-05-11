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

$ruta = @$_REQUEST["ruta"];
$mostrar = $ruta_db_superior . "filesystem/mostrar_binario.php?ruta=$ruta";
?>

<iframe id="detalles_pdf" width="100%" height="100%" frameborder="0" name="detalles_pdf" src="<?php echo($mostrar); ?>"></iframe>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery/1.4.2/jquery.js"></script>
<script>
	$(document).ready(function() {
		var alto = ($(window).height());
		$("#detalles_pdf").height(alto + 340);
	}); 
</script>
