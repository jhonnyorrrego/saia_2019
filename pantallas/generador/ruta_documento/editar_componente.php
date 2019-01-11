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
for($i=0;$i<$campos["numcampos"];$i++){
	$librerias=explode(",",$campos[$i]["librerias"]);
	foreach($librerias AS $key=>$libreria){
		$extension=explode(".",$libreria);
		$cant=count($extension);
    if($extension[$cant-1]!==''){            	
  		switch($extension[($cant-1)]){
  	    case "php":           
  	      include_once($ruta_db_superior.$libreria);
  	    break;
  	    case "js":
  	      $texto='<script type="text/javascript" src="'.$ruta_db_superior.$libreria.'"></script>';
  	    break;
  	    case "css": 
  	      $texto='<link rel="stylesheet" type="text/css" href="'.$ruta_db_superior.$libreria.'"/>';    
  	    break;
  	    default:
  	      $texto=""; //retorna un vacio si no existe el tipo
  	    break;
  	  }
  		echo($texto);    
  	}
  }
}
$accionesa="checked";
$accionese="checked";
$accionesb="checked";
$acciones1="";

$predeterminado1="";
$alto="400";
$ancho="500";
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
	if(!@$datos_valor[0]){
    $datos_valor[0]=$pantalla_campos[0]["etiqueta"];
  }
	if($datos_valor[1]){
		$ruta_adicionar_enlace=$datos_valor[1];
	}
	else{
		$ruta_adicionar_enlace="pantallas/ruta_temporal/adicionar_ruta_temporal.php?enviado_a=highslide";
	}
	$lancho=explode(",",$datos_valor[2]);
  if(@$lancho[0]){
    $ancho=$lancho[0];
  }
  if(@$lancho[1]){
    $alto=$lancho[1];
  }
  $parametros_request=$datos_valor[3];
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
    <label class="control-label" for="etiqueta">Etiqueta *</label>
    <div class="controls">
      <input type="text" name="fs_etiqueta" id="etiqueta" placeholder="Etiqueta" value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="etiqueta">Texto enlace*</label>
    <div class="controls">
      <input type="text" name="texto_enlace" id="texto_enlace" placeholder="Texto enlace" value="<?php echo(@$datos_valor[0]);?>" required>
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
    <label class="control-label" for="ruta_adicionar_enlace">Enlace</label>
    <div class="controls">
      <input type="text" name="ruta_adicionar_enlace" id="ruta_adicionar_enlace" placeholder="" value="<?php echo(@$ruta_adicionar_enlace);?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="parametros_request">Par&aacute;metros request</label>
    <div class="controls">
      <input type="text" name="parametros_request" id="parametros_request" placeholder="parametros separados por coma" value="<?php echo(@$parametros_request);?>">
    </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="ancho">Ancho</label>
    <div class="controls">
      <input type="text" name="ancho" id="ancho" placeholder="" value="<?php echo(@$ancho);?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="alto">Alto</label>
    <div class="controls">
      <input type="text" name="alto" id="alto" placeholder="" value="<?php echo(@$alto);?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda *</label>
    <div class="controls">
      <textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda" required><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
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
              $("#pc_"+idpantalla_campo,parent.document).replaceWith(objeto.codigo_html);        
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
	var texto_enlace=$("#texto_enlace").val();
	var ruta_adicionar=$("#ruta_adicionar_enlace").val();
	var parametros_hs=$("#ancho").val()+","+$("#alto").val();
  var parametros_request=$("#parametros_request").val();
	$("#fs_valor").val(texto_enlace+";"+ruta_adicionar+";"+parametros_hs+";"+parametros_request);
}
</script>