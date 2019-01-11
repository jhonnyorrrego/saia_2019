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
<script type='text/javascript'>
    var upload_url = '<?php echo $ruta_db_superior;?>dropzone/cargar_archivos_formato.php';
var mensaje = 'Arrastre aquí los archivos';
Dropzone.autoDiscover = false;
    var lista_archivos = new Object();
$(document).ready(function () {
    Dropzone.autoDiscover = false;
    $('.saia_dz').each(function () {
        var idformato = $(this).attr('data-idformato');
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
           		dictRemoveFile: 'Quitar anexo',
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
                        	delete lista_archivos[file.upload.uuid];
                        	$('#'+paramName).val(Object.values(lista_archivos).join());
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
                    	$('#'+paramName).val(Object.values(lista_archivos).join());
                        if($('#dz_campo_'+idcampoFormato).find('label.error').length) {
                            $('#dz_campo_'+idcampoFormato).find('label.error').remove()
                        }
                    }
        };
        $(this).dropzone(opciones);
        $(this).addClass('dropzone');
    });
});
</script>