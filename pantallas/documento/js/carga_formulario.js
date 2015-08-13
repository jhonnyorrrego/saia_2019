function llamado_formulario(nombre,ruta_superior,componente){
	if(nombre==''){
		$("#muestra_plantilla").html('');
		$("#muestra_plantilla").removeClass('clase_capas');
		$("#muestra_plantilla").addClass('clase_sin_capas');
	}
	if(nombre!='-1'){
		$.post(ruta_superior+"formatos/"+nombre+"/buscar_"+nombre+"2.php",{comp:componente},function(formulario){
			$("#muestra_plantilla").removeClass('clase_sin_capas');
			$("#muestra_plantilla").addClass('clase_capas');
			$("#muestra_plantilla").html(formulario);
		});
	}
	else{
		$.post(ruta_superior+"pantallas/documento/busqueda_general.php",{comp:componente},function(formulario){
			$("#muestra_plantilla").removeClass('clase_sin_capas');
			$("#muestra_plantilla").addClass('clase_capas');
			$("#muestra_plantilla").html(formulario);
		});
	}
}
var mostrar=0;
$(".toggle_busqueda").live('click',function(){
	var ruta=$(this).attr("ruta");
	var div=$(this).attr("id");
	$('#div_'+div).toggle();
	if(mostrar==0){
		$.post(ruta,{},function(formulario){
			$('#div_'+div).html(formulario);
			mostrar=1;
		});
	}
});