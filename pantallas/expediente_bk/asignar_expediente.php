<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-datetimepicker.min.css"/>
<?php include_once($ruta_db_superior."db.php"); ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/dhtmlXTree.js"></script>
<?php 
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
require_once $ruta_db_superior . "arboles/crear_arbol_ft.php";
//echo librerias_jquery("3.3");
echo (librerias_notificaciones());
echo librerias_UI("1.12");
echo librerias_arboles_ft("2.24", 'filtro');

$propietario=busca_filtro_tabla("idfuncionario","expediente e,funcionario f","f.funcionario_codigo=e.propietario and idexpediente IN(".$_REQUEST["idexpediente"].")","",$conn);

$array_propietarios=extrae_campo($propietario,'idfuncionario');

$seleccionados=busca_filtro_tabla("identidad_expediente,idfuncionario,nombres,apellidos,permiso","entidad_expediente e,funcionario f","e.llave_entidad=f.idfuncionario and e.expediente_idexpediente IN (".@$_REQUEST["idexpediente"].") AND e.entidad_identidad=1 and f.idfuncionario NOT IN (".implode(',', $array_propietarios).")","",$conn);

$table='<table class="table table-bordered" id="funcionarios_seleccionados">
<thead>
<tr>
  <th style="text-align:center; vertical-align:middle" rowspan="2">Funcionario</th>
  <th style="text-align:center" colspan="4">Permisos</th>
</tr>
<tr><th style="text-align:center">Ver</th> <th style="text-align:center">Editar</th> <th style="text-align:center">Eliminar</th> <th style="text-align:center">Compartir</th></tr>
</thead>';
$idfuncionarios=array();
for($i=0;$i<$seleccionados["numcampos"];$i++){
	$idfuncionarios[]=$seleccionados[$i]["idfuncionario"];
	$m=""; $e="";
	if(strpos($seleccionados[$i]["permiso"],"m")!==false){
		$m="checked=true";
	}
	if(strpos($seleccionados[$i]["permiso"],"e")!==false){
		$e="checked=true";
	}
	if(strpos($seleccionados[$i]["permiso"],"p")!==false){
		$p="checked=true";
	}
	$table.='<tr id="fila_'.$seleccionados[$i]["idfuncionario"].'">
		<td><input type="hidden" name="idfuncionario[]" value="'.$seleccionados[$i]["idfuncionario"].'">'.ucwords(strtolower($seleccionados[$i]["nombres"].' '.$seleccionados[$i]["apellidos"])).' <img style="cursor:pointer" src="'.$ruta_db_superior.'imagenes/eliminar_nota.gif" onclick="eliminar_asociado('.$seleccionados[$i]["idfuncionario"].')"/></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_'.$seleccionados[$i]["idfuncionario"].'[]" value="l" disabled checked=true></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_'.$seleccionados[$i]["idfuncionario"].'[]" value="m" '.$m.' class="realizar_submit"></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_'.$seleccionados[$i]["idfuncionario"].'[]" value="e" '.$e.' class="realizar_submit"></td>
		<td style="text-align:center"><input type="checkbox" name="permisos_'.$seleccionados[$i]["idfuncionario"].'[]" value="p" '.$p.' class="realizar_submit"></td>
	</tr>';
}
$table.="</table>";
	
?>
<form name="formulario_asignar_expediente" id="formulario_asignar_expediente" method="post">
<input type="hidden" name="idexpediente" id="idexpediente" value="<?php echo($_REQUEST["idexpediente"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Asignar acceso expediente(s) <?php $expediente=busca_filtro_tabla("","expediente","idexpediente IN(".$_REQUEST["idexpediente"].")","",$conn); echo(implode(", ", extrae_campo($expediente,'nombre','U')));?></legend>
<style>
.clase_sin_capas{
	margin-bottom: 0px;
  min-height: 0px;
  padding: 0px;
  border: 0px solid #E3E3E3;
}
ul.fancytree-container {
    border: none;
    background-color:#F5F5F5;
}
span.fancytree-title 
{  
	font-family: Verdana,Tahoma,arial;
	font-size: 9px; 
}
</style>

