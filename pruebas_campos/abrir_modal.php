<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
    if(is_file($ruta."db.php")){
        $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}

include_once($ruta_db_superior."assets/librerias.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="js/featherlight/featherlight.min.css" />

<?php
echo jquery();
?>
<script src="js/featherlight/featherlight.min.js" type="text/javascript"></script>
</head>
<body>
<div id="modal">Mostrar</div>

	<script type="text/javascript">
	$(document).ready(function() {
		console.log("Hola");
		//$(document).on('click', '.element', function() {
    	$('#modal').click(function() {
    		$.featherlight({
        		iframe: 'jsonform.html',
        		iframeMaxWidth: '98%',
        		iframeWidth: 600,
    			iframeHeight: 300,
    			marginheight: 5, marginwidth: 5,
    			});
    	});
	});
	</script>
</body>

	</html>