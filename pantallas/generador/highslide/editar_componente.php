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
$campos=busca_filtro_tabla("","pantalla_componente B","idpantalla_componente=".$_REQUEST["idpantalla_componente"],"",$conn);
$accionesa="checked";
$accionese="checked";
$accionesb="checked";
$acciones1="";

$predeterminado1="";
$predeterminado2="500";
$predeterminado3="400";
if(@$_REQUEST["idpantalla_campos"]){    
  $pantalla_campos=get_pantalla_campos($_REQUEST["idpantalla_campos"],0);
  $obligatoriedad_si='';
  $obligatoriedad_no='';    
  if($pantalla_campos[0]["obligatoriedad"])
    $obligatoriedad_si=' checked="checked"';
  else 
    $obligatoriedad_no=' checked="checked"';
    
  $accionesa="";
	$accionese="";
	$accionesb="";
	$acciones1="";
	$acciones_guardadas=explode(",",$pantalla_campos[0]["acciones"]);
	if(in_array("a",$acciones_guardadas))$accionesa="checked";
	if(in_array("e",$acciones_guardadas))$accionese="checked";
	if(in_array("b",$acciones_guardadas))$accionesb="checked";
	if(in_array("1",$acciones_guardadas))$acciones1="checked";
	
	$datos_valor=explode(";",$pantalla_campos[0]["valor"]);
	
	if($datos_valor[0]){
		$predeterminado1=$datos_valor[0];
	}
	else{
		$predeterminado1="";
	}
	
	if($datos_valor[1]){
		$predeterminado2=$datos_valor[1];
	}
	else{
		$predeterminado2="500";
	}
	
	if($datos_valor[2]){
		$predeterminado3=$datos_valor[2];
	}
	else{
		$predeterminado3="400";
	}
}
else{
  alerta("No es posible Editar el Campo");
}
?>
<form method="POST" action="" class="form-horizontal" name="editar_pantalla_campo" id="editar_pantalla_campo">
  <fieldset id="content_form_name">
    <legend>Editar Campos</legend>
  </fieldset>
  <div class="control-group">
    <label class="control-label" for="nombre">Nombre *</label>
    <div class="controls">
      <input type="text" name="fs_nombre" id="nombre" placeholder="Nombre" value="<?php echo(@$pantalla_campos[0]["nombre"]);?>" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta *</label>
    <div class="controls">
      <input type="text" name="fs_etiqueta" id="etiqueta" placeholder="Etiqueta" value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" required>
    </div>
  </div>
  <input type="hidden" name="fs_obligatoriedad" id="opcional" value="0">
  
  <div class="control-group">
    <label class="control-label">Formularios *</label>
    <div class="controls">
      <label class="checkbox inline" for="acciones_0">
        <input type="checkbox" name="fs_acciones[]" id="acciones_0" value="a" <?php echo($accionesa); ?>>
        Adicionar
      </label>
      <label class="checkbox inline" for="acciones_1">
        <input type="checkbox" name="fs_acciones[]" id="acciones_1" value="e" <?php echo($accionese); ?>>
        Editar
      </label>
      <label class="checkbox inline" for="acciones_2">
        <input type="checkbox" name="fs_acciones[]" id="acciones_2" value="b" <?php echo($accionesb); ?>>
        Buscar
      </label>
      <label class="checkbox inline" for="acciones_5">
        <input type="checkbox" name="fs_acciones[]" id="acciones_5" value="1" <?php echo($acciones1); ?>>
        Autoguardado
      </label>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="predeterminado">Enlace</label>
    <div class="controls">
      <input type="text" name="enlace1" id="enlace1" placeholder="" value="<?php echo(@$predeterminado1);?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="predeterminado">Ancho</label>
    <div class="controls">
      <input type="text" name="enlace2" id="enlace2" placeholder="" value="<?php echo(@$predeterminado2);?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="predeterminado">Alto</label>
    <div class="controls">
      <input type="text" name="enlace3" id="enlace3" placeholder="" value="<?php echo(@$predeterminado3);?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda *</label>
    <div class="controls">
      <textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda" required><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="placeholder">Marcador</label>
    <div class="controls">
      <input type="text" name="fs_placeholder" id="placeholder" placeholder="Marcador" value="<?php echo(@$pantalla_campos[0]["placeholder"]);?>">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="fs_valor" id="fs_valor" value="">
  	<input type="hidden" name="idpantalla_campos" id="idpantalla_campos" value="<?php echo($_REQUEST["idpantalla_campos"]); ?>">
    <button type="button" class="btn btn-primary" id="enviar_formulario_saia">Aceptar</button>
    <button type="button" class="btn" id="cancelar_formulario_saia">Cancel</button>
    <div class="pull-right" id="cargando_enviar"></div>
  </div>
</form>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_validar_formulario());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function(){
	var formulario = $("#editar_pantalla_campo");
	formulario.validate({
    rules: {
      "fs_acciones[]": {
        required: true,
        minlength:1            
      }
    }
  });
	$("#enviar_formulario_saia").click(function(){    
    var idpantalla_campo=$("#idpantalla_campos").val();
		if(formulario.valid()){
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
			$(this).attr('disabled', 'disabled');
			parsear_items();
			$.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
        data: "ejecutar_campos_formato=set_pantalla_campos&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
        success: function(html){                
          if(html){          
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              //$("#content").append(objeto.etiqueta_html);
              //setTimeout(notificacion_saia("Actualizaci&oacute;n realizada con &eacute;xito.","success","",2500),5000);  
              //$("#pc_"+idpantalla_campo,parent.document).find(".control-label").html(objeto.etiqueta);             
              $("#pc_"+idpantalla_campo,parent.document).replaceWith(objeto.codigo_html);              
              //$("#pc_"+idpantalla_campo,parent.document).find(".elemento_formulario").attr("placeholder",objeto.placeholder);        
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
function parsear_items(){
	var enlace1=$("#enlace1").val();
	var enlace2=$("#enlace2").val();
	var enlace3=$("#enlace3").val();
	$("#fs_valor").val(enlace1+";"+enlace2+";"+enlace3);
}
</script>