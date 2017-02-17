<?php 
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".@$_REQUEST["idpaso_documento"],"",$conn);
if($paso_documento["numcampos"]){
	$idpaso = $paso_documento[0]["paso_idpaso"];
	$iddocumento = $paso_documento[0]["documento_iddocumento"];
	$idpaso_documento=$paso_documento[0]["idpaso_documento"];
	$iddiagram = $paso_documento[0]["diagram_iddiagram_instance"];
	$idactividad=$_REQUEST["idactividad"];
}
else{
	die('<div class="well label-important">No es posible encontrar la informaci&oacute;n de la actividad para el proceso actual.</div>');
}
echo(estilo_bootstrap());
echo(estilo_file_upload());
?>
<style>
	body{padding-top: 0px;}
	table tr{height: 0px;}
	table td{height: 0px;}
	.table td{padding: 0px;line-height: 25px;}
	.table{width: 100%;}	
	.progress{margin-bottom: 0px;}
	p{margin: 0px;}
</style>
<div class="container fluid">
<p><i class="icon-share-alt"></i><a href="<?php echo($ruta_db_superior);?>bpmn/paso/actividades_paso.php?idpaso=<?php echo($_REQUEST["idpaso"]);?>&diagrama=<?php echo(@$_REQUEST['diagrama']); ?>&documento=<?php echo(@$_REQUEST['documento']); ?>&idpaso_documento=<?php echo(@$_REQUEST['idpaso_documento']); ?>">Regresar</a></p>

</br>	
<form class="form-horizontal" id="terminar_actividad_paso" name="terminar_actividad_paso" method="POST"  action="" enctype="multipart/form-data">
		<legend class="texto-azul">terminar actividad del paso </legend>  
	  <div class="control-group">
	    <label class="control-label" for="observaciones">Observaciones *</label>
	    <div class="controls">
	      <textarea id="observaciones" name="observaciones" required></textarea>
        <input type="hidden"  id="ruta" name="ruta" value="anexos/">
        <input type="hidden" name="idpaso_documento" id="idpaso_documento" value="<?php echo($idpaso_documento);?>">
        <input type="hidden" name="iddocumento" id="iddocumento" value="<?php echo($iddocumento);?>">
        <input type="hidden" name="idactividad" id="idactividad" value="<?php echo($idactividad);?>">        
	    </div>
	  </div>
	  <div id="mensaje_file"></div>
    <div class="control-group">
        <div width="100%">
        	<div class="pull-left">            
            <button type="button" class="btn btn-mini btn-primary start" data-ng-click="submit()">
                <i class="glyphicon-upload"></i>
                <span>Aceptar</span>
            </button>        
            <span class="btn btn-mini btn-success fileinput-button" ng-class="{disabled: disabled}" style="margin-left:40px;">
                <i class="glyphicon-plus"></i>
                <span>Examinar</span>
                <input type="file" name="files[]" multiple ng-disabled="disabled" id="files">
            </span>
          </div>
        </div>
    </div>
    <table class="table table-striped" id="archivos">       
    </table>
</form>
</div>
<?php
echo(librerias_jquery('1.7'));
echo(librerias_bootstrap());
echo(librerias_file_upload());
echo(librerias_notificaciones());
echo(librerias_validar_formulario(11));
?>
<script src="<?php echo($ruta_db_superior);?>pantallas/anexos/js/anexos.js"></script>
<script>
$(document).ready(function(){            
  var archivos = 0;
  var falla_archivos = 0;
  var exito_archivos = 0;
  var formulario= $('#terminar_actividad_paso');
  var error=0;
  var data2;
  redireccion=1;
  formulario.validate({
  	submitHandler: function(form) {
				<?php encriptar_sqli("terminar_actividad_paso",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
  });
  $('.eliminar_file').on('click',function(){        
    $(this).closest("tr").remove();
  });
  $('#terminar_actividad_paso').fileupload({        
      url: '<?php echo($ruta_db_superior);?>bpmn/paso/subir_archivo_actividad.php',
      dataType: 'json',        
      autoUpload: false            
  }).on('fileuploadadd', function (e, data) {
    redirecciona=0;
    $(".start").on('click', function () {
      if(formulario.valid()){
        data.submit();
      }
    });
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
      redireccion=1
    }  
    else if(parseInt(falla_archivos)==0){
      notificacion_saia("Archivos faltantes cargados con &eacute;xito","success","",2500);
      redireccion=1        
    } 
    redireccionar_flujo();    
  }).on('fileuploadfail', function(e, data){              
    $.each(data.files, function(index,file){              
      notificacion_saia('Error:'+file.name+" <br> "+file.error,'error','',3500);   
      falla_archivos++; 
      redireccion=1
      redireccionar_flujo();    
    });    
  });
  $(".start").on('click', function () {
    if(formulario.valid()){
      $.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>bpmn/paso/class_instancia_terminacion.php",
        data:formulario.serialize(),
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              notificacion_saia(objeto.mensaje,"success","",3500);
              redireccionar_flujo();
            } 
            else{
              //No es exitosa la carga de la informaion
              notificacion_saia(objeto.mensaje,"error","",4500);
            }   
          }
          else{
                //No se envia el registro html error 
          }
        }
     });
    }
  });             
});  
function redireccionar_flujo(){
  if(redireccion==1){
    parent.window.history.go(0)
    //datos={ kConnector:'iframe', url:"<?php echo(PROTOCOLO_CONEXION.RUTA_PDF.'/flujos_documento.php?key='.$paso_documento[0]["documento_iddocumento"]);?>"}  
    //parent.parent.$(".k-focus").closest("#contenedor_busqueda").kaiten("reload",parent.parent.$(".k-focus"),datos);
  }
}
</script>
</body>
</html>