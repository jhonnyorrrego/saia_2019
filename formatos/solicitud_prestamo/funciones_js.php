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
	$('#entregar_devolver').live("change",function(){
		var valor=$(this).val();
		entregar_devolver(valor);
		$('#entregar_devolver').val('');
	});
	
});
function entregar_devolver(accion){
	
		var valor_accion=0;
		var texto_observacion='';
		if(accion=='entregar'){
			valor_accion=1;
			texto_observacion='entrega';
		}
		if(accion=='devolver'){
			valor_accion=2;
			texto_observacion='devolucion';
		}
	
		var registros_seleccionados="";
		$('._'+accion).each(function(){
			var checkbox = $(this);
			if(checkbox.is(':checked')===true){
				registros_seleccionados+=checkbox.val()+",";
			}
		});
		registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
		if(registros_seleccionados==""){
			alert("No ha seleccionado ningun campo");
		}else{
			var confirmacion=confirm("Esta seguro de "+accion+"?");
			if(confirmacion){
				var observaciones=prompt("Por favor describa "+texto_observacion);
				window.open("../../formatos/solicitud_prestamo/procesar_estado.php?accion="+valor_accion+"&idft_item_prestamo_exp="+registros_seleccionados+"&observaciones="+observaciones,"_self");
			}
		}		
}
</script>