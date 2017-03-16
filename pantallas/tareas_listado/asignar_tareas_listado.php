<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
$_REQUEST["tipo_entidad"]=5; 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-iconos-segundarios.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-datetimepicker.min.css"/>
<?php include_once($ruta_db_superior."db.php"); ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php include_once($ruta_db_superior."librerias_saia.php"); ?>
<?php
$seleccionados=busca_filtro_tabla("B.iddependencia_cargo, C.nombres, C.apellidos","entidad_expediente A, dependencia_cargo B, funcionario C","A.expediente_idexpediente=".@$_REQUEST["idexpediente"]." AND (A.entidad_identidad=1 AND A.llave_entidad=B.funcionario_idfuncionario) AND B.funcionario_idfuncionario=C.idfuncionario","",$conn);
$seleccionados_array=extrae_campo($seleccionados,"iddependencia_cargo");
for($i=0;$i<$seleccionados["numcampos"];$i++){
	$nombres[]=ucwords(strtolower($seleccionados[$i]["nombres"]." ".$seleccionados[$i]["apellidos"]));
}
$nombres=array_unique($nombres);
?>
<form name="formulario_asignar_expediente" id="formulario_asignar_expediente">
<input type="hidden" name="idexpediente" id="idexpediente" value="<?php echo($_REQUEST["idexpediente"]);?>">
<input type="hidden" id="cerrar_higslide" value="<?php echo(@$_REQUEST["cerrar_higslide"]);?>">
<legend>Asignar acceso Listado de tareas <?php $expediente=busca_filtro_tabla("","expediente","idexpediente=".$_REQUEST["idexpediente"]); echo($expediente[0]["nombre"]);?></legend>
<div class="control-group element">
  <label class="control-label" for="nombre"><?php if(@$_REQUEST["tipo_entidad"]){
      echo"<input type='hidden' value='".$_REQUEST["tipo_entidad"]."' name='tipo_entidad' >";
      $entidad = busca_filtro_tabla("*","entidad","identidad=".$_REQUEST["tipo_entidad"],"nombre",$conn);
			if($_REQUEST["tipo_entidad"]==5){
				echo("Funcionario");
			}
			else echo($entidad[0]["nombre"]);
    }
    else{
      echo("Entidad");
    }?>*
  </label>

  <div class="controls"> 
    <?php
    if(@$_REQUEST["llave_entidad"]){
      echo "<input type='hidden' value='".$_REQUEST["llave_entidad"]."' name='  llave_entidad' >";
    }    
    if(@$_REQUEST["filtrar_expediente"])
      echo "<input type='hidden' value='".$_REQUEST["filtrar_expediente"]."' name='filtrar_expediente' >";     
      
    /*$entidad = busca_filtro_tabla("*","entidad","","nombre",$conn);
    $select_entidad = "<select class='required' name='tipo_entidad' onchange='valores_entidad(this.value);'><option value=''>Seleccionar..</option>";
    if($entidad["numcampos"]>0)
      for($i=0; $i<$entidad["numcampos"]; $i++){ 
        if($entidad[$i]["identidad"]!=3 && $entidad[$i]["identidad"]!=5) {
          $select_entidad.="<option value=".$entidad[$i]["identidad"];
          if(@$_REQUEST["tipo_entidad"] && $entidad[$i]["identidad"]==@$_REQUEST["tipo_entidad"])
            $select_entidad.=" selected ";
          $select_entidad.=">".ucfirst($entidad[$i]["nombre"])."</option>";
        } 
      } */
      if(@$_REQUEST["tipo_entidad"])
        echo '<script>$(document).ready(function(){valores_entidad("'.$_REQUEST["tipo_entidad"].'");});</script>';
      $select_entidad.="</select>";
      echo $select_entidad;
    ?>
    <div id="sub_entidad" class="arbol_saia">
    </div>
    <label>Para quitar el permiso del listado de tareas sobre un usuario, tener en cuenta quitar la seleccion de dicho usuario en todas las partes que se encuentra sobre el arbol de funcionarios.</label>
  </div>
</div>
<!--div class="control-group element">
  <label class="control-label" for="nombre"> Acci&oacute;n*
  </label>
  <div class="controls"> 
    <input type='radio' name='opcion' value='1' checked >Adicionar&nbsp;&nbsp;
    <input type='radio' name='opcion' value='0'>Quitar
  </div>
</div-->
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
<div class="form-actions">
<button class="btn btn-primary" id="submit_formulario_asignar_expediente">Aceptar</button>
<button class="btn" id="cancel_formulario_asignar_expediente">Cancelar</button>
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
  var formulario_asignar_expediente=$("#formulario_asignar_expediente");
  formulario_asignar_expediente.validate({  
    submitHandler: function(form) {
    }
  });
  $.ajax({
    url: "<?php echo($ruta_db_superior);?>pantallas/expediente/arbol_expediente_entidad.php" ,
    data:"entidad=expediente<?php if(@$_REQUEST['filtrar_expediente']) echo '&filtrar_expediente='.$_REQUEST['filtrar_expediente']; if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad'];?>",
    type: "POST",
    success: function(msg){
      $("#divexpediente").html(msg);
    }
  });
  $("#submit_formulario_asignar_expediente").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', 'disabled');  
    if(formulario_asignar_expediente.valid()){
      $.ajax({
        type:'GET',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
        data: "ejecutar_expediente=asignar_permiso_expediente&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario_asignar_expediente.serialize(),
        success: function(html){               
          if(html){                   
            var objeto=jQuery.parseJSON(html);                  
            if(objeto.exito){              
              $('#cargando_enviar').html("Terminado ...");  
              if($("#cerrar_higslide").val()){            
                $("#arbol_padre_actualizado", parent.document).val($("#cod_padre").val());
                parent.window.hs.getExpander().close();                  
              }
              notificacion_saia(objeto.mensaje,"success","",2500);
              window.open("detalles_expediente.php?idexpediente=<?php echo(@$_REQUEST["idexpediente"]); ?>&idbusqueda_componente=<?php echo($_REQUEST['idbusqueda_componente']);?>&rand="+Math.round(Math.random()*100000),"_self");
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
//funcion para cargar los elementos de la entidad seleccionada
function valores_entidad(identidad){
  if(identidad!=""){
    $.ajax({url: "<?php echo($ruta_db_superior);?>pantallas/expediente/arbol_expediente_entidad.php" ,
      data:"entidad="+identidad+"&expedientes="+$("#expediente_idexpediente").val()+"<?php if(@$_REQUEST['tipo_entidad']) echo '&tipo_entidad='.$_REQUEST['tipo_entidad'] ; if(@$_REQUEST['llave_entidad']) echo '&llave_entidad='.$_REQUEST['llave_entidad']; ?>&seleccionado=<?php echo(implode(",",$seleccionados_array)); ?>",
      type: "POST",
      success: function(msg){
        $("#sub_entidad").html(msg);
      }
    });        
  }       
}
function todos_check(elemento,campo){
  seleccionados=elemento.getAllLeafs();
  nodos=seleccionados.split(",");
  for(i=0;i<nodos.length;i++)
    elemento.setCheck(nodos[i],true);
  document.getElementById(campo).value=elemento.getAllChecked();   
} 
function ninguno_check(elemento,campo){
  seleccionados=elemento.getAllLeafs();
  nodos=seleccionados.split(",");
  for(i=0;i<nodos.length;i++)
    elemento.setCheck(nodos[i],false);
  document.getElementById(campo).value="";
} 
</script>