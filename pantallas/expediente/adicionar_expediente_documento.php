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
$dato_padre=busca_filtro_tabla("","expediente a","a.idexpediente=".$_REQUEST["cod_padre"],"",$conn);
?>
<form name="formulario_expediente" id="formulario_expediente" method="post">
<input type="hidden" name="iddoc" id="iddoc" value="<?php echo($_REQUEST["iddoc"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Crear expediente</legend>
<div class="control-group element">
  <label class="control-label" for="nombre">Expediente padre
  </label>
  <div class="controls"> 
    <span class="phpmaker">
			<input type="text" id="stext" width="200px" size="20">          
      <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext').value),1)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext').value),0,1)">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem(htmlentities(document.getElementById('stext').value))">
      <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>      
      <div id="esperando_expediente"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
			<div id="treeboxbox_tree2" class="arbol_saia"></div>
      <input type="hidden" name="cod_padre" id="cod_padre" value="<?php echo($datos[0]["cod_padre"]); ?>">
      <input type="hidden" name="ejecutar_expediente" value="set_expediente_documento">
      <input type="hidden" name="tipo_retorno" value="1">
    </span>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="fecha">Fecha de creaci&oacute;n *
  </label>
  <div class="controls"> 
		<div id="fecha" class="input-append date">
			<input data-format="yyyy-MM-dd" type="text" name="fecha" value="<?php echo(date("Y-m-d"));?>" readonly />
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nombre">Nombre *
  </label>
  <div class="controls"> 
    <input type="text" name="nombre" id="nombre" >
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="nombre">Descripci&oacute;n *
  </label>
  <div class="controls"> 
    <textarea name="descripcion" id="descripcion"></textarea>
  </div>
</div>
<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_expediente">Aceptar</button>
<button class="btn btn-mini" id="" onclick="window.open('<?php echo($ruta_db_superior); ?>expediente_llenar.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>','_self'); return false;">Volver</button>
<?php if(@$_REQUEST["volver"]&&@$_REQUEST["enlace"]){ ?>
	<button class="btn btn-mini" onclick="window.open('<?php echo($ruta_db_superior.$_REQUEST["enlace"]); ?>?variable_busqueda=idexpediente/**/<?php echo($_REQUEST["cod_padre"]); ?>&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>','_self');">Volver</button>
<?php } ?>
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
<?php
  echo(librerias_arboles());
  ?>
  <script>
  $(document).ready(function(){
    var browserType;
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }
    tree2=new dhtmlXTreeObject("treeboxbox_tree2","","",0);
  	tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
  	tree2.enableIEImageFix(true);
    tree2.enableCheckBoxes(1);
    tree2.enableRadioButtons(true);
    tree2.setOnLoadingStart(cargando_expediente);
    tree2.setOnLoadingEnd(fin_cargando_expediente);
    //tree2.enableSmartXMLParsing(true);
    tree2.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_expediente.php?accion=1&permiso_editar=1");	
  	tree2.loadXML("<?php echo($ruta_db_superior);?>test_expediente.php?accion=1&permiso_editar=1");
    tree2.setOnCheckHandler(onNodeSelect_expediente);
      
  	function onNodeSelect_expediente(nodeId){
  		valor_destino=document.getElementById("cod_padre");
  		if(tree2.isItemChecked(nodeId)){
  			if(valor_destino.value!=="")
        	tree2.setCheck(valor_destino.value,false);
        if(nodeId.indexOf("_")!=-1)
        	nodeId=nodeId.substr(0,nodeId.indexOf("_"));
        valor_destino.value=nodeId;
      }
      else{
      	valor_destino.value="";
      }
    }
  
    function fin_cargando_expediente() {
      if (browserType == "gecko" )
        document.poppedLayer = eval('document.getElementById("esperando_expediente")');
      else if (browserType == "ie")
        document.poppedLayer = eval('document.getElementById("esperando_expediente")');
      else
        document.poppedLayer = eval('document.layers["esperando_expediente"]');
      document.poppedLayer.style.display = "none";
      document.getElementById('expedientes').value=tree2.getAllChecked();
    }
    function cargando_expediente() {
      if (browserType == "gecko" )
        document.poppedLayer = eval('document.getElementById("esperando_expediente")');
      else if (browserType == "ie")
        document.poppedLayer = eval('document.getElementById("esperando_expediente")');
      else
        document.poppedLayer = eval('document.layers["esperando_expediente"]');
      document.poppedLayer.style.display = "";
    }
  });
  </script>
<script type="text/javascript">
$(document).ready(function(){
  $('#fecha').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  var formulario_expediente=$("#formulario_expediente");
  formulario_expediente.validate({
  "rules":{"nombre":{"required":true}},
  submitHandler: function(form) {
  }
  });
  $("#submit_formulario_expediente").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', 'disabled');  
    if(formulario_expediente.valid()){
    	<?php if(@$_REQUEST["volver"]&&@$_REQUEST["enlace"]){ ?>
    		window.open('<?php echo($ruta_db_superior.$_REQUEST["enlace"]); ?>?variable_busqueda=idexpediente/**/<?php echo($_REQUEST["cod_padre"]); ?>&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>','_self');
    	<?php } ?>
    <?php encriptar_sqli("formulario_expediente",0,"form_info",$ruta_db_superior); ?>
      $.ajax({
        type:'POST',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
        data: "rand="+Math.round(Math.random()*100000)+"&"+formulario_expediente.serialize(),
        success: function(html){               
          if(html){                   
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"success","",2500);
              window.open("<?php echo($ruta_db_superior); ?>expediente_llenar.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>","_self");
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
});
</script>    