<!--div class="control-group element">
    <label class="control-label" for="nombre"><b>Seleccionar Expediente(s):</b>
    </label>
    <div class="controls">
    	<?php
		$origen = array("url" => "arboles/arbol_expediente.php", "ruta_db_superior" => $ruta_db_superior,
		    "params" => array(		    	
		        "checkbox" => true,		        
		        "cargar_partes"=>1,
		        "inicia"=>$_REQUEST["idexpediente"],
		        "id"=>$_REQUEST["idexpediente"]
		        //"seleccionados" => $dependencia_seleccionada
		    ));
			
			
		$opciones_arbol = array("keyboard" => true, "selectMode" => 2, "onNodeSelect" =>'seleccionar_expedientes',"lazy"=> true);
		$extensiones = array("filter" => array());
		$arbol_expediente = new ArbolFt("expedientes", $origen, $opciones_arbol, $extensiones);
		echo $arbol_expediente->generar_html();
		?>
	 
	</div>
</div-->
	<script type="text/javascript">
	function seleccionar_expedientes(event,data){
		  
	  if(data.node.selected){
	  	var idexpediente = data.node.key;
	  	 //$("#expedientes").val(idexpediente);
	  	 var seleccionados = Array();
		var items = data.tree.getSelectedNodes();
		for(var i=0;i<items.length;i++){
			seleccionados.push(items[i].key);
		}
		var s = seleccionados.join(",");
		$("#expedientes").val(s);	  
	  }
  }			
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
  		
			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","",0);
			tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
			tree3.enableIEImageFix(true);
      tree3.enableCheckBoxes(1);
       tree3.setOnCheckHandler(cargar_seleccionados_hijos);
      //tree3.enableSmartXMLParsing(true);
      tree3.setOnLoadingStart(cargando_expediente);
      tree3.setOnLoadingEnd(fin_cargando_expediente);
      
		//	tree3.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_expediente.php?doc=617&accion=1&permiso_editar=1");
		<?php
		for ($i=0; $i <$expediente['numcampos'] ; $i++) { 
			
		?>
			tree3.loadXML("<?php echo($ruta_db_superior);?>test_expediente.php?carga_total=1&accion=1&permiso_editar=1&inicia=<?php echo($expediente[$i]["idexpediente"]); ?>");
			
		<?php
		}
		?>
			
			function fin_cargando_expediente() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_expediente")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_expediente")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_expediente"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_expediente() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_expediente")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_expediente")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_expediente"]');
        document.poppedLayer.style.display = "";
      }
			-->
      </script>
    </div>
</div>    
    
<div class="control-group element">
  <div class="controls"> 
    <?php
    if(@$_REQUEST["llave_entidad"]){
      echo "<input type='hidden' value='".$_REQUEST["llave_entidad"]."' name='  llave_entidad' >";
    }    
    if(@$_REQUEST["filtrar_expediente"])
      echo "<input type='hidden' value='".$_REQUEST["filtrar_expediente"]."' name='filtrar_expediente' >";  
    ?>
    <div id="sub_entidad" class="arbol_saia">
    </div>
    <hr/>
		<b>Asignar Permiso A:*</b> <input type="hidden" name="propietario" value="<?php echo $propietario[0]["idfuncionario"];?>"> <input type='hidden' id='idfuncionario' size='50' name='idfuncionario' value="<?php echo implode(",", $idfuncionarios);?>"> <input type='text' id='buscar_radicado' size='50' name='buscar_radicado'> <div id='ul_completar' class='ac_results'></div>
		<?php
			echo $table;
		?>

  </div>
</div>

<?php if($_REQUEST["mostrar_arbol_expediente"]){?> 
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
<?php 
}?>
<input type="hidden" name="key_formulario_saia" value="<?php echo(generar_llave_md5_saia());?>">
<input type="hidden" name="ejecutar_expediente" value="asignar_permiso_expediente">
<input type="hidden" name="tipo_retorno" value="1">
<div class="form-actions" style="display:none;">
<button class="btn btn-primary" id="submit_formulario_asignar_expediente">Aceptar</button>
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
<style >
.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}
.ac_results li:hover {
background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height:10px;
	overflow: hidden;
}
</style>

