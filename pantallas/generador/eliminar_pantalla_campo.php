<?php
$max_salida=10; 
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta;
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/generador/librerias.php");
echo estilo_bootstrap();
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
    <h5 class="label-fields">¿Est&aacute; seguro de eliminar este campo?</h5>
  </fieldset>
  <div class="form-actions">
  	<input type="hidden" name="idpantalla_campos" id="idpantalla_campos" value="<?= $_REQUEST["idpantalla_campos"];?>">
    <input type="hidden" name="idformato" id="idformato" value="<?= $_REQUEST["idformato"]; ?>">
    <button  style="background: #48b0f7;color:fff;" class="btn btn-info" id="enviar_formulario_saia" ><span  style="color:fff; background: #48b0f7;">Aceptar</span></button>
    <button  style="background: #F55753;color:fff;" class="btn btn-info" id="cancelar_formulario_saia" ><span  style="color:fff; background: #F55753;">Cancelar</span></button>
    
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<?php
echo librerias_jquery("1.8");
echo librerias_bootstrap();
echo librerias_validar_formulario();
echo librerias_notificaciones();
?>
<script type="text/javascript">
$(document).ready(function(){
	var formulario = $("#editar_pantalla_campo");
	formulario.validate();
	$("#enviar_formulario_saia").click(function(){
		if(formulario.valid()){
			$('#cargando_enviar').html("<div id='icon-cargando'></div>Eliminando");
			$(this).attr('disabled', 'disabled');
      var idpantalla_campo=$("#idpantalla_campos").val();
      var idFormato=$("#idformato").val();
			$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
        data: "ejecutar_campos_formato=delete_pantalla_campos&tipo_retorno=1&idformato="+idFormato+"&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              $('#cargando_enviar').html("Eliminado ...");
              $("#pc_"+idpantalla_campo,parent.document).remove();
              if(!objeto.mostrarTexto){
                $("#list_one",parent.document).show();
              }
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