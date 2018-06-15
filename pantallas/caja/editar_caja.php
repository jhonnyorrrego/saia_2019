<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."pantallas/caja/librerias.php"); 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-datetimepicker.min.css"/>
<?php 
include_once($ruta_db_superior."db.php"); 
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php include_once($ruta_db_superior."librerias_saia.php");
$datos=busca_filtro_tabla("","caja a,dependencia b, serie c","a.codigo_serie=c.codigo AND a.codigo_dependencia=b.codigo AND a.idcaja=".$_REQUEST["idcaja"]."","",$conn);
echo(librerias_arboles());
?>
<form name="formulario_caja" id="formulario_caja" method="post">
<input type="hidden" name="idcaja" id="idcaja" value="<?php echo($_REQUEST["idcaja"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Editar caja</legend>

<small id="serie_dependencia"></small>
<div class="control-group element">
  <label class="control-label" for="serie_idserie">Serie asociada *
  </label>
  <div class="controls">       
  	<?php echo("<b>Serie.</b> ".mostrar_seleccionados_caja($datos[0]["serie_idserie"],"nombre","serie")." <b>| Fondo.</b> ".$datos[0]["fondo"]); ?>
  	<br />
    <span class="phpmaker">
			<input type="text" id="stext_serie" width="200px" size="20">          
      <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_serie').value),1)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_serie').value),0,1)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem((document.getElementById('stext_serie').value))">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>      
      <div id="esperando_serie"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
			<div id="treeboxbox_tree3" class="arbol_saia"></div>
    </span>
     <input type="hidden" name="serie_idserie" id="serie_idserie" value="<?php echo($datos[0]["serie_idserie"]); ?>">
     <input type="hidden" name="dependencia_iddependencia" id="dependencia_iddependencia" value="<?php echo($datos[0]["dependencia_iddependencia"]); ?>">
  </div>
