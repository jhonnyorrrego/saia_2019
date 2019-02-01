<?php
$max_salida = 6;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");
$ruta = $_REQUEST["ruta"];
unset($_REQUEST["ruta"]);
foreach ($_REQUEST as $key => $value) {
    $ruta .= "&" . $key . "=" . $value;
}
?>
<iframe id="detalles_pdf" width="100%" height="100%" frameborder="0" name="detalles_pdf" src="<?=$ruta; ?>"></iframe>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery/1.4.2/jquery.js"></script>
<script>
	$(document).ready(function() {
		var alto = ($(window).height());
		$("#detalles_pdf").height(alto + 450);
	}); 
</script>