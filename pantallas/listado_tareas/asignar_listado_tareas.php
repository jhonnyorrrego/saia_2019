<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."librerias_saia.php"); 
include_once($ruta_db_superior."db.php");
$xml=$ruta_db_superior."test.php?sin_padre=1&tipo_id=idfuncionario";
$campo="funcionarios";



if(@$_REQUEST['idlistado_tareas']){
	$valor=explode(',',$_REQUEST['idlistado_tareas']);
	$longitud=count($valor);
	for($i=0;$i<$longitud;$i++){
		if($valor[$i]==''){
			unset($valor[$i]); 
		}
	}
	$valor=array_values($valor);
	$valor=implode(',',$valor);	
	$_REQUEST['idlistado_tareas']=$valor;
}




$seleccionados=busca_filtro_tabla("A.llave_entidad","permiso_listado_tareas A","A.fk_listado_tareas in(".$_REQUEST["idlistado_tareas"].") AND A.entidad_identidad=1","",$conn);
if($seleccionados["numcampos"]){
	$datos_array=extrae_campo($seleccionados,"llave_entidad","U");
	$valores=implode(",", $datos_array);
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap_reescribir.css"/>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<?php
echo(librerias_arboles());
echo(librerias_notificaciones());
?>
<form name="formulario_asignar_permiso" id="formulario_asignar_permiso">
<legend>Permiso de acceso a la lista de tareas</legend>
<div class="control-group element">
	<input type="hidden" name="idlistado_tareas" id="idlistado_tareas" value="<?php echo $_REQUEST["idlistado_tareas"]; ?>" />
  <div class="controls"> 
		<div id="sub_entidad" class="arbol_saia">
			Buscar: <input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25">
			<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),1)"> 
			<img src="<?php echo($ruta_db_superior);?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
			<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value),0,1)"> 
			<img src="<?php echo($ruta_db_superior);?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
			<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem((document.getElementById('stext<?php echo $entidad; ?>').value))">
			<img src="<?php echo($ruta_db_superior);?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
			</span>
			<div id="esperando<?php echo $entidad; ?>"><img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
			<div id="treeboxbox<?php echo $entidad; ?>"></div>
			<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
			<script type="text/javascript">
			      var browserType;
			      if (document.layers) {browserType = "nn4"}
			      if (document.all) {browserType = "ie"}
			      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
			         browserType= "gecko"
			      }
						tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","","",0);
						tree<?php echo $entidad; ?>.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
						tree<?php echo $entidad; ?>.enableIEImageFix(true);
						tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
			      tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
			      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
			      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes("<?php echo $anidado;?>");
						tree<?php echo $entidad; ?>.loadXML("<?php echo $xml; ?>");
			      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
						function onNodeSelect<?php echo $entidad; ?>(nodeId)
			      {document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
			      }
			      function fin_cargando<?php echo $entidad; ?>() {
			      if (browserType == "gecko" )
			         document.poppedLayer =
			             eval('document.getElementById("esperando<?php echo $entidad; ?>")');
			      else if (browserType == "ie")
			         document.poppedLayer =
			            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
			      else
			         document.poppedLayer =
			            eval('document.layers["esperando<?php echo $entidad; ?>"]');
			      document.poppedLayer.style.display = "none";
			      document.getElementById('<?php echo $campo; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
			    }
			    
			    function cargando<?php echo $entidad; ?>() {
			      if (browserType == "gecko" )
			         document.poppedLayer =
			             eval('document.getElementById("esperando<?php echo $entidad; ?>")');
			      else if (browserType == "ie")
			         document.poppedLayer =
			            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
			      else
			         document.poppedLayer =
			             eval('document.layers["esperando<?php echo $entidad; ?>"]');
			      document.poppedLayer.style.display = "";
			    }
			 </script><br>
			
			<a onclick="todos_check(tree<?php echo $entidad; ?>,'<?php echo $campo; ?>')" href="#">TODOS</a>&nbsp;&nbsp;&nbsp;
			<a onclick="ninguno_check(tree<?php echo $entidad; ?>,'<?php echo $campo; ?>')" href="#">NINGUNO</a>
		</div>
    
  </div>
</div>

<div class="form-actions">
<button class="btn btn-mini btn-danger" id="quitar_permiso">Quitar Permiso</button>
<button class="btn btn-mini btn-primary" id="submit_formulario">Asignar Permiso</button>

<div id="cargando_enviar" class="pull-right"></div>
</div>
</form>
<table class="table table-striped" id="lista_listados_seleccionados">
<tr>
	<th>Lista</th><th>Creador</th>
</tr>
<?php
	$datos_listados=busca_filtro_tabla('','listado_tareas','idlistado_tareas in('.$_REQUEST["idlistado_tareas"].')','idlistado_tareas DESC',$conn);
	$cadena='';
	for($i=0;$i<$datos_listados['numcampos'];$i++){
		$creador=busca_filtro_tabla('','funcionario','idfuncionario='.$datos_listados[$i]["creador_lista"],'',$conn);
		$cadena.='
				<tr>
					<td>
						'.$datos_listados[$i]['nombre_lista'].'
					</td>	
					<td>
						'.$creador[0]['nombres'].' '.$creador[0]['apellidos'].'
					</td>
				</tr>	
		';
	}
	echo($cadena);
?>
</table>

<script type="text/javascript">
$(document).ready(function(){ 

  $("#submit_formulario").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', true);  
		var func_selec=$("#funcionarios").val();
		var idtarea=$("#idlistado_tareas").val();
    if(func_selec!="" && idtarea!=""){
      $.ajax({
        type:'POST',
        dataType: 'json',
        async:false,
        url: "<?php echo($ruta_db_superior);?>pantallas/listado_tareas/ejecutar_acciones.php",
        data: "ejecutar_accion=asignar_permiso_listado_tarea&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+$("#formulario_asignar_permiso").serialize(),
        success: function(objeto){               
          if(objeto.exito){              
            $('#cargando_enviar').html("Terminado ...");  
            notificacion_saia(objeto.mensaje,"success","",2500);
            window.location.reload();
          }else{
            $('#cargando_enviar').html("Terminado ...");
            notificacion_saia(objeto.mensaje,"error","",8500);
          }                  
        }
    	});
    }else{
    	notificacion_saia("Seleccione los funcionarios","error","",8500);
    	$(this).attr('disabled', false);
    }
  });  
});





