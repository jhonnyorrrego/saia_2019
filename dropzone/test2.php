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
?>

<!DOCTYPE HTML>

<html lang="es">
<head>

<link href="dist/dropzone.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../js/jquery-1.7.min.js"></script>
<script src="dist/dropzone.js"></script>

</head>
<body>
	<form id="formulario_formatos" action="../pantallas/whatever.php">
		<!-- <button type="submit" class="btn btn-primary">
			<i class="glyphicon glyphicon-upload"></i> <span>Enviar archivos</span>
		</button> -->
		<div id="dz_campo_4611" class="saia_dz" data-nombre-campo="archivo1" data-idcampo-formato="4611" data-extensiones=".png, .jpg" data-multiple="unico">
			<div class="dz-message"><span>Arrastre aquí los archivos adjuntos</span></div>
		</div>
		<div id="dz_campo_4612" class="saia_dz" data-nombre-campo="archivo2" data-idcampo-formato="4612" data-extensiones=".png, .jpg,.pdf" data-multiple="multiple">
			<div class="dz-default dz-message"><span>Arrastre aquí los archivos adjuntos</span></div>
		</div>
		<input type="hidden" id="form_uuid" name="form_uuid" value="<?php echo uniqid("421-") . "-" . uniqid();?>">
	</form>

</body>
<script type='text/javascript'>
var upload_url = 'cargar_archivos.php';
var mensaje = 'Arrastre aquí los archivos';
var idformato = 421;
Dropzone.autoDiscover = false;
var lista_archivos = [];
$(document).ready(function () {
    Dropzone.autoDiscover = false;
    $('.saia_dz').each(function () {
    	var idcampo = $(this).attr('id');
    	var paramName = $(this).attr('data-nombre-campo');
    	var idcampoFormato = $(this).attr('data-idcampo-formato');
    	var extensiones = $(this).attr('data-extensiones');
    	var multiple_text = $(this).attr('data-multiple');
    	var multiple = false;
    	var form_uuid = $('#form_uuid').val();
    	var maxFiles = 1;
    	if(multiple_text == 'multiple') {
    		multiple = true;
    		maxFiles = 10;
    	}
        var opciones = {
        	ignoreHiddenFiles : true,
        	maxFiles : maxFiles,
        	acceptedFiles: extensiones,
       		addRemoveLinks: true,
       		dictRemoveFile: 'Quitar archivo',
       		dictMaxFilesExceeded : 'No puede subir mas archivos',
       		dictResponseError : 'El servidor respondió con código {{statusCode}}',
    		uploadMultiple: multiple,
        	url: upload_url,
        	paramName : paramName,
        	params : {
            	idformato : idformato,
            	idcampo_formato : idcampoFormato,
            	nombre_campo : paramName,
            	uuid : form_uuid
            },
            /*addedfile: function(file) {
                // obtener el uuid del archivo para usarlo como token. Aqui this es el objeto dropzone
                this.options.params.uuid = file.upload.uuid;
                //console.log(this.options);
            },*/
            removedfile : function(file) {
                if(lista_archivos && lista_archivos[file.upload.uuid]) {
                	$.ajax({
                		url: upload_url,
                		type: 'POST',
                		data: {
                    		accion:'eliminar_temporal',
                        	idformato : idformato,
                        	idcampo_formato : idcampoFormato,
                    		archivo: lista_archivos[file.upload.uuid]}
                		});
                }
                if (file.previewElement != null && file.previewElement.parentNode != null) {
                    file.previewElement.parentNode.removeChild(file.previewElement);
                }
                return this._updateMaxFilesReachedClass();
            },
            success : function(file, response) {
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
        };
        //new Dropzone($(this), opciones);
        $(this).dropzone(opciones);
        $(this).addClass('dropzone');
        //console.log(opciones);
    });
    function iterar_input_archivo(archivos, nombreCampo) {
    	var myForm = document.forms.formulario_formatos;
    	var myControls = myForm.elements[nombreCampo+'[]'];
    	for (var i = 0; i < myControls.length; i++) {
    	    var aControl = myControls[i];
    	}

        if(Array.isArray(archivos)) {
        } else {
        }
    }
});

</script>
</html>