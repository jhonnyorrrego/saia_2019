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

echo (estilo_bootstrap());
echo (librerias_jquery("1.8.3"));
echo(librerias_validar_formulario());
echo (librerias_notificaciones());
echo (librerias_highslide());

if(isset($_REQUEST['idencabezado'])){
	$idencabezado=$_REQUEST['idencabezado'];
}

if(isset($_REQUEST['idpie'])){
	$idencabezado=$_REQUEST['idpie'];
}
$encabezados=busca_filtro_tabla("","encabezado_formato","idencabezado_formato=".$idencabezado,"etiqueta",$conn);
	    $contenido_enc= $encabezados[0]["contenido"];
	    $etiqueta_enc = $encabezados[0]["etiqueta"];

?>

<script src="<?= $ruta_db_superior ?>js/ckeditor/4.11/ckeditor_cust/ckeditor.js"></script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="">
			<div class="">

				<div class="">
					<div class="" id="pantalla_mostrar-tab">
						<br>
						<form name="formulario_editor_encabezado" id="formulario_editor_encabezado" action="">
                  		<input type="hidden" name="idencabezado" id="idencabezado" value="<?php echo $idencabezado;?>"></input>
                  		<input type="hidden" name="accion_encab" id="accion_encabezado" value="1"></input>
                  		<div id="div_etiqueta_encabezado">
                    		<label for="etiqueta_encabezado">Etiqueta:
                  				<input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado" value="<?php echo $etiqueta_enc;?>"></input>
							</label>
                  		</div>
                  		<textarea name="editor_encabezado" id="editor_encabezado"> 
                  			<?php
                  if($idencabezado) {
                    echo $contenido_enc;
                  }
                  ?>
                  		</textarea>
                  		<script>
							var editor_encabezado = CKEDITOR.replace("editor_encabezado");
						</script>
                  	</form>
					</select>
						<br>
					<button style="background: #48b0f7;color:fff;margin-top:3px;" class="btn btn-info actualizar_encabezado" id="guardar_cambios" ><span  style="color:fff; background: #48b0f7;"> Guardar Cambios</span></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$(function(){
	$(document).on("click", ".actualizar_encabezado", function(e) {
	var formulario_encabezado = $("#formulario_editor_encabezado");
	formulario_encabezado.validate({
		ignore: [],
        debug: false,
        rules: {
          "etiqueta_encabezado": {
              required: true,
              minlength:1
          },
          editor_encabezado:{
              required: function(){
                 CKEDITOR.instances.editor_encabezado.updateElement();
                },
                minlength:1
            }
        }    
	});
	if(formulario_encabezado.valid()){
	  	//var editor = tinymce.get('editor_encabezado');
		var etiqueta = $("#etiqueta_encabezado").val();
		//var contenido = editor.getContent();
		var contenido = CKEDITOR.instances['editor_encabezado'].getData();	
		var id = $("#idencabezado").val();

		var datos = {
			ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
			idencabezado : id,
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
            		notificacion_saia("Encabezado pagina actualizado","success","",3000);
            		parent.hs.close();           		                                  
            	}
            }
        });
	  }
   });
});
	
</script>

