$(function () {

	let baseUrl = $("script[data-baseurl]", parent.document).data('baseurl');
	var consulta64 = $("script[data-consulta64]").data('consulta64');
	$('#expediente_flujo').selectize({
	    valueField: 'value',
	    labelField: 'text',
	    searchField: 'text',
		persist: false,
		createOnBlur: true,
		create: false,
		maxItems: 1,
		load: function(query, callback) {
	        if (!query.length) return callback();
	        $.ajax({
	            url: baseUrl + "autocompletar.php",
	            type: 'POST',
	            dataType: 'json',
	            data: {
	            	consulta: consulta64,
	            	valor: query
	            },
	            error: function() {
	                callback();
	            },
	            success: function(res) {
	                callback(res);
	            }
	        });
	    }
	});

    var upload_url = 'cargar_archivos_flujo.php';
    Dropzone.autoDiscover = false;
    var lista_archivos = new Object();
    Dropzone.autoDiscover = false;
    $('.dropzone').each(function () {
    	var idcampo = $(this).attr('id');
    	var paramName = $(this).attr('name');
    	var idcampoFormato = $(this).data('idcampo-formato');
    	var extensiones = $(this).data('extensiones');
    	var multiple_text = $(this).data('multiple');
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
       		dictResponseError : 'El servidor respondio con codigo {{statusCode}}',
       		dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
       		dictInvalidFileType: "No puede cargar archivos de este tipo",
    		uploadMultiple: multiple,
        	url: upload_url,
        	paramName : paramName,
        	params : {
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
        let dropzoneControl = $(this)[0].dropzone;
        if (!dropzoneControl) {
        	$(this).dropzone(opciones);
        	$(this).addClass('dropzone');
            //dropzoneControl.destroy();
        }
    });

});