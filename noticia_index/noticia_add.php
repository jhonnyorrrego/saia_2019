<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

?>

<!DOCTYPE html>
<html>
<head>
<?php
echo (estilo_bootstrap());

?>

<link href="<?php echo $ruta_db_superior;?>dropzone/dist/dropzone.css"
	type="text/css" rel="stylesheet" />

<?php
echo (librerias_jquery('1.7'));
echo (librerias_notificaciones());
echo (librerias_validar_formulario('11'));
?>

<script src="<?php echo $ruta_db_superior;?>dropzone/dist/dropzone.js"></script>

</head>
<body>

	<div class="container">
		<h5>Configuración de Noticias y contenido relacionado</h5>
		<br />

		<ul class="nav nav-tabs">
			<li><a href="noticia_detalles.php">Detalles</a></li>
			<li class="active"><a href="noticia_add.php">Adicionar</a></li>
			<li><a href="noticia_principal_add.php">Informacion Principal</a></li>
		</ul>
		<br />


		<form class="form-horizontal" action="noticia_procesar.php"
			method="post" enctype="multipart/form-data" id="formuploadajax">
			<fieldset>

				<!-- Form Name -->
				<legend>Adicionar noticia</legend>

				<!-- Text input-->
				<div class="control-group">
					<label class="control-label" for="titulo">Titulo*</label>
					<div class="controls">
						<input id="titulo" name="titulo" type="text" placeholder="Titulo"
							class="input-xlarge required">
					</div>
				</div>

				<!-- Text input-->
				<div class="control-group">
					<label class="control-label" for="subtitulo">Subtitulo*</label>
					<div class="controls">
						<input id="subtitulo" name="subtitulo" type="text"
							placeholder="Subtitulo" class="input-xlarge required">
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
						<div id="dz_noticia">
							<div class="dz-message">
								<span>Arrastre aquí los archivos adjuntos</span>
							</div>
						</div>
					</div>
				</div>

				<input type="hidden" id="adicionar2" name="adicionar2" value="1">
				<!-- Button -->
				<div class="control-group">
					<label class="control-label" for="adicionar"></label>
					<div class="controls">
						<input type="button" id="adicionar" name="adicionar"
							class="btn btn-primary" value="Adicionar" />
					</div>
				</div>

			</fieldset>
			<input type='hidden' id='form_uuid' name='form_uuid'
				value='<?php  echo (uniqid() . "-" . uniqid()); ?>'>

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

    var upload_url = '<?php echo $ruta_db_superior;?>/dropzone/cargar_archivos_anexos.php';
	var form_uuid = $('#form_uuid').val();
	var lista_archivos = [];
    Dropzone.autoDiscover = false;
	var dz = new Dropzone("#dz_noticia", {
		url: upload_url,
    	maxFiles : 1,
		acceptedFiles: ".jpg, .png, .jpeg",
		paramName: "imagen_modulo",
   		addRemoveLinks: true,
   		dictRemoveFile: 'Quitar archivo',
   		dictMaxFilesExceeded : 'No puede subir mas archivos',
   		dictResponseError : 'El servidor respondió con código {{statusCode}}',
		uploadMultiple: false,
		params: {Adicionar: 5, uuid: form_uuid, nombre_campo : "imagen_modulo",
			},
		success: function(file, response) {
        	for (var key in response) {
            	if(Array.isArray(response[key])) {
                	for(var i=0; i < response[key].length; i++) {
                		archivo=response[key][i];
                    	if(archivo.original_name == file.upload.filename) {
                    		lista_archivos[file.upload.uuid] = archivo.id;
                    	}
                	}
            	} else {
            		if(response[key].original_name == file.upload.filename) {
                		lista_archivos[file.upload.uuid] = response[key].id;
            		}
            	}
        	}
		},
        removedfile : function(file) {
            if(lista_archivos && lista_archivos[file.upload.uuid]) {
            	$.ajax({
            		url: upload_url,
            		type: 'POST',
            		data: {
                		accion:'eliminar_temporal',
                		archivo: lista_archivos[file.upload.uuid]}
            		});
            }
            if (file.previewElement != null && file.previewElement.parentNode != null) {
                file.previewElement.parentNode.removeChild(file.previewElement);
            }
            return this._updateMaxFilesReachedClass();
        },

	});
    $("#dz_noticia").addClass('dropzone');

</script>
