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
		<input type="hidden" id="archivo1" name="archivo1" value="">
		<div id="dz_campo_4612" class="saia_dz" data-nombre-campo="archivo2" data-idcampo-formato="4612">
			<div class="dz-default dz-message"><span>Arrastre aquí los archivos adjuntos</span></div>
		</div>
		<input type="hidden" id="archivo2" name="archivo2" value="">
	</form>

</body>
<script type='text/javascript'>
var upload_url = 'cargar_archivos.php';
var mensaje = 'Arrastre aquí los archivos';
var idformato = 388;
Dropzone.autoDiscover = false;

$(document).ready(function () {
    Dropzone.autoDiscover = false;
    $('.saia_dz').each(function () {
    	var idcampo = $(this).attr('id');
    	var paramName = $(this).data('nombre-campo');
    	var idcampoFormato = $(this).data('idcampo-formato');
    	var extensiones = $(this).data('extensiones');
    	var multiple_text = $(this).data('multiple');
    	var multiple = false;
    	if(multiple_text == 'multiple') {
    		multiple = true;
    	}
        var opciones = {
        	ignoreHiddenFiles : true,
        	acceptedFiles: extensiones,
       		addRemoveLinks: true,
       		dictRemoveFile: 'Quitar archivo',
    		uploadMultiple: multiple,
        	url: upload_url,
        	paramName : paramName,
        	params : {
            	idformato : idformato,
            	idcampo_formato : idcampoFormato,
            	nombre_campo : paramName,
            	uuid : ''
            },
            success : function(file, response){
                //console.log(file);
                //console.log(response);
                if(response && response[file.upload.uuid]) {
                   	$('#'+paramName).val(file.upload.uuid);
                }
            },
            /*addedfile: function(file) {
                // obtener el uuid del archivo para usarlo como token. Aqui this es el objeto dropzone
                this.options.params.uuid = file.upload.uuid;
                //console.log(this.options);
            },*/
            sending: function(file, xhr, formData) {
            	  // Will send the filesize along with the file as POST data.
            	  formData.append('uuid', file.upload.uuid);
            	  //this.options.params.uuid = file.upload.uuid;
            }
        };
        //new Dropzone($(this), opciones);
        $(this).dropzone(opciones);
        $(this).addClass('dropzone');
        //console.log(opciones);
    });
});

</script>
</html>