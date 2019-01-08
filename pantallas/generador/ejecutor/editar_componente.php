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

$tipo1="";
$tipo2="";
$tipo3="";
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
  <div class="control-group">
    <label class="control-label" for="obligatoriedad">Obligatoriedad</label>
    <div class="controls">
      <label class="control-label" for="obligatorio">
        <input type="radio" name="fs_obligatoriedad" id="obligatorio" value="1" <?php echo($obligatoriedad_si);?> required>
        Obligatorio
      </label>
      <label class="control-label" for="radios-1">
        <input type="radio" name="fs_obligatoriedad" id="opcional" value="0" <?php echo($obligatoriedad_no);?>>
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
        <input type="checkbox" name="fs_acciones[]" id="acciones_5" value="1" <?php echo($acciones1); ?>>
        Autoguardado
      </label>
    </div>
  </div>
  <?php 
  $parametros1=explode("@",$pantalla_campos[0]["valor"]);
  if($parametros1[0]=="unico"){
  	$cantidad1=' checked="checked" ';
  }
  else{
  	$cantidad2=' checked="checked" ';
  }
  if($parametros1[1]=="" || (strpos("identificacion",$parametros1[1])===false && strpos("nombre",$parametros1[1])===false)){
  	$identificacion=' checked="checked" ';
  }
  if(strpos("nombre",$parametros1[1])!==false){
  	$nombre_remitente=' checked="checked" ';
  }
  $parametros2=explode(",",$parametros1[2]);
  foreach($parametros2 AS $key=>$valor){
  	if($valor=="cargo"){
  		$cargo=' checked="checked" ';
  	}
  	if($valor=="empresa"){
  		$empresa=' checked="checked" ';
  	}
  	if($valor=="direccion"){
  		$direccion=' checked="checked" ';
  	}
  	if($valor=="telefono"){
  		$telefono=' checked="checked" ';
  	}
  	if($valor=="email"){
  		$email=' checked="checked" ';
  	}
  	if($valor=="titulo"){
  		$titulo=' checked="checked" ';
  	}
  	if($valor=="ciudad"){
  		$ciudad=' checked="checked" ';
  	}
  }
  ?> 
  <div class="control-group">
    <label class="control-label" for="cantidad">Cantidad</label>
    <div class="controls">
      <label class="control-label" for="cantidad">
        <input type="radio" name="cantidad" id="unico" value="unico" <?php echo($cantidad1);?> required>
        &Uacute;nico
      </label>
      <label class="control-label" for="cantidad">
        <input type="radio" name="cantidad" id="multiple" value="multiple" <?php echo($cantidad2);?>>
        Multiple
      </label>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Datos Remitente</label>
    <div class="controls">
      <label class="checkbox inline" for="identificacion">
        <input type="checkbox" class="principales" name="identificacion" id="identificacion" value="identificacion" <?php echo($identificacion); ?>>
        Identificaci&oacute;n
      </label>
      <label class="checkbox inline" for="nombre_remitente">
        <input type="checkbox"  class="principales" name="nombre_remitente" id="nombre_remitente" value="nombre" <?php echo($nombre_remitente); ?>>
        Nombre
      </label>
      <label class="checkbox inline" for="cargo">
        <input type="checkbox" class="adicionales" name="cargo" id="cargo" value="cargo" <?php echo($cargo); ?>>
        Cargo
      </label>
      <label class="checkbox inline" for="empresa">
        <input type="checkbox" class="adicionales" name="empresa" id="empresa" value="empresa" <?php echo($empresa); ?>>
        Empresa
      </label>
      <label class="checkbox inline" for="direccion">
        <input type="checkbox" class="adicionales" name="direccion" id="direccion" value="direccion" <?php echo($direccion); ?>>
        Direcci&oacute;n
      </label>
	  <label class="checkbox inline" for="telefono">
        <input type="checkbox" class="adicionales" name="telefono" id="telefono" value="telefono" <?php echo($telefono); ?>>
        Tel&eacute;fono
      </label>
      <label class="checkbox inline" for="email">
        <input type="checkbox" class="adicionales" name="email" id="email" value="email" <?php echo($email); ?>>
        Correo electr&oacute;nico
      </label>
      <label class="checkbox inline" for="titulo">
        <input type="checkbox" class="adicionales" name="titulo" id="titulo" value="titulo" <?php echo($titulo); ?>>
        T&iacute;tulo
      </label>
      <label class="checkbox inline" for="ciudad">
        <input type="checkbox" class="adicionales" name="ciudad" id="ciudad" value="ciudad" <?php echo($ciudad); ?>>
        Ciudad
      </label>
    </div>
  </div>
  <input type="hidden" name="fs_valor" id="fs_valor" value="<?php echo($pantalla_campos[0]["valor"]); ?>">
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
		var valor_adicionales = $(".adicionales").map(function(){
	        return this.value;
	    }).get().join(",");
		var valor_principales = $(".principales").map(function(){
	        return this.value;
	    }).get().join(",");
	    $("#fs_valor").val($("input:radio[name='cantidad']:checked").val()+"@"+valor_principales+"@"+valor_adicionales);
    	var idpantalla_campo=$("#idpantalla_campos").val();
		if(formulario.valid()){
			$('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
			$(this).attr('disabled', 'disabled');
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
</script>