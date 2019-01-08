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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery('1.7'));

?>


<script>
	$(document).ready(function(){
		$('.exportar_reporte_cierre_dia').live('click',function(){
			var variable_busqueda=$(this).attr('variable_busqueda');
			var enlace='pantallas/tareas_listado/exportar_reporte_cierre_dia.php?variable_busqueda='+variable_busqueda;
	        top.hs.htmlExpand(this, { 
	        	objectType: 'iframe',
	        	width: 500, 
	        	height: 200,
	        	contentId:'centro', 		
	        	preserveContent:false, 
	        	src:enlace,
	        	outlineType: 'rounded-white',
	        	wrapperClassName:'highslide-wrapper drag-header'
	        });	
		});
	});
</script>