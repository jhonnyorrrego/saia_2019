<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/generador/librerias.php");
echo(estilo_bootstrap());
if(@$_REQUEST["idpantalla_campos"]){
  $pantalla_campos=get_pantalla_campos($_REQUEST["idpantalla_campos"],0);
	if("id".$pantalla_campos[0]["pantalla"]==$pantalla_campos[0]["nombre"]){
		die("No es posible eliminar este campo");
	}
}
else{
  alerta("No es posible Editar el Campo");
}
if($pantalla_campos[0]["etiqueta_html"]=="campo_heredado"&&$pantalla_campos[0]["valor"]!=''){
	$campo_heredado=get_pantalla_campos($pantalla_campos[0]["valor"],0);
	if($campo_heredado[0]["obligatoriedad"]==1){
		die("No es posible eliminar este campo heredado, su origen es obligatorio");
	}
}
?>
<form method="POST" action="" class="form-horizontal" name="editar_pantalla_campo" id="editar_pantalla_campo">
  <fieldset id="content_form_name">
    <legend>Eliminar Campo</legend>
  </fieldset>
  <div class="control-group">
    <label class="control-label" for="nombre">Nombre</label>
    <div class="controls">
      <input type="text" name="fs_nombre" id="nombre" placeholder="Nombre" value="<?php echo(@$pantalla_campos[0]["nombre"]);?>" disabled="disabled">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta</label>
    <div class="controls">
      <input type="text" name="fs_etiqueta" id="etiqueta" placeholder="Etiqueta" value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" disabled="disabled">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="placeholder">Marcador</label>
    <div class="controls">
      <input type="text" name="fs_placeholder" id="placeholder" placeholder="Marcador" value="<?php echo(@$pantalla_campos[0]["placeholder"]);?>" disabled="disabled">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="idpantalla_campos" id="idpantalla_campos" value="<?php echo($_REQUEST["idpantalla_campos"]); ?>">
    <button type="button" class="btn btn-primary" id="enviar_formulario_saia">Aceptar</button>
    <button type="button" class="btn" id="cancelar_formulario_saia">Cancel</button>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<?php
echo(librerias_jquery("1.8"));
echo(librerias_bootstrap());
echo(librerias_validar_formulario());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function(){
	var formulario = $("#editar_pantalla_campo");
	formulario.validate();
	$("#enviar_formulario_saia").click(function(){
		if(formulario.valid()){
			$('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
			$(this).attr('disabled', 'disabled');
      var idpantalla_campo=$("#idpantalla_campos").val();
			$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
        data: "ejecutar_campos_formato=delete_pantalla_campos&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              //$("#content").append(objeto.etiqueta_html);
              //setTimeout(notificacion_saia("Eliminaci&oacute;n realizada con &eacute;xito.","success","",2500),5000);
              $("#pc_"+idpantalla_campo,parent.document).remove();
              parent.hs.close();
            }
        	}
        }
    	});
		}
		else{
			$(".error").first().focus();
		}
	});
	$("#cancelar_formulario_saia").click(function(){
		parent.hs.close();
	});
});
</script>