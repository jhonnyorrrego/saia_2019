<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = "";
$ruta = "";
while ($max_salida > 0) {
	$file=is_file($ruta . "db.php");
    if ($file) {
        $ruta_db_superior = $ruta;
		break;
        //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
print_r($_REQUEST);
echo(estilo_lightness());
echo(librerias_jquery("sapi"));
echo(librerias_UI());
echo(librerias_kaiten());
//echo(librerias_tiny());
echo(librerias_principal());
echo(estilo_principal());
print_r($_SESSION);
?>
<div id="container"></div>
<div id="custom-options-text" class="hidden">
</div>
<script type="text/javascript">
(function($){
	$K = $('#container');
	$K.kaiten({ 
		columnWidth : '320px',
		optionsSelector : '#custom-options-text',
		startup : function(dataFromURL){
				this.kaiten('load', { kConnector:'html.page', url:'pruba/buscador0.php', 'kTitle':'Home' });
		}
	});
})(jQuery);
</script>			
