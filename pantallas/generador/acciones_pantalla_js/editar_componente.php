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
include_once $ruta_db_superior . 'core/autoload.php';
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
$idpantalla=busca_filtro_tabla("","pantalla_campos a","a.idpantalla_campos=".$_REQUEST["idpantalla_campos"],"",$conn);
$lcampos=busca_filtro_tabla("","pantalla_campos","pantalla_idpantalla=".$idpantalla[0]["pantalla_idpantalla"],"",$conn);
$listado_campos_formulario='<select name="lparametros" class="lparametros">';      
if($lcampos["numcampos"]){              
  for($i=0;$i<$lcampos["numcampos"];$i++){
    $listado_campos_formulario.='<option value="'.$lcampos[$i]["idpantalla_campos"].'">'.$lcampos[$i]["etiqueta"].'</option>';
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
	$datos=busca_filtro_tabla("c.ruta,b.nombre, b.parametros, a.momento, a.accion, d.lugar_incluir","pantalla_funcion_exe a, pantalla_funcion b, pantalla_libreria c, pantalla_include d","a.fk_idpantalla_funcion=b.idpantalla_funcion and b.fk_idpantalla_libreria=c.idpantalla_libreria and c.idpantalla_libreria=d.fk_idpantalla_libreria and a.idpantalla_funcion_exe=".$idpantalla[0]["valor"],"",$conn);
	
	$datos_parametros=busca_filtro_tabla("d.nombre as nombre_param, d.valor, d.tipo","pantalla_func_param d","fk_idpantalla_funcion_exe=".$idpantalla[0]["valor"],"",$conn);
	
	$adicional_exe="&idpantalla_funcion_exe=".$idpantalla[0]["valor"];
	
	$momento_checked1="";
	$momento_checked2="";
	$momento_checked3="";
	if($datos[0]["momento"]==1)$momento_checked1="checked";
	else if($datos[0]["momento"]==2)$momento_checked2="checked";
	else if($datos[0]["momento"]==3)$momento_checked3="checked";
	else $momento_checked2='checked';
	
	$lugar_incluir1="";
	$lugar_incluir2="";
	if($datos[0]["lugar_incluir"]=="head")$lugar_incluir1="checked";
	if($datos[0]["lugar_incluir"]=="footer")$lugar_incluir2="checked";
	
	$parametros=explode(",",$datos[0]["parametros"]);
	$parameters="";
	if($datos[0]["parametros"])
		$parameters=str_replace(" ","","$".implode(",$",$parametros));
	
	$seleccionar_arbol='tree_acciones.selectItem("'.$datos[0]["ruta"].'",true,false);';
	$seleccionar_accion='$("#funcion option[value=\''.$datos[0]["nombre"].'('.$parameters.')\']").attr("selected",true);
	$("#funcion").change();';
	
	$llenar_parametros="";
	for($i=0;$i<$datos_parametros["numcampos"];$i++){
		$llenar_parametros.="$('#div".$datos_parametros[$i]["tipo"]."_".$datos_parametros[$i]["nombre_param"]."').click();";
		if($datos_parametros[$i]["tipo"]==1){
			$llenar_parametros.="$('#".$datos_parametros[$i]["nombre_param"]."_dato option[value=\'".$datos_parametros[$i]["valor"]."\']').attr('selected',true);";
		}
		if($datos_parametros[$i]["tipo"]==2){
			$llenar_parametros.="$('#".$datos_parametros[$i]["nombre_param"]."_dato').val('".$datos_parametros[$i]["valor"]."');";
		}
		if($datos_parametros[$i]["tipo"]==3){
			$llenar_parametros.="$('#".$datos_parametros[$i]["nombre_param"]."_dato').val('".$datos_parametros[$i]["valor"]."');";
		}
		if($datos_parametros[$i]["tipo"]==4){
			$llenar_parametros.="$('#".$datos_parametros[$i]["nombre_param"]."_dato').val('".$datos_parametros[$i]["valor"]."');";
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
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ayuda">Librer&iacute;a *</label>
    <div class="controls">
      <div id="esperando_acciones">
    	<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
      </div>    
      <div id="tree_acciones" class="arbol_saia"></div> 
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="ayuda">Lugar *</label>
    	<div class="controls">
				<label class="radio inline" for="lugar_incluir">        
	        <input type="radio" name="lugar_incluir" id="lugar_incluir_1" value="head" <?php echo $lugar_incluir1; ?>>
	        Encabezado
	      </label>
	      <label class="radio inline" for="lugar_incluir">        
	        <input type="radio" name="lugar_incluir" id="lugar_incluir_2" value="footer" <?php echo $lugar_incluir2; ?>>
	        Pie p&aacute;gina
	      </label>
    	</div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="momento">Ejecutar *</label>
    <div class="controls">
      <label class="radio inline" for="momento">        
        <input type="radio" name="momento" id="momento_1" value="1" <?php echo $momento_checked1; ?>>
        Anterior
      </label>
      <label class="radio inline" for="momento">        
        <input type="radio" name="momento" id="momento_2" value="2" <?php echo $momento_checked2; ?>>
        Posterior
      </label>
      <label class="radio inline" for="momento">        
        <input type="radio" name="momento" id="momento_3" value="3" <?php echo $momento_checked3; ?>>
        Error
      </label>
    </div>
  </div> 
  <div class="control-group">
    <?php
      $acciones=busca_filtro_tabla("","pantalla_accion","","nombre",$conn);
    ?>
    <label class="control-label" for="accion">&nbsp;</label>
    <div class="controls">
      <select name="accion" id="accion">
        <?php
          for($i=0;$i<$acciones["numcampos"];$i++){
            echo('<option value="'.$acciones[$i]["nombre"].'">'.$acciones[$i]["etiqueta"].'</option>');
          }
        ?>
      </select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="accion">&nbsp;</label>
    <div class="controls">
      <div id="configurar_funcion_campo"></div><br>
    </div>
  </div> 
  <div id="contenedor_funcion"></div>
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
<input type="hidden" name="funcion" id="funcion_definitiva" value="">
<input type="hidden" name="ruta" id="ruta" value="">
</form>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_validar_formulario());
echo(librerias_arboles());
echo(librerias_notificaciones());
$carpeta_inicial=busca_filtro_tabla("","configuracion a","a.nombre='inicio_arbol' and tipo='pantallas'","",$conn);
?>
<script type="text/javascript">
$(document).ready(function(){
	var cargar=0;
  var browserType;
  if (document.layers) {browserType = "nn4"}
  if (document.all) {browserType = "ie"}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
     browserType= "gecko"
  }
  tree_acciones=new dhtmlXTreeObject("tree_acciones","","",0);
  tree_acciones.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  tree_acciones.enableTreeImages(false);
  tree_acciones.enableTextSigns(true);
  tree_acciones.enableAutoTooltips(true);
  tree_acciones.setOnLoadingStart(cargando_mostrar);
  tree_acciones.setOnLoadingEnd(fin_cargando_mostrar);
  tree_acciones.setOnClickHandler(insertar_mostrar);
  tree_acciones.enableThreeStateCheckboxes(true);
  tree_acciones.enableSmartXMLParsing(true); 
  tree_acciones.loadXML("<?php echo($ruta_db_superior);?>pantallas/lib/test_archivos_carpeta.php?carpeta_inicial=<?php echo($carpeta_inicial[0]["valor"]); ?>&extensiones_permitidas=js");
  
  function insertar_mostrar(nodeId){
    var ruta_archivo=tree_acciones.getUserData(nodeId,"myurl");     
    if(ruta_archivo!=''){      
      tree_acciones.closeItem("0");  
      $("#configurar_funcion_campo").html("cargando...");
      $.ajax({
        type:'POST',
        url: '<?php echo($ruta_db_superior);?>pantallas/generador/configurar_listado_funciones_libreria.php',  
        data:'ruta='+ruta_archivo+'&pantalla_idpantalla=<?php echo $idpantalla[0]["pantalla_idpantalla"]; ?>&rand='+Math.round(Math.random()*100000),    
        success: function(html){                              
          if(html){
            $("#ruta_archivo_actual").val(ruta_archivo);
            $("#ruta").val(ruta_archivo.replace("../../",""));
            notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000);
            $("#configurar_funcion_campo").html(html);
            tree_acciones.closeAllItems(0);
            <?php if($datos){
            	echo $seleccionar_accion;
            } ?>
          }
        }
      });                            
    }
    else{
          tree_acciones.openItem(nodeId);    
    }
  }
  
  function fin_cargando_mostrar() {
    if (browserType == "gecko" )
       document.poppedLayer =
           eval('document.getElementById("esperando_acciones")');
    else if (browserType == "ie")
       document.poppedLayer =
          eval('document.getElementById("esperando_acciones")');
    else
       document.poppedLayer =
          eval('document.layers["esperando_acciones"]');
    document.poppedLayer.style.visibility = "hidden";
    
    if(cargar==0){
    	cargar++;
    <?php if($datos){
    	echo $seleccionar_arbol;
    } ?>
    }
  }
  function cargando_mostrar() {
    if (browserType == "gecko" )
       document.poppedLayer =
           eval('document.getElementById("esperando_acciones")');
    else if (browserType == "ie")
       document.poppedLayer =
          eval('document.getElementById("esperando_acciones")');
    else
       document.poppedLayer =
           eval('document.layers["esperando_acciones"]');
    document.poppedLayer.style.visibility = "visible";
  } 
  
  var formulario = $("#editar_acciones_pantalla");
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
var funcion='';
var nombre_funcion='';
  $(".seleccionar_pantalla_funcion").live("change",function(){
   	funcion=$('option:selected', this).attr('funcion');
    var lugar_incluir=$("input[name='lugar_incluir']:checked").val();
    nombre_funcion=$('option:selected', this).attr('nombre'); 
    $("#contenedor_funcion").html("cargando...");
    $("#contenedor_funcion").removeData();           
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/generador/detalle_pantalla_funcion.php",
      data: "funcion="+funcion+"&idpantalla=<?php echo($idpantalla[0]["pantalla_idpantalla"]);?>&lugar_incluir="+lugar_incluir+"&ruta=<?php echo($_REQUEST['ruta']);?>&rand="+Math.round(Math.random()*100000),
      success: function(html){                
        if(html){
          $("#contenedor_funcion").html(html);
          	<?php if($datos){
          		echo $llenar_parametros;
						}
          	?>
        }          
      }    
    });
  });
  
  $(".seleccion_variable_funcion_pantalla").live("change",function(){    
    var opcion=$(this).val();  
    var nombre=$(this).attr("name");
    nombre=nombre.replace("div_","");        
    if(opcion==1){      
      $("#"+$(this).attr("name")).html('<?php echo($listado_campos_formulario);?>');            
    }
    else if(opcion==2){          
      $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');            
    }
    else if(opcion==3){          
      $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');            
    }
    else if(opcion==4){          
      $("#"+$(this).attr("name")).html('<?php echo($input_variable_formulario);?>');            
    }
    $("#"+$(this).attr("name")).find(".lparametros").attr("name",nombre+"_dato");
    $("#"+$(this).attr("name")).find(".lparametros").attr("id",nombre+"_dato");
  });
  
    $("#enviar_formulario_saia").live("click",function(){
      var nombre_form = nombre_funcion;
      if(formulario.valid()){
        $('#enviar_formulario_saia').html("<div id='icon-cargando'></div>Procesando");                
        if (formulario.data('locked') == undefined && !formulario.data('locked')){
          $("#enviar_formulario_saia").attr('disabled', 'disabled');
           $("#funcion_definitiva").val(nombre_funcion);
           var ruta=$("#ruta").val();
          $.ajax({
            type:'POST',
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
            data: "ejecutar_pantalla_campo=guardar_configurar_pantalla_libreria&tipo_retorno=1&ruta="+ruta+"&pantalla_idpantalla=<?php echo $idpantalla[0]["pantalla_idpantalla"].$adicional_exe; ?>&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
            beforeSend: function(){ formulario.data('locked', true);},
            success: function(html){                
              if(html){                                        
                var objeto=jQuery.parseJSON(html);                  
                if(objeto.exito){
                  $('#cargando_enviar_'+nombre_form).html("Terminado ...");
                  	notificacion_saia(objeto.mensaje,"success","",2500);
                  	guardar_componente(objeto.idfuncion_exe,formulario);
                }
                else{
                  $('#cargando_enviar_'+nombre_form).html("Terminado ...");
                  notificacion_saia(objeto.mensaje,"error","",2500);
                }                              
              }          
            },
            complete: function(){ formulario.data('locked', false); formulario.remove(); delete formulario; $("#funcion_"+nombre_form).collapse('hide');}
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
      data: "ejecutar_pantalla_campo=set_pantalla_campos&fs_valor="+id+"&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario.serialize(),
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