$(document).ready(function(){ 

  $("#quitar_permiso").click(function(){  
    $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
		$(this).attr('disabled', true);  
		var func_selec=$("#funcionarios").val();
		var idtarea=$("#idlistado_tareas").val();
    if(func_selec!="" && idtarea!=""){
    	if(confirm('Esta seguro de QUITAR los permisos a los funcionarios seleccionados?')){
	      $.ajax({
	        type:'POST',
	        dataType: 'json',
	        async:false,
	        url: "<?php echo($ruta_db_superior);?>pantallas/listado_tareas/ejecutar_acciones.php",
	        data: "ejecutar_accion=quitar_permiso_listado_tarea&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+$("#formulario_asignar_permiso").serialize(),
	        success: function(objeto){               
	          if(objeto.exito){              
	            $('#cargando_enviar').html("Terminado ...");  
	            notificacion_saia(objeto.mensaje,"success","",2500);
	            window.location.reload();
	          }else{
	            $('#cargando_enviar').html("Terminado ...");
	            notificacion_saia(objeto.mensaje,"error","",8500);
	          }                  
	        }
	    	});
    	}else{
    		$(this).attr('disabled', false);
    		 $('#cargando_enviar').html('');
    	}
    	
    }else{
    	notificacion_saia("Seleccione los funcionarios","error","",8500);
    	$(this).attr('disabled', false);
    }
  });  
});




function edit_check(){
	campo='<?php echo $campo; ?>';
	seleccionados='<?php echo $valores;?>'
  nodos=seleccionados.split(",");
  for(i=0;i<nodos.length;i++)
    tree.setCheck(nodos[i],true);
  document.getElementById(campo).value=tree.getAllChecked();   
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


<?php

if(@$_REQUEST['idlistado_tareas']){

?>
<script>
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo($_REQUEST['idlistado_tareas']);?>",parent.document).children().addClass("documento_actual").addClass("alert-info");
  
</script>
<?php
	
}


?>
