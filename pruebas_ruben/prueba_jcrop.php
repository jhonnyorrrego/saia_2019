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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/anexos/librerias_anexos.php");

echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
  

  
if(@$_REQUEST['mostrar_recorte'] && @$_REQUEST['idfuncionario']){  //MUESTRA FOTO RECORTADA

	$idfuncionario=$_REQUEST['idfuncionario'];
	$foto_recorte=busca_filtro_tabla("foto_recorte","funcionario","idfuncionario=".$idfuncionario,"",$conn);
	?>
		<img src="<?php echo($ruta_db_superior.$foto_recorte[0]['foto_recorte']); ?>"/ id="foto_recorte">	
	<?php
}

  
if(@$_REQUEST['recortar'] && @$_REQUEST['idfuncionario']){   //PERMITE RECORTAR LA FOTO
	
	$idfuncionario=$_REQUEST['idfuncionario'];
	$foto_original=busca_filtro_tabla("foto_original","funcionario","idfuncionario=".$idfuncionario,"",$conn);
	echo(librerias_jqcrop());
	?>
	
	<img src="<?php echo($ruta_db_superior.$foto_original[0]['foto_original']); ?>"/ id="foto_original">
	<input type="hidden" name="x" id="x" />
	<input type="hidden" name="y" id="y" />
	<input type="hidden" name="w" id="w" />
	<input type="hidden" name="h" id="h" />
	<br>
	<input type="button" name="recortar" id="recortar" value="Recortar">
	<script language="Javascript">

	        $('#foto_original').Jcrop({
	        	onChange: cargar_cordenadas,
	        	onSelect: cargar_cordenadas
	        });

	function cargar_cordenadas(c){ 
      $('#x').val(c.x);
      $('#y').val(c.y);
      $('#w').val(c.w);
      $('#h').val(c.h);	
	}
	
	
	$('#recortar').click(function(){
		if($('#x').val()!='' && $('#y').val()!='' && $('#w').val()!='' && $('#h').val()!=''){
			$.ajax({
				type:'POST',
	            dataType: 'json',
	            url: "<?php echo($ruta_db_superior);?>pruebas_ruben/recortar_imagen.php",
	            data: {
	            	x:$('#x').val(),
	            	y:$('#y').val(),
	            	w:$('#w').val(),
	            	h:$('#h').val(),
	            	idfuncionario:'<?php echo($idfuncionario); ?>',
	            	recortar:1
	            },
	            success: function(datos){
	            	
	            	if(datos.exito==1){
	            		notificacion_saia('Imagen Recortada Satisfactoriamente','success','',3500);
     					setTimeout(function(){ window.location="<?php echo($ruta_db_superior); ?>pruebas_ruben/prueba_jcrop.php?mostrar_recorte=1&idfuncionario=<?php echo($idfuncionario); ?>"  }, 2000);	            		
	
	            	}
					
	            }
			}); 	
		}else{
			notificacion_saia('Debe seleccionar una porcion de la imagen','error','',3500);
		}			
	});
	
	</script>
	<?php
	
}


if(@$_REQUEST['idfuncionario'] && !@$_REQUEST['recortar'] && !@$_REQUEST['mostrar_recorte']){   //PERMITE CARGAR LA IMAGEN A RECORTAR
	  
echo(estilo_bootstrap());
echo(estilo_file_upload());
echo(librerias_file_upload());


$idfuncionario=1;

?>

		<form id="formulario_tareas">
 		<div id="mensaje_file"></div>
		<div class="control-group">
			<label class="control-label" for="files[]"></label>
        <div width="100%">
        	<div class="pull-left">                    
            <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;" id="contenedor_anexos">
                <i class="glyphicon-plus"></i>
                <span>Examinar</span>
                <input type="file" name="files[]" multiple ng-disabled="disabled" id="files">
            </span>
          
          </div>
        </div>
        <br/>   
		<table class="table table-striped" id="archivos"></table>        
		</div>
		</form>
<script src="<?php echo($ruta_db_superior);?>pantallas/anexos/js/anexos.js"></script>
<script>
$(document).ready(function(){            
  var archivos = 0;
  var falla_archivos = 0;
  var exito_archivos = 0;
  var formulario= $('#formulario_tareas');
  var error=0;
  var data2;
  redireccion=1;
  
  $('.eliminar_file').on('click',function(){        
    $(this).closest("tr").remove();
  });
  $('#formulario_tareas').fileupload({        
      url: '<?php echo($ruta_db_superior);?>pruebas_ruben/upload_jcrop.php?subir=1&idfuncionario=<?php echo($idfuncionario); ?>',
      dataType: 'json',
      autoUpload: true            
  }).on('fileuploadadd', function (e, data) {
    redirecciona=0;

    archivos++;      
    $.each(data.files, function (index, file) {       
      var texto='<tr><td>'+file.name+'</td><td>'+tamanio_archivo(file.size,2)+'</td><!--td><i class="icon-trash eliminar_file"></i></td--><td width="100px"><div class="progress progress-striped active"><div class="bar bar-success" id="'+file.size+'" ></div></div></td></tr>';                 
      $("#archivos").append(texto);                     
    });                           
  }).on('fileuploadprogress', function (e, data){
      var progress = parseInt(data.loaded / data.total * 100, 10);        
      $.each(data.files, function(index,file){                                  
        $('#'+file.size).css('width',(progress)+ '%');
        $('#'+file.size).html((progress)+"%");
      });                     
  }).on('fileuploaddone', function(e, data){
    redirecciona=0;
    $.each(data.result.files, function(index,file){       
      if(typeof(file.error)!="undefined"){
        $('#'+file.size).removeClass('bar-success');
        $('#'+file.size).addClass('bar-danger');
        falla_archivos++;
        notificacion_saia('Error:'+file.name+"<br>"+file.error,'error','',3500);
      }                   
      else{
        exito_archivos++;
      }
    });             
    if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
      notificacion_saia("Todos los archivos se cargaron con &eacute;xito","success","",2500);
      setTimeout(function(){ window.location="<?php echo($ruta_db_superior); ?>pruebas_ruben/prueba_jcrop.php?recortar=1&idfuncionario=<?php echo($idfuncionario); ?>"  }, 1000);
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      setTimeout(function(){ formulario.submit();  }, 1000);
    }
    
   	
  }).on('fileuploadfail', function(e, data){              
    $.each(data.files, function(index,file){              
      notificacion_saia('Error:'+file.name+" <br> "+file.error,'error','',3500); 
     // setTimeout(function(){  window.location.reload(); }, 3000);  
     
      falla_archivos++; 
    });    
  });
  
  

   
});  

</script>

<?php
}

?>