<?php

if(@$_REQUEST["mostrar_arbol_expediente"]){  
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
    tree2.enableRadioButtons(true);
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
    	document.getElementById("cod_padre").value=valores;
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
  <?php
}
?>


<script type="text/javascript">
$(document).ready(function(){
    
    
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo(@$_REQUEST["idexpediente"]);?>",parent.document).addClass("documento_actual").addClass("alert-info");        
 
 $('.realizar_submit').live('click',function(){
     $('#submit_formulario_asignar_expediente').click();
 });
    
$("#submit_formulario_asignar_expediente").click(function(){  
	var formulario_asignar_expediente=$("#formulario_asignar_expediente");
  $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
	$(this).attr('disabled', 'disabled');  
	
	<?php encriptar_sqli("formulario_asignar_expediente",0,"form_info",$ruta_db_superior,false,false); ?>
  $.ajax({
    type:'POST',
    async:false,
    url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
    data: "rand="+Math.round(Math.random()*100000)+"&"+formulario_asignar_expediente.serialize(),
    success: function(html){               
      if(html){                   
        var objeto=jQuery.parseJSON(html);                  
        if(objeto.exito==1){              
          $('#cargando_enviar').html("Terminado ...");  
          if($("#cerrar_higslide").val()){            
            $("#arbol_padre_actualizado", parent.document).val($("#cod_padre").val());
            parent.window.hs.getExpander().close();                  
          }
          notificacion_saia(objeto.mensaje,"success","",2500);
        }else{
        	if(objeto.exito==2){
        		$("#submit_formulario_asignar_expediente").attr("disabled",false);
        	}
          $('#cargando_enviar').html("Terminado ...");
          notificacion_saia(objeto.mensaje,"error","",8500);
        }                
      }          
    }
	});
}); 	
	
	
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

	$("#buscar_radicado").keyup(function (){
	  delay(function(){
      var valor=$("#buscar_radicado").val();
      var seleccionados=$("#idfuncionario").val();
      if(valor==0 || valor==""){
        //alert("Ingrese nombre o apellido");
         $("#ul_completar").empty();
      }else{
        $("#ul_completar").empty().load( "autocompletar.php", { valor:valor,seleccionados:seleccionados,propietario:'<?php echo $propietario[0]["idfuncionario"];?>',opt:1});
      }
    }, 500 );
	});

});
	
function cargar_datos(idfunc,nombre){
	$("#ul_completar").empty();
	$("#buscar_radicado").val("");
	if(idfunc!=0){
		$("#funcionarios_seleccionados").append("<tr id='fila_"+idfunc+"'><td><input type='hidden' name='idfuncionario[]' value='"+idfunc+"'>"+nombre+" <img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' onclick='eliminar_asociado("+idfunc+");'></td> <td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='l' disabled checked=true></td><td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='m' class='realizar_submit'></td><td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='e' class='realizar_submit'></td> <td style='text-align:center'><input type='checkbox' name='permisos_"+idfunc+"[]' value='p' class='realizar_submit'></td> </tr>");
		var sel=$("#idfuncionario").val();
		if(sel!=""){
			$("#idfuncionario").val(sel+","+idfunc);
		}else{
			$("#idfuncionario").val(idfunc);
		}
	}  
	$('#submit_formulario_asignar_expediente').click();
}

function eliminar_asociado(idfunc){
	$("#fila_"+idfunc).remove();
	var datos=$("#idfuncionario").val().split(",");
	var cantidad=datos.length;
	var nuevos_datos=new Array();
	var a=0;
	for(var i=0;i<cantidad;i++){
		if(idfunc!=datos[i]){
			nuevos_datos[a]=datos[i];
			a++;
		}
	}
	var datos_guardar=nuevos_datos.join(",");
	$("#idfuncionario").val(datos_guardar);	
	
	$('#submit_formulario_asignar_expediente').click();	
}
</script>