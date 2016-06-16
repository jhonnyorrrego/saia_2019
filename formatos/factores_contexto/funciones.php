<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery('1.7'));

function validar_tipo_contexto($idformato, $iddoc){
?>
<script type="text/javascript" >
	$(document).ready(function(){
		var tipo_factor = <?php echo($_REQUEST['tipo_factor']);?>
		
		if(parseInt(tipo_factor) == 1){
			$("#factores_contexto0").attr('checked', 'checked');
		}else{
			$("#factores_contexto1").attr('checked', 'checked');
		}
	});
</script>
<?php
}
?>