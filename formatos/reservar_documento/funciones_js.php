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
echo (librerias_jquery('1.7'));

?>
<script>
$(document).ready(function(){
	//$("#nav_busqueda").after("<div style='margin:5px' class='ui-state-default ui-jqgrid-pager ui-corner-bottom'><button class='btn btn-mini' title='Entregar' id='entregar'>Entregar</button> <button class='btn btn-mini' title='Devolver' id='devolver'>Devolver</button></div>");
	/*Entregados*/
	$("#entregar").click(function (){
		var registros_seleccionados="";
		$('._entregar').each(function(){
			var checkbox = $(this);
			if(checkbox.is(':checked')===true){
				registros_seleccionados+=checkbox.val()+",";
			}
		});
		registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
		if(registros_seleccionados==""){
			alert("No ha seleccionado ningun campo");
		}else{
			var confirmacion=confirm("Esta seguro de entregar?");
			if(confirmacion){
				var observaciones=prompt("Por favor describa su entrega");
				window.open("../../formatos/reservar_documento/procesar_estado.php?accion=1&documentos="+registros_seleccionados+"&observaciones="+observaciones,"_self");
			}
		}
	});
	
	/*Devueltos*/
	$("#devolver").click(function (){
		var registros_seleccionados="";
		$('._devolver').each(function(){
			var checkbox = $(this);
			if(checkbox.is(':checked')===true){
				registros_seleccionados+=checkbox.val()+",";
			}
		});
		registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
		if(registros_seleccionados==""){
			alert("No ha seleccionado ningun campo");
		}else{
			var confirmacion=confirm("Esta seguro de devolver?");
			if(confirmacion){
				var observaciones=prompt("Por favor describa su devolucion");
				window.open("../../formatos/reservar_documento/procesar_estado.php?accion=2&documentos="+registros_seleccionados+"&observaciones="+observaciones,"_self");
			}
		}
	});
});

</script>