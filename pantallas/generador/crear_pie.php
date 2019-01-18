<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

echo estilo_bootstrap();
echo librerias_jquery("1.8.3");
echo librerias_validar_formulario();
echo librerias_notificaciones();
echo librerias_highslide();

?>

<script src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="">
			<div class="">
				<div class="">
					<div class="" id="pantalla_mostrar-tab">
						<br>
						<form name="formulario_encabezado" id="formulario_encabezado" action="">
                  		<div id="div_etiqueta_encabezado">
                    		<label for="etiqueta_encabezado">Etiqueta:
                  				<input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado">
							</label>
                  		</div>
                  		<textarea name="editor_pie" id="editor_pie"></textarea>
                  		<script>
							var editor_pie = CKEDITOR.replace("editor_pie");
						</script>
                  	</form>
					</select>
						<br>
					<button style="background: #48b0f7;color:fff;margin-top:3px;" class="btn btn-info crear_pie" id="guardar_cambios" ><span  style="color:fff; background: #48b0f7;"> Guardar Cambios</span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$(function(){
	$(document).on("click", ".crear_pie", function(e) {
	var formulario_encabezado = $("#formulario_encabezado");
	formulario_encabezado.validate({
		ignore: [],
        debug: false,
        rules: {
          "etiqueta_encabezado": {
              required: true,
              minlength:1
          },
          editor_pie:{
              required: function(){
                 CKEDITOR.instances.editor_pie.updateElement();
                },
                minlength:1
            }
        }    
	});
	if(formulario_encabezado.valid()){
		var etiqueta = $("#etiqueta_encabezado").val();
		var contenido = CKEDITOR.instances['editor_pie'].getData();	
		var id = $("#idencabezado").val();
		var datos = {
			ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
			rand: Math.round(Math.random()*100000),
			etiqueta : etiqueta,
			contenido : contenido,
			tipo_retorno : 1
		};
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_formato.php",
            data: datos,
            success: function(data) {
            	if(data.exito == 1) {
                    $("#sel_pie_pagina",window.parent.document).attr("idpie",data.idInsertado);
            		notificacion_saia("Pie de pagina creado","success","",3000);
            		parent.hs.close();           		                                  
            	}
            }
        });
	  }
   });
});
	
</script>

