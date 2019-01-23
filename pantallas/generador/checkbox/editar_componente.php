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
$items=false;
if(strpos(strtoupper($pantalla_campos[0]["valor"]),"SELECT")!==false){
	$valor_llenado1=$pantalla_campos[0]["valor"];
}
else{
	$valor_llenado2=utf8_encode(html_entity_decode($pantalla_campos[0]["valor"]));
	$filas=explode(";",$valor_llenado2);
	$cant=count($filas);
	$items=true;
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
  <div class="control-group">
    <label class="control-label" for="obligatoriedad">Obligatoriedad</label>
    <div class="controls">
      <label class="control-label" for="obligatorio">
        <input type="radio" name="fs_obligatoriedad" id="obligatorio" value="1" <?php echo($obligatoriedad_si);?> required>
        Obligatorio
      </label>
      <label class="control-label" for="radios-1">
        <input type="radio" name="fs_obligatoriedad" id="opcional" value="0" <?php echo($obligatoriedad_no);?>><br>
        Opcional
      </label>
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
        <input type="checkbox" name="fs_acciones[]" id="acciones_5" value="l" <?php echo($acciones1); ?>>
        Autoguardado
      </label>
      <label class="checkbox inline" for="acciones_6">
        <input type="checkbox" name="fs_acciones[]" id="acciones_6" value="p" <?php echo($accionesp); ?>>
        Descripci&oacute;n
      </label>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Tipo*</label>
    <div class="controls">
    	<label class="control-label" for="tipo_llenado_1">
        <input class="radio_tipo" type="radio" name="tipo_llenado" id="tipo_llenado_1" value="1" checked="true">
        Est&aacute;tico
      </label>
    	<label class="control-label" for="tipo_llenado_2">
        <input class="radio_tipo" type="radio" name="tipo_llenado" id="tipo_llenado_2" value="2">
        Autom&aacute;tico
      </label>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="valor">Valor de llenado</label>
    
    <div class="controls" id="valor_llenado1">
      <table class="table table-bordered">
      	<thead>
      		<tr>
      		<td style="text-align:center;"><b>Etiqueta</b></td>
      		<td style="text-align:center;"><b>Valor</b></td>
      		<td style="text-align:center;">&nbsp;</td>
      	</tr>
      	</thead>
      	<tbody id="items">
<?php
for($i=0;$i<$cant;$i++){
	$datos=explode(",",$filas[$i]);
	if($datos[0]!=''||$datos[1]!=''){
		echo "<tr id='fila[]' ><td><input type='text' class='etiquetas_llenado' style='width:100px' value='".$datos[1]."'></td><td><input type='text' class='valores_llenado' style='width:100px' value='".$datos[0]."'></td><td class='eliminar_fila' style='cursor:pointer;text-align:center'>X</td></tr>";
	}
}
?>
      	</tbody>
      	<tfoot>
      		<tr>
      			<td colspan="3" id="adicionar_item" style="text-align:center;cursor:pointer">+Adicionar</td>
      		</tr>
      	</tfoot>
      </table>
    </div>
    <input type="hidden" name="fs_valor" id="valor">
    <div class="controls" id="valor_llenado2" style="display:none">
      <textarea name="valor2" id="valor2" placeholder="valor de llenado"><?php echo(@$valor_llenado1);?></textarea>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="predeterminado">Valor predeterminado</label>
    <div class="controls">
      <input type="text" name="fs_predeterminado" id="predeterminado" placeholder="Valor predeterminado" value="<?php echo(@$pantalla_campos[0]["predeterminado"]);?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda</label>
    <div class="controls">
      <textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda"><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
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
	
	$(".radio_tipo").click(function(){
		var valor=$(this).val();
		if(valor==1){
			$("#valor_llenado1").show();
			$("#valor_llenado2").hide();
		}
		else if(valor==2){
			$("#valor_llenado2").show();
			$("#valor_llenado1").hide();
		}
	});
	
	$("#adicionar_item").click(function(){
		$("#items").append("<tr id='fila[]' ><td><input type='text' class='etiquetas_llenado' style='width:100px'></td><td><input type='text' class='valores_llenado' style='width:100px'></td><td class='eliminar_fila' style='cursor:pointer;text-align:center'>X</td></tr>");
	});
	
	$(".eliminar_fila").live("click",function(){
		var fila=$(this).parent();
		fila.remove();
	});
	<?php if(!$items){ ?>
	$("#tipo_llenado_2").click();
	<?php } ?>
});	
function parsear_items(){
	if($("#tipo_llenado_1").attr("checked")){
		var etiqueta=new Array();
		var valor=new Array();
		$(".etiquetas_llenado").each(function(i){
			etiqueta[i]=$(this).attr("value");
		});
		$(".valores_llenado").each(function(i){
			valor[i]=$(this).attr("value");
		});
		var cantidad=valor.length;
		var cadena=new Array();
		for(var i=0;i<cantidad;i++){
			cadena[i]=valor[i]+","+etiqueta[i];
		}
		$("#valor").val(cadena.join(";"));
	}
	else if($("#tipo_llenado_2").attr("checked")){
		var cadena=$("#valor2").val();
		$("#valor").val(cadena);
	}
}
</script>