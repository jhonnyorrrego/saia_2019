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
$accionesp="";
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
	$accionesp="";
	$acciones_guardadas=explode(",",$pantalla_campos[0]["acciones"]);
	if(in_array("a",$acciones_guardadas))$accionesa="checked";
	if(in_array("e",$acciones_guardadas))$accionese="checked";
	if(in_array("b",$acciones_guardadas))$accionesb="checked";
	if(in_array("1",$acciones_guardadas))$acciones1="checked";
	if(in_array("p",$acciones_guardadas))$accionesp="checked";
}
else{
  alerta("No es posible Editar el Campo");
}
$tipo_campo1="checked";
$tipo_campo2="";
$idcampo_heredado="";
if($pantalla_campos[0]["valor"]){
	$tipo_campo1="";
	$tipo_campo2="";
	$datos=explode("|",$pantalla_campos[0]["valor"]);
	if($datos[1]==1){
		$tipo_campo1="checked";
	}
	if($datos[1]==2){
		$tipo_campo2="checked";
	}
	if($datos[0]){
		$idcampo_heredado=$datos[0];
	}
}

$heredados_existentes=busca_filtro_tabla("valor","pantalla_campos a","a.etiqueta_html='campo_heredado' and (valor is not null and valor<>'' and valor<>'0')","",$conn);
$no_permitidos=array();
for($i=0;$i<$heredados_existentes["numcampos"];$i++){
	$valor_campo=explode("|",$heredados_existentes[$i]["valor"]);
	$no_permitidos[]=$valor_campo[0];
}
?>
<form method="POST" action="" class="form-horizontal" name="editar_pantalla_campo" id="editar_pantalla_campo">
  <fieldset id="content_form_name">
    <legend>Editar Campos Heredados</legend>
  </fieldset>
  <input type="hidden" name="fs_tabla" id="tabla" value="">
  <input type="hidden" name="fs_nombre" id="fs_nombre" value="<?php echo(@$pantalla_campos[0]["nombre"]);?>">
  <input type="hidden" name="fs_obligatoriedad" id="fs_obligatoriedad" value="<?php echo(@$pantalla_campos[0]["obligatoriedad"]);?>">
  
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta *</label>
    <div class="controls">
      <input type="text" name="fs_etiqueta" id="fs_etiqueta" placeholder="Etiqueta" value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" required>
    </div>
  </div>
  
  
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
      <label class="checkbox inline" for="acciones_6">
        <input type="checkbox" name="fs_acciones[]" id="acciones_6" value="p" <?php echo($accionesp); ?>>
        Descripci&oacute;n
      </label>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Tipo de campo*</label>
    <div class="controls">
      <label class="checkbox inline" for="tipo_campo_1">
        <input type="radio" name="tipo_campo" id="tipo_campo1" value="1" <?php echo($tipo_campo1); ?>>
        Defecto
      </label>
      <label class="checkbox inline" for="tipo_campo_2">
        <input type="radio" name="tipo_campo" id="tipo_campo2" value="2" <?php echo($tipo_campo2); ?>>
        Oculto
      </label>
    </div>
  </div>
  <!--div class="control-group">
    <label class="control-label" for="valor">Valor de llenado</label>
    <div class="controls">
      <textarea name="fs_valor" id="valor" placeholder="valor de llenado"><?php echo(@$pantalla_campos[0]["valor"]);?></textarea>
    </div>
  </div-->
  <?php
  if(!$pantalla_campos[0]["valor"]){
  ?>
  <div class="control-group">
  	<label class="control-label" for="predeterminado">Campo a heredar*</label>
  	<div class="controls">
  		<select id="valor" required><option value="">Por favor seleccione...</option>
<?php
$nuevos_campos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$pantalla_campos[0]["clase_pantalla"]." AND banderas NOT LIKE '%pk%' and idpantalla_campos not in(".implode(",",$no_permitidos).")","",$conn);
for($i=0;$i<$nuevos_campos["numcampos"];$i++){
	echo("<option value='".$nuevos_campos[$i]["idpantalla_campos"]."' nombre='".$nuevos_campos[$i]["nombre"]."' obligatoriedad='".$nuevos_campos[$i]["obligatoriedad"]."' predeterminado='".$nuevos_campos[$i]["predeterminado"]."' etiqueta='".$nuevos_campos[$i]["etiqueta"]."' ayuda='".$nuevos_campos[$i]["ayuda"]."'>".$nuevos_campos[$i]["etiqueta"]."(".$nuevos_campos[$i]["nombre"].")</option>");
}
?>
  		</select>
  	</div>
  </div>
  <?php }else{ ?>
  	<input type="hidden" id="valor" value="<?php echo($idcampo_heredado); ?>">
  <?php } ?>
  <div class="control-group">
    <label class="control-label" for="predeterminado">Valor predeterminado</label>
    <div class="controls">
      <input type="text" name="fs_predeterminado" id="predeterminado" placeholder="Valor predeterminado" value="<?php echo(@$pantalla_campos[0]["predeterminado"]);?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda</label>
    <div class="controls">
      <textarea name="fs_ayuda" id="fs_ayuda" placeholder="Ayuda"><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="placeholder">Marcador</label>
    <div class="controls">
      <input type="text" name="fs_placeholder" id="placeholder" placeholder="Marcador" value="<?php echo(@$pantalla_campos[0]["placeholder"]);?>">
    </div>
  </div>
  <div class="form-actions">
  	<input type="hidden" name="fs_valor" id="fs_valor" value="<?php echo($pantalla_campos[0]["valor"]); ?>">
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
        data: "ejecutar_pantalla_campo=set_pantalla_campos&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
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
$("#valor").change(function(){
	var valor=$(this).val();
	if(valor){
		var nombre=$("#valor option:selected").attr("nombre");
		var obligatoriedad=$("#valor option:selected").attr("obligatoriedad");
		var predeterminado=$("#valor option:selected").attr("predeterminado");
		var etiqueta=$("#valor option:selected").attr("etiqueta");
		var ayuda=$("#valor option:selected").attr("ayuda");
		
		$("#fs_nombre").val(nombre);
		$("#fs_obligatoriedad").val(obligatoriedad);
		$("#fs_predeterminado").val(predeterminado);
		$("#fs_etiqueta").val(etiqueta);
		$("#fs_ayuda").val(ayuda);
	}
});
function parsear_items(){
	var fs_valor=$("#valor").val()+"|"+$("input[name=tipo_campo]:checked").val();
	$("#fs_valor").val(fs_valor);
}
</script>