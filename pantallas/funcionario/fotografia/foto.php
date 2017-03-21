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
require_once($ruta_db_superior.'StorageUtils.php');
require_once($ruta_db_superior.'filesystem/SaiaStorage.php');

if(!@$_REQUEST['ruta_recorte']){
	echo(librerias_jquery("1.7"));
	echo(librerias_notificaciones()); 	
}


if(@$_REQUEST['ruta_recorte'] && @$_REQUEST['idfuncionario']){ //RETORNA LA RUTA DE LA IMAGEN RECORTADA

	$idfuncionario=$_REQUEST['idfuncionario'];
	$foto_recortada=busca_filtro_tabla("foto_recorte","funcionario","idfuncionario=".$idfuncionario,"",$conn);	
	$archivo_binario=StorageUtils::get_binary_file($foto_recortada[0]['foto_recorte']);
	echo(json_encode(array('ruta'=>$archivo_binario)));
}
  
 
if(@$_REQUEST['recortar'] && @$_REQUEST['idfuncionario']){   //PERMITE RECORTAR LA FOTO
	
	$idfuncionario=$_REQUEST['idfuncionario'];
	$foto_original=busca_filtro_tabla("foto_original,foto_cordenadas","funcionario","idfuncionario=".$idfuncionario,"",$conn);
	$archivo_binario=StorageUtils::get_binary_file($foto_original[0]['foto_original']);	
	$cordenadas=explode(',',$foto_original[0]['foto_cordenadas']);
	$cordenadas=array_map('intval', $cordenadas);
	echo(librerias_jqcrop());
	echo(estilo_bootstrap());
	?>
	<style>
		img{
			max-width:none;
		} 	
	</style>
	<strong>Seleccione el rango de imagen:</strong>
	<hr>
	<img src="<?php echo($archivo_binario); ?>" id="foto_original"  />
	<input type="hidden" name="x" id="x" />
	<input type="hidden" name="y" id="y" />
	<input type="hidden" name="x2" id="x2" />
	<input type="hidden" name="y2" id="y2" />
	<input type="hidden" name="w" id="w" />
	<input type="hidden" name="h" id="h" />
	<br>
	<input type="button" class="btn btn-mini btn-primary" name="recortar" id="recortar" value="Recortar">
	<input type="button" class="btn btn-mini btn-success" name="cambiar_foto" id="cambiar_foto" value="Cambiar Foto">
	<input type="button" class="btn btn-mini btn-danger" name="eliminar_foto" id="eliminar_foto" value="Eliminar Foto">
	<script language="Javascript">

	$('#foto_original').Jcrop({
	    onChange: cargar_cordenadas,
		onSelect: cargar_cordenadas,
		setSelect:[<?php echo($cordenadas[0]); ?>,<?php echo($cordenadas[1]); ?>,<?php echo($cordenadas[2]); ?>,<?php echo($cordenadas[3]); ?>]
	});

	function cargar_cordenadas(c){ 
      $('#x').val(c.x);
      $('#y').val(c.y);
      $('#x2').val(c.x2);
      $('#y2').val(c.y2);     
      $('#w').val(c.w);
      $('#h').val(c.h);	
	}
	
	$('#cambiar_foto').click(function(){
		window.location="<?php echo($ruta_db_superior);?>pantallas/funcionario/fotografia/foto.php?idfuncionario=<?php echo($idfuncionario); ?>";
	});
	
	$('#eliminar_foto').click(function(){
		if(confirm('Esta seguro de eliminar la fotografia?')){
			$.ajax({
				type:'POST',
	            dataType: 'json',
	            async:false,
	            url: "<?php echo($ruta_db_superior);?>pantallas/funcionario/fotografia/eliminar_foto.php",
	            data: {
	            	idfuncionario:'<?php echo($idfuncionario); ?>',
					eliminar_foto:1
	            },
	            success: function(datos){
	            	if(datos.exito==1){
	            		notificacion_saia('Imagen Eliminada Satisfactoriamente','success','',3500);
     					window.parent.top.hs.close(); 		
	            	}
	            }
			}); 
		}

	});	
	
	$('#recortar').click(function(){
		var ejecutar=true;
		if($('#w').val()==0 || $('#h').val()==0){
			ejecutar=false;
		}
		
		
		if(ejecutar){
			$.ajax({
				type:'POST',
	            dataType: 'json',
	            async:false,
	            url: "<?php echo($ruta_db_superior);?>pantallas/funcionario/fotografia/recortar_foto.php",
	            data: {
	            	x:$('#x').val(),
	            	y:$('#y').val(),
	            	x2:$('#x2').val(),
	            	y2:$('#y2').val(),	            	
	            	w:$('#w').val(),
	            	h:$('#h').val(),
	            	idfuncionario:'<?php echo($idfuncionario); ?>',
	            	recortar:1
	            },
	            success: function(datos){
	            	if(datos.exito==1){
	            		notificacion_saia('Imagen Recortada Satisfactoriamente','success','',3500);
     					window.parent.top.hs.close(); 		
	            	}
	            }
			}); 	
		}else{
			notificacion_saia('<span style="color:white;">Debe seleccionar un rango de imagen</span>','error','',3500);
		}			
	});
	</script>
	<?php
}


if(@$_REQUEST['idfuncionario'] && !@$_REQUEST['recortar'] && !@$_REQUEST['ruta_recorte']){   //PERMITE CARGAR LA IMAGEN A RECORTAR
	  
echo(estilo_bootstrap());
echo(estilo_file_upload());
echo(librerias_file_upload());


$idfuncionario=@$_REQUEST['idfuncionario'];

?>
		<strong>Seleccionar Imagen:</strong>
		<hr>
		<form id="formulario_tareas">
			
            <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;" id="contenedor_anexos">
                <span>Examinar</span>
                <input type="file" name="files[]" multiple ng-disabled="disabled" id="files">
            </span>			
		</form>
		<br><br>
		<table class="table table-striped" id="archivos"></table> 
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
      url: '<?php echo($ruta_db_superior);?>pantallas/funcionario/fotografia/upload_foto.php?subir=1&idfuncionario=<?php echo($idfuncionario); ?>',
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
        window.location.reload();
      }                   
      else{
        exito_archivos++;
      }
    });             
    if((parseInt(falla_archivos)+parseInt(exito_archivos)==parseInt(archivos)) && (parseInt(falla_archivos)==0)){
      notificacion_saia("Todos los archivos se cargaron con &eacute;xito","success","",2500);
   	  window.location="<?php echo($ruta_db_superior); ?>pantallas/funcionario/fotografia/foto.php?recortar=1&idfuncionario=<?php echo($idfuncionario); ?>";
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      window.location="<?php echo($ruta_db_superior); ?>pantallas/funcionario/fotografia/foto.php?recortar=1&idfuncionario=<?php echo($idfuncionario); ?>";
    }
    
   	
  }).on('fileuploadfail', function(e, data){              
    $.each(data.files, function(index,file){              
      notificacion_saia('Error:'+file.name+" <br> "+file.error,'error','',3500); 
      window.location.reload();
      falla_archivos++; 
    });    
  });   
});  

</script>

<?php
}

?>
