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
	$("#nav_busqueda").after("<div style='margin:5px' class='ui-state-default ui-jqgrid-pager ui-corner-bottom'><button class='btn btn-mini' title='Remitir' id='remitir'>Remitir</button> <button class='btn btn-mini' title='Recibido' id='recibido'>Recibido</button> <button class='btn btn-mini' title='Ejecutado' id='ejecutado'>Ejecutado</button></div>");
	
	/*Remitidos*/
	$("#remitir").click(function (){
		var registros_seleccionados="";
		$('._remitir').each(function(){
			var checkbox = $(this);
			if(checkbox.is(':checked')===true){
				registros_seleccionados+=checkbox.val()+",";
				padre=checkbox.attr("padre");
				anterior=checkbox.attr("anterior");
			}
		});
		registros_seleccionados = registros_seleccionados.substring(0, registros_seleccionados.length-1);
		if(registros_seleccionados==""){
			alert("NO ha seleccionado ningun campo");
		}else{
			$("#ejecutado").after("<div id='ir_adicionar_documento' class='link kenlace_saia' enlace='formatos/carta_citas/adicionar_carta_citas.php?anterior="+anterior+"&padre="+padre+"&idformato=266&idtem="+registros_seleccionados+"' conector='iframe' titulo='Actualizar Permisos'>---</div>");
			$("#ir_adicionar_documento").trigger("click");
			$("#ir_adicionar_documento").remove();
		}
	});
	
	/*Recibidos*/
	$("#recibido").click(function (){
		var registros_seleccionados=0;
		$('._recibido').each(function(){
			var input = $(this);
			if(input.val()!=0){
				registros_seleccionados++;
				$.ajax({
					type:'POST',
					url: "../../formatos/citas_ejecutadas/reporte.php",
					data: {idtem:input.attr("idtem"),nro_autorizacion:input.val(),opt:2}
				});
			}
		});
		if(registros_seleccionados>0){
			alert("Datos Guardados");
			window.open("../../pantallas/buscador_principal.php?idbusqueda=41","centro");
		}else{
			alert("NO ha ingresado Datos");
		}
	});
	
	/*Ejecutados*/
	$("#ejecutado").click(function (){
		var registros_seleccionados=0;
		$('._ejecutado').each(function(){
			var texarea = $(this);
			if(texarea.val()!=0){
				registros_seleccionados++;
				$.ajax({
					type:'POST',
					url: "../../formatos/citas_ejecutadas/reporte.php",
					data: {idtem:texarea.attr("idtem"),observaciones:texarea.val(),opt:3}
				});
			}
		});
		if(registros_seleccionados>0){
			alert("Datos Guardados");
			window.open("../../pantallas/buscador_principal.php?idbusqueda=41","centro");
		}else{
			alert("NO ha ingresado Datos");
		}
	});
});

</script>