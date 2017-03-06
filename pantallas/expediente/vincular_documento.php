<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); 
include_once($ruta_db_superior."pantallas/documento/librerias.php");
include_once($ruta_db_superior."pantallas/documento/librerias_flujo.php");
include_once($ruta_db_superior."pantallas/ejecutor/librerias.php");
include_once($ruta_db_superior."pantallas/expediente/librerias.php");
?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-datetimepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/datetimepicker.css" />
<?php include_once($ruta_db_superior."db.php"); ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php 
include_once($ruta_db_superior."librerias_saia.php"); 
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
  if(@$_REQUEST["iddoc"])  
    $iddoc=$_REQUEST["iddoc"];
  if(@$_REQUEST["key"])  
    $iddoc=$_REQUEST["key"];
  //include_once($ruta_db_superior."formatos/librerias/menu_principal_documento.php");
  //echo(menu_principal_documento($iddoc,@$_REQUEST["vista"]));
  $documento=busca_filtro_tabla("*,".fecha_db_obtener("fecha","Y-m-d")." AS fecha","documento","iddocumento=".$iddoc,"",$conn);
}
echo(librerias_arboles());
?>
<legend>Gestionar documento en expediente</legend> <br><br>
<div data-toggle="collapse" data-target="#div_info_doc">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del documento</b>
</div>
<div id="div_info_doc"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td class="prettyprint">
      <b>Fecha del documento:</b>
    </td>
    <td colspan="3" id="fecha_documento">
       <?php echo(fecha_creacion_documento($documento[0]["fecha"],$documento[0]["plantilla"]));?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Descripci&oacute;n del documento:</b>
    </td>
    <td colspan="3">
       <?php echo($documento[0]["descripcion"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Tipo de documento:</b>
    </td>
    <td colspan="3">
       <?php echo(serie_documento($documento[0]["serie"]));?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Expedientes a los que pertenece:</b>
    </td>
    <td colspan="3">
       <?php echo(listado_expedientes_documento($iddoc));?>
    </td>
  </tr>
</table>
</div>
<form name="formulario_vincular_documento" id="formulario_vincular_documento">
<input type="hidden" name="iddoc" id="iddoc" value="<?php echo($iddoc);?>">
<input type="hidden" id="arbol_padre_actualizado" value="">
<div class="control-group element">
  <label class="control-label" for="nombre">Elegir expediente *
  </label>
  <div class="controls"> 
    <span class="phpmaker">
			Buscar:<br><input type="text" id="stext" width="200px" size="20">          
      <a href="javascript:void(0)" onclick="find_item_tree((document.getElementById('stext').value),'');">
      <img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png"border="0px"></a>      
      <div id="esperando_expediente"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
			<div id="treeboxbox_tree2" class="arbol_saia"></div>
      <input type="hidden" name="expedientes" id="expedientes" value="">
      
    </span>
  </div>
</div>
<div class="control-group element">  
  <div class="controls">   
    <a tabindex="-1" class="highslide" href="<?php echo($ruta_db_superior);?>pantallas/expediente/adicionar_expediente.php?iddocumento=<?php echo($iddoc);?>&mostrar_arbol_expediente=1&cerrar_higslide=1" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 450, height:400, align:'center', wrapperClassName:'full-size', preserveContent:'false'})"><button class="btn btn-warning btn-mini">Crear Expediente</button></a>
  </div>
</div>
<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<div class="form-actions">
<button class="btn btn-primary" id="submit_formulario_vincular_documento">Aceptar</button>
<button class="btn" id="cancel_formulario_vincular_documento">Cancelar</button>
<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var browserType;
  if (document.layers) {browserType = "nn4"}
  if (document.all) {browserType = "ie"}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
     browserType= "gecko"
  }
  $('#fecha').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
  var formulario_vincular_documento=$("#formulario_vincular_documento");
  formulario_vincular_documento.validate({"rules":{"expedientes":{"required":true}},
  submitHandler: function(form) {
  }
  });
  $("#submit_formulario_vincular_documento").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', 'disabled');
    if(formulario_vincular_documento.valid()){
      $.ajax({
        type:'GET',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
        data: "ejecutar_expediente=vincular_expediente_documento&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario_vincular_documento.serialize(),
        success: function(html){               
          if(html){                   
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){                 
              $('#cargando_enviar').html("Terminado ...");
              notificacion_saia(objeto.mensaje,"success","",2500);                                                        	
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
  tree2=new dhtmlXTreeObject("treeboxbox_tree2","","",0);
	tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
	tree2.enableIEImageFix(true);
  tree2.enableCheckBoxes(1);
  tree2.enableSmartXMLParsing(true);	
  tree2.setXMLAutoLoading("<?php echo($ruta_db_superior);?>pantallas/expediente/test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1");	
	tree2.loadXML("<?php echo($ruta_db_superior);?>pantallas/expediente/test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1");            
  tree2.setOnLoadingStart(cargando_expediente);
  tree2.setOnLoadingEnd(fin_cargando_expediente);
  
  tree2.setOnCheckHandler(onNodeSelect_expediente);
    
	function onNodeSelect_expediente(nodeId){
		var valores=tree2.getAllChecked();
    var nuevos_valores=valores.split(",");
		var cantidad=nuevos_valores.length;
		var funcionarios=new Array();
		var indice=0;
		for(var i=0;i<cantidad;i++){
			if(nuevos_valores[i].indexOf("#")=='-1'){
				if(nuevos_valores[i]!=""){
          var valor_tmp=nuevos_valores[i].split("_");
		      funcionarios[indice]=valor_tmp[0];								
					indice++;
				}
			}
		}
		var valores=funcionarios.join(",");	
  	document.getElementById("expedientes").value=valores;
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
  
  $(".opcion_informacion").on("hide",function(){
    $(this).prev().children("i").removeClass();
    $(this).prev().children("i").addClass("icon-plus-sign");
  });
  $(".opcion_informacion").on("show",function(){
    $(this).prev().children("i").removeClass();
    $(this).prev().children("i").addClass("icon-minus-sign");
  });
  $("#fecha_documento").find(".pull-right").removeClass("pull-right");
  hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
  hs.forceAjaxReload = true;
  hs.outlineType = 'rounded-white';
  hs.targetX = 'descriptor -350px';
  hs.targetY = 'descriptor 300px';
  hs.zIndexCounter = 10010;
  hs.Expander.prototype.onAfterClose = function() {  
    if (this.isClosing) {      
      $("#arbol_padre_actualizado").val()            
      if($("#arbol_padre_actualizado").val()){      
        alert($("#arbol_padre_actualizado").val());
        tree2.smartRefreshBranch($("#arbol_padre_actualizado").val());
        alert($("#arbol_padre_actualizado").val());
      }                      
    }
  }
});
</script>    