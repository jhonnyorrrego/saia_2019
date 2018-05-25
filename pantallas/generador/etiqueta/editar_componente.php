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
if(@$_REQUEST["idpantalla_campos"]){    
  $pantalla_campos=get_pantalla_campos($_REQUEST["idpantalla_campos"],0);
  $obligatoriedad_si='';
  $obligatoriedad_no='';    
  if($pantalla_campos[0]["obligatoriedad"])
    $obligatoriedad_si=' checked="checked"';
  else 
    $obligatoriedad_no=' checked="checked"';
}
else{
  alerta("No es posible Editar el Campo");
}
$items=false;
$ruta_archivo="pantallas/lib/librerias_comunicacion_saia.php";
$nombre_funcion="informacion_documento";
if($pantalla_campos[0]["valor"]){
	$tipo2=False;
	$valor1="";
	$datos=explode("/**/",$pantalla_campos[0]["valor"]);
	if($datos[0]==1){
		$valor1=$datos[1];
	}
	else if($datos[0]==2){
		$ruta_archivo=$datos[1];
		$nombre_funcion=$datos[2];
		$tipo2=true;
	}
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
  
  <input type="hidden" name="fs_valor" id="fs_valor" value="<?php echo (@$pantalla_campos[0]["valor"]); ?>">
  <div class="control-group">
    <label class="control-label" for="ayuda">Tipo*</label>
    <div class="controls">
      <input type="radio" name="tipo" value="1" id="tipo1" checked>Texto plano
      <input type="radio" name="tipo" value="2" id="tipo2">Llamado a una funcion
    </div>
  </div>
  
  <div id="texto_valor" class="control-group">
    <label class="control-label" for="">Valor de llenado *</label>
    <div class="controls">
      <textarea name="valor1" id="valor1" placeholder="" required><?php echo(@$valor1);?></textarea>
    </div>
  </div>
  
  <div id="capa_funciones" style="display:none">
  <div class="control-group">
    <label class="control-label" for="ruta_archivo">Ruta archivo</label>
    <div class="controls">
      <input name="ruta_archivo" id="ruta_archivo" placeholder="" value="<?php echo (@$ruta_archivo); ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="nombre_funcion">Nombre funcion</label>
    <div class="controls">
      <input name="nombre_funcion" id="nombre_funcion" placeholder value="<?php echo (@$nombre_funcion); ?>">
    </div>
  </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="ayuda">Ayuda *</label>
    <div class="controls">
      <textarea name="fs_ayuda" id="ayuda" placeholder="Ayuda" required><?php echo(@$pantalla_campos[0]["ayuda"]);?></textarea>
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
			parsear_valor();
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
	
	$('input[name$="tipo"]').click(function(){
		var valor=$(this).val();
		if(valor==1){
			$("#texto_valor").show();
			$("#capa_funciones").hide();
		}
		if(valor==2){
			$("#texto_valor").hide();
			$("#capa_funciones").show();
		}
	});
	<?php if($tipo2){ ?>
	$("#tipo2").click();
	<?php } ?>
});	
function parsear_valor(){
	var cadena='';
	if($('#tipo1').attr("checked")){
		var valor1=$("#valor1").val();
		cadena="1/**/"+valor1;
	}
	if($('#tipo2').attr("checked")){
		var ruta_archivo=$("#ruta_archivo").val();
		var nombre_funcion=$("#nombre_funcion").val();
		cadena="2/**/"+ruta_archivo+"/**/"+nombre_funcion;
	}
	$("#fs_valor").val(cadena);
}
</script>