</div>
<label style="display:none" class="error" for="serie_idserie">Campo obligatorio.</label>
<script type="text/javascript">
var browserType;
if (document.layers) {browserType = "nn4"}
if (document.all) {browserType = "ie"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {
   browserType= "gecko"
}    
tree2=new dhtmlXTreeObject("treeboxbox_tree3","","",0);
	tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
	tree2.enableIEImageFix(true);
tree2.enableCheckBoxes(1);
tree2.enableRadioButtons(true);
tree2.setOnLoadingStart(cargando_serie);
tree2.setOnLoadingEnd(fin_cargando_serie);
tree2.enableSmartXMLParsing(true);
//tree3.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_serie_funcionario.php?con_padres=1&pantalla=expediente");	
	//tree3.loadXML("<?php echo($ruta_db_superior);?>test_serie_funcionario.php?con_padres=1&pantalla=expediente");
	tree2.setXMLAutoLoading("../../test_dependencia_serie.php?tabla=dependencia&admin=1&mostrar_nodos=dsa&sin_padre_dependencia=1&cargar_series=1&funcionario=1&carga_partes_dependencia=1&carga_partes_series=1&no_grupos=1&no_tipos=1&seleccionado=<?php echo($datos[0]["serie_idserie"])?>&seleccionado_dep=<?php echo($datos[0]["iddependencia"])?>");	
	tree2.loadXML("../../test_dependencia_serie.php?tabla=dependencia&admin=1&mostrar_nodos=dsa&sin_padre_dependencia=1&cargar_series=1&funcionario=1&carga_partes_dependencia=1&carga_partes_series=1&no_grupos=1&no_tipos=1&seleccionado=<?php echo($datos[0]["serie_idserie"])?>&seleccionado_dep=<?php echo($datos[0]["iddependencia"])?>");
tree2.setOnCheckHandler(onNodeSelect_serie2);
  
	function onNodeSelect_serie2(nodeId){
		var item_select=tree2.getAllChecked();
		console.log(nodeId+" -- "+item_select);
		if(item_select!=="undefined" && item_select!=nodeId){
	  		lista_items=item_select.split(",");
	  		for(i=0;i<lista_items.length;i++){
	  			tree2.setCheck(lista_items[i],0);
	  	  	}
	  	}
		tree2.setCheck(nodeId,1);
	  if(tree2.isItemChecked(nodeId)){
    $("#serie_idserie").val(tree2.getUserData(nodeId,"idserie"));
    $("#dependencia_iddependencia").val(tree2.getUserData(nodeId,"iddependencia"));
    $("#codigo_numero_serie").val(tree2.getUserData(nodeId,"serie_codigo"));
	$("#codigo_numero_dependencia").val(tree2.getUserData(nodeId,"dependencia_codigo"));
	$("#fondo").val(tree2.getUserData(nodeId,"dependencia_nombre"));
	$("#codigo_numero_dependencia").trigger('keyup');
	$("#codigo_numero_serie").trigger('keyup');
  }
  else{
	$("#serie_idserie").val("");
	$("#dependencia_iddependencia").val("");
	$("#codigo_numero_serie").val('');
	  	$("#codigo_numero_dependencia").val('');
	    $("#fondo").val('');
	  	$("#codigo_numero_dependencia").trigger('keyup');
	    $("#codigo_numero_serie").trigger('keyup');
  }
}
function fin_cargando_serie() {
  if (browserType == "gecko" )
    document.poppedLayer = eval('document.getElementById("esperando_serie")');
  else if (browserType == "ie")
    document.poppedLayer = eval('document.getElementById("esperando_serie")');
  else
    document.poppedLayer = eval('document.layers["esperando_serie"]');
  document.poppedLayer.style.display = "none";
}
function cargando_serie() {
  if (browserType == "gecko" )
    document.poppedLayer = eval('document.getElementById("esperando_serie")');
  else if (browserType == "ie")
    document.poppedLayer = eval('document.getElementById("esperando_serie")');
  else
    document.poppedLayer = eval('document.layers["esperando_serie"]');
  document.poppedLayer.style.display = "";
}   
</script>

<div class="control-group element">
  <label class="control-label" for="codigo">Codigo
  </label>
  <div class="controls"> 
    <input type="text"  id="cod_serie"  value="<?php echo($datos[0]["codigo_serie"]) ?>" style="width:12%;" readonly="readonly">
    <input type="text"  id="cod_dependencia" value="<?php echo($datos[0]["codigo_dependencia"]) ?>" style="width:12%;" readonly="readonly">
    <input type="text"  id="cod_consecutivo" required="required" name="no_consecutivo" value="<?php echo($datos[0]["no_consecutivo"]) ?>" style="width:12%;">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="fondo">Fondo
  </label>
  <div class="controls"> 
    <input type="text" name="fondo" id="fondo"  required="required" value="<?php echo($datos[0]["fondo"]); ?>" readonly="readonly">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="seccion">Seccion
  </label>
  <div class="controls"> 
    <input type="text" name="seccion" id="seccion" value="<?php echo($datos[0]["seccion"]); ?>">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="subseccion">Subseccion
  </label>
  <div class="controls"> 
    <input type="text" name="subseccion" id="subseccion" value="<?php echo($datos[0]["subseccion"]); ?>">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="division">Division
  </label>
  <div class="controls"> 
    <input type="text" name="division" id="division" value="<?php echo($datos[0]["division"]); ?>">
  </div>
</div>

<!--
<div class="control-group element">
  <label class="control-label" for="no_carpetas">No carpetas
  </label>
  <div class="controls"> 
    <input type="text" name="no_carpetas" id="no_carpetas" value="<?php echo consultar_numero_carpetas_caja($datos[0][idcaja])?>">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="fecha_extrema_i">Fecha extrema inicial
  </label>
  <div id="fecha_extrema_i" class="input-append date">
		<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_i" value="<?php echo calcular_fecha_extrema_inicial($datos[0][idcaja]) ?>" readonly />
		<span class="add-on">
			<i data-time-icon="icon-time" data-date-icon="icon-calendar">
			</i>
		</span>
	</div>
</div>

<div class="control-group element">
  <label class="control-label" for="fecha_extrema_f">Fecha extrema final
  </label>
  <div id="fecha_extrema_f" class="input-append date">
		<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_f" value="<?php echo calcular_fecha_extrema_final($datos[0][idcaja]) ?>" readonly />
		<span class="add-on">
			<i data-time-icon="icon-time" data-date-icon="icon-calendar">
			</i>
		</span>
	</div>
</div>
-->
<div class="control-group element">
  <label class="control-label" for="modulo">Módulo
  </label>
  <div class="controls"> 
    <input type="text" name="modulo" id="modulo" value="<?php echo($datos[0]["modulo"]);?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="panel">Panel
  </label>
  <div class="controls"> 
    <input type="text" name="panel" id="panel" value="<?php echo($datos[0]["panel"]);?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nivel">Nivel
  </label>
  <div class="controls"> 
    <input type="text" name="nivel" id="nivel" value="<?php echo($datos[0]["nivel"]);?>">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="material">Material
  </label>
  <div class="controls">
  	<select name="material" id="material"> 
  	  <option value="">Seleccione.</option>
	</select>
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="seguridad">Seguridad
  </label>
  <div class="controls">
  	<select name="seguridad" id="seguridad">
  		<option value="">Por favor seleccione...</option>
  		<option value="1" <?php if($datos[0]["seguridad"]==1)echo("selected");?>>Confidencial</option>
  		<option value="2" <?php if($datos[0]["seguridad"]==2)echo("selected");?>>Publica</option>
  		<option value="3" <?php if($datos[0]["seguridad"]==3)echo("selected");?>>Rutinario</option>
  	</select>
  </div>
</div>

<input type="hidden" name="funcionario_idfuncionario" id="funcionario_idfuncionario" value="<?php echo(usuario_actual('idfuncionario')); ?>">

<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<input type="hidden"  name="ejecutar_caja" value="update_caja"/>
<input type="hidden"  name="tipo_retorno" value="1"/>
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_caja">Aceptar</button>
<button class="btn btn-mini" id="cancel_formulario_caja">Cancelar</button>

<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap/saia/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap/saia/bootstrap-datetimepicker.js"></script>
<?php echo(librerias_arboles()); ?>
<script type="text/javascript">
$(document).ready(function(){
	consultar_materiales_caja();
	mostrar_serie_dependencia("<?php echo $datos[0][codigo_serie] ?>","<?php echo $datos[0][codigo_dependencia] ?>");
	$('#fecha_extrema_i').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  $('#fecha_extrema_f').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
	
	
	var browserType;
  if (document.layers) {browserType = "nn4"}
  if (document.all) {browserType = "ie"}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
     browserType= "gecko"
  }
	
  var formulario_caja=$("#formulario_caja");
  $("#submit_formulario_caja").click(function(){  
    if(formulario_caja.valid()){
    	$('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
			$(this).attr('disabled', 'disabled');
			<?php encriptar_sqli("formulario_caja",0,"form_info",$ruta_db_superior); ?>
      $.ajax({
        type:'POST',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/caja/ejecutar_acciones.php",
        data: "rand="+Math.round(Math.random()*100000)+"&"+formulario_caja.serialize(),
        success: function(html){               
          if(html){                   
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
              $.ajax({
                type:'POST',
                async:false,
                url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda.php",
                data: "idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']); ?>&page=1&rows=1&actual_row=0&caja_actual="+objeto.idcaja,
                success: function(html2){               
                  if(html2){      
                    var objeto2=jQuery.parseJSON(html2);
                    $("#<?php echo($_REQUEST['div_actualiza']);?>", parent.document).prepend(objeto2.rows[0].info);
                  }
                }
              });   
              $('#cargando_enviar').html("Terminado ...");  
              if($("#cerrar_higslide").val()){            
                $("#arbol_padre_actualizado", parent.document).val($("#cod_padre").val());
                parent.window.hs.getExpander().close();                  
              }
              notificacion_saia(objeto.mensaje,"success","",2500);
              window.open("detalles_caja.php?idcaja="+objeto.idcaja+"&idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']);?>&rand="+Math.round(Math.random()*100000),"_self");
            }
            else{
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"error","",8500);
            }                  
          }          
        }
    	});
    }
    else{
      notificacion_saia("Formulario con errores","error","",8500);
    }
  });  
    
     function consultar_materiales_caja(){
    	$.ajax({
    		type : "GET",
    		async: false,
    		url : "<?php echo $ruta_db_superior."pantallas/caja/consulta_materiales_caja.php"?>",
    		success : function (response){
    			response = $.parseJSON(response);
    			$.each(response,function(index,value){
    				$("#material").append(new Option(value.nombre,value.valor));
    			});
    		},
    		error : function (){
    			alert("error consultando los materiales");
    		}
    	});
    	
    	var material = "<?php echo $datos[0][material]?>";
    	$("#material").val(material);
    }
    
    function mostrar_serie_dependencia(codigo_serie,codigo_dependencia){
    	
    	$.ajax({
    		type : "GET",
    		url : "<?php echo $ruta_db_superior."pantallas/caja/consulta_nombre_serie_dependencia.php"?>",
    		data:{
    			codigo_serie : codigo_serie,
    			codigo_dependencia : codigo_dependencia
    		},
    		success : function (response){
    			var response = $.parseJSON(response);
    			$("#serie_dependencia").text("Serie: "+response.serie+" Dependencia: "+response.dependencia);
    			
    		},
    		error : function (){
    			alert("error consultando los codigos");
    		}
    	});
    	
    }
});
</script>
<?php
function mostrar_seleccionados_caja($id,$campo="nombre",$tabla){
	global $conn;
	$dato=busca_filtro_tabla($campo,$tabla,"id".$tabla."='".$id."'","",$conn);
	$etiquetas=extrae_campo($dato,$campo,"m");
	return(ucwords(implode(", ",$etiquetas)));
}
?>