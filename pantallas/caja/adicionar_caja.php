<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-datetimepicker.min.css"/>
<?php include_once($ruta_db_superior."db.php"); 
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");

?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php include_once($ruta_db_superior."librerias_saia.php");
?>
<form name="formulario_caja" id="formulario_caja" method="post">
<input type="hidden" name="cod_padre" id="cod_padre" value="<?php echo($_REQUEST["cod_padre"]);?>">
<input type="hidden" name="iddocumento" id="iddocumento" value="<?php echo($_REQUEST["iddocumento"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Crear caja</legend>
<div class="control-group element">
  <label class="control-label" for="no_consecutivo">No consecutivo
  </label>
  <div class="controls"> 
    <input type="text" name="no_consecutivo" id="no_consecutivo" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="fondo">Fondo
  </label>
  <div class="controls"> 
    <input type="text" name="fondo" id="fondo" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="seccion">Seccion
  </label>
  <div class="controls"> 
    <input type="text" name="seccion" id="seccion" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="subseccion">Subseccion
  </label>
  <div class="controls"> 
    <input type="text" name="subseccion" id="subseccion" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="division">Division
  </label>
  <div class="controls"> 
    <input type="text" name="division" id="division" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="codigo">Codigo
  </label>
  <div class="controls"> 
    <input type="text" name="codigo" id="codigo" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="nombre">Serie asociada
  </label>
  <div class="controls">
  	<b><?php echo(mostrar_seleccionados_caja($datos[0]["serie_idserie"],"nombre","serie")); ?></b>
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
      <input type="hidden" name="serie_idserie" id="serie_idserie" value="">
    </span>
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="no_carpetas">No carpetas
  </label>
  <div class="controls"> 
    <input type="text" name="no_carpetas" id="no_carpetas" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="no_caja">No caja
  </label>
  <div class="controls"> 
    <input type="text" name="no_cajas" id="no_cajas" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="no_correlativo">No correlativo
  </label>
  <div class="controls"> 
    <input type="text" name="no_correlativo" id="no_correlativo" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="fecha_extrema_i">Fecha extrema inicial
  </label>
  <div id="fecha_extrema_i" class="input-append date">
		<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_i" value="<?php echo($datos[0]["fecha_extrema_i"]);?>" readonly />
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
		<input data-format="yyyy-MM-dd" type="text" name="fecha_extrema_f" value="<?php echo($datos[0]["fecha_extrema_f"]);?>" readonly />
		<span class="add-on">
			<i data-time-icon="icon-time" data-date-icon="icon-calendar">
			</i>
		</span>
	</div>
</div>

<div class="control-group element">
  <label class="control-label" for="estanteria">Estanter&iacute;a
  </label>
  <div class="controls"> 
    <input type="text" name="estanteria" id="estanteria" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="panel">Panel
  </label>
  <div class="controls"> 
    <input type="text" name="panel" id="panel" value="">
  </div>
</div>

<div class="control-group element">
  <label class="control-label" for="material">Material
  </label>
  <div class="controls"> 
    <input type="text" name="material" id="material" value="">
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
<input type="hidden"  name="ejecutar_caja" value="set_caja"/>
<input type="hidden"  name="tipo_retorno" value="1"/>
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_caja">Aceptar</button>
<button class="btn btn-mini" id="cancel_formulario_caja">Cancelar</button>

<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap-datetimepicker.js"></script>
<?php echo(librerias_arboles()); ?>
<script type="text/javascript">
$(document).ready(function(){
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
  formulario_caja.validate({
  "rules":{"numero":{"required":true}},
  submitHandler: function(form) {
  }
  });
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
              if($("#iddocumento").val()==''){
                notificacion_saia(objeto.mensaje,"success","",2500);                                                                                            
                window.open("detalles_caja.php?idcaja="+objeto.idcaja+"&idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']);?>&rand="+Math.round(Math.random()*100000),"_self");
              }
              else{
                window.open("vincular_documento.php?idcaja="+objeto.idcaja+"&iddocumento="+$("#iddocumento").val()+"&rand="+Math.round(Math.random()*100000),"_self");
              }                                           	
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
  
  tree3=new dhtmlXTreeObject("treeboxbox_tree3","","",0);
  	tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  	tree3.enableIEImageFix(true);
    tree3.enableCheckBoxes(1);
    tree3.enableRadioButtons(true);
    tree3.setOnLoadingStart(cargando_serie);
    tree3.setOnLoadingEnd(fin_cargando_serie);
    tree3.enableSmartXMLParsing(true);
    tree3.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_serie_funcionario.php?con_padres=1&seleccionado=<?php echo($datos[0]["serie_idserie"]); ?>&seleecionar_padre=1&pantalla=expediente");	
  	tree3.loadXML("<?php echo($ruta_db_superior);?>test_serie_funcionario.php?con_padres=1&seleccionado=<?php echo($datos[0]["serie_idserie"]); ?>&seleecionar_padre=1&pantalla=expediente");
    tree3.setOnCheckHandler(onNodeSelect_serie);
      
  	function onNodeSelect_serie(nodeId){
  		valor_destino=document.getElementById("serie_idserie");
  		if(tree3.isItemChecked(nodeId)){
  			if(valor_destino.value!=="")
        	tree3.setCheck(valor_destino.value,false);
        if(nodeId.indexOf("_")!=-1)
        	nodeId=nodeId.substr(0,nodeId.indexOf("_"));
        valor_destino.value=nodeId;
      }
      else{
      	valor_destino.value="";
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