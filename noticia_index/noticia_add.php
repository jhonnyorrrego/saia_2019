<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
echo(estilo_bootstrap());
echo(librerias_notificaciones());
echo( librerias_validar_formulario('11') );
?>

<!DOCTYPE html>
<html>
	<head>
		
	</head>	
	<body>

<div class="container">
		<h5>Configuración de Noticias y contenido relacionado</h5>
		<br/>
		
		<ul class="nav nav-tabs">
		  <li ><a href="noticia_detalles.php">Detalles</a></li>
		    <li class="active"><a href="noticia_add.php">Adicionar</a></li>
		     <li><a href="noticia_principal_add.php">Informacion Principal</a></li>
		</ul>		
		<br/>
		

		<form class="form-horizontal" action="noticia_procesar.php" method="post" enctype="multipart/form-data" id="formuploadajax">
		<fieldset>
		
		<!-- Form Name -->
		<legend>Adicionar noticia</legend>
	

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="titulo">Titulo*</label>
		  <div class="controls">
		    <input id="titulo" name="titulo" type="text" placeholder="Titulo" class="input-xlarge required">
		  </div>
		</div>	

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="subtitulo">Subtitulo*</label>
		  <div class="controls">
		    <input id="subtitulo" name="subtitulo" type="text" placeholder="Subtitulo" class="input-xlarge required">
		  </div>
		</div>	
				
		
		<!-- Textarea -->
		<div class="control-group">
		  <label class="control-label" for="noticia">Noticia*</label>
		  <div class="controls">                     
		    <textarea id="noticia" name="noticia" class="required"></textarea>
		  </div>
		</div>
		
		<!-- File Button --> 
		<div class="control-group">
		  <label class="control-label" for="filebutton">Imagen*</label>
		  <div class="controls">
		    <input id="imagen_modulo" name="imagen_modulo" class="input-file required" type="file" >
		  </div>
		</div>

		<input type="hidden" id="adicionar2" name="adicionar2" value="1">
		<!-- Button -->
		<div class="control-group">
		  <label class="control-label" for="adicionar"></label>
		  <div class="controls">
		    <input type="button" id="adicionar" name="adicionar" class="btn btn-primary" value="Adicionar" />
		  </div>
		</div>
		
		</fieldset>
		</form>
</div>				
							
	</body>
	
</html>
<script>
	$(document).ready(function(){
		
		$('#formuploadajax').validate();
		
		$('#adicionar').click(function(){
			if($('#formuploadajax').valid()){
				
			
			if( $('#titulo').val()=='' || $('#subtitulo').val()=='' || $('#noticia').val()=='' || $('#imagen_modulo').val()==''){
				notificacion_saia('<b>Atenci&oacute;n</b><br>Todos los campos deben estar llenos','success','',3000);
			}else{
				var formData = new FormData(document.getElementById("formuploadajax"));
					$.ajax({
				        type:"POST",
				        url: "noticia_procesar.php",	
						dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false,			        
				        success: function(datos){
				        	notificacion_saia(datos,'success','',3000);
				        	window.location="noticia_detalles.php";
				        }
				    });	
			 }   
    		}
							
		});
	});
</script>