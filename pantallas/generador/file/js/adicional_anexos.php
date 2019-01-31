<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
$configuracion=busca_filtro_tabla("valor,nombre","configuracion","nombre LIKE 'extensiones_upload' OR nombre LIKE 'tamanio_maximo_upload'","",$conn);
for($i=0;$i<$configuracion['numcampos'];$i++){
	switch ($configuracion[$i]['nombre']){
		case 'extensiones_upload':
				$extenciones = str_replace(',','|',$configuracion[$i]['valor']);
			break;
		case 'tamanio_maximo_upload':
				$max_tamanio = $configuracion[$i]['valor'];
		break;
	}
}
?>
<script>
$(document).ready(function(){
var idform=$("form")[0];
if(!idform)idform="";
var idtexto=new String(idform.id);
var nombre_pantalla=idtexto.replace("formulario_","");
var archivos = 0;
var falla_archivos = 0;
var exito_archivos = 0;
var error=0;
var tamano_max=<?php echo $max_tamanio; ?>;
var extensiones=/(\.|\/)(<?php echo $extenciones; ?>)$/i;
$("#"+idform.id).append('<input type="hidden" name="pantalla" id="pantalla" value="'+nombre_pantalla+'">');
$(".anexos").fileupload({
    url: '<?php echo $ruta_db_superior; ?>pantallas/generador/file/subir_archivo.php?pantalla='+nombre_pantalla,
		maxFileSize: tamano_max,
		acceptFileTypes: extensiones
}).bind('fileuploadadd',function(e,data){
  archivos++;
  var nombre_tabla=$(this).attr("id");
	$.each(data.files, function (index, file){
		if(file.type.length && !extensiones.test(file.type)) {
			notificacion_saia('Extension no valida','error','',2500);
		}
		else if(file.size>tamano_max){
			notificacion_saia('Anexo supera el peso maximo','error','',2500);
		}
		else{
			var texto='<tr id="fila_'+nombre_tabla+'_'+file.name+'"><td>'+file.name+'</td><td>'+tamanio_archivo(file.size,2)+'</td><td><div class="progress progress-striped active" style="margin-bottom:0px;"><div class="bar bar-success anexos_subidos" id="'+file.size+'" campo="'+nombre_tabla+'"></div></div></td><td class="borrar_anexo" anexo="'+file.name+'" campo="'+nombre_tabla+'" style="cursor:pointer;text-align:center">X</td></tr>';
		}
		$('#archivos_'+nombre_tabla).append(texto);
  });	    	                    
}).bind('fileuploadprogress', function (e, data){
		var progress = parseInt(data.loaded / data.total * 100, 10);    		
		$.each(data.files, function(index,file){    			    		      			   	
			$('#'+file.size).css('width',(progress)+ '%');
			$('#'+file.size).html((progress)+'%');
		});    	                
}).bind('fileuploaddone', function(e, data){    
	$.each(data.result.files, function(index,file){
		if(typeof(file.error)!='undefined'){
			$('#'+file.size).removeClass('bar-success');
			$('#'+file.size).addClass('bar-danger');
			falla_archivos++;
			notificacion_saia('Error:'+file.name+'<br>'+file.error,'error','',3500);
		}    	       		 		
		else{
			exito_archivos++;
		}
  });	            
	if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
    notificacion_saia('Todos los archivos se cargaron con &eacute;xito','success','',2500);
	}     	
}).bind('fileuploadfail', function(e, data){
	$.each(data.files, function(index,file){
		notificacion_saia('Error:'.file.name,'error','',3500);   
		falla_archivos++; 		
	});    
});
$(".borrar_anexo").on('click',function(){
	var nombre_campo=$(this).attr("campo");
	var nombre_anexo=$(this).attr("anexo");
	$.ajax({
		type:'POST',
    url: "<?php echo($ruta_db_superior);?>pantallas/generador/file/borrar_archivo.php",
    data: "nombre_pantalla="+nombre_pantalla+"&campo="+nombre_campo+"&anexo="+nombre_anexo+"&ejecutar_borrado=eliminar_anexo_temp",
    success: function(html){                
			if(html==1){
				notificacion_saia("Anexo eliminado",'success','',2500);
			}
			else if(html==0){
				notificacion_saia("No se ha podido eliminar el anexo",'error','',2500);
			}
   	}
  });
	$(this).parent().remove();
});

$(".borrar_anexo_original").on('click',function(){
	var confirmar=confirm("Esta seguro de eliminar este anexo?");
	if(confirmar){
		var idanexos=$(this).attr("idanexos");
		var idregistro=$(this).attr("idregistro");
		var pantalla=$(this).attr("pantalla");
		var nombre_campo=$(this).attr("nombre_campo");
		$.ajax({
			type:'POST',
	    url: "<?php echo($ruta_db_superior);?>pantallas/generador/file/borrar_archivo.php",
	    data: "idanexos="+idanexos+"&idregistro="+idregistro+"&nombre_campo="+nombre_campo+"&pantalla="+pantalla+"&ejecutar_borrado=eliminar_anexo",
	    success: function(html){                
				if(html==1){
					notificacion_saia("Anexo eliminado",'success','',2500);
				}
				else if(html==0){
					notificacion_saia("No se ha podido eliminar el anexo",'error','',2500);
				}
	   	}
	  });
		$(this).parent().remove();
	}
});
});

function validar_anexos_subidos(){
	var fallo=true;
	
	$(".validar_campos").each(function(i){
		$(this).val("");
	});
	
	$(".anexos_subidos").each(function(i){
		var nombre=$(this).attr("campo");
		$("#"+nombre+"_oculto").val("1");
		var valor=$(this).html();
		if(valor!="100%"){
			fallo=false;
		}
	});
	if(!fallo)notificacion_saia('Los anexos no han sido cargados','error','',2500);
	
	$(".validar_campos").each(function(i){
		if($(this).val()==""||$(this).val()=="0"){
			$("#error_"+$(this).attr("id")).html("<b>Este campo es obligatorio.</b>");
			fallo=false;
			notificacion_saia('Formulario con errores','error','',2500);
		}
	});
	return fallo;
}
</script>