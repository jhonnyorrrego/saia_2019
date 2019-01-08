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
}
else{
  alerta("No es posible Editar el Campo");
}
$idpantalla=busca_filtro_tabla("","campos_formato a","a.idcampos_formato=".$_REQUEST["idpantalla_campos"],"",$conn);
$lcampos=busca_filtro_tabla("","campos_formato","formato_idformato=".$idpantalla[0]["formato_idformato"],"",$conn);
$listado_campos_formulario='<select name="lparametros" class="lparametros">';      
if($lcampos["numcampos"]){              
  for($i=0;$i<$lcampos["numcampos"];$i++){
    $listado_campos_formulario.='<option value="'.$lcampos[$i]["idcampos_formato"].'">'.$lcampos[$i]["etiqueta"].'</option>';
    array_push($campos,$lcampos[$i]["nombre"]);
  }
}               
$listado_campos_formulario.='</select>';
$input_variable_formulario='<input type="text" name="_dato" value="" class="lparametros">';

$datos='';
$momento_checked1='';
$momento_checked2='checked';
$momento_checked3='';
$adicional_exe='';
if($idpantalla[0]["valor"]){
	$datos=busca_filtro_tabla("c.ruta,b.nombre, b.parametros, d.nombre as nombre_param, d.valor, d.tipo, a.momento, a.accion","pantalla_funcion_exe a, pantalla_funcion b, pantalla_libreria c, pantalla_func_param d","a.fk_idpantalla_funcion=b.idpantalla_funcion and b.fk_idpantalla_libreria=c.idpantalla_libreria and a.idpantalla_funcion_exe=d.fk_idpantalla_funcion_exe and a.idpantalla_funcion_exe=".$idpantalla[0]["valor"],"",$conn);
	
	$adicional_exe="&idpantalla_funcion_exe=".$idpantalla[0]["valor"];
	
	$momento_checked1="";
	$momento_checked2="";
	$momento_checked3="";
	if($datos[0]["momento"]==1)$momento_checked1="checked";
	else if($datos[0]["momento"]==2)$momento_checked2="checked";
	else if($datos[0]["momento"]==3)$momento_checked3="checked";
	else $momento_checked2='checked';
	
	$parametros=explode(",",$datos[0]["parametros"]);
	$parameters="$".implode(",$",$parametros);	
	$seleccionar_accion='$("#funcion option[value=\''.$datos[0]["nombre"].'('.$parameters.')\']").attr("selected",true);
	$("#funcion").change();';
	
	$llenar_parametros="";
	for($i=0;$i<$datos["numcampos"];$i++){
		$llenar_parametros.="$('#div".$datos[$i]["tipo"]."_".$datos[$i]["nombre_param"]."').click();";
		if($datos[$i]["tipo"]==1){
			$llenar_parametros.="$('#".$datos[$i]["nombre_param"]."_dato option[value=\'".$datos[$i]["valor"]."\']').attr('selected',true);";
		}
		if($datos[$i]["tipo"]==2){
			$llenar_parametros.="$('#".$datos[$i]["nombre_param"]."_dato').val('".$datos[$i]["valor"]."');";
		}
		if($datos[$i]["tipo"]==3){
			$llenar_parametros.="$('#".$datos[$i]["nombre_param"]."_dato').val('".$datos[$i]["valor"]."');";
		}
	}
	if($datos[0]["accion"])
		$accion_pantalla="$('#accion option[value=\'".$datos[0]["accion"]."\']').attr('selected',true)";
}
?>
<form method="POST" action="" class="form-horizontal" name="editar_acciones_pantalla" id="editar_acciones_pantalla">
  <fieldset id="content_form_name">
    <legend>Editar acciones pantalla</legend>
  </fieldset>
  <input type="hidden" name="fs_tabla" value="">
  <div class="control-group">
    <label class="control-label" for="etiqueta">Etiqueta *</label>
    <div class="controls">
      <input type="text" name="fs_etiqueta" id="etiqueta" placeholder="Etiqueta" value="<?php echo(@$pantalla_campos[0]["etiqueta"]);?>" required>
      <input type="hidden" name="momento" id="momento_2" value="2">
      <input type="hidden" name="accion" id="accion" value="enviar_exito">  
      <input type="hidden" name="funcion" id="funcion_definitiva" value="">
    </div>
  </div>  
  <!--------------------------------------------------------------->
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
<input type="hidden" name="ruta" id="ruta" value="pantallas/documento/librerias.php">
</form>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_validar_formulario());
echo(librerias_arboles());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
$(document).ready(function(){	
  var formulario = $("#editar_acciones_pantalla");
  var nombre_funcion='seguimiento_documento';
  formulario.validate({
  	rules: {
  		"fs_etiqueta": {
        required: true
      }
    }
  });
  
  $("#cancelar_formulario_saia").click(function(){		
    parent.hs.close();
});
  $("#enviar_formulario_saia").live("click",function(){
    if(formulario.valid()){
      $('#enviar_formulario_saia').html("<div id='icon-cargando'></div>Procesando");                
      if (formulario.data('locked') == undefined && !formulario.data('locked')){
        $("#enviar_formulario_saia").attr('disabled', 'disabled');
         $("#funcion_definitiva").val(nombre_funcion);
         var ruta=$("#ruta").val();
        $.ajax({
          type:'POST',
          url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
          data: "ejecutar_campos_formato=guardar_configurar_pantalla_libreria&tipo_retorno=1&ruta="+ruta+"&pantalla_idpantalla=<?php echo $idpantalla[0]["pantalla_idpantalla"].$adicional_exe; ?>&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
          beforeSend: function(){ formulario.data('locked', true);},
          success: function(html){                
            if(html){                                        
              var objeto=jQuery.parseJSON(html);                  
              if(objeto.exito){
                $('#cargando_enviar').html("Terminado ...");
                	notificacion_saia(objeto.mensaje,"success","",2500);
                	guardar_componente(objeto.idfuncion_exe,formulario);
              }
              else{
                $('#cargando_enviar').html("Terminado ...");
                notificacion_saia(objeto.mensaje,"error","",2500);
              }                              
            }          
          },
          complete: function(){ formulario.data('locked', false); formulario.remove(); delete formulario; }
        });
      }  
    }  
  });
    <?php if($datos){
    	echo $accion_pantalla;
    }?>
});	

function guardar_componente(id,formulario){
  var idpantalla_campo=$("#idpantalla_campos").val();
    $('#cargando_enviar').html("Procesando <i id='icon-cargando'>&nbsp;</i>");
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
      data: "ejecutar_campos_formato=set_pantalla_campos&fs_valor="+id+"&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
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
</script>